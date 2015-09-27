<?php
namespace App\Model\Table;

use App\Model\Entity\Organization;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Organizations Model
 */
class OrganizationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('organizations');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasOne('Users', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('Addresses', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('Contacts', [
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('Sectors', [
            'className' => 'Organizations',
            'foreignKey' => 'organization_id'
        ]);
        $this->hasMany('Permissions', [
            'foreignKey' => 'organization_id'
        ]);
        $this->belongsToMany('People', [
            'through' => 'OrganizationsPeople',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');
            
        $validator
            ->allowEmpty('region');
            
        $validator
            ->allowEmpty('care_type');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['organization_id'], 'Organizations'));
        return $rules;
    }
    
    /**
     * Finds the organzations that have no users yet
     * Encontra as organizacões que ainda não possuem usuários
     * 
     * Um usuário pode ter permissão de criar um usuário para
     * qualquer organizacão ($local_only = false)
     * ou somente para a unidade local ($local_only = true)
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findNoUsers(Query $query, array $options) {
        $condition[] = ['Organizations.id NOT IN' => $this->People->Users->find('all', ['fields' => 'organization_id', 
                        'conditions' => ['organization_id IS NOT' => null]])];
        
        if ($options['local_only']) {
            $condition[] = ['id =' => $options['organization_id']];         
        }
        return $this->find('list')->where($condition);
    }
    
    /**
     * Encontra a organização na qual um gestor pode dar permissões
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findAllowed(Query $query, array $options) {
        $condition = ['name IS NOT' => null];
        
        if($options['local_only']) {
            $condition = ['id' => $options['organization_id']];         
        }
        return $this->find('list')->where($condition);
    }
}

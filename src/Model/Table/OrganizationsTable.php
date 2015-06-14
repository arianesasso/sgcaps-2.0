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
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
    
    /**
     * Finds the organzations that are not users yet.
     * Encontra as organizacões que ainda não são usuários.
     * 
     * Se o usuário for do tipo gestor_caps ele poderá dar permissões somente à 
     * sua unidade. No entanto, um gestor 'geral' pode dar permissões à todas.
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findNoUsers(Query $query, array $options) {
        $condition = ['user_id IS' => null];
        
        if(array_search('gestor_geral', $options['roles']) === false) {
            $condition[] = ['id =' => $options['organization_id']];         
        }       
        return $this->find('list')->where($condition);
    }
    
    /**
     * Finds the organizations in which a manager user can give permissions
     * If the manager is a 'gestor_caps' it can only give permission in its Caps
     * If the manager is a 'gestor_geral' it can give all kinds of permissions
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findAllowed(Query $query, array $options) {
        $condition = ['name IS NOT' => null];
        
        if(array_search('gestor_geral', $options['roles']) === false) {
            $condition = ['id' => $options['organization_id']];         
        }
        return $this->find('list')->where($condition);
    }
}

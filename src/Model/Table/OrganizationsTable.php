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
     * Finds the organzations that are not users yet
     * Encontra as organizacões que ainda não são usuários
     * 
     * Se o usuário for um gestor 'geral' ele poderá dar permissões à todas as unidades
     * Caso contrário, ele poderá dar permissões somente à sua unidade
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findNoUsers(Query $query, array $options) {
        $condition[] = ['Organizations.id NOT IN' => $this->People->Users->find('all', ['fields' => 'organization_id', 
                        'conditions' => ['organization_id IS NOT' => null]])];
        
        if(array_search('gestor.geral', $options['roles']) === false) {
            $condition[] = ['id =' => $options['organization_id']];         
        }    
        pr($this->find('list')->where($condition));
        return $this->find('list')->where($condition);
    }
    
    /**
     * Encontra a organização na qual um gestor pode dar permissões
     * Se o gestor for um 'gestor.geral' ele poderá dar permissões em qualquer unidade,
     * se ele for um gestor mais restrito (ex.: gestor.caps) só poderá dar permissões
     * para a sua unidade
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findAllowed(Query $query, array $options) {
        $condition = ['name IS NOT' => null];
        
        if(array_search('gestor.geral', $options['roles']) === false) {
            $condition = ['id' => $options['organization_id']];         
        }
        return $this->find('list')->where($condition);
    }
}

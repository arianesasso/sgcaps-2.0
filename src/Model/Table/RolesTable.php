<?php
namespace App\Model\Table;

use App\Model\Entity\Role;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Roles Model
 */
class RolesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('roles');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('Permissions', [
            'foreignKey' => 'role_id'
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

        return $validator;
    }
    
     /**
     * Finds the roles a manager user can give
     * If the manager is a 'gestor_caps' it can only give Caps permissions
     * If the manager is a 'gestor_geral' it can give all kinds of permissions
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findAllowed(Query $query, array $options) {
        $condition = ['name IS NOT' => null];
        
        if(array_search('gestor_caps', $options['roles']) !== false) {
            $condition = ['name LIKE' => '%Caps%'];         
        }
        return $this->find('list')->where($condition);
    }
}

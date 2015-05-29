<?php

namespace App\Model\Table;

use App\Model\Entity\Permission;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Permissions Model
 */
class PermissionsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('permissions');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'admin_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->add('id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('id', 'create');

        $validator
                ->add('beginning', 'valid', ['rule' => 'datetime'])
                ->requirePresence('beginning', 'create')
                ->notEmpty('beginning');

        $validator
                ->add('ending', 'valid', ['rule' => 'datetime'])
                ->allowEmpty('ending');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['organization_id'], 'Organizations'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));
        $rules->add($rules->existsIn(['admin_id'], 'Users'));
        return $rules;
    }

    /**
     * Finds the user validy roles for a given organization
     * Encontra os papéis válidos de um usuário em uma dada organização
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findValidyRoles(Query $query, array $options) {
        $fields = [
            'Roles.name',
        ];
        return $this->find('list', ['valueField' => 'Roles.name'])
                        ->select($fields)
                        ->distinct($fields)
                        ->where(['Permissions.user_id' => $options['user_id'],
                                 'Permissions.organization_id' => $options['organization_id'],
                                 'OR' => [['Permissions.ending >=' => date('Y-m-d H:i:s')],
                                          ['Permissions.ending IS' => null]],
                                ])
                        ->contain('Roles');
    }

    /**
     * Finds the Organizations in which the user has validy permissions
     * Encontra as organizações nas quais o usuário tem permissões válidas
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findValidyOrganizations(Query $query, array $options) {
        $fields = [
            'Organizations.name',
            'Organizations.id'
        ];
        return $this->find()
                        ->select($fields)
                        ->distinct($fields)
                        ->where(['Permissions.user_id' => $options['user_id'],
                                 'OR' => [['Permissions.ending >=' => date('Y-m-d H:i:s')], 
                                          ['Permissions.ending IS' => null]],
                                ])
                        ->contain('Organizations');
    }

}

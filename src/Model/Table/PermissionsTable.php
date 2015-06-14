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
        $this->belongsTo('Admins', [
            'className' => 'Users',
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
                ->requirePresence('organization_id', 'create')
                ->notEmpty('organization_id', 'Campo obrigatório');
        
        $validator
                ->requirePresence('role_id', 'create')
                ->notEmpty('role_id', 'Campo obrigatório');

        $validator
                ->add('beginning', 'valid', ['rule' => 'date'])
                ->requirePresence('beginning', 'create')
                ->notEmpty('beginning', 'Campo obrigatório');

        $validator
                ->add('ending', 'valid', ['rule' => 'date'])
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
            'Roles.alias'
        ];
        return $this->find('list', ['valueField' => 'Roles.alias'])
                        ->select($fields)
                        ->distinct($fields)
                        ->where(['Permissions.user_id' => $options['user_id'],
                                 'Permissions.organization_id' => $options['organization_id'],
                                 'Permissions.beginning <=' => date('Y-m-d H:i:s'),
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
                                 'Permissions.beginning <=' => date('Y-m-d H:i:s'),
                                 'OR' => [['Permissions.ending >=' => date('Y-m-d H:i:s')],
                                          ['Permissions.ending IS' => null]],
                                ])
                        ->contain('Organizations');
    }
    
    /**
     * Finds if the permission that is going to be granted is still valid
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findStillValid(Query $query, array $options) {
        return $this->find()
                        ->where(['user_id' => $options['user_id'],
                                 'role_id' => $options['role_id'],
                                 'organization_id' => $options['organization_id'],
                                 'Permissions.beginning <=' => date('Y-m-d H:i:s'),
                                 'OR' => [['Permissions.ending >=' => date('Y-m-d H:i:s')],
                                          ['Permissions.ending IS' => null]],
                                ]);
    }
    
    /**
     * Finds the permissions a manager can see
     * If the manager is a 'gestor_caps' he/she can only see the permissions
     * that the user has in her/his unit
     * If the user is a 'gestor_geral' he/she can see all the users permissions
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findAllowedValidy(Query $query, array $options) {
        $query = $this->find()
                ->where(['Permissions.user_id' => $options['id'],
                    'OR' => ['Permissions.ending IS' => null,
                        'Permissions.ending >=' => date('Y-m-d H:i:s')
                    ]
                ])
                ->contain(['Roles', 'Organizations', 'Admins.People'])
                ->order(['Organizations.name', 'Permissions.beginning']);
        
        if (array_search('gestor_geral', $options['roles']) === false) {
            $query = $this->find()->where(['Permissions.user_id' => $options['id'],
                             'Permissions.organization_id' => $options['organization_id'],
                             'OR' => ['Permissions.ending IS' => null,
                                      'Permissions.ending >=' => date('Y-m-d H:i:s')
                            ]
                        ])
                 ->contain(['Roles', 'Organizations', 'Admins.People'])
                 ->order(['Organizations.name', 'Permissions.beginning']);
        }
        return $query;
    }
}

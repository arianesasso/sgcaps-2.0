<?php

namespace App\Model\Table;

use App\Model\Entity\Permission;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

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
                ->add('beginning', ['isDate' => ['rule' => 'date'],
                                    'validateDate' => ['rule' => [$this,'validateDate'], 'message' => 'Data inválida', 'last' => true]
                                   ])
                ->requirePresence('beginning', 'create')
                ->notEmpty('beginning', 'Campo obrigatório');

        $validator
                ->add('ending', ['isDate' => ['rule' => 'date', 'on' => 'create'],
                                 'validateDate' => ['rule' => [$this,'validateDate'], 'on' => 'create', 'message' => 'Data inválida', 'last' => true],
                                 'biggerThanBeginning' => ['rule' => [$this, 'compareDates'],  'on'=> 'create', 'message' => 'Esta data deve ser maior que a data de início']
                                ])
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
     * Verifica se a data escolhida para início ou fim de uma dada permissão
     * não é menor do que a data atual
     * 
     * @param type $field Data de início ou fim de uma dada permissão
     * @return boolean
     */
    public function validateDate($field) {
        $date = Time::createFromFormat('Y-m-d', trim(implode("-", $field)));
        $currentDate = Time::now();
        if($date < $currentDate) {
            return false;
        }
        return true;
    }
    
    /**
     * Verifica se a data final da validade é maior que a data de início
     * 
     * @param type $field Data de fim da validade
     * @param type $record Todas as informações relativas a permissão
     * @return boolean
     */
    public function compareDates($field, $record) {
        $ending = Time::createFromFormat('Y-m-d', trim(implode("-", $field)));
        $beginning = Time::createFromFormat('Y-m-d', trim(implode("-", $record['data']['beginning'])));
        if($ending <= $beginning) {
            return false;
        }
        return true;
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
            'Roles.alias',
            'Roles.domain'
        ];
        return $this->find()->hydrate(false)
                        ->select($fields)
                        ->distinct($fields)
                        ->where(['Permissions.user_id' => $options['user_id'],
                                 'Permissions.organization_id' => $options['organization_id'],
                                 'Permissions.beginning <=' => date('Y-m-d H:i:s'),
                                 'OR' => [['Permissions.ending >' => date('Y-m-d H:i:s')],
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
                                 'OR' => [['Permissions.ending >' => date('Y-m-d H:i:s')],
                                          ['Permissions.ending IS' => null]],
                                ])
                        ->contain('Organizations');
    }
    
    /**
     * Finds if the permission that is going to be granted is still valid
     * Descobre se a permissão a ser garantida é válida ainda
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findStillValid(Query $query, array $options) {
        $beginning = Time::createFromFormat('Y-m-d', trim(implode("-", $options['beginning'])))->format('Y-m-d');
        $ending = Time::createFromFormat('Y-m-d', trim(implode("-", $options['ending'])))->format('Y-m-d');
        return $this->find()
                        ->where(['user_id' => $options['user_id'],
                                 'role_id' => $options['role_id'],
                                 'organization_id' => $options['organization_id'],
                                 'AND' =>['OR' => [['Permissions.ending >' => date('Y-m-d H:i:s')],
                                                  ['Permissions.ending IS' => null]]],
                                 'OR' => [['AND' => ['Permissions.ending >=' => $ending],
                                                    ['Permissions.beginning <=' => $ending]
                                          ],
                                          ['AND' => ['Permissions.ending >=' => $beginning],
                                                    ['Permissions.ending <' => $ending]
                                          ]
                                         ],
                                  ]);
    }
    
    /**
     * Finds the validy permissions a manager can see.
     * If the user is a 'gestor.geral' he/she can see all the users permissions
     * Otherwise he/she can only see the permissions that the user has in 
     * her/his current unit.
     * 
     * Encontra as permissões válidas que um gestor pode ver.
     * Se ele for um 'gestor.geral' poderá ver todas as permissões de um usuário.
     * Caso contrário, ele só poderá ver as permissões do usuário na unidade na qual
     * está logado.
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findAllowedValidy(Query $query, array $options) {
        $query = $this->find()
                ->where(['Permissions.user_id' => $options['id'],
                    'OR' => ['Permissions.ending IS' => null,
                        'Permissions.ending >' => date('Y-m-d H:i:s')
                    ]
                ])
                ->contain(['Roles', 'Organizations', 'Admins.People', 'Admins.Organizations'])
                ->order(['Organizations.name', 'Permissions.beginning']);
        
        if (array_search('gestor.geral', $options['roles']) === false) {
            $query = $this->find()->where(['Permissions.user_id' => $options['id'],
                             'Permissions.organization_id' => $options['organization_id'],
                             'OR' => ['Permissions.ending IS' => null,
                                      'Permissions.ending >' => date('Y-m-d H:i:s')
                            ]
                        ])
                 ->contain(['Roles', 'Organizations', 'Admins.People', 'Admins.Organizations'])
                 ->order(['Organizations.name', 'Permissions.beginning']);
        }
        return $query;
    }
}

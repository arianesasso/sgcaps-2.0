<?php

namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 */
class UsersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id'
        ]);
        $this->belongsTo('People', [
            'foreignKey' => 'person_id'
        ]);
        $this->hasMany('Permissions', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Admins', [
            'classname' => 'Users',
            'foreignKey' => 'admin_id'
        ]);
    }
    
    /**
     * Verifica se as duas senhas digitadas são idênticas
     * 
     * @param type $field  Primeira senha digitada
     * @param type $record Todas as informações relativas ao usuário
     * @return boolean
     */
    public function requireVerification($field, $record) {
        if(!empty($field) && $field != $record['data']['retype_password']) {
            return false;
        }
        return true;
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
                ->add('person_id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('person_id', 'create');

        $validator
                ->add('organization_id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('organization_id', 'create');

        $validator
                ->requirePresence('username', 'create')
                ->notEmpty('username', 'Campo obrigatório', 'create');

        $validator
                ->add('password', ['require_verification' => ['rule' => [$this,'requireVerification'], 'message' => 'Preenhca o campo abaixo']])
                ->requirePresence('password', 'create')
                ->notEmpty('password', 'Campo obrigatório', 'create');
              
        $validator
                ->add('retype_password', ['isEqual' => ['rule' => ['compareWith', 'password'], 'message' => 'As senhas devem ser idênticas']])
                ->requirePresence('retype_password', 'create')
                ->notEmpty('retype_password', 'Campo obrigatório', 'create');
        
        $validator
                ->add('active', 'valid', ['rule' => 'boolean'])
                ->requirePresence('active', 'create')
                ->notEmpty('active', 'create');

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
        $rules->add($rules->existsIn(['person_id'], 'People', 'O profissionals precisa existir'));
        $rules->add($rules->existsIn(['organization_id'], 'Organizations', 'A unidade precisa existir'));
        $rules->add($rules->isUnique(['username'], 'Usuário já existente'));
        return $rules;
    }

    /**
     * Encontra os usuários que um gestor pode ver.
     * Se o gestor for do tipo 'gestor.geral' poderá ver todos os usuários.
     * Se não, só poderá ver os usuários que tem ou já tiveram permissões na sua
     * unidade.
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findAllowed(Query $query, array $options) {
        $fields = ['Users.id'];

        $query = $this->find()
                ->distinct($fields)
                ->contain(['People', 'Organizations']);

        if (array_search('gestor.geral', $options['roles']) === false) {
            $query = $this->find()->distinct($fields)
                    ->contain(['People', 'Organizations'])
                    ->matching('Permissions', function ($q) use ($options) {
                        return $q->where(['Permissions.organization_id' => $options['organization_id']])
                                 ->distinct();
            });
        }
        return $query;
    }

}

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

        $this->hasOne('Organizations', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('People', [
            'foreignKey' => 'user_id'
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
                ->requirePresence('username', 'create')
                ->notEmpty('username', 'Campo obrigatório', 'create');

        $validator
                ->requirePresence('password', 'create')
                ->notEmpty('password', 'Campo obrigatório', 'create');

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

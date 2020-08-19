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
        $this->setTable('roles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasMany('Permissions', [
            'foreignKey' => 'role_id'
        ]);
        $this->belongsToMany('Actions', [
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'action_id',
            'joinTable' => 'actions_roles'
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
            ->add('name', ['maxLength' => [
                            'rule' => ['maxLength', 250],
                            'message' => 'O nome ultrapassou o tamanho máximo permitido'
                          ],
                          'onlyLettersAndSpaces' => [
                            'rule' => array('custom', '/^[\pL\s]+$/u'),
                            'message' => 'O nome deve conter somente letras e espaços'
                          ]
             ])
            ->notEmpty('name');

        $validator
            ->requirePresence('alias', 'create')
            ->notEmpty('alias');

        $validator
            ->requirePresence('domain', 'create')
            ->notEmpty('domain');

        return $validator;
    }

    /**
     * @TODO   Exibir esse tipo de validação com dois campos corretamente na tela
     * @param  RulesChecker $rules
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['alias' , 'domain'], 'Esse papel já existe'));
        $rules->addDelete(function ($entity, $options) {
            $count = $this->Permissions->find("all", ["conditions" => ["role_id" => $entity->id]])->count();
            if ($count == 0) {
                return true;
            } else {
                return false;
            }
        }, 'preventDelete');
        return $rules;
    }

     /**
     * Finds the roles a user user can give
     *
     * @TODO  Melhorar esse método, pois ele só recupera permissões de CAPS para o caso local
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findAllowed(Query $query, array $options) {
        $condition = ['name IS NOT' => null];

        if($options['local_only']) {
            $condition = ['domain' => 'caps'];
        }
        return $this->find('list')->where($condition);
    }
}

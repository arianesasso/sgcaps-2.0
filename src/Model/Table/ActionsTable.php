<?php
namespace App\Model\Table;

use App\Model\Entity\Action;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Actions Model
 */
class ActionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->setTable('actions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsToMany('Roles', [
            'foreignKey' => 'action_id',
            'targetForeignKey' => 'role_id',
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
            ->add('name', ['maxLength' => [
                            'rule' => ['maxLength', 250],
                            'message' => 'O nome ultrapassou o tamanho máximo permitido'
                          ],
                          'onlyLettersAndSpaces' => [
                            'rule' => array('custom', '/^[\pL\s]+$/u'),
                            'message' => 'O nome deve conter somente letras e espaços'
                          ]
             ])
            ->requirePresence('name', 'create')
            ->notEmpty('name');
        $validator
            ->requirePresence('alias', 'create')
            ->notEmpty('alias');
        $validator
            ->requirePresence('controller', 'create')
            ->notEmpty('controller');
        $validator
            ->requirePresence('action', 'create')
            ->notEmpty('action');

        return $validator;
    }

     /**
     * Método para encontrar as ações que um determinado usuário pode realizar
     * dadas suas permissões correntes
     *
     * @param Query $query
     * @param array $options | $options['roles_ids'] => ids dos papéis/roles que o usuário possui na unidade atual
     * @return type
     */
    public function findAllowedActions(Query $query, array $options) {
        $fields = ['alias', 'controller', 'action'];
        $allowedActions = $this->find('all', ['fields' => $fields])
                               ->distinct()
                               ->matching('Roles', function ($q) use ($options) {
                                        return $q->where(['Roles.id IN' => $options['roles_ids']]);
        });
        return $allowedActions;
    }

    /**
     * @TODO   Fazer com que essa validação seja exibida
     * @param  RulesChecker $rules
     * @return RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['alias'], 'Uma ação com esse nome já existe'));
        return $rules;
    }
}

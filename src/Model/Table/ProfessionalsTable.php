<?php
namespace App\Model\Table;

use App\Model\Entity\Professional;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Professionals Model
 */
class ProfessionalsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('professionals');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('People', [
            'foreignKey' => 'person_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'board_state_id'
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
            ->allowEmpty('board_acronym');
            
        $validator
            ->allowEmpty('board_number');

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
        $rules->add($rules->existsIn(['person_id'], 'People'));
        $rules->add($rules->existsIn(['board_state_id'], 'States'));
        return $rules;
    }
       
    /**
     * Finds the professionals that are not users
     * Encontra os profissionais que não são usuários
     * 
     * @param Query $query
     * @param array $options
     * @return type
     */
    public function findNoUsers(Query $query, array $options) {
        $fields = [
            'People.id',
            'People.name'
        ];
        return $this->find('list',['keyField' => 'People.id', 'valueField' => 'People.name'])
                        ->select($fields)
                        ->where(['user_id IS' => null])
                        ->contain('People'  );
    }
}

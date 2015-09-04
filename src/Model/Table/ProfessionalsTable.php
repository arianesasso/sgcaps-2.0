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
            ->allowEmpty('board_acronym', 'valid', ['rule' => 'string', 'message' => 'Digite somente letras']);
            
        $validator
            ->add('board_number', 'valid', ['rule' => 'alphaNumeric', 'message' => 'Digite somente números e letras'])
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
     * O método busca os profissionais que ainda não são usuários e que estão 
     * vinculados atualmente a unidade na qual o usuário atual está logado
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

        $condition[] = ['Professionals.person_id NOT IN' => $this->People->Users->find('all', ['fields' => 'person_id']), 
                        'OrganizationsPeople.organization_id' => $options['organization_id'],
                        'OR' => ['OrganizationsPeople.ended IS' => null,
                        'OrganizationsPeople.ended >=' => date('Y-m-d H:i:s')]];
        $matching = 'People.Organizations';

        return $this->find()
                        ->select($fields)
                        ->contain('People')
                        ->matching($matching)
                        ->where($condition);
    }
}

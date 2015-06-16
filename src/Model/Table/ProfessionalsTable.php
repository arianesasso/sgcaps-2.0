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
     * Se o usuário logado for um 'gestor.geral' o método busca
     * todos os profissionais que não são usuários ainda
     * 
     * Caso o gestor seja mais restrito o método busca os profissionais que 
     * não são usuários e que estão vinculados à unidade na qual o usuário atual 
     * está logado
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
        $condition = ['People.user_id IS' => null];
        $matching = 'People';

        if(array_search('gestor.geral', $options['roles']) === false) {
            $condition[] = ['OrganizationsPeople.organization_id' => $options['organization_id'],
                            'OR' => ['OrganizationsPeople.ended IS' => null, 
                                     'OrganizationsPeople.ended >=' => date('Y-m-d H:i:s')]];
            $matching = $matching . '.Organizations';          
        }
              
        return $this->find()
                        ->select($fields)
                        ->matching($matching)
                        ->where($condition);
    }
}

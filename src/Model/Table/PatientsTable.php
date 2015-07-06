<?php
namespace App\Model\Table;

use App\Model\Entity\Patient;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Patients Model
 */
class PatientsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('patients');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('People', [
            'foreignKey' => 'person_id',
            'joinType' => 'INNER'
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
            ->add('cns', 'custom', ['rule' => [$this,'validateCns'], 'message' => 'CNS inválido'])
            ->allowEmpty('cns');
            
        $validator
            ->allowEmpty('marital_status');
            
        $validator
            ->add('approximate_age', 
                    ['valid' => ['rule' => 'numeric', 'message' => 'Valor inválido', 'last' => true],
                     'range' => ['rule' => ['range', 1, 150], 'message' => 'Valor inválido']
                    ])
            ->allowEmpty('approximate_age');
            
        $validator
            ->allowEmpty('ethnicity');
            
        $validator
            ->allowEmpty('observation');

        return $validator;
    }
    
    /**
     * Função para validar CNS segundo rotina de validação definida no site
     * abaixo
     * 
     * @see http://cartaonet.datasus.gov.br/
     * @param type $field O campo que está sendo validado
     * @return boolean
     */
    public function validateCns($field) {
        //O campo vem com __ por causa da máscara do jquery
        $cns = str_replace('_', '', $field);
        //Verifico se o CNS tem exatamente 15 dígitos
        if ((strlen(trim($cns))) != 15) {
            return false;
        }
        //Caso tenha 15 dígitos, uso as regras de validação do site do cartão SUS
        if($cns[0] == 1 || $cns[0] == 2) {
            return $this->__validateCns12($cns);
        } 
        if($cns[0] == 7 || $cns[0] == 8 || $cns[0] == 9) {
            return $this->__validateCns789($cns);
        }
        return false;
    }
    
    /**
     * Função que valida números começados em 1 ou 2
     * 
     * @param type $cns Número do CNS
     * @return boolean
     */
    private function __validateCns12($cns){
        $pis = substr($cns, 0, 11);
        $soma = (((substr($pis, 0, 1)) * 15) +
                ((substr($pis, 1, 1)) * 14) +
                ((substr($pis, 2, 1)) * 13) +
                ((substr($pis, 3, 1)) * 12) +
                ((substr($pis, 4, 1)) * 11) +
                ((substr($pis, 5, 1)) * 10) +
                ((substr($pis, 6, 1)) * 9) +
                ((substr($pis, 7, 1)) * 8) +
                ((substr($pis, 8, 1)) * 7) +
                ((substr($pis, 9, 1)) * 6) +
                ((substr($pis, 10, 1)) * 5));
        $resto = fmod($soma, 11);
        $dv = 11 - $resto;
        if ($dv == 11) {
            $dv = 0;
        }
        if ($dv == 10) {
            $soma = ((((substr($pis, 0, 1)) * 15) +
                    ((substr($pis, 1, 1)) * 14) +
                    ((substr($pis, 2, 1)) * 13) +
                    ((substr($pis, 3, 1)) * 12) +
                    ((substr($pis, 4, 1)) * 11) +
                    ((substr($pis, 5, 1)) * 10) +
                    ((substr($pis, 6, 1)) * 9) +
                    ((substr($pis, 7, 1)) * 8) +
                    ((substr($pis, 8, 1)) * 7) +
                    ((substr($pis, 9, 1)) * 6) +
                    ((substr($pis, 10, 1)) * 5)) + 2);
            $resto = fmod($soma, 11);
            $dv = 11 - $resto;
            $resultado = $pis . "001" . $dv;
        } else {
            $resultado = $pis . "000" . $dv;
        }
        if ($cns != $resultado) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * Função que valida números começados em 7 ou 8 ou 9
     * 
     * @param type $cns Número do CNS
     * @return boolean
     */
    private function __validateCns789($cns) {
        $soma = (((substr($cns, 0, 1)) * 15) +
                ((substr($cns, 1, 1)) * 14) +
                ((substr($cns, 2, 1)) * 13) +
                ((substr($cns, 3, 1)) * 12) +
                ((substr($cns, 4, 1)) * 11) +
                ((substr($cns, 5, 1)) * 10) +
                ((substr($cns, 6, 1)) * 9) +
                ((substr($cns, 7, 1)) * 8) +
                ((substr($cns, 8, 1)) * 7) +
                ((substr($cns, 9, 1)) * 6) +
                ((substr($cns, 10, 1)) * 5) +
                ((substr($cns, 11, 1)) * 4) +
                ((substr($cns, 12, 1)) * 3) +
                ((substr($cns, 13, 1)) * 2) +
                ((substr($cns, 14, 1)) * 1));
        $resto = fmod($soma, 11);
        if ($resto != 0) {
            return false;
        } else {
            return true;
        }
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
        return $rules;
    }
}

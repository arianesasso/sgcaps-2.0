<?php

namespace App\Model\Table;

use App\Model\Entity\Person;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

/**
 * People Model
 */
class PeopleTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('people');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->hasOne('Users', [
            'foreignKey' => 'person_id'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'rg_state_id'
        ]);
        $this->belongsTo('Occupations', [
            'foreignKey' => 'occupation_id',
            'joinType' => 'LEFT',
        ]);
        $this->hasMany('Addresses', [
            'foreignKey' => 'person_id'
        ]);
        $this->hasMany('Contacts', [
            'foreignKey' => 'person_id'
        ]);
        $this->hasOne('Patients', [
            'foreignKey' => 'person_id'
        ]);
        $this->hasOne('Professionals', [
            'foreignKey' => 'person_id'
        ]);
        $this->belongsToMany('Organizations', [
            'through' => 'OrganizationsPeople',
        ]);
    }
    
    /**
     * Verifica se todas as infos relativas ao rgh estão preenchidas
     * simultaneamente
     * 
     * @param type $field  RG ou RG - UF
     * @param type $record Todas as informações relativas ao usuário
     * @return boolean
     */
    public function requireRgInfo($field, $record) {
        if(!empty($field) && empty($record['data']['rg'])) {
            return false;
        }
        if(!empty($field) && empty($record['data']['rg_state_id'])) {
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
    public function validationDefault(Validator $validator)
    {
        $validator
                ->add('id', 'valid', ['rule' => 'numeric'])
                ->allowEmpty('id', 'create');

        $validator
                ->requirePresence('name', 'create')
                ->notEmpty('name', 'Campo obrigatório');

        $validator
                ->requirePresence('gender', 'create')
                ->notEmpty('gender', 'Campo obrigatório');

        $validator
                ->add('rg', 
                        ['valid' => ['rule' => 'alphaNumeric', 'message' => 'Digite somente números e letras', 'last' => true],
                         'require_verification' => ['rule' => [$this,'requireRgInfo'], 'message' => 'Preencha o estado do RG']
                        ])
                ->allowEmpty('rg');
        
        $validator
                ->add('rg_state_id', [                  
                         'require_verification' => ['rule' => [$this,'requireRgInfo'], 'message' => 'Preencha o RG']
                     ])
                ->allowEmpty('rg_state_id');

        $validator
                ->add('birthdate', ['isDate' => ['rule' => ['date', 'dmy'], 'message' => 'Data inválida', 'last' => true], 'validateBirhdate' => ['rule' => [$this,'validateBirhdate'], 'message' => 'Data inválida']])
                ->allowEmpty('birthdate');
        
        $validator
                ->add('cpf', 'custom', ['rule' => [$this,'validateCpf'], 'message' => 'CPF inválido'])
                ->allowEmpty('cpf');

        $validator
                ->allowEmpty('occupation');

        return $validator;
    }
    
    /**
     * Função para validar CPF segundo rotina de validação definida no site
     * abaixo
     * 
     * @see http://www.geradorcpf.com/algoritmo_do_cpf.htm
     * @param type $field O campo que está sendo validado
     * @return boolean
     */
    public function validateCpf($field) {
        //O campo vem com _ por causa da máscara do jquery
        $cpf = str_replace(['.','-'], ['',''], $field);
        //Verifico se o CPF tem exatamente 11 dígitos
        if ((strlen(trim($cpf))) != 11) {
            return false;
        }
        
        $digits = ['0','0'];
        //Calcula o primeiro dígito de verificação.
        $j = 0;
        for($i = 10; $i >= 2; $i--) {
            $digits[0] += $i*$cpf[$j];
            $j++;
        }
        $digits[0] = $digits[0]%11;
        if($digits[0] < 2) {
            $digits[0] = 0;
        } else {
            $digits[0] = 11-$digits[0];
        }

        //Calcula o segundo dígito de verificação.
        $j = 0;
        for($i = 11; $i >= 3; $i--) {
            $digits[1] += ($i)*$cpf[$j];
            $j++;
        }
        $digits[1] += 2*$digits[0];
        $digits[1] = $digits[1]%11;
        if($digits[1] < 2) {
            $digits[1] = 0;
        } else {
            $digits[1] = 11-$digits[1];
        }
        //Retorna Verdadeiro se os dígitos de verificação são os esperados.
        return ($digits[0] == $cpf[9] && $digits[1] == $cpf[10]) ? true : false;
    }
    
    /**
     * Valida se o ano da data de nascimento não é menor do que 100 anos no
     * passado ou maior que um ano atrás
     * 
     * @param type $field O campo a ser validado (no caso a data de nascimento)
     * @return boolean
     */
    public function validateBirhdate($field) {
        if(empty($field)) {
            return true;
        }
        $date = Time::createFromFormat('d/m/Y', trim($field));
        $year = $date->format('Y');
        $currentYear = Time::now()->format('Y');
        if($year > ($currentYear-1) || $year <=  ($currentYear-120)) {
            return false;
        }
        return true;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['rg_state_id'], 'States', 'O estado precisa existir'));
        $rules->add($rules->isUnique(['cpf'], 'CPF já existente'));
        $rules->add($rules->isUnique(['rg' , 'rg_state_id'], 'RG já existente'));
        return $rules;
    }

}

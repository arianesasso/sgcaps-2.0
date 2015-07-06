<?php

namespace App\Model\Table;

use App\Model\Entity\Person;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'rg_state_id'
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
                ->requirePresence('name')
                ->notEmpty('name', 'Campo obrigatório');

        $validator
                ->requirePresence('gender')
                ->notEmpty('gender', 'Campo obrigatório');

        $validator
                ->add('rg', 'valid', ['rule' => 'alphaNumeric', 'message' => 'Digite somente números e letras'])
                ->allowEmpty('rg');

        $validator
                ->add('birthdate', 'valid', ['rule' => ['date', 'dmy'], 'message' => 'Data inválida'])
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
        //O campo vem com __ por causa da máscara do jquery
        $cpf = str_replace(['.','-'], '', $field);
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
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['user_id'], 'Users', 'O usuário precisa existir'));
        $rules->add($rules->existsIn(['rg_state_id'], 'States', 'O estado precisa existir'));
        $rules->add($rules->isUnique(['cpf'], 'CPF já existente'));
        return $rules;
    }

}

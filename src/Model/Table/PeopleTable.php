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
                ->allowEmpty('rg');

        $validator
                ->add('birthdate', 'valid', ['rule' => ['date', 'dmy']])
                ->allowEmpty('birthdate');

        $validator
                ->allowEmpty('occupation');

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
        $rules->add($rules->existsIn(['user_id'], 'Users', 'O usuário precisa existir'));
        $rules->add($rules->existsIn(['rg_state_id'], 'States', 'O estado precisa existir'));
        $rules->add($rules->isUnique(['cpf'], 'CPF já existente'));
        return $rules;
    }

}

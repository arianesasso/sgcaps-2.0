<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Time;

/**
 * Person Entity.
 */
class Person extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'name' => true,
        'gender' => true,
        'cpf' => true,
        'rg' => true,
        'rg_state_id' => true,
        'birthdate' => true,
        'occupation' => true,
        'user' => true,
        'state' => true,
        'addresses' => true,
        'contacts' => true,
        'patients' => true,
        'professionals' => true,
    ];

    protected function _setBirthdate($value) {
        $data = new Time($value);
        return $data->format('Y-m-d');
    }

}

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
        'name' => true,
        'gender' => true,
        'cpf' => true,
        'rg' => true,
        'rg_state_id' => true,
        'birthdate' => true,
        'occupation_id' => true,
        'occupation' => true,
        'user' => true,
        'state' => true,
        'addresses' => true,
        'contacts' => true,
        'patients' => true,
        'professionals' => true,
        'organizations' => true,
    ];

    protected function _setBirthdate($value) {
        $date = null;
        if (!empty($value)) {
            $date = Time::createFromFormat('d/m/Y', trim($value));
            $date->format('Y-m-d');
        }
        return $date;
    }

    protected function _setCpf($value) {
        return empty($value) ? null : str_replace([".", "-"], ["", ""], $value);
    }

    protected function _setName($value) {
        return mb_strtoupper(trim($value));
    }

    protected function _setRg($value) {
        return empty($value) ? null : str_replace("_", "", $value);
    }

    protected function _setOccupationId($value) {
        return empty($value) ? null : mb_strtoupper($value);
    }

}

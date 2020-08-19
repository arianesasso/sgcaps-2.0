<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Patient Entity.
 */
class Patient extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'person_id' => true,
        'cns' => true,
        'marital_status' => true,
        'approximate_age' => true,
        'ethnicity' => true,
        'observation' => true,
        'person' => true,
    ];

    protected function _setObservation($value) {
        return empty($value)? null : trim($value);
    }

    protected function _setMaritalStatus($value) {
        return empty($value)? null : $value;
    }

    protected function _setEthnicity($value) {
        return empty($value)? null : $value;
    }

    protected function _setCns($value) {
        return empty($value)? null : str_replace('_','',trim($value));
    }
}

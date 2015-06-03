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
}

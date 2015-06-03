<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Professional Entity.
 */
class Professional extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'person_id' => true,
        'board_acronym' => true,
        'board_number' => true,
        'board_state_id' => true,
        'person' => true,
        'state' => true,
    ];
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Occupation Entity.
 */
class Occupation extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'cbo_id' => true,
        'description' => true,
        'version' => true,
        'cbo' => true,
    ];
}

<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Action Entity.
 */
class Action extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'alias' => true,
        'controller' => true,
        'action' => true,
        'roles' => true,
    ];
}

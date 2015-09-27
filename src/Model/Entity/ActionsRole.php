<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActionsRole Entity.
 */
class ActionsRole extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'role_id' => true,
        'action_id' => true,
        'modifieds' => true,
        'role' => true,
        'action' => true,
    ];
}

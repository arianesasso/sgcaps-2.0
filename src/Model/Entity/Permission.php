<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Permission Entity.
 */
class Permission extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'organization_id' => true,
        'role_id' => true,
        'beginning' => true,
        'ending' => true,
        'admin_id' => true,
        'user' => true,
        'organization' => true,
        'role' => true,
        'admin' => true,
    ];
}

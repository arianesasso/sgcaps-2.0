<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Organization Entity.
 */
class Organization extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'organization_id' => true,
        'user_id' => true,
        'name' => true,
        'region' => true,
        'care_type' => true,
        'organizations' => true,
        'user' => true,
        'addresses' => true,
        'contacts' => true,
        'permissions' => true,
    ];
}

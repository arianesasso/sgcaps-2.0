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
        'name' => true,
        'region' => true,
        'care_type' => true,
        'active' => true,
        'organization' => true,
        'user' => true,
        'addresses' => true,
        'contacts' => true,
        'sectors' => true,
        'permissions' => true,
        'people' => true,
    ];
}

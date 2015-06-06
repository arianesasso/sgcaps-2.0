<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrganizationsPerson Entity.
 */
class OrganizationsPerson extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'person_id' => true,
        'organization_id' => true,
        'ended' => true,
        'person' => true,
        'organization' => true,
    ];
}

<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity.
 */
class User extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'password' => true,
        'active' => true,
        'blocked' => true,
        'user_id' => true,
        'users' => true,
        'organizations' => true,
        'permissions' => true,
        'validities' => true,
    ];

    /**
     * Receives the user inputted password and encrypts it with bycript
     * 
     * @param string $value
     * @return string
     */
     protected function _setPassword($value)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }

}

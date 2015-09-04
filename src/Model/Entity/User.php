<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

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
        'person_id' => true,
        'organization_id' => true,
        'username' => true,
        'password' => true,
        'active' => true,
        'admin_id' => true,
        'organization' => true,
        'person' => true,
        'permissions' => true,
        'admin' => true,
    ];

    /**
     * Receives the user inputted password and encrypts it with bycript
     * Recebe a senha inserida pelo usuário e a encripta utilizando 
     * o algoritmo bycript
     * 
     * @param string $value
     * @return string
     */
    protected function _setPassword($value) {
        if(empty($value)) {
            return $this->password;
        }
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($value);
    }
}

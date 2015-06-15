<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class UserPermissionsComponent extends Component {

    /**
     * Encontra os papéis válidos para um usuário em uma dada unidade
     * 
     * @param type $userId
     * @param type $organizationId
     * @return string
     */
    public function validyRoles($userId, $organizationId) {
        $Permissions = TableRegistry::get('Permissions');
        $permissions = $Permissions->find('validyroles', ['user_id' => $userId, 'organization_id' => $organizationId]);
        $userRoles = array();
        foreach ($permissions as $permission):
            $userRoles[] = $permission['Roles']['alias'] . '.' . $permission['Roles']['domain'];
        endforeach;
        return $userRoles;
    }

}
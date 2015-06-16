<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class UserPermissionsComponent extends Component {

    public $Permissions;
    /**
     * Encontra os papéis válidos para um usuário em uma dada unidade
     * 
     * @param type $userId
     * @param type $organizationId
     * @return string
     */
    public function validyRoles($userId, $organizationId) {
        if(empty($this->Permissions)) {
            $this->Permissions = TableRegistry::get('Permissions');
        }
        $permissions = $this->Permissions->find('validyroles', ['user_id' => $userId, 'organization_id' => $organizationId]);
        $userRoles = array();
        foreach ($permissions as $permission):
            $userRoles[] = $permission['Roles']['alias'] . '.' . $permission['Roles']['domain'];
        endforeach;
        return $userRoles;
    }
    
    /**
     * Encontra as organizaćÕes na qual o usuário tem permissões
     * válidass
     * 
     * @param type $userId
     * @param type $organizationId
     * @return string
     */
    public function validyOrganizations($userId) {
        if(empty($this->Permissions)) {
            $this->Permissions = TableRegistry::get('Permissions');
        }
        return $this->Permissions->find('validyorganizations', ['user_id' => $userId])->toArray();
    }

}

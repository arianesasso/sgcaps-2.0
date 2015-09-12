<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class UserPermissionsComponent extends Component {

    public $Permissions;
    
    /**
     * Encontra os papéis válidos para um usuário em uma dada unidade
     * 
     * @param int $userId
     * @param int $organizationId
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
     * @param int $userId
     * @param int $organizationId
     * @return string
     */
    public function validyOrganizations($userId) {
        if(empty($this->Permissions)) {
            $this->Permissions = TableRegistry::get('Permissions');
        }
        return $this->Permissions->find('validyorganizations', ['user_id' => $userId])->toArray();
    }
    
    /**
     * Verifica se o usuário tem um dado papel na unidade em que está logado
     * Verifies wheter the user has a specific role in the organization in which
     * it is logged
     * 
     * @param array $roles Array com os papéis do usuário nessa unidade
     * @param array $roleName Nome do papel procurado
     * @return boolean
     */
    public function hasRole($roles, $roleName) {
        foreach ($roles as $role) {
            $roleNames[] = explode('.', $role)[0];
        }
        if (array_search($roleName, $roleNames) === false) {
            return false;
        }
        return true;
    }
}

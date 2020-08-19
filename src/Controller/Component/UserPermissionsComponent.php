<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class UserPermissionsComponent extends Component {

    public $Permissions;
    public $Actions;

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
            $userRoles[$permission['role']['id']] = $permission['role']['alias'] . '.' . $permission['role']['domain'];
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

    /**
     * Verifica se um usuário está autorizado a realizar determinada
     * ação em um controller
     *
     * @param type $roles           | Os papéis que o usuário possui na unidade atual
     * @param type $controller      | O controller para o qual se deseja verificar a autorização
     * @param type $action          | A ação para a qual se deseja verificar a autorização
     * @return boolean
     */
    public function isAuthorized($actions, $controller, $action) {
        $authorization = "{$controller}.{$action}";
        $actionsKeys = array_keys($actions);
        if(array_search($authorization, $actionsKeys) !== false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verifica quais acões um usuário pode realizar no sistema
     * dado os papéis que possui na unidade em que está logado
     *
     * @param  type $roles | Os papéis que o usuário possui na unidade atual
     * @return array       | Array com as acões que o usuário pode realizar no sistema
     */
    public function allowedActions($roles) {
        $actions = array();
        if(empty($this->Actions)) {
            $this->Actions = TableRegistry::get('Actions');
        }
        $rolesIds = array_keys($roles);
        $allowedActions = $this->Actions->find('allowedActions', ['roles_ids' => $rolesIds]);
        foreach($allowedActions as $allowedAction) {
           $actions[$allowedAction->controller . '.' . $allowedAction->action] = $allowedAction->alias;
        }
        return $actions;
    }
}

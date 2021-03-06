<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 */
class RolesController extends AppController {

    public function isAuthorized($user) {
        parent::isAuthorized($user);
        $actions = $this->request->session()->read('Auth.User.actions');
        $controller = $this->request->controller;
        $action = $this->request->action;
        return $this->UserPermissions->isAuthorized($actions, $controller, $action);
    }

    /**
     * Método para listar todos os papéis disponíveis
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->viewBuilder()->setLayout('devoops_complete');
        $this->set('roles', $this->Roles->find('all'));
        $this->set('_serialize', ['roles']);
    }

    /**
     * Método para adicionar um novo papel
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     *              Redireciona em caso de sucesso, renderiza a view caso contrário
     */
    public function add() {
        $this->viewBuilder()->setLayout('devoops_complete');
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            if (empty($this->request->data['actions']['_ids'])) {
                $this->Flash->bootstrapError('Deve ser escolhida ao menos uma ação');
            } else {
                $this->request->data['alias'] = $this->request->data['name'];
                $role = $this->Roles->patchEntity($role, $this->request->data);
                if ($this->Roles->save($role)) {
                    $this->Flash->bootstrapSuccess('O papel foi salvo.');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->bootstrapError('O papel não foi salvo. Por favor, tente novamente.');
                }
            }
        }
        $actions = $this->Roles->Actions->find('list',['order' => ['name' => 'asc']]);
        $this->set(compact('role', 'actions'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Método para editar um papel existente
     * Edit method
     *
     * @param string|null $id Role id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->viewBuilder()->setLayout('devoops_complete');
        $role = $this->Roles->get($id, [
            'contain' => ['Actions']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['alias'] = $this->request->data['name'];
            $role = $this->Roles->patchEntity($role, $this->request->data);
            if ($this->Roles->save($role)) {
                $this->Flash->bootstrapSuccess('O papel foi salvo.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->bootstrapError('O papel não foi salvo. Por favor, tente novamente');
            }
        }
        $actions = $this->Roles->Actions->find('list',['order' => ['name' => 'asc']]);
        $this->set(compact('role', 'actions'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Método para deletar um papel existente
     * Delete method
     *
     * @param string|null $id Role id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->bootstrapSuccess('O papel foi deletado.');
        } else {
            $count = $this->Roles->Permissions->find("all", ["conditions" => ["role_id" => $id]])->count();
            if ($count == 0) {
                $this->Flash->bootstrapError('O papel não foi deletado. Por favor, tente novamente.');
            } else {
                $this->Flash->bootstrapError('O papel não foi deletado, pois existem permissões associadas.');
            }
        }
        return $this->redirect(['action' => 'index']);
    }
}

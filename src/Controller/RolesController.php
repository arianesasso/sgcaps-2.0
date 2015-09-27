<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 */
class RolesController extends AppController
{

    public function isAuthorized($user) {
        parent::isAuthorized($user);
        $actions = $this->request->session()->read('Auth.User.actions');
        $controller = $this->request->controller;
        $action = $this->request->action;
        return $this->UserPermissions->isAuthorized($actions, $controller, $action);
    }
    
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('roles', $this->paginate($this->Roles));
        $this->set('_serialize', ['roles']);
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Actions', 'Permissions']
        ]);
        $this->set('role', $role);
        $this->set('_serialize', ['role']);
    }

    /**
     * Método para adicionar um novo papel
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     *              Redireciona em caso de sucesso, renderiza a view caso contrário
     */
    public function add() {
        $this->layout = 'devoops_complete';
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
        $actions = $this->Roles->Actions->find('list');
        $this->set(compact('role', 'actions'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Actions']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->data);
            if ($this->Roles->save($role)) {
                $this->Flash->success('The role has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The role could not be saved. Please, try again.');
            }
        }
        $actions = $this->Roles->Actions->find('list', ['limit' => 200]);
        $this->set(compact('role', 'actions'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success('The role has been deleted.');
        } else {
            $this->Flash->error('The role could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}

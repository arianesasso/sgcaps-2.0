<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Actions Controller
 *
 * @property \App\Model\Table\ActionsTable $Actions
 */
class ActionsController extends AppController {

    public function isAuthorized($user) {
        parent::isAuthorized($user);
        $actions = $this->request->session()->read('Auth.User.actions');
        $controller = $this->request->controller;
        $action = $this->request->action;
        return $this->UserPermissions->isAuthorized($actions, $controller, $action);
    }
    
    /**
     * Método para listar todas as ações disponíveis
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->layout = 'devoops_complete';
        $this->set('actions', $this->Actions->find('all'));
        $this->set('_serialize', ['actions']);
    }

    /**
     * Método para criar uma nova ação
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->layout = 'devoops_complete';
        $action = $this->Actions->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['alias'] = $this->request->data['name'];
            $action = $this->Actions->patchEntity($action, $this->request->data);
            if ($this->Actions->save($action)) {
                $this->Flash->bootstrapSuccess('A ação foi salva.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->bootstrapError('A ação não foi salva. Por favor, tente novamente.');
            }
        }
        $roles = $this->Actions->Roles->find('list',['order' => ['name' => 'asc']]);
        $this->set(compact('action', 'roles'));
        $this->set('_serialize', ['action']);
    }

    /**
     * Método para editar uma ação
     * Edit method
     *
     * @param string|null $id Action id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->layout = 'devoops_complete';
        $action = $this->Actions->get($id, [
            'contain' => ['Roles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['alias'] = $this->request->data['name'];
            $action = $this->Actions->patchEntity($action, $this->request->data);
            if ($this->Actions->save($action)) {
                $this->Flash->bootstrapSuccess('A ação foi salva.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->bootstrapError('A ação não foi salva. Por favor, tente novamente.');
            }
        }
        $roles = $this->Actions->Roles->find('list',['order' => ['name' => 'asc']]);
        $this->set(compact('action', 'roles'));
        $this->set('_serialize', ['action']);
    }

    /**
     * Método para deletar uma ação
     * Delete method
     *
     * @param string|null $id Action id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $action = $this->Actions->get($id);
        if ($this->Actions->delete($action)) {
            $this->Flash->bootstrapSuccess('A ação foi deletada.');
        } else {
            $this->Flash->bootstrapError('A ação não foi deletada. Por favor, tente novamente');
        }
        return $this->redirect(['action' => 'index']);
    }
}

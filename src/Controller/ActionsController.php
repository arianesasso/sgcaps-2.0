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
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->set('actions', $this->paginate($this->Actions));
        $this->set('_serialize', ['actions']);
    }

    /**
     * View method
     *
     * @param string|null $id Action id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $action = $this->Actions->get($id, [
            'contain' => ['Roles']
        ]);
        $this->set('action', $action);
        $this->set('_serialize', ['action']);
    }

    /**
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
        $roles = $this->Actions->Roles->find('list');
        $this->set(compact('action', 'roles'));
        $this->set('_serialize', ['action']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Action id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $action = $this->Actions->get($id, [
            'contain' => ['Roles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $action = $this->Actions->patchEntity($action, $this->request->data);
            if ($this->Actions->save($action)) {
                $this->Flash->success('The action has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The action could not be saved. Please, try again.');
            }
        }
        $roles = $this->Actions->Roles->find('list', ['limit' => 200]);
        $this->set(compact('action', 'roles'));
        $this->set('_serialize', ['action']);
    }

    /**
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
            $this->Flash->success('The action has been deleted.');
        } else {
            $this->Flash->error('The action could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}

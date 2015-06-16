<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Organizations Controller
 *
 * @property \App\Model\Table\OrganizationsTable $Organizations
 */
class OrganizationsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('organizations', $this->paginate($this->Organizations));
        $this->set('_serialize', ['organizations']);
    }
    
    /**
     * Shows a list of organizations that are not users yet
     * Mostra uma lista de organizações que não são usuárias ainda
     *
     * @return void
     */
    public function showNoUserList()
    {
        $this->layout = 'ajax';
        $roles = $this->request->session()->read('Auth.User.roles');
        $organizationId = $this->request->session()->read('Auth.User.organization.id');
        $this->set('organizations', $this->Organizations->find('NoUsers', ['roles' =>  $roles, 'organization_id' => $organizationId]));
        $this->set('_serialize', ['organizations']);
    }

    /**
     * View method
     *
     * @param string|null $id Organization id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $organization = $this->Organizations->get($id, [
            'contain' => ['Users', 'Organizations', 'Addresses', 'Contacts', 'Permissions']
        ]);
        $this->set('organization', $organization);
        $this->set('_serialize', ['organization']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $organization = $this->Organizations->newEntity();
        if ($this->request->is('post')) {
            $organization = $this->Organizations->patchEntity($organization, $this->request->data);
            if ($this->Organizations->save($organization)) {
                $this->Flash->success('The organization has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The organization could not be saved. Please, try again.');
            }
        }
        $users = $this->Organizations->Users->find('list', ['limit' => 200]);
        $this->set(compact('organization', 'users'));
        $this->set('_serialize', ['organization']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Organization id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $organization = $this->Organizations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $organization = $this->Organizations->patchEntity($organization, $this->request->data);
            if ($this->Organizations->save($organization)) {
                $this->Flash->success('The organization has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The organization could not be saved. Please, try again.');
            }
        }
        $users = $this->Organizations->Users->find('list', ['limit' => 200]);
        $this->set(compact('organization', 'users'));
        $this->set('_serialize', ['organization']);
    }
    
    /**
     * Adds user_id to the organization
     *
     * @param string $id Organization id.
     * @param integer $userId User id.
     * @return void Redirects on successful addition
     */
    public function addUser($id, $userId)
    {
        if ($this->request->referer(true) != '/usuario/cadastrar') {
            return $this->redirect(['controller' => 'usuario', 'action' => 'sem-permissao']);
        }
        $this->autoRender = false;
        $organization = $this->Organizations->patchEntity($this->Organizations->get($id), ['user_id' => $userId]);
        if ($this->Organizations->save($organization)) {
            $this->Flash->bootstrapSuccess('O usuário foi criado com sucesso.');
            $controller = strtolower($this->request->params['controller']);
            $this->redirect(['controller' => 'permissao', 'action' => 'adicionar', $userId, $controller, $id]);
        } else {
            /**
             * @TODO tratar o usuário que já foi inserido, fazer rollback (?)
             */
            $this->Flash->error('Não foi possível criar um usuário para essa organização.');
            $this->redirect(['controller' => 'usuario', 'action' => 'cadastrar']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Organization id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $organization = $this->Organizations->get($id);
        if ($this->Organizations->delete($organization)) {
            $this->Flash->success('The organization has been deleted.');
        } else {
            $this->Flash->error('The organization could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}

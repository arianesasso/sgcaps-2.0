<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Professionals Controller
 *
 * @property \App\Model\Table\ProfessionalsTable $Professionals
 */
class ProfessionalsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['People', 'States']
        ];
        $this->set('professionals', $this->paginate($this->Professionals));
        $this->set('_serialize', ['professionals']);
    }
    
     /**
     * Shows a list of professionals that are not users yet
     * Mostra uma lista de profissionais que ainda não são usuários
     *
     * @return void
     */
    public function showNoUserList()
    {  
        $this->layout = 'ajax';
        $roles = $this->request->session()->read('Auth.User.roles');
        $organizationId = $this->request->session()->read('Auth.User.organization.id');
        $this->set('professionals', $this->Professionals->find('NoUsers', ['roles' =>  $roles, 'organization_id' => $organizationId]));
        $this->set('_serialize', ['professionals']);
    }
    
    /**
     * View method
     *
     * @param string|null $id Professional id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $professional = $this->Professionals->get($id, [
            'contain' => ['People', 'States']
        ]);
        $this->set('professional', $professional);
        $this->set('_serialize', ['professional']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $professional = $this->Professionals->newEntity();
        if ($this->request->is('post')) {
            $professional = $this->Professionals->patchEntity($professional, $this->request->data);
            if ($this->Professionals->save($professional)) {
                $this->Flash->success('The professional has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The professional could not be saved. Please, try again.');
            }
        }
        $people = $this->Professionals->People->find('list', ['limit' => 200]);
        $states = $this->Professionals->States->find('list', ['limit' => 200]);
        $this->set(compact('professional', 'people', 'states'));
        $this->set('_serialize', ['professional']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Professional id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $professional = $this->Professionals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $professional = $this->Professionals->patchEntity($professional, $this->request->data);
            if ($this->Professionals->save($professional)) {
                $this->Flash->success('The professional has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The professional could not be saved. Please, try again.');
            }
        }
        $people = $this->Professionals->People->find('list', ['limit' => 200]);
        $states = $this->Professionals->States->find('list', ['limit' => 200]);
        $this->set(compact('professional', 'people', 'states'));
        $this->set('_serialize', ['professional']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Professional id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $professional = $this->Professionals->get($id);
        if ($this->Professionals->delete($professional)) {
            $this->Flash->success('The professional has been deleted.');
        } else {
            $this->Flash->error('The professional could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}

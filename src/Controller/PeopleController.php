<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * People Controller
 *
 * @property \App\Model\Table\PeopleTable $People
 */
class PeopleController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'States']
        ];
        $this->set('people', $this->paginate($this->People));
        $this->set('_serialize', ['people']);
    }

    /**
     * View method
     *
     * @param string|null $id Person id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $person = $this->People->get($id, [
            'contain' => ['Users', 'States', 'Addresses', 'Contacts', 'Patients', 'Professionals']
        ]);
        $this->set('person', $person);
        $this->set('_serialize', ['person']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $person = $this->People->newEntity();
        if ($this->request->is('post')) {
            $person = $this->People->patchEntity($person, $this->request->data);
            if ($this->People->save($person)) {
                $this->Flash->success('The person has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The person could not be saved. Please, try again.');
            }
        }
        $users = $this->People->Users->find('list', ['limit' => 200]);
        $states = $this->People->States->find('list', ['limit' => 200]);
        $this->set(compact('person', 'users', 'states'));
        $this->set('_serialize', ['person']);
    }
    
     /**
     * Adds user_id to the person
     *
     * @param string $id Person id.
     * @param integer $userId User id.
     * @return void Redirects on successful addition
     */
    public function addUser($id, $userId)
    {
        if ($this->request->referer(true) != '/usuario/cadastrar') {
            return $this->redirect(['controller' => 'usuario', 'action' => 'sem-permissao']);
        }
        $this->autoRender = false;
        $people = $this->People->patchEntity($this->People->get($id), ['user_id' => $userId]);
        if ($this->People->save($people)) {
            $this->Flash->bootstrapSuccess('O usuário foi criado com sucesso.');
            $controller = strtolower($this->request->params['controller']);
            $this->redirect(['controller' => 'permissao', 'action' => 'adicionar', $userId, $controller]);
        } else {
            $this->Flash->error('Não foi possível criar um usuário para essa pessoa.');
            $this->redirect(['controller' => 'usuario', 'action' => 'cadastrar']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Person id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $person = $this->People->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $person = $this->People->patchEntity($person, $this->request->data);
            if ($this->People->save($person)) {
                $this->Flash->success('The person has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The person could not be saved. Please, try again.');
            }
        }
        $users = $this->People->Users->find('list', ['limit' => 200]);
        $states = $this->People->States->find('list', ['limit' => 200]);
        $this->set(compact('person', 'users', 'states'));
        $this->set('_serialize', ['person']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Person id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $person = $this->People->get($id);
        if ($this->People->delete($person)) {
            $this->Flash->success('The person has been deleted.');
        } else {
            $this->Flash->error('The person could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}

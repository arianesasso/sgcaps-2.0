<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Patients Controller
 *
 * @property \App\Model\Table\PatientsTable $Patients
 */
class PatientsController extends AppController {
    
    public function isAuthorized($user) {
        parent::isAuthorized($user);
        $actions = $this->request->session()->read('Auth.User.actions');
        $controller = $this->request->controller;
        $action = $this->request->action;
        return $this->UserPermissions->isAuthorized($actions, $controller, $action);
    }

    /**
     * Método para listar todos os pacientes
     *
     * @return void
     */
    public function index() {
        $this->viewBuilder()->layout('devoops_complete');
        $this->set('patients', $this->Patients->find('all', ['contain' => ['People']]));
        $this->set('_serialize', ['patients']);
    }

    /**
     * Método para visualizar um paciente específico
     *
     * @param string|null $id Patient id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->layout('devoops_complete');
        
        $patient = $this->Patients->get($id, [
            'contain' => ['People', 'People.States', 'People.Occupations']
        ]);
        $this->set('patient', $patient);
        $this->set('_serialize', ['patient']);
    }

    /**
     * Método para cadastrar um novo paciente
     *
     * @return void Redireciona se houver sucesso, caso contrário exibe uma
     *              mensagem de erro
     */
    public function add() {
        $this->viewBuilder()->layout('devoops_complete');
        $patient = $this->Patients->newEntity();
        if ($this->request->is('post')) {
            $patient = $this->Patients->patchEntity($patient, $this->request->data);
            if ($this->Patients->save($patient)) {
                $this->Flash->bootstrapSuccess('O paciente foi salvo com sucesso.');
                return $this->redirect(['controller' => 'paciente', 'action' => 'visualizar', $patient->id]);
            } else {
                $this->Flash->bootstrapError('O paciente não foi salvo, tente novamente.');
            }
        }
        $occupations = $this->Patients->People->Occupations->find('list', ['keyField' => 'id','valueField' => 'description', 'order' => ['description' => 'ASC']]);
        $states = $this->Patients->People->States->find('list');
        $this->set(compact('patient', 'states', 'occupations'));
        $this->set('_serialize', ['patient']);
    }

    /**
     * Método para editar dados de um paciente
     *
     * @TODO esse método ainda precisa ser construído (o código abaixo é proveniente do bake)
     * 
     * @param string|null $id Patient id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $patient = $this->Patients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $patient = $this->Patients->patchEntity($patient, $this->request->data);
            if ($this->Patients->save($patient)) {
                $this->Flash->success('The patient has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The patient could not be saved. Please, try again.');
            }
        }
        $people = $this->Patients->People->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'people'));
        $this->set('_serialize', ['patient']);
    }
}

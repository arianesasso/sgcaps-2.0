<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Controller para gerenciar profissionais
 * Professionals Controller
 *
 * @property \App\Model\Table\ProfessionalsTable $Professionals
 */
class ProfessionalsController extends AppController {

    public function isAuthorized($user) {
        parent::isAuthorized($user);
        $actions = $this->request->session()->read('Auth.User.actions');
        $controller = $this->request->controller;
        $action = $this->request->action;
        if($this->request->action == 'showNoUserList') {
            return true;
        }
        return $this->UserPermissions->isAuthorized($actions, $controller, $action);
    }

    /**
     * Métododo que lista todos os profissionais cadastrados
     * Method that lists all the registered professionals
     *
     * @return void
     */
    public function index() {
        $this->viewBuilder()->setLayout('devoops_complete');
        $this->set('professionals', $this->Professionals->find('all', ['contain' => ['People', 'States']]));
        $this->set('_serialize', ['professionals']);
    }

    /**
     * Mostra uma lista de profissionais que ainda não são usuários
     * Shows a list of professionals that are not users yet
     *
     * @return void
     */
    public function showNoUserList() {
        if (!$this->request->is('ajax')) {
            $this->redirect(['controller' => 'usuario', 'action' => 'sem-permissao']);
        }
        $this->viewBuilder()->setLayout('ajax');
        $actions = $this->request->session()->read('Auth.User.actions');
        $organizationId = $this->request->session()->read('Auth.User.organization.id');
        if(in_array('cadastrar_usuario_local', $actions)) {
            $localOnly = true;
        }
        if(in_array('cadastrar_qualquer_usuario', $actions)) {
            $localOnly = false;
        }
        $this->set('professionals', $this->Professionals->find('noUsers', ['local_only' => $localOnly, 'organization_id' => $organizationId]));
        $this->set('_serialize', ['professionals']);
    }

    /**
     * Método para visualizar um profissional específico
     * Method to visualize a specific professional
     *
     * @param string|null $id Professional id | Id do Profissional
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null, $type = null) {
        $this->viewBuilder()->setLayout('devoops_complete');

        if(empty($type)) {
            $professional = $this->Professionals->find('all',
                                  ['conditions' => [$id],
                                   'contain' => ['People', 'States', 'People.States',
                                            'People.Occupations']
                                  ])
                                 ->first();
        } else {
            $professional = $this->Professionals->findByPersonId($id)
                                 ->contain(['People', 'States', 'People.States',
                                            'People.Occupations'])
                                 ->first();
        }
        pr('fuck this shit');
        $this->set('professional', $professional);
        $this->set('_serialize', ['professional']);
    }

    /**
     * Método para adicionar um novo profissional
     * Add method
     *
     * @return void Redireciona em caso de sucesso, renderiza view caso contrário
     *              Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->viewBuilder()->setLayout('devoops_complete');
        $professional = $this->Professionals->newEntity();
        // Se for um POST irá salvar o registro
        if ($this->request->is('post')) {
            // Necessário para vincular o profissional a organização no momento do cadastro
            $this->request->data['person']['organizations'] = [['id' => $this->request->session()->read('Auth.User.organization.id')]];
            // É preciso declarar a assoçiacão para que se salve corretamente
            // na tabela organizations_people
            $professional = $this->Professionals->patchEntity($professional,
                    $this->request->data, ['associated' => ['People.Organizations']]);
            // Salva o registro
            if ($this->Professionals->save($professional)) {
                $this->Flash->bootstrapSuccess('O profissional foi salvo com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->bootstrapError('O profissional não pode ser salvo.');
            }
        }
        // Caso não seja um POST irá renderizar o formulário de cadastro
        $occupations = $this->Professionals->People->Occupations->find('list', ['keyField' => 'id', 'valueField' => 'description', 'order' => ['description' => 'ASC']]);
        $states = $this->Professionals->States->find('list');
        $this->set(compact('professional', 'states', 'occupations'));
        $this->set('_serialize', ['professional']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Professional id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
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
}

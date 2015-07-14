<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * People Controller
 *
 * @property \App\Model\Table\PeopleTable $People
 */
class PeopleController extends AppController {

    /**
     * Adds user_id to the person
     *
     * @param string $id Person id.
     * @param integer $userId User id.
     * @return void Redirects on successful addition
     */
    public function addUser($id, $userId) {
        if ($this->request->referer(true) != '/usuario/cadastrar') {
            return $this->redirect(['controller' => 'usuario', 'action' => 'sem-permissao']);
        }
        $this->autoRender = false;
        $person = $this->People->patchEntity($this->People->get($id), ['user_id' => $userId]);
        if ($this->People->save($person)) {
            $this->Flash->bootstrapSuccess('O usuário foi criado com sucesso.');
            $controller = strtolower($this->request->params['controller']);
            $this->redirect(['controller' => 'permissao', 'action' => 'adicionar', $userId, $controller]);
        } else {
            /**
             * @TODO tratar o usuário que já foi inserido, fazer rollback (?)
             */
            $this->Flash->bootstrapError('Não foi possível criar um usuário para essa pessoa.');
            $this->redirect(['controller' => 'usuario', 'action' => 'cadastrar']);
        }
    }

}

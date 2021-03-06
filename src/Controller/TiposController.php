<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tipos Controller
 *
 * @property \App\Model\Table\TiposTable $Tipos
 */
class TiposController extends AppController {

    /**
     * Index method
     *
     * @return void
     */
    public $paginate = [
        "limit" => 10,
        "order" => [
            "Tipos.id" => "asc"
        ],
        "conditions" => [
            "Tipos.estado" => 1
        ]
    ];
    
    public function index() {
        $this->layout = "main";
        
        $this->set('tipos', $this->paginate());
        $this->set('_serialize', ['tipos']);
    }

    /**
     * View method
     *
     * @param string|null $id Tipo id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null) {
        $this->layout = "main";
        $tipo = $this->Tipos->get($id);
        $this->set('tipo', $tipo);
        $this->set('_serialize', ['tipo']);
    }
    
    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->layout = "main";
        
        $tipo = $this->Tipos->newEntity();
        if ($this->request->is('post')) {
            $tipo = $this->Tipos->patchEntity($tipo, $this->request->data);
            if ($this->Tipos->save($tipo)) {
                $this->Flash->success(__("El Tipo de Test ha sido registrado correctamente."));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El Tipo de Test no pudo ser registrado. Por favor, inténtalo nuevamente.'));
            }
        }
        $this->set(compact('tipo'));
        $this->set('_serialize', ['tipo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tipo id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->layout = "main";
        $tipo = $this->Tipos->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipo = $this->Tipos->patchEntity($tipo, $this->request->data);
            if ($this->Tipos->save($tipo)) {
                $this->Flash->success(__('El Tipo de Test ha sido registrado correctamente.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El Tipo de Test no pudo ser registrado. Por favor, inténtalo nuevamente.'));
            }
        }
        $this->set(compact('tipo'));
        $this->set('_serialize', ['tipo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tipo id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $tipo = $this->Tipos->get($id);
        $tipo->estado = 2;
        if ($this->Tipos->save($tipo)) {
            $this->Flash->success(__('El Tipo de Test ha sido deshabilitado.'));
        } else {
            $this->Flash->error(__('El Tipo de Test no pudo ser deshabilitado. Por favor, inténtalo nuevamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}

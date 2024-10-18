<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ContactUsers Controller
 *
 * @property \App\Model\Table\ContactUsersTable $ContactUsers
 */
class ContactUsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->ContactUsers->find()
            ->contain(['Organisations']);
        $contactUsers = $this->paginate($query);

        $this->set(compact('contactUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactUser = $this->ContactUsers->get($id, contain: ['Organisations']);
        $this->set(compact('contactUser'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactUser = $this->ContactUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $contactUser = $this->ContactUsers->patchEntity($contactUser, $this->request->getData());
            if ($this->ContactUsers->save($contactUser)) {
                $this->Flash->success(__('The contact user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact user could not be saved. Please, try again.'));
        }
        $organisations = $this->ContactUsers->Organisations->find('list', limit: 200)->all();
        $this->set(compact('contactUser', 'organisations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactUser = $this->ContactUsers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactUser = $this->ContactUsers->patchEntity($contactUser, $this->request->getData());
            if ($this->ContactUsers->save($contactUser)) {
                $this->Flash->success(__('The contact user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact user could not be saved. Please, try again.'));
        }
        $organisations = $this->ContactUsers->Organisations->find('list', limit: 200)->all();
        $this->set(compact('contactUser', 'organisations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactUser = $this->ContactUsers->get($id);
        if ($this->ContactUsers->delete($contactUser)) {
            $this->Flash->success(__('The contact user has been deleted.'));
        } else {
            $this->Flash->error(__('The contact user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

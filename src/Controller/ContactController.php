<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Contact Controller
 *
 * @property \App\Model\Table\ContactTable $Contact
 */
class ContactController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');

        // Allow unauthenticated access to the add action
        $this->Authentication->allowUnauthenticated(['add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Contact->find()
            ->contain(['Organisations', 'Contractors']);
        $contact = $this->paginate($query);

        $this->set(compact('contact'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contact = $this->Contact->get($id, contain: ['Organisations', 'Contractors']);
        $this->set(compact('contact'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contact = $this->Contact->newEmptyEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contact->patchEntity($contact, $this->request->getData());
            if ($this->Contact->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
//            dd($contact->getErrors());
//            exit();
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $organisations = $this->Contact->Organisations->find('list', [
            'keyField' => 'id',
            'valueField' => 'business_name',
            'limit' => 200
        ])->toArray();

        $contractors = $this->Contact->Contractors->find('list', [
            'keyField' => 'id',
            'valueField' => 'first_name',
            'limit' => 200
        ])->toArray();

//        dd($organisations);
//        exit;
        $this->set(compact('contact', 'organisations', 'contractors'));

    }

    /**
     * Edit method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contact = $this->Contact->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contact->patchEntity($contact, $this->request->getData());
            if ($this->Contact->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $organisations = $this->Contact->Organisations->find('list', [
            'keyField' => 'id',
            'valueField' => 'business_name'
        ])->limit(200)->all();

        $contractors = $this->Contact->Contractors->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row->first_name . ' ' . $row->last_name;
            }        ])->limit(200)->all();
//        debug($organisations);
//        exit();
        $this->set(compact('contact', 'organisations', 'contractors'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contact->get($id);
        if ($this->Contact->delete($contact)) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

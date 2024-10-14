<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ContactUs Controller
 *
 * @property \App\Model\Table\ContactUsTable $ContactUs
 */
class ContactUsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->ContactUs->find()
            ->contain(['Organisations']);
        $contactUs = $this->paginate($query);

        $this->set(compact('contactUs'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact U id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contactU = $this->ContactUs->get($id, contain: ['Organisations']);
        $this->set(compact('contactU'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactU = $this->ContactUs->newEmptyEntity();
        if ($this->request->is('post')) {
            $contactU = $this->ContactUs->patchEntity($contactU, $this->request->getData());
            if ($this->ContactUs->save($contactU)) {
                $this->Flash->success(__('The contact u has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact u could not be saved. Please, try again.'));
        }
        $organisations = $this->ContactUs->Organisations->find('list', limit: 200)->all();
        $this->set(compact('contactU', 'organisations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact U id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contactU = $this->ContactUs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contactU = $this->ContactUs->patchEntity($contactU, $this->request->getData());
            if ($this->ContactUs->save($contactU)) {
                $this->Flash->success(__('The contact u has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact u could not be saved. Please, try again.'));
        }
        $organisations = $this->ContactUs->Organisations->find('list', limit: 200)->all();
        $this->set(compact('contactU', 'organisations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact U id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contactU = $this->ContactUs->get($id);
        if ($this->ContactUs->delete($contactU)) {
            $this->Flash->success(__('The contact u has been deleted.'));
        } else {
            $this->Flash->error(__('The contact u could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

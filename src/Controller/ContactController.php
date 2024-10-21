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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Contact->find()
            ->contain(['Organisations']);
        $contact = $this->paginate($query);

        $this->set(compact('contact'));

        $query = $this->Contact->find('all', [
            'conditions' => [
                'OR' => [
                    'Contractors.first_name LIKE' => '%' . $keyword . '%',
                    'Contractors.last_name LIKE' => '%' . $keyword . '%'
                ]
            ]
        ]);

        $query = $this->Contact->find('all', [
            'conditions' => ['Contractors.contractor_email LIKE' => '%' . $keyword . '%']
        ]);


        $query = $this->Contact->find()
            ->select(['Contractors.id', 'Contractors.first_name', 'Contractors.last_name', 'project_count' => $query->func()->count('Projects.id')])
            ->leftJoinWith('Projects')
            ->group(['Contractors.id'])
            ->order(['project_count' => 'DESC']);


        $query = $this->Contact->find()
            ->matching('Skills', function($q) use ($selectedSkills) {
                return $q->where(['Skills.skill_name IN' => $selectedSkills]);
            });

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
        $contact = $this->Contact->get($id, contain: ['Organisations']);
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

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $organisations = $this->Contact->Organisations->find('list', limit: 200)->all();
        $this->set(compact('contact', 'organisations'));
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
        $organisations = $this->Contact->Organisations->find('list', limit: 200)->all();
        $this->set(compact('contact', 'organisations'));
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

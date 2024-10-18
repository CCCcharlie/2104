<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Contractors Controller
 *
 * @property \App\Model\Table\ContractorsTable $Contractors
 */
class ContractorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Contractors->find();
        $contractors = $this->paginate($query);

        $this->set(compact('contractors'));

        // Retrieve search parameters from the query string
        $name = $this->request->getQuery('name');
        $email = $this->request->getQuery('email');
        $skills = $this->request->getQuery('skills');
        $sort = $this->request->getQuery('sort', 'default'); // Default sort if none provided

        // Start building the query
        $query = $this->Contractors->find()
            ->contain(['Skills', 'Projects'])
            ->leftJoinWith('Projects') // Join with the Projects table for sorting by project count
            ->select([
                'Contractors.id',
                'Contractors.first_name',
                'Contractors.last_name',
                'Contractors.contractor_email',
                'Contractors.phone_number',
                'project_count' => $query->func()->count('Projects.id')
            ])
            ->group('Contractors.id');

        // Filter by name (first or last)
        if (!empty($name)) {
            $query->where([
                'OR' => [
                    'Contractors.first_name LIKE' => '%' . $name . '%',
                    'Contractors.last_name LIKE' => '%' . $name . '%'
                ]
            ]);
        }

        // Filter by email
        if (!empty($email)) {
            $query->where(['Contractors.contractor_email LIKE' => '%' . $email . '%']);
        }

        // Filter by skills
        if (!empty($skills)) {
            $query->matching('Skills', function ($q) use ($skills) {
                return $q->where(['Skills.id IN' => $skills]);
            });
        }

        // Sorting by project count if selected
        if ($sort === 'projects') {
            $query->order(['project_count' => 'DESC']);
        }

        // Paginate the filtered and sorted results
        $contractors = $this->paginate($query);

        // Fetch the list of skills for the filter form
        $skillsList = $this->Contractors->Skills->find('list')->toArray();

        // Set variables for the view
        $this->set(compact('contractors', 'skillsList'));
    }


    /**
     * View method
     *
     * @param string|null $id Contractor id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contractor = $this->Contractors->get($id, contain: ['Skills', 'Projects']);
        $this->set(compact('contractor'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contractor = $this->Contractors->newEmptyEntity();
        if ($this->request->is('post')) {
            $contractor = $this->Contractors->patchEntity($contractor, $this->request->getData());
            if ($this->Contractors->save($contractor)) {
                $this->Flash->success(__('The contractor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractor could not be saved. Please, try again.'));
        }
        $skills = $this->Contractors->Skills->find('list', limit: 200)->all();
        $this->set(compact('contractor', 'skills'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contractor id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contractor = $this->Contractors->get($id, contain: ['Skills']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contractor = $this->Contractors->patchEntity($contractor, $this->request->getData());
            if ($this->Contractors->save($contractor)) {
                $this->Flash->success(__('The contractor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractor could not be saved. Please, try again.'));
        }
        $skills = $this->Contractors->Skills->find('list', limit: 200)->all();
        $this->set(compact('contractor', 'skills'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contractor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contractor = $this->Contractors->get($id);
        if ($this->Contractors->delete($contractor)) {
            $this->Flash->success(__('The contractor has been deleted.'));
        } else {
            $this->Flash->error(__('The contractor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }




}

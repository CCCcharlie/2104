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
        $keyword = $this->request->getQuery('keyword'); // Name keyword
        $email = $this->request->getQuery('email'); // Email keyword
        $skills = $this->request->getQuery('skills'); // Skills filter
        $sortByProjects = $this->request->getQuery('sort_by_projects'); // Sort option


        $query = $this->Contractors->find()
            ->contain(['Skills']) // Include Skills table for filtering
            ->leftJoinWith('Projects'); // Ensure Projects are included in the join

        // Apply keyword filter if a keyword is entered
        if (!empty($this->request->getQuery('keyword'))) {
            $keyword = $this->request->getQuery('keyword');
            $query->where([
                'OR' => [
                    'Contractors.first_name LIKE' => '%' . $keyword . '%',
                    'Contractors.last_name LIKE' => '%' . $keyword . '%'
                ]
            ]);
        }

        // Apply email filter if an email is entered
        if (!empty($this->request->getQuery('email'))) {
            $email = $this->request->getQuery('email');
            $query->where(['Contractors.contractor_email LIKE' => '%' . $email . '%']);
        }

        // Apply skills filter if any skills are selected
        if (!empty($this->request->getQuery('skills'))) {
            $skills = $this->request->getQuery('skills');
            $query->matching('Skills', function ($q) use ($skills) {
                return $q->where(['Skills.id IN' => $skills]);
            });
        }

        // Sort by the number of projects if the checkbox is checked
        if ($this->request->getQuery('sort_by_projects') === '1') {
            $query->select(['total_projects' => $query->func()->count('Projects.id')])
                ->group('Contractors.id')
                ->order(['total_projects' => 'DESC']);
        }

        $contractors = $this->paginate($query);
        $skillsList = $this->Contractors->Skills->find('list')->toArray();
        $this->set(compact('contractors', 'skillsList'));


        $query = $this->Contractors->find()
            ->contain(['Skills', 'Projects']); // Include related Skills and Projects

        // Filter by first name or last name
        if (!empty($keyword)) {
            $query->where([
                'OR' => [
                    'Contractors.first_name LIKE' => '%' . $keyword . '%',
                    'Contractors.last_name LIKE' => '%' . $keyword . '%'
                ]
            ]);
        }

        // Filter by email
        if (!empty($this->request->getQuery('email'))) {
            $email = $this->request->getQuery('email');
            $query->where(['Contractors.contractor_email LIKE' => '%' . $email . '%']);
        }

        // Filter by selected skills (checkboxes)
        if (!empty($skills)) {
            $query->matching('Skills', function ($q) use ($skills) {
                return $q->where(['Skills.id IN' => $skills]);
            });
        }

        // Sort by the number of projects
        if ($sortByProjects) {
            $query = $query
                ->select(['total_projects' => $query->func()->count('Projects.id')])
                ->group('Contractors.id')
                ->order(['total_projects' => 'DESC']);
        }
        // Base query to load contractors with associated projects
        $query = $this->Contractors->find()
            ->contain(['Projects']); // Ensures Projects are joined for counting

        // Apply project count filter
        if ($projectCount = $this->request->getQuery('project_count')) {
            $query->select(['total_projects' => $query->func()->count('Projects.id')])
                ->leftJoinWith('Projects') // Include Projects in the join
                ->group(['Contractors.id'])
                ->having(['total_projects >=' => $projectCount]);
        }


        $contractors = $this->paginate($query);
        $skillsList = $this->Contractors->Skills->find('list')->toArray(); // List of skills for the filter

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

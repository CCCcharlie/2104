<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 */
class ProjectsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $keyword = $this->request->getQuery('keyword'); // Skill keyword
        $status = $this->request->getQuery('status');   // Status filter
        $skills = $this->request->getQuery('skills');   // Array of skill IDs
        $startDate = $this->request->getQuery('start_date'); // Start date filter
        $endDate = $this->request->getQuery('end_date');     // End date filter

        $query = $this->Projects->find()
            ->contain(['Skills', 'Contractors', 'Organisations']); // Include related tables

        // Filter by skill keyword if present
        if (!empty($keyword)) {
            $query->matching('Skills', function ($q) use ($keyword) {
                return $q->where(['Skills.skill_name LIKE' => '%' . $keyword . '%']);
            });
        }

        // Filter by project completion status
        if ($status !== null && $status !== '') {
            $query->where(['Projects.complete' => $status]);
        }

        // Filter by selected skills if any skills are specified
        if (!empty($skills)) {
            $query->matching('Skills', function ($q) use ($skills) {
                return $q->where(['Skills.id IN' => $skills]);
            });
        }

        // Filter by start and end dates if both are provided
        if (!empty($startDate) && !empty($endDate)) {
            $query->where([
                'Projects.project_due_date >=' => $startDate,
                'Projects.project_due_date <=' => $endDate
            ]);
        }

        // Fetch the skills list for filtering options in the view
        $skills = $this->Projects->Skills->find();

        // Paginate the query results to display in the view
        $projects = $this->paginate($query);

        // Pass the data to the view
        $this->set(compact('projects', 'skills'));
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project = $this->Projects->get($id, contain: ['Contractors', 'Organisations']);
        $this->set(compact('project'));
        $this->Form->create(null, ['type' => 'get']);
        $this->Form->control('keyword', ['label' => 'Search by Keyword']);
        $this->Form->control('status', [
            'label' => 'Filter by Status',
            'options' => [
                '' => 'Any',  // Default to any status
                '1' => 'Complete',
                '0' => 'Incomplete'
            ]
        ]);
        $this->Form->control('start_date', ['type' => 'date', 'label' => 'Start Date']);
        $this->Form->control('end_date', ['type' => 'date', 'label' => 'End Date']);
        $this->Form->button('Search');
        $this->Form->end();
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project = $this->Projects->newEmptyEntity();
        if ($this->request->is('post')) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $contractors = $this->Projects->Contractors->find('list', limit: 200)->all();
        $organisations = $this->Projects->Organisations->find('list', limit: 200)->all();
        $this->set(compact('project', 'contractors', 'organisations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        $contractors = $this->Projects->Contractors->find('list', limit: 200)->all();
        $organisations = $this->Projects->Organisations->find('list', limit: 200)->all();
        $this->set(compact('project', 'contractors', 'organisations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('The project has been deleted.'));
        } else {
            $this->Flash->error(__('The project could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

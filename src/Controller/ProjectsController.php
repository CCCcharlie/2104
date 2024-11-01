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
     *  Displays a paginated list of projects, with optional filters for skills, status, date range, and keyword search.
     *  Also fetches the list of skills for filtering options in the view
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $keyword = $this->request->getQuery('keyword'); // Skill keyword
        $status = $this->request->getQuery('status');   // Status filter
        $skills = $this->request->getQuery('skills', []); // Default to empty array
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



        $skills = array_filter($skills, function($skill) {
            return $skill !== '0'; // only keep the valid
        });
        // Apply skills filter if any skills are selected
        if (isset($skills) && is_array($skills) && !empty($skills)) {

            $query->matching('Skills', function ($q) use ($skills) {
                return $q->where(['Skills.id IN' => $skills]);
            });
        }

        // Filter by start and end dates if both are provided
        if (!empty($startDate)) {
            $query->where(['Projects.project_due_date >=' => $startDate]);
        }

        if (!empty($endDate)) {
            $query->where(['Projects.project_due_date <=' => $endDate]);
        }


        // Fetch the skills list for filtering options in the view
        $skillsList = $this->Projects->Skills->find('list', [
            'keyField' => 'id',
            'valueField' => 'skill_name'
        ])->toArray();

        // Paginate the query results to display in the view
        $projects = $this->paginate($query);

        // Pass the data to the view
        $this->set(compact('projects', 'skillsList'));
    }

    /**
     * View method
     * Displays detailed information about a specific project, including associated contractors, organisations, and skills.
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project = $this->Projects->get($id, contain: ['Contractors', 'Organisations', 'Skills']);
        $this->set(compact('project'));
    }

    /**
     * Add method
     * Creates a new project record. On successful save, redirects to the index; otherwise, renders the form with validation errors.
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
        // Fetch contractors with full name (first and last)
        $contractors = $this->Projects->Contractors->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['first_name'] . ' ' . $row['last_name'];
            }
        ])->toArray();

        // Fetch organisations by name
        $organisations = $this->Projects->Organisations->find('list', [
            'keyField' => 'id',
            'valueField' => 'business_name'
        ])->toArray();
        $skills = $this->Projects->Skills->find('list', limit: 200)->all();
        $this->set(compact('project', 'contractors', 'organisations', 'skills'));
    }

    /**
     * Edit method
     * Edits an existing project record. On successful save, redirects to the index; otherwise, renders the form with validation errors.
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, contain: ['Skills']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->Flash->success(__('The project has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The project could not be saved. Please, try again.'));
        }
        // Fetch contractors with full name (first and last)
        $contractors = $this->Projects->Contractors->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['first_name'] . ' ' . $row['last_name'];
            }
        ])->toArray();

        // Fetch organisations by name
        $organisations = $this->Projects->Organisations->find('list', [
            'keyField' => 'id',
            'valueField' => 'business_name'
        ])->toArray();
        $skills = $this->Projects->Skills->find('list', limit: 200)->all();
        $this->set(compact('project', 'contractors', 'organisations', 'skills'));
    }

    /**
     * Delete method
     * Deletes an existing project record. Redirects to the index on successful deletion, with appropriate success or error messages.
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

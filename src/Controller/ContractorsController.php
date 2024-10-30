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
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');

        // Allow unauthenticated access to the add action
        $this->Authentication->allowUnauthenticated(['add']);
    }
    /**
     * Index method
     * Handles the display of all contractors. Allows filtering and sorting
     *  by name, email, skills, project count, and skill sets. Retrieves a list
     *  of contractors and their associated skills and projects
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Get query parameters
        $keyword = $this->request->getQuery('keyword'); // Name keyword
        $email = $this->request->getQuery('email'); // Email keyword
        $skills = $this->request->getQuery('skills', []); // Ensure it defaults to an empty array
        $sortByProjects = $this->request->getQuery('sort_by_projects'); // Sort option
        $projectCount = $this->request->getQuery('project_count'); // Minimum project count filter

        // Start building the query
        $query = $this->Contractors->find()
            ->contain(['Skills']) // Include Skills table for filtering
            ->leftJoinWith('Projects'); // Ensure Projects are included in the join

        // Apply name keyword filter if provided
        if (!empty($keyword)) {
            $query->where([
                'OR' => [
                    'Contractors.first_name LIKE' => '%' . $keyword . '%',
                    'Contractors.last_name LIKE' => '%' . $keyword . '%'
                ]
            ]);
        }

        // Apply email filter if an email is entered
        if (!empty($email)) {
            $query->where(['Contractors.contractor_email LIKE' => '%' . $email . '%']);
        }

//        debug($skills); // Check the structure of the $skills array

        // Apply skills filter if any skills are selected
// Ensure $skills is treated as an array
        if (!empty($skills) && is_array($skills)) {
            $query->matching('Skills', function ($q) use ($skills) {
                return $q->where(['Skills.id IN' => $skills]);
            });
        }


        // Sort by the number of projects if the sort option is checked
        if ($sortByProjects === '1' || !empty($projectCount)) {
            $query->select([
                'Contractors.id',
                'Contractors.first_name',
                'Contractors.last_name',
                'Contractors.phone_number',
                'Contractors.contractor_email',
                'Contractors.created',
                'Contractors.modified',
                'total_projects' => $query->func()->count('Projects.id')
            ])
                ->group('Contractors.id');

            // Sort in descending order by project count if the checkbox is checked
            if ($sortByProjects === '1') {
                $query->order(['total_projects' => 'DESC']);
            }

            // Filter by minimum project count if specified
            if (!empty($projectCount)) {
                $query->having(['total_projects >=' => $projectCount]);
            }
        }

        // Paginate the results
        $contractors = $this->paginate($query);

        // Get the list of skills for the skills filter
        // Additional sorting and filtering applied based on project count if set
        $skillsList = $this->Contractors->Skills->find('list')->toArray();

        // Set variables for the view
        $this->set(compact('contractors', 'skillsList'));
    }


    /**
     * View method
     *Displays detailed information for a specific contractor, including
     *  their skills and associated projects
     *
     * @param string|null $id Contractor id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {


        // Get the list of skills for the skills filter
        $skillsList = $this->Contractors->Skills->find('list')->toArray();

        $contractor = $this->Contractors->get($id, contain: ['Skills', 'Projects']);
        $this->set(compact('contractor','skillsList'));
    }

    /**
     * Add method
     *
     * Handles creating a new contractor record. Processes form submission
     *  for contractor information and saves to the database if valid
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
     * Allows updating an existing contractor's information. Retrieves the
     *  contractor record by ID and applies any changes submitted via form
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
     * Deletes a specified contractor record from the database based on the
     *  provided ID. Redirects to the contractors list upon successful deletion
     *
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

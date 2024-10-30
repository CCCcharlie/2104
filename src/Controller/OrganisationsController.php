<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Organisations Controller
 *
 * @property \App\Model\Table\OrganisationsTable $Organisations
 */
class OrganisationsController extends AppController
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
     *Fetches a list of organisations with optional filters for name and project count,
     *  and pagination. Supports sorting by the number of projects
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // intialise query
        $query = $this->Organisations->find()
            ->contain(['Projects']); // 包含 Projects 关联

        // search based on the business_name
        if ($keyword = $this->request->getQuery('keyword')) {
            $query->where(['Organisations.business_name LIKE' => '%' . $keyword . '%']);
        }

        // check if sort by project picked
        if ($this->request->getQuery('sort_by_projects') === '1') {
            $query->select([
                'Organisations.id',
                'Organisations.business_name',
                'Organisations.contact_first_name',
                'Organisations.contact_last_name',
                'Organisations.contact_email',
                'Organisations.current_website',
                'Organisations.created',
                'Organisations.modified',
                'total_projects' => $query->func()->count('Projects.id')
            ])
                ->leftJoinWith('Projects') // join with project
                ->groupBy(['Organisations.id']) // groupby organisation
                ->orderBy(['total_projects' => 'DESC']); // order by project
        }

        // sort by project number
        if ($projectCount = $this->request->getQuery('project_count')) {
            $query->select([
                'Organisations.id',
                'Organisations.business_name',
                'Organisations.contact_first_name',
                'Organisations.contact_last_name',
                'Organisations.contact_email',
                'Organisations.current_website',
                'Organisations.created',
                'Organisations.modified',
                'total_projects' => $query->func()->count('Projects.id')
            ])
                ->leftJoinWith('Projects')
                ->groupBy(['Organisations.id'])
                ->having(['total_projects >=' => $projectCount]);
        }


        $organisations = $this->paginate($query);


        $this->set(compact('organisations'));
    }

    /**
     * View method
     *  Displays details of a single organisation, including related contacts and projects
     * @param string|null $id Organisation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $organisation = $this->Organisations->get($id, contain: ['Contact', 'Projects']);
        $this->set(compact('organisation'));
    }

    /**
     * Add method
     *  Allows the addition of a new organisation to the database. Redirects on success
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $organisation = $this->Organisations->newEmptyEntity();
        if ($this->request->is('post')) {
            $organisation = $this->Organisations->patchEntity($organisation, $this->request->getData());
            if ($this->Organisations->save($organisation)) {
                $this->Flash->success(__('The organisation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The organisation could not be saved. Please, try again.'));
        }
        $this->set(compact('organisation'));
    }

    /**
     * Edit method
     *  Allows the addition of a new organisation to the database. Redirects on success
     * @param string|null $id Organisation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $organisation = $this->Organisations->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $organisation = $this->Organisations->patchEntity($organisation, $this->request->getData());
            if ($this->Organisations->save($organisation)) {
                $this->Flash->success(__('The organisation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The organisation could not be saved. Please, try again.'));
        }
        $this->set(compact('organisation'));
    }

    /**
     * Delete method
     *  Removes an organisation from the database, if it exists. Redirects on success
     * @param string|null $id Organisation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $organisation = $this->Organisations->get($id);
        if ($this->Organisations->delete($organisation)) {
            $this->Flash->success(__('The organisation has been deleted.'));
        } else {
            $this->Flash->error(__('The organisation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

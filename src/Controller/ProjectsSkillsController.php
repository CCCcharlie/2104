<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProjectsSkills Controller
 *
 * @property \App\Model\Table\ProjectsSkillsTable $ProjectsSkills
 */
class ProjectsSkillsController extends AppController
{
    /**
     * Index method
     * Displays a paginated list of project-skill associations, including related project and skill data.
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->ProjectsSkills->find()
            ->contain(['Projects', 'Skills']);
        $projectsSkills = $this->paginate($query);

        $this->set(compact('projectsSkills'));
    }

    /**
     * View method
     * Displays detailed information about a specific project-skill association.
     * @param string|null $id Projects Skill id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projectsSkill = $this->ProjectsSkills->get($id, contain: ['Projects', 'Skills']);
        $this->set(compact('projectsSkill'));
    }

    /**
     * Add method
     * Creates a new project-skill association. On successful save, redirects to the index; otherwise, renders the form with validation errors.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $projectsSkill = $this->ProjectsSkills->newEmptyEntity();
        if ($this->request->is('post')) {
            $projectsSkill = $this->ProjectsSkills->patchEntity($projectsSkill, $this->request->getData());
            if ($this->ProjectsSkills->save($projectsSkill)) {
                $this->Flash->success(__('The projects skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projects skill could not be saved. Please, try again.'));
        }
        $projects = $this->ProjectsSkills->Projects->find('list', limit: 200)->all();
        $skills = $this->ProjectsSkills->Skills->find('list', limit: 200)->all();
        $this->set(compact('projectsSkill', 'projects', 'skills'));
    }

    /**
     * Edit method
     * Updates an existing project-skill association. On successful save, redirects to the index; otherwise, renders the form with validation errors.
     * @param string|null $id Projects Skill id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $projectsSkill = $this->ProjectsSkills->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $projectsSkill = $this->ProjectsSkills->patchEntity($projectsSkill, $this->request->getData());
            if ($this->ProjectsSkills->save($projectsSkill)) {
                $this->Flash->success(__('The projects skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The projects skill could not be saved. Please, try again.'));
        }
        $projects = $this->ProjectsSkills->Projects->find('list', limit: 200)->all();
        $skills = $this->ProjectsSkills->Skills->find('list', limit: 200)->all();
        $this->set(compact('projectsSkill', 'projects', 'skills'));
    }

    /**
     * Delete method
     * Deletes an existing project-skill association. Redirects to the index on successful deletion, with appropriate success or error messages.
     * @param string|null $id Projects Skill id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $projectsSkill = $this->ProjectsSkills->get($id);
        if ($this->ProjectsSkills->delete($projectsSkill)) {
            $this->Flash->success(__('The projects skill has been deleted.'));
        } else {
            $this->Flash->error(__('The projects skill could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

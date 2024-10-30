<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Skills Controller
 *
 * @property \App\Model\Table\SkillsTable $Skills
 */
class SkillsController extends AppController
{
    /**
     * Index method
     * Displays a paginated list of skills.
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Skills->find();
        $skills = $this->paginate($query);

        $this->set(compact('skills'));
    }

    /**
     * View method
     * Displays detailed information about a specific skill and its related projects.
     * @param string|null $id Skill id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $skill = $this->Skills->get($id, contain: ['Projects']);
        $this->set(compact('skill'));
    }

    /**
     * Add method
     * Creates a new skill. On successful save, redirects to the index; otherwise, renders the form with validation errors.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $skill = $this->Skills->newEmptyEntity();
        if ($this->request->is('post')) {
            $skill = $this->Skills->patchEntity($skill, $this->request->getData());
            if ($this->Skills->save($skill)) {
                $this->Flash->success(__('The skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The skill could not be saved. Please, try again.'));
        }
        $projects = $this->Skills->Projects->find('list', limit: 200)->all();
        $this->set(compact('skill', 'projects'));
    }

    /**
     * Edit method
     * Updates an existing skill. On successful save, redirects to the index; otherwise, renders the form with validation errors.
     * @param string|null $id Skill id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $skill = $this->Skills->get($id, contain: ['Projects']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $skill = $this->Skills->patchEntity($skill, $this->request->getData());
            if ($this->Skills->save($skill)) {
                $this->Flash->success(__('The skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The skill could not be saved. Please, try again.'));
        }
        $projects = $this->Skills->Projects->find('list', limit: 200)->all();
        $this->set(compact('skill', 'projects'));
    }

    /**
     * Delete method
     * Deletes an existing skill. Redirects to the index on successful deletion, with appropriate success or error messages.
     * @param string|null $id Skill id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $skill = $this->Skills->get($id);
        if ($this->Skills->delete($skill)) {
            $this->Flash->success(__('The skill has been deleted.'));
        } else {
            $this->Flash->error(__('The skill could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

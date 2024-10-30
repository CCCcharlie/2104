<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ContractorsSkills Controller
 *
 * @property \App\Model\Table\ContractorsSkillsTable $ContractorsSkills
 */
class ContractorsSkillsController extends AppController
{
    /**
     * Index method
     *
     * Displays a list of all contractor-skill relationships. Retrieves data from
     *  the ContractorsSkills table along with associated Contractor and Skill records
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->ContractorsSkills->find()
            ->contain(['Contractors', 'Skills']);
        $contractorsSkills = $this->paginate($query);

        $this->set(compact('contractorsSkills'));
    }

    /**
     * View method
     *
     * Displays details for a specific contractor-skill relationship based on ID.
     *  Retrieves the contractor-skill record along with associated Contractor and Skill data
     *
     * @param string|null $id Contractors Skill id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contractorsSkill = $this->ContractorsSkills->get($id, contain: ['Contractors', 'Skills']);
        $this->set(compact('contractorsSkill'));
    }

    /**
     * Add method
     *
     * Handles the creation of a new contractor-skill relationship. Processes form
     *  submission and saves the data to the database if valid. On successful save, redirects to index
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contractorsSkill = $this->ContractorsSkills->newEmptyEntity();
        if ($this->request->is('post')) {
            $contractorsSkill = $this->ContractorsSkills->patchEntity($contractorsSkill, $this->request->getData());
            if ($this->ContractorsSkills->save($contractorsSkill)) {
                $this->Flash->success(__('The contractors skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractors skill could not be saved. Please, try again.'));
        }
        $contractors = $this->ContractorsSkills->Contractors->find('list', limit: 200)->all();
        $skills = $this->ContractorsSkills->Skills->find('list', limit: 200)->all();
        $this->set(compact('contractorsSkill', 'contractors', 'skills'));
    }

    /**
     * Edit method
     *
     * Allows editing of an existing contractor-skill relationship based on ID.
     *  Processes form submission and applies changes to the database if valid
     *
     * @param string|null $id Contractors Skill id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contractorsSkill = $this->ContractorsSkills->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contractorsSkill = $this->ContractorsSkills->patchEntity($contractorsSkill, $this->request->getData());
            if ($this->ContractorsSkills->save($contractorsSkill)) {
                $this->Flash->success(__('The contractors skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contractors skill could not be saved. Please, try again.'));
        }
        $contractors = $this->ContractorsSkills->Contractors->find('list', limit: 200)->all();
        $skills = $this->ContractorsSkills->Skills->find('list', limit: 200)->all();
        $this->set(compact('contractorsSkill', 'contractors', 'skills'));
    }

    /**
     * Delete method
     *
     * Deletes a contractor-skill relationship based on the provided ID. If deletion
     *  is successful, redirects to the index. Otherwise, displays an error message
     *
     * @param string|null $id Contractors Skill id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contractorsSkill = $this->ContractorsSkills->get($id);
        if ($this->ContractorsSkills->delete($contractorsSkill)) {
            $this->Flash->success(__('The contractors skill has been deleted.'));
        } else {
            $this->Flash->error(__('The contractors skill could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->Authentication->allowUnauthenticated(['login']);
    }

    /**
     * Index method
     * Displays a paginated list of users.
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     * Displays details of a specific user.
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *Creates a new user account. On successful save, redirects to the index page.
     *  Renders the form with validation errors otherwise
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *Updates an existing user's information. On successful save, redirects to the index.
     *  Renders the form with validation errors otherwise
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     * Deletes an existing user account. Redirects to the index with a success or error message.
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Login method
     *Authenticates the user based on submitted credentials. Redirects to Projects index on success.
     *  Displays an error message if authentication fails
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();


        if ($result->isValid()) {
            $this->Flash->success(__('Login successful'));
//            $redirect = $this->Authentication->getLoginRedirect();

            return $this->redirect(['controller' => 'Projects', 'action' => 'index']);
//
//            if ($redirect) {
//                return $this->redirect($redirect);
//            }
        }

        // Display error if user submitted and authentication failed
        else if ($this->request->is('post')) {

//
//            $email = $this->request->getData('email'); //  email
//            $password = $this->request->getData('password'); //  password


//            debug(['email' => $email, 'password' => $password]);
//            debug($result); //
//            debug($this->request->getRequestTarget());

            $this->Flash->error(__('Invalid username or password'));
        }
    }

    //Ends the user's session and redirects them to the login page with a logout message.
    public function logout() {
        // end the user session
        $this->Authentication->logout();

        // message
        $this->Flash->success(__('You have been logged out.'));


        return $this->redirect('/users/login');
    }
}

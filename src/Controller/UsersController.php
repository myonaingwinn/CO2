<?php

declare(strict_types=1);

namespace App\Controller;

use SebastianBergmann\Environment\Console;

use function PHPUnit\Framework\isEmpty;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $data = $this->Users->find('all', array('conditions' => array('Users.del_flg' => 'N')));
        $users = $this->paginate($data);
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
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
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //change role
        $this->request->allowMethod('get');
        $roleData = $this->request->getQuery('role');
        $id = $this->request->getQuery('userID');
        $data = $this->Users->find('all', [
            'conditions' => ([
                ['Users.id' => $id],
                ['Users.del_flg' => 'N']
            ])
        ]);
        $users = $data->toArray();
        $users[0]->role = $roleData;
        if ($this->Users->save($users[0])) {
            $this->Flash->success(__('The user has been saved.'));
            return $this->redirect(['action' => 'edit']);
        } else {
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $data = $this->Users->find('all', array('conditions' => array('Users.del_flg' => 'N')));
        $users = $this->paginate($data);
        $this->set(compact('users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
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

    //Search
    public function search()
    {

        $this->request->allowMethod('ajax');

        $keyword = $this->request->getQuery('keyword');

        $query = $this->Users->find('all', [
            'conditions' => ([
                'Or' => [
                    ['Users.name LIKE' => '%' . $keyword . '%'],
                    ['Users.email like' => '%' . $keyword . '%'],
                    ['Users.role like' => '%' . $keyword . '%'],
                    ['Users.last_login like' => '%' . $keyword . '%']
                ],
                'AND' => ['Users.del_flg' => 'N']
            ]),
            'order' => ['Users.name' => 'ASC']

        ]);
        $users = $this->paginate($query);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }
}

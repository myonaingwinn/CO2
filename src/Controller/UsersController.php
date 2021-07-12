<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Security;
use Cake\I18n\Time;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Mailer;

use function React\Promise\all;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if (!$user) {
                $this->Flash->error(__('ユーザー名かパスワードが間違っています.'));
            } else {
                $last_login = date("Y-m-d H:i:s");

                $id = $user['id'];
                $data = $this->Users->find('all', [
                    'conditions' => ([
                        ['Users.id' => $id],
                        ['Users.del_flg' => 'N']
                    ])
                ]);
                $users = $data->toArray();
                $users[0]->last_login = $last_login;
                $this->Users->save($users[0]);

                if ($user['role'] == 'A') {
                    $this->Auth->setUser($user);
                    return $this->redirect('/dashboard');
                } else if ($user['role'] == 'U') {
                    $this->Auth->setUser($user);
                    return $this->redirect('/dashboard');
                }
            }
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function forgotpassword()
    {
        if ($this->request->is('post')) {

            $email = $this->request->getData('email');
            $token = Security::hash(Security::randomBytes(25));

            $userTable =  $this->loadModel('Users');;
            // if ($email == NULL) {
            //     $this->Flash->error(__('メールアドレスは入力必須項目です.'));
            // }
            // else
            if ($user = $userTable->find('all')->where(['email' => $email])->first()) {

                $user->token = $token;
                if ($userTable->save($user)) {

                    $this->Flash->success('パスワードのリセットリンクがメールに送信されました。 (' . $email . ')メールを確認してください。');

                    $mailer = new Mailer('default');
                    $mailer->setTransport('mailForget');
                    $mailer->setfrom(['soetest1991@gmail.com' => 'CO2'])
                        ->setTo($email)
                        ->setEmailFormat('html')
                        ->setSubject('Forgot Password Request')
                        ->deliver('<br/>こんにちは
パスワードをリセットするには、<br/>以下のリンクをクリックしてください。<br/><br/><a href="http://localhost:8765/users/resetpassword/' . $token . '">パスワードのリセット</a>');
                }
            } else if ($userTable->find('all')->where(['email' => $email])->count() == 0) {
                $this->Flash->error(__('メールアドレスが存在しません。'));
            }
        }
    }

    public function resetpassword($token)
    {
        if ($this->request->is('post')) {
            $hasher = new DefaultPasswordHasher();
            //   $newpass = $hasher->hash($this->request->getData('password'));
            $newpass = $this->request->getData('password');
            $userTable = $this->loadModel('Users');
            //  $userTable = TableRegistry::get('Users');
            $user = $userTable->find('all')->where(['token' => $token])->first();

            $user->password = $newpass;

            if ($userTable->save($user)) {

                $this->Flash->success(__('パスワードが正常にリセットされました。新しいパスワードを使用してログインしてください。'));
                // return $this->redirect(['action' => 'login']);
                return $this->redirect($this->Auth->logout());
            }
        }
    }

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
            $email = $this->request->getData('email');


            $user_c = $this->Users->find()->where(['email' => $email])->count();
            if ($user_c >= 1) {
                $this->Flash->success(__('メール名が存在します。'));
            } else {
                $user = $this->Users->patchEntity($user, $this->request->getData());

                $uid = Security::hash(Security::randomBytes(25));
                $currDateTime = Time::now();

                $user->uid = $uid;

                $user->created = $currDateTime;

                $user->del_flg = 'N';


                if ($this->Users->save($user)) {
                    $this->Flash->success(__('ユーザーが保存されました。'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
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
    public function changeRole($id = null)
    { //change role
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
            $this->Flash->success(__('ユーザーが保存されました。'));
            return $this->redirect(['action' => 'edit']);
        } else {
            $this->Flash->error(__('ユーザーを保存できませんでした。 もう一度やり直してください。'));
        }
        $data = $this->Users->find('all', array('conditions' => array('Users.del_flg' => 'N')));
        $users = $this->paginate($data);
        $this->set(compact('users'));
        // return $this->redirect(['action' => 'index']);
    }

    //edit

    public function edit($id = null)
    {
        $data = $this->Users->find('all', array('conditions' => [
            'and' => ['Users.del_flg' => 'N'],
            ['Users.id' => $id]
        ]));
        $users = $data->toArray();
        $user = $users[0];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('ユーザーが保存されました。'));
                return $this->redirect('/users');
            }
            $this->Flash->error(__('ユーザーを保存できませんでした。 もう一度やり直してください。'));
        }
        $this->set(compact('user'));
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
            $this->Flash->success(__('ユーザーが削除されました。'));
        } else {
            $this->Flash->error(__('ユーザーを削除できませんでした。 もう一度やり直してください。'));
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

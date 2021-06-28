<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Security;
use Cake\I18n\Time;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Mailer;
use Cake\Event\EventInterface;



/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{


    public function admin()
    {
    }


    public function editor()
    {
    }
    public function login()
    {

        if ($this->request->is('post')) {

            $user = $this->Auth->identify();
            $email = $this->request->getData('email');
            $password = $this->request->getData('password');

            // if ($email == NULL) {
            //     $this->Flash->error(__('メールアドレスは入力必須項目です.'));
            // } else if ($password == NULL) {
            //     $this->Flash->error(__('パスワードは入力必須項目です.'));
            // } else {

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
                    return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                } else if ($user['role'] == 'U') {


                    $this->Auth->setUser($user);

                    return $this->redirect(['controller' => 'Users', 'action' => 'admin']);
                }
            } //user exist
            // }
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
        $users = $this->paginate($this->Users);

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
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
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
}

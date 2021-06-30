<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UserGraphDisplay Controller
 *
 * @method \App\Model\Entity\UserGraphDisplay[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserGraphDisplayController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // $this->loadModel('co2datadetails');
        // $data = $this->co2datadetails->find()->where([
        //         ['co2datadetails.co2_device_id' => 2],
        //         ['co2datadetails.id' => 2]
        //     ])->first();
        // $temperature = $data->temperature;
        // $time = $data->time_measured;

        $temperature = rand(100,200);
        $time = rand(50,60);
        $this->set(compact('temperature','time'));
    }

    /**
     * View method
     *
     * @param string|null $id User Graph Display id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userGraphDisplay = $this->UserGraphDisplay->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('userGraphDisplay'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userGraphDisplay = $this->UserGraphDisplay->newEmptyEntity();
        if ($this->request->is('post')) {
            $userGraphDisplay = $this->UserGraphDisplay->patchEntity($userGraphDisplay, $this->request->getData());
            if ($this->UserGraphDisplay->save($userGraphDisplay)) {
                $this->Flash->success(__('The user graph display has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user graph display could not be saved. Please, try again.'));
        }
        $this->set(compact('userGraphDisplay'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Graph Display id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // $this->loadModel('co2datadetails');
        // $this->request->allowMethod('get');
        // $roleData = $this->request->getQuery('role');
        // $data = $this->co2datadetails->find()->where([
        //         ['co2datadetails.co2_device_id' => 2],
        //         ['co2datadetails.id' => $roleData]
        //     ])->first();
        // $temperature = $data->temperature;
        // $time = $data->time_measured;
        $temperature = rand(-2,2);
        // $temperature = $roleData;
        $time = rand(50,60);
        $this->set(compact('temperature','time'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Graph Display id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userGraphDisplay = $this->UserGraphDisplay->get($id);
        if ($this->UserGraphDisplay->delete($userGraphDisplay)) {
            $this->Flash->success(__('The user graph display has been deleted.'));
        } else {
            $this->Flash->error(__('The user graph display could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

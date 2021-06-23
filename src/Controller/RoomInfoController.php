<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * RoomInfo Controller
 *
 * @property \App\Model\Table\RoomInfoTable $RoomInfo
 * @method \App\Model\Entity\RoomInfo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoomInfoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->loadModel('RoomInfo');
        $this->paginate = [
            'contain' => ['Co2datadetails'],
        ];
        $roomInfo = $this->paginate($this->RoomInfo);

        $this->set(compact('roomInfo'));
    }

    /**
     * View method
     *
     * @param string|null $id Room Info id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $roomInfo = $this->RoomInfo->get($id, [
            'contain' => ['Co2datadetails'],
        ]);

        $this->set(compact('roomInfo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('RoomInfo');
        $this->loadModel('Users');
        $roomInfo = $this->RoomInfo->newEmptyEntity();
        if ($this->request->is('post')) {
            $roomInfo = $this->RoomInfo->patchEntity($roomInfo, $this->request->getData());
            if ($this->RoomInfo->save($roomInfo)) {
                $this->Flash->success(__('The room info has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room info could not be saved. Please, try again.'));
        }
        $co2datadetails = $this->RoomInfo->Co2datadetails->find('list', ['limit' => 200]);
        $users = $this->Users->find('all')->where(['del_flg' => 'N'])->toArray();
        $this->set(compact('roomInfo', 'co2datadetails', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Room Info id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $roomInfo = $this->RoomInfo->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $roomInfo = $this->RoomInfo->patchEntity($roomInfo, $this->request->getData());
            if ($this->RoomInfo->save($roomInfo)) {
                $this->Flash->success(__('The room info has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room info could not be saved. Please, try again.'));
        }
        $co2datadetails = $this->RoomInfo->Co2datadetails->find('list', ['limit' => 200]);
        $this->set(compact('roomInfo', 'co2datadetails'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Room Info id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $roomInfo = $this->RoomInfo->get($id);
        if ($this->RoomInfo->delete($roomInfo)) {
            $this->Flash->success(__('The room info has been deleted.'));
        } else {
            $this->Flash->error(__('The room info could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

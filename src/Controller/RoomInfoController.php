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
            'contain' => ['Co2datadetails', 'Users'],
        ];
        $roomInfo = $this->paginate($this->RoomInfo->find('all')->where(['RoomInfo.del_flg' => 'N']));

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
                $this->Flash->success(__('デバイス情報が保存されました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('デバイス名はすでに使用されています。 もう一度やり直してください。'));  //デバイス情報を保存できませんでした。
        }
        $co2datadetails = $this->RoomInfo->Co2datadetails->find('list', ['limit' => 200]);
        $users = $this->Users->find('all')->where(['del_flg' => 'N', 'role' => 'U'])->toArray();
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
        $this->request->allowMethod(['patch', 'post', 'put']);
        $roomInfo = $this->RoomInfo->get($id);

        $query = $this->RoomInfo->Co2datadetails->find('all')->where(['co2_device_id' => $id])->select('co2_device_id');
        $data = $query->toArray();
        $device_id = implode(' ', $data);

        if (!empty($device_id))
            $this->Flash->error(__('このデバイスは使用中のため、削除できませんでした。'));
        else {
            $roomInfo->del_flg = 'Y';
            if ($this->RoomInfo->save($roomInfo)) {
                $this->Flash->success(__('デバイスが削除されました。'));
            } else {
                $this->Flash->error(__('デバイスを削除できませんでした。もう一度やり直してください。'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    public function search()
    {
        // $this->loadModel('RoomInfo');
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $this->request->allowMethod('ajax');
        $keyword = $this->request->getQuery('keyword');
        $query = $this->RoomInfo
            ->find()
            ->join(
                ['u' => [
                    'table' => 'Users', 'type' => 'INNER',
                    'conditions' => 'u.uid = RoomInfo.user_uid'
                ]]
            )
            ->where(
                [
                    'OR' => [
                        'RoomInfo.device_id LIKE' => '%' . $keyword . '%',
                        'RoomInfo.postal_code like' => '%' . $keyword . '%',
                        'RoomInfo.prefecture like' => '%' . $keyword . '%',
                        'RoomInfo.address like' => '%' . $keyword . '%',
                        'RoomInfo.room_no like' => '%' . $keyword . '%',
                        'u.name like' => '%' . $keyword . '%'
                    ],
                    'NOT' => ['RoomInfo.del_flg' => 'Y']
                ]
            )
            ->orderAsc('RoomInfo.device_id');
        $roomInfo = $this->paginate($query);
        $this->set(compact('roomInfo'));
        $this->set('_serialize', ['roomInfo']);
    }
}

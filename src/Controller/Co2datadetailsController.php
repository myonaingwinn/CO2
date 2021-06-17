<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Co2datadetails Controller
 *
 * @property \App\Model\Table\Co2datadetailsTable $Co2datadetails
 * @method \App\Model\Entity\Co2datadetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class Co2datadetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // $this->paginate = [
        //     'contain' => ['RoomInfo'],
        // ];
        // $co2datadetails = $this->paginate($this->Co2datadetails);

        $devices = $this->Co2datadetails->find()->select(['device' => 'co2_device_id', 'temperature', 'humidity', 'co2', 'noise', 'date'  => 'max(time_measured)', 'room' => 'r.room_no'])->join(['r' => [
            'table' => 'Room_Info',
            'type' => 'INNER',
            'conditions' => 'r.device_id = Co2datadetails.co2_device_id'
        ]])->group('r.device_id')->toArray();

        $this->set(compact(['devices']));
    }

    /**
     * View method
     *
     * @param string|null $id Co2datadetail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $co2datadetail = $this->Co2datadetails->get($id, [
            'contain' => ['Co2Devices'],
        ]);

        $this->set(compact('co2datadetail'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $co2datadetail = $this->Co2datadetails->newEmptyEntity();
        if ($this->request->is('post')) {
            $co2datadetail = $this->Co2datadetails->patchEntity($co2datadetail, $this->request->getData());
            if ($this->Co2datadetails->save($co2datadetail)) {
                $this->Flash->success(__('The co2datadetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The co2datadetail could not be saved. Please, try again.'));
        }
        $co2Devices = $this->Co2datadetails->Co2Devices->find('list', ['limit' => 200]);
        $this->set(compact('co2datadetail', 'co2Devices'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Co2datadetail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $co2datadetail = $this->Co2datadetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $co2datadetail = $this->Co2datadetails->patchEntity($co2datadetail, $this->request->getData());
            if ($this->Co2datadetails->save($co2datadetail)) {
                $this->Flash->success(__('The co2datadetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The co2datadetail could not be saved. Please, try again.'));
        }
        $co2Devices = $this->Co2datadetails->Co2Devices->find('list', ['limit' => 200]);
        $this->set(compact('co2datadetail', 'co2Devices'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Co2datadetail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $co2datadetail = $this->Co2datadetails->get($id);
        if ($this->Co2datadetails->delete($co2datadetail)) {
            $this->Flash->success(__('The co2datadetail has been deleted.'));
        } else {
            $this->Flash->error(__('The co2datadetail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

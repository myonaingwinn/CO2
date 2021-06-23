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
        //  Table data   
            $devices = $this->Co2datadetails->find()->select(['device' => 'co2_device_id', 'temperature', 'humidity', 'co2', 'noise', 'date'  => 'max(time_measured)', 'room' => 'r.room_no'])->join(['r' => [
            'table' => 'Room_Info',
            'type' => 'INNER',
            'conditions' => 'r.device_id = Co2datadetails.co2_device_id'
        ]])->group('r.device_id')->toArray();

        $this->set(compact('devices'));

        // co2datadetail table query
        $currentDateTime = date('Y-m-d H:m:s');

        $query = $this->Co2datadetails->find()
            ->select(['co2_device_id', 'temperature', 'humidity', 'co2', 'noise', 'time_measured', 'room' => 'r.room_no'])
            ->join(['r' => ['table' => 'Room_Info', 'type' => 'INNER', 'conditions' => 'r.device_id = Co2datadetails.co2_device_id']])
            // ->where(['Co2datadetails.time_measured >=' => $currentDateTime])
            ->order(['co2_device_id' => 'ASC', 'time_measured' => 'DESC'])
            ->limit(86400)
            ->toArray();

        // declare for each graph data array
        $num_devices = $temp = $hum = $co2 = $noise = [];
        $current_dev = $next_dev = '';
        
        // data split with censor data loop
        foreach($query as $row) {

            // time measured standard schema
            $dateArr = (array) $row["time_measured"];
            $dateStr = implode("", $dateArr);
            $date = explode(".", $dateStr);

            // array push for each graph
            array_push($temp, array($row["co2_device_id"],$date[0],$row["temperature"]));
            array_push($hum, array($row["co2_device_id"],$date[0],$row["humidity"]));
            array_push($co2, array($row["co2_device_id"],$date[0],$row["co2"]));
            array_push($noise, array($row["co2_device_id"],$date[0],$row["noise"]));
            
            // number of device
            $current_dev = $row["co2_device_id"];
            if ($current_dev != $next_dev)
            array_push($num_devices, array($row["co2_device_id"]));
            $next_dev = $row["co2_device_id"];
        }

        $tempalldata = $humalldata = $co2alldata = $noisealldata = [];
        $i = 1;
        echo count($num_devices);
        // data split with device loop
        for ($i; $i <= count($num_devices); $i++) {
            
            ${"temp$i"} = ${"hum$i"} = ${"co2$i"} = ${"noise$i"} = [];
            
            foreach($temp as $tempdata) {
                if ($tempdata[0] == "dvTest".$i) 
                    array_push(${"temp$i"}, $tempdata);
            }
            array_push($tempalldata,${"temp$i"});
            
            foreach($hum as $humdata) {
                if ($humdata[0] == "dvTest".$i) 
                    array_push(${"hum$i"}, $humdata);
            }
            array_push($humalldata,${"hum$i"});

            foreach($co2 as $co2data) {
                if ($co2data[0] == "dvTest".$i) 
                    array_push(${"co2$i"}, $co2data);
            }
            array_push($co2alldata,${"co2$i"});

            foreach($noise as $noisedata) {
                if ($noisedata[0] == "dvTest".$i) 
                    array_push(${"noise$i"}, $noisedata);
            }
            array_push($noisealldata,${"noise$i"});
        }

        // sent array data to template
        $this->set(compact('tempalldata', 'humalldata', 'co2alldata', 'noisealldata', 'num_devices'));
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

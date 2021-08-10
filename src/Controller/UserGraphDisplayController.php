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
        // $dev_data = [];
        $device_name = [];
        $this->loadModel('co2datadetails');
        $devices = $this->co2datadetails->find('all');
        $devices->select(['co2_device_id'])->distinct(['co2_device_id']);
        foreach ($devices as $dev) {
            array_push($device_name, $dev->co2_device_id);
            // $dev_name = $devices->co2_device_id;
            // $query = $this->co2datadetails->find('all')
            // ->where(['co2_device_id >' => $dev->co2_device_id])
            // ->limit(86400)->toArray();
            // $query_arr = [];
            // foreach ($query as $row_query) {
            //     // time measured standard schema
            //     $dateArr = (array) $row_query["time_measured"];
            //     $dateStr = implode("", $dateArr);
            //     $date = explode(".", $dateStr);
            //     // array push for schema format
            //     array_push($query_arr, array($date[0],$row_query["temperature"],$row_query["humidity"]
            //     ,$row_query["co2"],$row_query["noise"]));
            // }

            //     array_push($dev_data,$query_arr);
        }

        //  $this->set(compact('device_name','dev_data'));



        // declare for query variable
        $query_var_one = "dvTest";
        $query_var_two = "";
        $query_arr = [];

        $this->loadModel('co2datadetails');
        $query = $this->co2datadetails->find()->select(['co2_device_id'])
            ->group('co2_device_id');
        // echo json_encode($query);
        // $query1 = json_encode($query[]);
        $query1 = $query->toArray();
        // $query2 = json_decode($query1, true);
        // $num_devices = count($query2);

        $device = [];
        $i = 0;
        foreach ($query as $row) {


            $query_device = $this->co2datadetails->find()
                ->select(['temperature', 'humidity', 'co2', 'noise', 'time_measured', 'co2_device_id'])
                ->where(['co2_device_id' =>  $row['co2_device_id']]);
            $query_arr = [];
            foreach ($query_device as $row_query) {

                // time measured standard schema
                $dateArr = (array) $row_query["time_measured"];
                $dateStr = implode("", $dateArr);
                $date = explode(".", $dateStr);

                // echo $row_query["temperature"];

                // array push for schema format
                array_push($query_arr, array(
                    $date[0], $row_query["temperature"], $row_query["humidity"], $row_query["co2"], $row_query["noise"], $row_query["co2_device_id"]
                ));
            }
            $device[$i] = $query_arr;
            //  echo $device[$i];
            $i++;
        }
        //  echo json_encode($device);
        $this->set(compact('device', 'device_name'));

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

        // declare for query variable
        $query_var_one = "dvTest";
        $query_var_two = "";
        $query_arr = [];

        $this->loadModel('co2datadetails');
        // $this->loadModel('room_info');
        $query = $this->co2datadetails->find('all')->limit(86400)->toArray();
        // $devices = $this->room_info->find('all')->select(['device_id'])->distinct(['device_id']);

        foreach ($query as $row_query) {
            
            // time measured standard schema
            $dateArr = (array) $row_query["time_measured"];
            $dateStr = implode("", $dateArr);
            $date = explode(".", $dateStr);

            // array push for schema format
            array_push($query_arr, array($date[0],$row_query["temperature"],$row_query["humidity"]
            ,$row_query["co2"],$row_query["noise"]));
            // array_push($query_arr, array($date[0],"Humidity",$row_query["humidity"]));
            // array_push($query_arr, array($date[0],"Noise",$row_query["co2"]));
            // array_push($query_arr, array($date[0],"Humidity",$row_query["noise"]));
        }

        $json_query = json_encode($query_arr);

        $this->set(compact('json_query'));

        
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
        
        // $dev_data = [];
        $device_name = [];
        $this->loadModel('co2datadetails');
        $devices = $this->co2datadetails->find('all');
        $devices->select(['co2_device_id'])->distinct(['co2_device_id']);
        foreach($devices as $dev){
            array_push($device_name,$dev->co2_device_id );
            // $dev_name = $devices->co2_device_id;
            // $query = $this->co2datadetails->find('all')
            // ->where(['co2_device_id >' => $dev->co2_device_id])
            // ->limit(86400)->toArray();
            // $query_arr = [];
            // foreach ($query as $row_query) {
            //     // time measured standard schema
            //     $dateArr = (array) $row_query["time_measured"];
            //     $dateStr = implode("", $dateArr);
            //     $date = explode(".", $dateStr);
            //     // array push for schema format
            //     array_push($query_arr, array($date[0],$row_query["temperature"],$row_query["humidity"]
            //     ,$row_query["co2"],$row_query["noise"]));
            // }

        //     array_push($dev_data,$query_arr);
        }
        
        //  $this->set(compact('device_name','dev_data'));



         // declare for query variable
         $query_var_one = "dvTest";
         $query_var_two = "";
         $query_arr = [];
 
         $this->loadModel('co2datadetails');
         $query = $this->co2datadetails->find()->
         select(['co2_device_id'])
         ->group('co2_device_id');
         // echo json_encode($query);
         // $query1 = json_encode($query[]);
         $query1 = $query->toArray();
         // $query2 = json_decode($query1, true);
         // $num_devices = count($query2);
 
         $device = [];
         $i = 0;
         foreach ($query as $row) {
 
 
             $query_device = $this->co2datadetails->find()
             ->select(['temperature', 'humidity', 'co2', 'noise', 'time_measured', 'co2_device_id'])
             ->where(['co2_device_id' =>  $row['co2_device_id']]);
             $query_arr = [];
             foreach ($query_device as $row_query) {
 
                 // time measured standard schema
                 $dateArr = (array) $row_query["time_measured"];
                 $dateStr = implode("", $dateArr);
                 $date = explode(".", $dateStr);
 
                 // echo $row_query["temperature"];
 
                 // array push for schema format
                 array_push($query_arr, array(
                     $date[0], $row_query["temperature"], $row_query["humidity"], $row_query["co2"], $row_query["noise"], $row_query["co2_device_id"]
                 ));
             }
             $device[$i] = $query_arr;
             //  echo $device[$i];
             $i++;
         }
         //  echo json_encode($device);
         $this->set(compact('device','device_name'));


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

    public function onetimedata()
    {
        $this->request->allowMethod('get');
        
        $data = "one ";

        $type = $_GET['type'];

        // assign variables query
        $this->loadModel('co2datadetails');
        $query = $this->co2datadetails->find()
        ->select(['temperature','humidity','co2','noise','time_measured'])
        ->where(['co2_device_id' =>  $type])
        ->order(['time_measured' => 'DESC'])
        ->first();
        // $dd = $query["temperature"];
        // $time = json_encode($query->time_measured);
        // list($timedate, $timezone) = explode("+", $time);
        // list($date, $clock) = explode("T", $timedate);
        // $timeresult = $date.' '.$clock;
        // $data     = $query->type;

            $dateArr = (array) $query["time_measured"];
            $dateStr = implode("", $dateArr);
            $date = explode(".", $dateStr);
        
        $data = $query["temperature"]."#".$query["humidity"]."#".$query["co2"]."#".$query["noise"]."#".$date[0];
        echo $data;
        return $this->response;
        // DATE_FORMAT(TS, '%d-%m-%y %h:%i:%s');
    }

}

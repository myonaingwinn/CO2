<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;

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
        // Table data   
        $connection = ConnectionManager::get('default');

        $devices = $connection->execute("SELECT c.co2_device_id AS device, c.temperature, c.humidity, c.co2, c.noise, r.room_no AS room FROM Co2datadetails c JOIN Room_Info r ON c.co2_device_id = r.device_id, (SELECT cc.id, cc.co2_device_id, MAX(cc.time_measured) AS maxDate FROM Co2datadetails cc GROUP BY cc.co2_device_id) my WHERE c.co2_device_id=my.co2_device_id AND c.time_measured=my.maxDate AND c.time_measured >= CURDATE();")->fetchAll('assoc');

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
        foreach ($query as $row) {
            // time measured standard schema
            $dateArr = (array) $row["time_measured"];
            $dateStr = implode("", $dateArr);
            $date = explode(".", $dateStr);

            // array push for each graph
            array_push($temp, array($row["co2_device_id"], $date[0], $row["temperature"]));
            array_push($hum, array($row["co2_device_id"], $date[0], $row["humidity"]));
            array_push($co2, array($row["co2_device_id"], $date[0], $row["co2"]));
            array_push($noise, array($row["co2_device_id"], $date[0], $row["noise"]));

            // number of device
            $current_dev = $row["co2_device_id"];
            if ($current_dev != $next_dev)
                array_push($num_devices, array($row["co2_device_id"]));
            $next_dev = $row["co2_device_id"];
        }

        $tempalldata = $humalldata = $co2alldata = $noisealldata = [];
        $dname = "dvTest";
        $i = 1;

        // data split with device loop
        for ($i; $i <= count($num_devices); $i++) {

            ${"temp$i"} = ${"hum$i"} = ${"co2$i"} = ${"noise$i"} = [];

            foreach ($temp as $tempdata) {
                if ($tempdata[0] == $dname . $i)
                    array_push(${"temp$i"}, $tempdata);
            }
            array_push($tempalldata, ${"temp$i"});

            foreach ($hum as $humdata) {
                if ($humdata[0] == $dname . $i)
                    array_push(${"hum$i"}, $humdata);
            }
            array_push($humalldata, ${"hum$i"});

            foreach ($co2 as $co2data) {
                if ($co2data[0] == $dname . $i)
                    array_push(${"co2$i"}, $co2data);
            }
            array_push($co2alldata, ${"co2$i"});

            foreach ($noise as $noisedata) {
                if ($noisedata[0] == $dname . $i)
                    array_push(${"noise$i"}, $noisedata);
            }
            array_push($noisealldata, ${"noise$i"});
        }

        // sent array data to template
        $this->set(compact('tempalldata', 'humalldata', 'co2alldata', 'noisealldata', 'num_devices'));

        // date time max min query
        $datequery = $this->Co2datadetails->find()
            ->select(['startdate'  => 'min(time_measured)', 'enddate'  => 'max(time_measured)'])
            ->toArray();

        // date time format conversion
        $convstartdate = $datequery[0]->startdate;
        $startsec = strtotime($convstartdate);
        $start = date("Y-m-d", $startsec);
        $start2 = date("H:i", $startsec);
        $startdate = $start . 'T' . $start2;

        $convenddate = $datequery[0]->enddate;
        $endsec = strtotime($convenddate);
        $end = date("Y-m-d", $endsec);
        $end2 = date("H:i", $endsec);
        $enddate = $end . 'T' . $end2;

        // sent array data to template
        $this->set(compact('startdate', 'enddate'));

    }

    public function csv()
    {
        // get value from query url
        $starttime = $this->request->getQuery('start-time');
        $endtime = $this->request->getQuery('end-time');
        $dev_name = $this->request->getQuery('select-device');

        // csv file download name
        $this->response = $this->response->withDownload('co2datadetails.csv');

        // csv file query
        $csv_arr = $this->Co2datadetails->find()
            ->select(['id', 'co2_device_id', 'temperature', 'humidity', 'co2', 'noise', 'time_measured', 'room' => 'r.room_no'])
            ->join(['r' => ['table' => 'Room_Info', 'type' => 'INNER', 'conditions' => 'r.device_id = Co2datadetails.co2_device_id']])
            ->where(['Co2datadetails.co2_device_id LIKE' => $dev_name, 'Co2datadetails.time_measured >=' => $starttime, 'Co2datadetails.time_measured <=' => $endtime])
            ->order(['co2_device_id' => 'ASC', 'time_measured' => 'DESC']);
        $_serialize = 'csv_arr';
        $_header = ['ID', '装置名', '温度', '湿度', 'CO2', 'ノイズ', '測定時間', '部屋'];
        $_extract = ['id', 'co2_device_id', 'temperature', 'humidity', 'co2', 'noise', 'time_measured', 'room'];

        $this->viewBuilder()->setClassName('CsvView.Csv');

        // downloading file
        $this->set(compact('csv_arr', '_serialize', '_header', '_extract'));
    }

    public function view()
    {
        // graph data query
        $query = $this->Co2datadetails->find()
            ->select(['co2_device_id', 'temperature', 'humidity', 'co2', 'noise', 'time_measured', 'room' => 'r.room_no'])
            ->join(['r' => ['table' => 'Room_Info', 'type' => 'INNER', 'conditions' => 'r.device_id = Co2datadetails.co2_device_id']])
            // ->where(['Co2datadetails.time_measured >=' => $currentDateTime])
            ->order(['time_measured' => 'ASC', 'co2_device_id' => 'ASC',])
            ->limit(30000)
            ->toArray();

        // declare for each graph data array
        $num_devices = $temp = $hum = $co2 = $noise = [];
        $dv1 = $dv2 = $dv3 = [];
        $current_dev = $next_dev = '';

        // data split with censor data loop
        foreach ($query as $row) {
            // time measured standard schema
            $dateArr = (array) $row["time_measured"];
            $dateStr = implode("", $dateArr);
            $date = explode(".", $dateStr);

            // array push for each graph
            array_push($temp, array($date[0], $row["co2_device_id"], $row["temperature"]));
            array_push($hum, array($date[0], $row["co2_device_id"], $row["humidity"]));
            array_push($co2, array($date[0], $row["co2_device_id"], $row["co2"]));
            array_push($noise, array($date[0], $row["co2_device_id"], $row["noise"]));

            if ($row["co2_device_id"] == 'dvTest1')
                array_push($dv1, array($date[0], $row["temperature"], $row["humidity"], $row["co2"], $row["noise"], $row["co2_device_id"]));
            if ($row["co2_device_id"] == 'dvTest2')
                array_push($dv2, array($date[0], $row["temperature"], $row["humidity"], $row["co2"], $row["noise"], $row["co2_device_id"]));
            if ($row["co2_device_id"] == 'dvTest3')
                array_push($dv3, array($date[0], $row["temperature"], $row["humidity"], $row["co2"], $row["noise"], $row["co2_device_id"]));

            // number of device
            $current_dev = $row["co2_device_id"];
            if ($current_dev != $next_dev)
                array_push($num_devices, array($row["co2_device_id"]));
            $next_dev = $row["co2_device_id"];
        }

        // sent array data to template
        $this->set(compact('temp', 'hum', 'co2', 'noise', 'dv1', 'dv2', 'dv3'));
    }

    public function detail($id = null)
    {
        // id value split to customize query
        list($row, $row_num, $col, $col_num_one, $col_num_two, $graph, $dev_num) = explode("-", $id);

        // declare for query variable
        $query_var_one = "dvTest";
        $query_var_two = "";
        $query_arr = [];
        
        // variable assign 
        for ($i=0; $i<$dev_num; $i++) {
            if ($row_num == $i) $query_var_one = $query_var_one.($i+1);
            if ($col_num_one == 1) {
                if ($col_num_two == 0) $query_var_two = "temperature"; else $query_var_two = "humidity";
            } else {
                if ($col_num_two == 0) $query_var_two = "co2"; else $query_var_two = "noise";
            }
        }

        // assign variables query
        $query = $this->Co2datadetails->find()
            ->select(['co2_device_id', $query_var_two, 'time_measured'])
            ->where(['co2_device_id' => $query_var_one])
            ->order(['time_measured' => 'ASC'])
            ->limit(86400)
            ->toArray();

        // reassign query array format for json format
        foreach ($query as $row_query) {
            
            // time measured standard schema
            $dateArr = (array) $row_query["time_measured"];
            $dateStr = implode("", $dateArr);
            $date = explode(".", $dateStr);

            // array push for schema format
            array_push($query_arr, array($date[0],$row_query[$query_var_two],$row_query["co2_device_id"]));
        }

        $json_query = json_encode($query_arr);
        $device_name = $query_var_one;
        $sensor = $query_var_two;

        $this->set(compact('json_query', 'device_name', 'sensor'));

    }

    public function onetimedata()
    {
        $this->request->allowMethod('get');
        
        $data = 0;

        $type = $_GET['type'];
        $device = $_GET['device'];

        // assign variables query
        $query = $this->Co2datadetails->find()
            ->select(['type'  => $type, 'time_measured'])
            ->where(['co2_device_id' => $device])
            ->order(['time_measured' => 'DESC'])
            ->first();
        
        $time = json_encode($query->time_measured);
        list($timedate, $timezone) = explode("+", $time);
        list($date, $clock) = explode("T", $timedate);
        $timeresult = $date.' '.$clock;
        $data = $query->type;
        
        echo $data.$timeresult;
        return $this->response;
        // DATE_FORMAT(TS, '%d-%m-%y %h:%i:%s');
    }

    public function notify()
    {

        if (isset($_POST['image'])) {

            //----------Create Json File For Post Image

            if (file_exists(WWW_ROOT . '/graph/graphImg.json')) {
                unlink(WWW_ROOT . '/graph/graphImg.json');
            }
            $json_file = fopen(WWW_ROOT . '/graph/graphImg.json', "a") or die("Unable to open file!");
            $current_data = file_get_contents(WWW_ROOT . '/graph/graphImg.json');

            $array_data = json_decode($current_data, true);
            $extra = array(
                'imageURL' => $_POST['image']
            );
            $array_data[] = $extra;
            $final_data = json_encode($array_data);

            file_put_contents(WWW_ROOT . '/graph/graphImg.json', $final_data);

            fclose($json_file);
            //----------End Create Json File

            //----------Convert Json to Image with Base64 Decoder


            $imgContents = file_get_contents(WWW_ROOT . '/graph/graphImg.json');

            $str_length = strlen($imgContents);
            $sparrow = substr($imgContents, 37, $str_length - 40);
            $decoder = base64_decode($sparrow);
            $img = imagecreatefromstring($decoder);

            if (!$img) {
                die('base 64 value is not a valid image');
            } else {
                header('Content-Type:image/jpeg');

                imagejpeg($img, WWW_ROOT . '/graph/graphImage.jpeg');

                imagedestroy($img);
            }
            //----------End Convert Json to Image 

            //----------Line Message Notify
            $line_api = 'https://notify-api.line.me/api/notify';
            // $access_token = "k4rGxe8pDwINs1POVZQo1nniV7hGn9ibu4SiIoLSh9R"; // For My Personal Account
            $access_token = "pzV5k7fagBKn3agMGDmamUdUPkLPwStRsKqXVrP5yBG"; //For LineTest Group

            $message = '警告メッセージ';    //text max 1,000 charecter
            $image_thumbnail_url = 'https://dummyimage.com/1024x1024/f598f5/fff.jpg';  // max size 240x240px JPEG
            $image_fullsize_url = 'https://dummyimage.com/1024x1024/844334/fff.jpg'; //max size 1024x1024px JPEG

            $file_name_with_full_path = WWW_ROOT . '/graph/graphImage.jpeg';

            $imageFile = curl_file_create($file_name_with_full_path);
            $sticker_package_id = '';  // Package ID sticker
            $sticker_id = '';    // ID sticker
            $message_data = array(
                'imageThumbnail' => $image_thumbnail_url,
                'imageFullsize' => $image_fullsize_url,
                'message' => $message,
                'imageFile' => $imageFile,
                'stickerPackageId' => $sticker_package_id,
                'stickerId' => $sticker_id
            );

            $headers = array('Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer ' . $access_token);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $line_api);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $message_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            //----------End Line Message Notify

        } //end of isset IF
    }
}

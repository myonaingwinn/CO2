<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\Co2datadetailsHistoryTable;
use App\Model\Entity\Co2datadetailsHistory;

/**
 * Co2datadetailsHistory Controller
 *
 * @property \App\Model\Table\Co2datadetailsHistoryTable $Co2datadetailsHistory
 * @method \App\Model\Entity\Co2datadetailsHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class Co2datadetailsHistoryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Co2Devices'],
        ];
        $co2datadetailsHistory = $this->paginate($this->Co2datadetailsHistory);

        $this->set(compact('co2datadetailsHistory'));
    }

    // CSV Download Date Function
    public function csvdate()
    {
        // co2datadetail table query
        $currentDateTime = date('H:m:s');

        // get value from query url
        $startdate = $this->request->getQuery('start-date');
        $enddate = $this->request->getQuery('end-date');
        $dev_name = $this->request->getQuery('select-device-report');

        $this->Co2datadetailsHistory = new Co2datadetailsHistoryTable();

        // csv file download name
        $this->response = $this->response->withDownload('report_data.csv');
        if ($startdate <= $enddate) {
            // csv file query
            $csv_arr = $this->Co2datadetailsHistory->find()
                ->select(['id', 'co2_device_id', 'temperature', 'humidity', 'co2', 'noise', 'time_measured'])
                ->where(['co2_device_id LIKE' => $dev_name, 'time_measured >=' => $startdate . ' 00:00:00', 'time_measured <=' => $enddate . ' 23:59:59'])
                ->order(['co2_device_id' => 'ASC', 'time_measured' => 'DESC']);
            $_serialize = 'csv_arr';
            $_header = ['ID', '装置名', '温度', '湿度', 'CO2', 'ノイズ', '測定時間'];
            $_extract = ['id', 'co2_device_id', 'temperature', 'humidity', 'co2', 'noise', 'time_measured'];

            $this->viewBuilder()->setClassName('CsvView.Csv');
        } else {
            $this->Flash->error(__('開始日は必ず終了日よりも早くなければなりません。'));
            return $this->redirect(['action' => 'csvdownload']);
        }
        // downloading file
        $this->set(compact('csv_arr', '_serialize', '_header', '_extract'));
    }

    public function csvhistory()
    {
        // get value from query url
        $dev_name = $this->request->getQuery('select-device-history');
        $history_date = $this->request->getQuery('date-history');

        // csv file download name
        $this->response = $this->response->withDownload('history_data.csv');

        // csv file query
        $this->Co2datadetailsHistory = new Co2datadetailsHistoryTable();
        $csv_arr = $this->Co2datadetailsHistory->find()
            ->select(['id', 'co2_device_id', 'temperature', 'humidity', 'co2', 'noise', 'time_measured'])
            ->where(['co2_device_id LIKE' => $dev_name, 'time_measured >=' => $history_date . ' 00:00:00', 'time_measured <=' => $history_date . ' 23:59:59'])
            ->order(['co2_device_id' => 'ASC', 'time_measured' => 'DESC']);
        $_serialize = 'csv_arr';
        $_header = ['ID', '装置名', '温度', '湿度', 'CO2', 'ノイズ', '測定時間'];
        $_extract = ['id', 'co2_device_id', 'temperature', 'humidity', 'co2', 'noise', 'time_measured'];

        $this->viewBuilder()->setClassName('CsvView.Csv');

        // downloading file
        $this->set(compact('csv_arr', '_serialize', '_header', '_extract'));
    }
}

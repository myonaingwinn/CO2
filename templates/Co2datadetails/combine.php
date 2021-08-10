<style>
  #btnBack {
    padding-right: 20px;
  }

  .cap {
    text-transform: capitalize;
  }

  .card {
    margin-top: 1.5rem;
    margin-bottom: 3rem;
  }
</style>

<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<?php
$sensor_info = "";
$line_send_Time = "";

switch ($sensor) {
  case "temperature":
    $sensor_info = "温度";
    break;
  case "humidity":
    $sensor_info = "湿度";
    break;
  case "co2":
    $sensor_info = "CO2";
    break;
  case "noise":
    $sensor_info = "雑音";
    break;
}
?>

<div class="row">
  <div class="col-4">
    <h2 class="cap"><?= __($device_name) . " : " . __($sensor_info) ?></h2>
  </div>
  <div class="col-7"></div>
  <div class="col-1">
    <!-- Back Button -->
    <?= $this->Html->link(__('戻る'), ['action' => 'index'], ['class' => 'btn btn-primary', 'id' => 'btnBack']) ?>
  </div>
</div>

<?= $this->Form->hidden($sensor, ['value' => $sensor, 'id' => 'sensor']); ?>
<?= $this->Form->hidden($device_name, ['value' => $device_name, 'id' => 'device_name']); ?>

<?= $this->Form->hidden($sensor_info, ['value' => $sensor_info, 'id' => 'sensor_info']); ?>
<?= $this->Form->hidden($line_send_Time, ['value' => $line_send_Time, 'id' => 'line_send_Time']); ?>

<div class="card">
  <div class="card-body">
    <div id="chart-container"></div>
  </div>
</div>

<script>
  'use strict';

  var schema = [{
    name: 'Date Time',
    type: 'date',
    format: '%Y-%m-%d %H:%M:%S'
  }, {
    //name: '<?php echo $sensor_info; ?>',
    name: $("#sensor_info").val(),
    type: 'number'
  }, {
    name: 'Device',
    type: 'string'
  }];

  var json_data = <?php echo $json_query; ?>;
  var sensor = $("#sensor").val();
  var device_name = $("#device_name").val();
  var line_send_time = $("#line_send_time").val();
  var line_alert_type = $("#sensor_info").val();

  // update date & reload after 1000 mili seconds
  var getNextRandomDate = function getNextRandomDate(d) {
    return new Date(new Date(d).getTime() + 1000);
  };

  var fd = function fd(d) {
    var e = new Date(d.getTime() - d.getTimezoneOffset() * 60000).toISOString();
    var f = e.split('.')[0];
    var g = f.split('T');
    var h = g.join(' ');
    return h;
  };

  // get data from controller by ajax
  var sensorData = function sensorData(type, device) {
    var dataAjax = $.ajax({
      type: "GET",
      url: "<?= $this->Url->build(['controller' => 'Co2datadetails', 'action' => 'onetimedata']) ?>",
      data: {
        type: type,
        device: device
      },

      dataType: 'text',
      success: function(data) {
        return (data);
      },
      error: function() {
        return "Not Working!!!";
      },
      async: false,
      headers: {
        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
      }
    });
    return dataAjax.responseText;
  }

  // Fusioncharts data store
  var dataStore = new FusionCharts.DataStore().createDataTable(json_data, schema);
  // time series chart instance
  var realtimeChart = new FusionCharts({
    type: 'timeseries',
    renderAt: 'chart-container',
    width: '100%',
    height: '500',
    dataSource: {
      chart: {
        theme: 'candy',
        paletteColors: '#BDF5CA'
      },
      data: dataStore,
      yAxis: {
        plottype: 'smooth-area'
      },
      series: 'Device',
      navigator: {
        enabled: 0
      },
      legend: {
        enabled: 0
      }
    },

  });

  realtimeChart.addEventListener("rendered", function(_ref) {
    var realtimeChart = _ref.sender;

    realtimeChart.incrementor = setInterval(function() {

      if (realtimeChart.feedData) {
        var final_result_date = sensorData(sensor, device_name).split('"')[1];
        var final_result_data = sensorData(sensor, device_name).split('"')[0];
        realtimeChart.feedData([
          [final_result_date, final_result_data, device_name]
        ]);
      }
    }, 1000);
  });

  realtimeChart.addEventListener("disposed", function(eventObj) {
    var chartRef = eventObj;
    clearInterval(chartRef.incrementor);
  })

  realtimeChart.render();
</script>
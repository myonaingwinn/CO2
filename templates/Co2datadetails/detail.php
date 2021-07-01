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

<div class="row">
  <div class="col-4">
    <h2 class="cap"><?= __($device_name) . " : " . __($sensor) ?></h2>
  </div>
  <div class="col-7"></div>
  <div class="col-1">
    <!-- Back Button -->
    <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn btn-primary', 'id' => 'btnBack']) ?>
  </div>
</div>

<?= $this->Form->hidden($sensor, ['value' => $sensor, 'id' => 'sensor']); ?>
<?= $this->Form->hidden($device_name, ['value' => $device_name, 'id' => 'device_name']); ?>

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
    name: 'Temperature',
    type: 'number'
  }, {
    name: 'Device',
    type: 'string'
  }];

  var json_data = <?php echo $json_query; ?>;
  var sensor = $("#sensor").val();
  var device_name = $("#device_name").val();

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
        paletteColors: '#FFEB3B' //FFFF00'
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
  var pathname = window.location.pathname;
  var finalPathname = pathname.split('/')[3];
  var resultPathname = finalPathname.slice(0, finalPathname.length - 2)
  console.log(resultPathname);

  var lastTimeStr = json_data[json_data.length - 1][0];

  realtimeChart.addEventListener("rendered", function(_ref) {
    var realtimeChart = _ref.sender;

    lastTimeStr = getNextRandomDate(lastTimeStr);
    // console.log("new lastTimeStr:", lastTimeStr);
    // var newDate = new Date(lastTimeStr);
    // console.log("newDate without format:", newDate);
    // var formattedNewDate = fd(newDate);
    // console.log("new Date first time:", formattedNewDate);

    realtimeChart.incrementor = setInterval(function() {
      // console.log("formattedNewDate before randomizing:", formattedNewDate);
      // newDate = getNextRandomDate(formattedNewDate);
      // formattedNewDate = fd(newDate);

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
<div id="devicesList"></div>

<script>
    var devices = <?php echo json_encode($devices); ?>;
    var titles = ['温度', '湿度', 'CO2', '雑音'];

    // generate device list with graphs
    $.each(devices, function(index, device) {
        
        $('#devicesList').append($('<h4>' + device.device + '</h4>'));
        $('#devicesList').append($('<div id="container-' + index + '" class="container-fluid"></div>'));

        // add row
        for (i = 1; i <= 2; i++) {
            $('#container-' + index).append($('<div id="row-' + index + '-' + i + '" class="row"></div>'));

            // add column
            for (j = 0; j < 2; j++) {
                $('#row-' + index + '-' + i).append($('<div id="row-' + index + '-col-' + i + '-' + j + '" class="col"></div>'));
                addCard('row-' + index + '-col-' + i + '-' + j, i, j);
            }
        }

    });

    // card details
    function addCard(id, col, card) {
        var index = card;

        if (col == 2 && card == 0)
            index = 2;
        else if (col == 2 && card == 1)
            index = 3;
        $('#' + id).append($('<div class="card"><div class="card-body"><h5 class="card-title">' + titles[index] + '</h5><div id="' + id + '-graph"></div><div class="row justify-content-end"><div class="col-3"></div></div></div></div>'));
    }
</script>

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

  var num_devices = <?php echo count($num_devices); ?>;
  for (var i=0; i<num_devices; i++) {

      var json_data = <?php echo json_encode($tempalldata[0]); ?>;
      
      // update date & reload after 10000 mili seconds
      var getNextRandomDate = function getNextRandomDate(d) {
        return new Date(new Date(d).getTime() + 10000);
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
          url: "<?= $this->Url->build(['controller' => 'Co2datadetails', 'action' => 'monitorTemp']) ?>",
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

      var graph_id = 'row-' + i + '-col-1-0-graph';
      var data_sensor = 'Sensor' + (i+1);

      // Fusioncharts data store
      var dataStore = new FusionCharts.DataStore().createDataTable(json_data, schema);
      // time series chart instance
      var realtimeChart = new FusionCharts({
        type: 'timeseries',
        renderAt: graph_id,
        width: '100%',
        height: '250',
        dataSource: {
          chart: {
            theme: 'candy',
            paletteColors: '#BDF5CA'
          },
          data: dataStore,
          yAxis: {
            plottype: 'line'
          },
          series: 'Device',
          navigator: {
            enabled: 0
          },
          legend: {
            enabled: 0
          },
          "extensions": {
            "customRangeSelector": {
                "enabled": "0"
            }
          }
        }
      });

      realtimeChart.addEventListener("rendered", function(_ref) {
          var realtimeChart = _ref.sender;

          realtimeChart.incrementor = setInterval(function() {

            if (realtimeChart.feedData) {
              var final_result_date = sensorData('temperature', data_sensor).split('"')[1];
              var final_result_data = sensorData('temperature', data_sensor).split('"')[0];

              realtimeChart.feedData([
                [final_result_date, final_result_data, data_sensor]
              ]);
              }

          }, 10000);
        });

        realtimeChart.addEventListener("disposed", function(eventObj) {
          var chartRef = eventObj;
          clearInterval(chartRef.incrementor);
        })

        realtimeChart.render();
      
  }
</script>

<script>
  'use strict';

  var schema = [{
    name: 'Date Time',
    type: 'date',
    format: '%Y-%m-%d %H:%M:%S'
  }, {
    name: 'Humidity',
    type: 'number'
  }, {
    name: 'Device',
    type: 'string'
  }];

  var num_devices = <?php echo count($num_devices); ?>;
  for (var i=0; i<num_devices; i++) {
      
      var json_data = <?php echo json_encode($humalldata[0]); ?>;
      
      // update date & reload after 10000 mili seconds
      var getNextRandomDate = function getNextRandomDate(d) {
        return new Date(new Date(d).getTime() + 10000);
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
          url: "<?= $this->Url->build(['controller' => 'Co2datadetails', 'action' => 'monitorHum']) ?>",
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

      var graph_id = 'row-' + i + '-col-1-1-graph';
      var data_sensor = 'Sensor' + (i+1);

      // Fusioncharts data store
      var dataStore = new FusionCharts.DataStore().createDataTable(json_data, schema);
      // time series chart instance
      var realtimeChart = new FusionCharts({
        type: 'timeseries',
        renderAt: graph_id,
        width: '100%',
        height: '250',
        dataSource: {
          chart: {
            theme: 'candy',
            paletteColors: '#BDF5CA'
          },
          data: dataStore,
          yAxis: {
            plottype: 'line'
          },
          series: 'Device',
          navigator: {
            enabled: 0
          },
          legend: {
            enabled: 0
          },
          "extensions": {
            "customRangeSelector": {
                "enabled": "0"
            }
          }
        }
      });

      realtimeChart.addEventListener("rendered", function(_ref) {
          var realtimeChart = _ref.sender;

          realtimeChart.incrementor = setInterval(function() {

            if (realtimeChart.feedData) {
              var final_result_date = sensorData('humidity', data_sensor).split('"')[1];
              var final_result_data = sensorData('humidity', data_sensor).split('"')[0];

              realtimeChart.feedData([
                [final_result_date, final_result_data, data_sensor]
              ]);
              }

          }, 10000);
        });

        realtimeChart.addEventListener("disposed", function(eventObj) {
          var chartRef = eventObj;
          clearInterval(chartRef.incrementor);
        })

        realtimeChart.render();
      
  }
</script>

<script>
  'use strict';

  var schema = [{
    name: 'Date Time',
    type: 'date',
    format: '%Y-%m-%d %H:%M:%S'
  }, {
    name: 'Co2',
    type: 'number'
  }, {
    name: 'Device',
    type: 'string'
  }];

  var num_devices = <?php echo count($num_devices); ?>;
  for (var i=0; i<num_devices; i++) {
      
      var json_data = <?php echo json_encode($co2alldata[0]); ?>;
      
      // update date & reload after 10000 mili seconds
      var getNextRandomDate = function getNextRandomDate(d) {
        return new Date(new Date(d).getTime() + 10000);
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
          url: "<?= $this->Url->build(['controller' => 'Co2datadetails', 'action' => 'monitorCo2']) ?>",
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

      var graph_id = 'row-' + i + '-col-2-0-graph';
      var data_sensor = 'Sensor' + (i+1);

      // Fusioncharts data store
      var dataStore = new FusionCharts.DataStore().createDataTable(json_data, schema);
      // time series chart instance
      var realtimeChart = new FusionCharts({
        type: 'timeseries',
        renderAt: graph_id,
        width: '100%',
        height: '250',
        dataSource: {
          chart: {
            theme: 'candy',
            paletteColors: '#BDF5CA'
          },
          data: dataStore,
          yAxis: {
            plottype: 'line'
          },
          series: 'Device',
          navigator: {
            enabled: 0
          },
          legend: {
            enabled: 0
          },
          "extensions": {
            "customRangeSelector": {
                "enabled": "0"
            }
          }
        }
      });

      realtimeChart.addEventListener("rendered", function(_ref) {
          var realtimeChart = _ref.sender;

          realtimeChart.incrementor = setInterval(function() {

            if (realtimeChart.feedData) {
              var final_result_date = sensorData('co2', data_sensor).split('"')[1];
              var final_result_data = sensorData('co2', data_sensor).split('"')[0];

              realtimeChart.feedData([
                [final_result_date, final_result_data, data_sensor]
              ]);
              }

          }, 10000);
        });

        realtimeChart.addEventListener("disposed", function(eventObj) {
          var chartRef = eventObj;
          clearInterval(chartRef.incrementor);
        })

        realtimeChart.render();
      
  }
</script>

<script>
  'use strict';

  var schema = [{
    name: 'Date Time',
    type: 'date',
    format: '%Y-%m-%d %H:%M:%S'
  }, {
    name: 'Noise',
    type: 'number'
  }, {
    name: 'Device',
    type: 'string'
  }];

  var num_devices = <?php echo count($num_devices); ?>;
  for (var i=0; i<num_devices; i++) {
      
      var json_data = <?php echo json_encode($noisealldata[0]); ?>;
      
      // update date & reload after 10000 mili seconds
      var getNextRandomDate = function getNextRandomDate(d) {
        return new Date(new Date(d).getTime() + 100000);
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
          url: "<?= $this->Url->build(['controller' => 'Co2datadetails', 'action' => 'monitorNoise']) ?>",
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

      var graph_id = 'row-' + i + '-col-2-1-graph';
      var data_sensor = 'Sensor' + (i+1);

      // Fusioncharts data store
      var dataStore = new FusionCharts.DataStore().createDataTable(json_data, schema);
      // time series chart instance
      var realtimeChart = new FusionCharts({
        type: 'timeseries',
        renderAt: graph_id,
        width: '100%',
        height: '250',
        dataSource: {
          chart: {
            theme: 'candy',
            paletteColors: '#BDF5CA'
          },
          data: dataStore,
          yAxis: {
            plottype: 'line'
          },
          series: 'Device',
          navigator: {
            enabled: 0
          },
          legend: {
            enabled: 0
          },
          "extensions": {
            "customRangeSelector": {
                "enabled": "0"
            }
          }
        }
      });

      realtimeChart.addEventListener("rendered", function(_ref) {
          var realtimeChart = _ref.sender;

          realtimeChart.incrementor = setInterval(function() {

            if (realtimeChart.feedData) {
              var final_result_date = sensorData('noise', data_sensor).split('"')[1];
              var final_result_data = sensorData('noise', data_sensor).split('"')[0];

              realtimeChart.feedData([
                [final_result_date, final_result_data, data_sensor]
              ]);
              }

          }, 10000);
        });

        realtimeChart.addEventListener("disposed", function(eventObj) {
          var chartRef = eventObj;
          clearInterval(chartRef.incrementor);
        })

        realtimeChart.render();
      
  }
</script>
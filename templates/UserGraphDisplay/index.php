<?php
include("fusioncharts.php");
echo $this->Html->script('fusioncharts/fusioncharts');
foreach ($device_name as $devices) {
	echo "<h2>$devices</h2>";
	echo "<div id='chart-$devices'></div>";
}
$no = 0;

?>





<script>
	'use strict';

	var schema = [{
			"name": "Time",
			"type": "date",
			"format": "%Y-%m-%d %H:%M:%S"
		},
		{
			"name": "Temperature",
			"type": "number"
		}, {
			"name": "Humidity",
			"type": "number"
		}, {
			"name": "Co2",
			"type": "number"
		}, {
			"name": "Noise",
			"type": "number"
		}
	]

	var sensorData = function sensorData(dev_name) {
		var dataAjax = $.ajax({
			type: "GET",
			url: "<?= $this->Url->build(['controller' => 'UserGraphDisplay', 'action' => 'onetimedata']) ?>",
			data: {
				type: dev_name
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


	var fusionGraph = function fusionGraph(json_data, dev_name) {
		// Fusioncharts data store
		var dataStore = new FusionCharts.DataStore().createDataTable(json_data, schema);
		// time series chart instance
		var realtimeChart = new FusionCharts({
			type: 'timeseries',
			renderAt: 'chart-' + dev_name,
			width: '100%',
			height: '500',
			dataSource: {
				chart: {
					theme: 'candy'
				},
				data: dataStore,
				series: 'Type',
				navigator: {
					enabled: 0
				},
				legend: {
					enabled: 0
				}
			},

		});


		var sensorData = function sensorData(dev_name) {
			var dataAjax = $.ajax({
				type: "GET",
				url: "<?= $this->Url->build(['controller' => 'UserGraphDisplay', 'action' => 'onetimedata']) ?>",
				data: {
					type: dev_name
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

		realtimeChart.addEventListener("rendered", function(_ref) {
			var realtimeChart = _ref.sender;
			realtimeChart.incrementor = setInterval(function() {
				var myArr = sensorData(dev_name).split("#");
				var dTemperature = myArr[0];
				var dHumidity = myArr[1];
				var dCo2 = myArr[2];
				var dNoise = myArr[3];
				var ddate = myArr[4];
				if (realtimeChart.feedData) {
					realtimeChart.feedData([
						[ddate, dTemperature, dHumidity, dCo2, dNoise]
					]);
				}
				// realtimeChart.render();
			}, 5000);
		});




		realtimeChart.addEventListener("disposed", function(eventObj) {
			var chartRef = eventObj;
			clearInterval(chartRef.incrementor);
		})

		realtimeChart.render();
	}



	var device_name = <?php echo json_encode($device_name); ?>;
	var dev_data = <?php echo json_encode($device); ?>;
	var x;
	var dev_name;
	var json_data;
	for (x = 0; x < device_name.length; x++) {
		fusionGraph(dev_data[x], device_name[x]);
	}
</script>
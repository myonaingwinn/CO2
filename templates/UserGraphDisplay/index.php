<?php
// echo $this->Html->script('jquery.canvasjs.min.js');
// echo $this->Html->script('canvasjs.min.js');
echo $this->Html->script('canvasjs.stock.min.js');
?>

<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
<style>
a.canvasjs-chart-credit{
	visibility: hidden;
}
h4{
    margin-top: 60px;
    text-align: center;
    font-family: grapheme_strstr;
    font-weight: bolder;
}
</style>
<h4>ROOM TEMPERATURE</h4>
<div id="chartContainer" style="height: 370px; width: 100%; margin-top:100px;"></div>

<div id="ranNumber">
<input type="hidden" id="getTemperature" value="<?php echo $temperature; ?>" />
<input type="hidden" id="getTime" value="<?php echo $time; ?>" />
</div>
<script>
window.onload = function() {
   

var initialNumberOfDataPoints = 700;
var updateInterval =  2000;
var dataPoints1 = [];
var dataTime = <?php echo time();  ?>;
var yValue1 = dataTime * 1000 - updateInterval * initialNumberOfDataPoints;
var xValue = 150;

// for(let i = 0; i < hh; i++){
// 	yValue1 += round(rand(-2, 2));
// 	// array_push($dataPoints1, array("x" => 0, "y" => 0));
// 	xValue += 2000;
// }
 
var chart = new CanvasJS.Chart("chartContainer", {
	zoomEnabled: true,
	title: {
		text: " "
	},
	axisX: {
		title: "Time"
	},
	axisY:{
        title: "Temperature",
		suffix: "°"
	}, 
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		verticalAlign: "top",
		fontSize: 22,
		fontColor: "dimGrey",
		itemclick : toggleDataSeries
	},
	data: [{ 
			type: "line",
			name: "Room A",
			xValueType: "dateTime",
			yValueFormatString: "#,### °C",
			xValueFormatString: "hh:mm:ss TT",
			showInLegend: true,
			legendText: "{name} " + yValue1 + " watts",
			dataPoints: dataPoints1
		}]
});
 
chart.render();
setInterval(function(){ dataLoaded(); updateChart();}, updateInterval);
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

function dataLoaded(){
    var nValue1 = Math.floor((Math.random() * 10) + 1);
    $.ajax({
            method: 'get',
            data: {
                role: nValue1
            },
            url: "<?php echo $this->Url->build(['controller' => 'UserGraphDisplay', 'action' => 'edit']); ?>",
            success: function(response) {
                $('#ranNumber').html(response);
            }
			
    });
  }
 
function updateChart() {
	var deltaY1, deltaY2;
	xValue += updateInterval;
	// adding random value
	// yValue1 = Math.round($("#getTemperature").val());
	// yValue1 = Math.round(gg);
	yValue1 =  Math.round(2 + Math.random() *(-2-2));
	// console.log(gg);
    if(dataPoints1.length > 700){
        dataPoints1.shift();
    }
	// pushing the new values
	dataPoints1.push({
		x: xValue,
		y: yValue1
	});
 
	// updating legend text with  updated with y Value 
	chart.options.data[0].legendText = "Room A " + yValue1 + "°C";
	chart.render();
}
 
}
</script>          
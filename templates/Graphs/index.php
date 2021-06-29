<?php

//Notes For Ajax
//Application.php [comment old csrf and add($csrf)]
//layout/default.php [  $this->Html->meta('csrfToken',$this->request->getAttribute('csrfToken')]

use Cake\Routing\Router;

$dataPoints = array();
$y = 5;
for ($i = 0; $i < 10; $i++) {
	$y += rand(-1, 1) * 0.1;
	array_push($dataPoints, array("x" => $i, "y" => $y));
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
	<script>
		window.onload = function() {

			var dataPoints = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;

			var chart = new CanvasJS.Chart("chartContainer", {
				theme: "light2",
				title: {
					text: "Live Internet Speed"
				},
				axisX: {
					title: "Time in millisecond"
				},
				axisY: {
					suffix: " Mbps"
				},
				data: [{
					type: "line",
					yValueFormatString: "#,##0.0#",
					toolTipContent: "{y} Mbps",
					dataPoints: dataPoints
				}]
			});
			chart.render();
			getGraphImage()

			var updateInterval = 1500;
			setInterval(function() {
				updateChart()
			}, updateInterval);

			var xValue = dataPoints.length;
			var yValue = dataPoints[dataPoints.length - 1].y;

			function updateChart() {
				yValue += (Math.random() - 0.5) * 0.1;
				dataPoints.push({
					x: xValue,
					y: yValue
				});
				xValue++;
				chart.render(); <<
				<< << < HEAD
					//	if (yValue > 5) {
					//	getGraphImage();
					//	}
					===
					=== =
					//if (yValue > 5) {
					//getGraphImage();
					//}
					>>>
					>>> > cd9e8cad9df3c0887fc164545522526e91eab7d0
			};

		}
	</script>
</head>

<body>
	<div id="chartContainer" style="height: 370px; width: 50%;"></div>

	<script type="text/javascript">
		var dataURL = {};

		function getGraphImage() {
			html2canvas(document.querySelector('#chartContainer')).then(canvas => {
				//console.log(canvas.toDataURL());  
				dataURL = canvas.toDataURL();
				//console.log(dataURL);
				post_data(dataURL);
			});
		}

		function post_data(imageURL) {
			//console.log(imageURL);  
			$.ajax({
				url: "<?= $this->Url->build(['controller' => 'Graphs', 'action' => 'notify']) ?>",
				type: "POST",
				data: {
					image: imageURL
				},
				dataType: "html",
				headers: {
					'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
				}
			});
		}
	</script>
</body>

</html>
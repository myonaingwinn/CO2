<?php
    include("fusioncharts.php");

    // encode json
    $jsonTemp = json_encode($temp);
    $jsonHum = json_encode($hum);
    $jsonCo2 = json_encode($co2);
    $jsonNoise = json_encode($noise);

    // schema for fusionchart
    $schemaTemp = file_get_contents('webroot\json\schemaTemp.json');
    $schemaHum = file_get_contents('webroot\json\schemaHum.json');
    $schemaCo2 = file_get_contents('webroot\json\schemaCo2.json');
    $schemaNoise = file_get_contents('webroot\json\schemaNoise.json');

    // fusionTable for schema and json data
    $tempFusionTable = new FusionTable($schemaTemp, $jsonTemp);
    $humFusionTable = new FusionTable($schemaHum, $jsonHum);
    $co2FusionTable = new FusionTable($schemaCo2, $jsonCo2);
    $noiseFusionTable = new FusionTable($schemaNoise, $jsonNoise);

    // time series graph
    $temptimeSeries = new TimeSeries($tempFusionTable);
    $humtimeSeries = new TimeSeries($humFusionTable);
    $co2timeSeries = new TimeSeries($co2FusionTable);
    $noisetimeSeries = new TimeSeries($noiseFusionTable);

    $temptimeSeries->AddAttribute('chart', '{"exportenabled":true}');
    $temptimeSeries->AddAttribute('navigator', '{"enabled":0}');
    $temptimeSeries->AddAttribute('legend', '{"enabled":"0"}');

    $humtimeSeries->AddAttribute('chart', '{"exportenabled":true}');
    $humtimeSeries->AddAttribute('navigator', '{"enabled":0}');
    $humtimeSeries->AddAttribute('legend', '{"enabled":"0"}');

    $co2timeSeries->AddAttribute('chart', '{"exportenabled":true}');
    $co2timeSeries->AddAttribute('navigator', '{"enabled":0}');
    $co2timeSeries->AddAttribute('legend', '{"enabled":"0"}');

    $noisetimeSeries->AddAttribute('chart', '{"exportenabled":true}');
    $noisetimeSeries->AddAttribute('navigator', '{"enabled":0}');
    $noisetimeSeries->AddAttribute('legend', '{"enabled":"0"}');

    // chart object
    $ChartTemp = new FusionCharts(
        "timeseries",
        "MyFirstChart" ,
        "100%",
        "450",
        "temperature",
        "json",
        $temptimeSeries
    );
    $ChartHum = new FusionCharts(
        "timeseries",
        "MyFirstChart2" ,
        "100%",
        "450",
        "humidity",
        "json",
        $humtimeSeries
    );
    $ChartCo2 = new FusionCharts(
        "timeseries",
        "MyFirstChart3" ,
        "100%",
        "450",
        "co2",
        "json",
        $co2timeSeries
    );
    $ChartNoise = new FusionCharts(
        "timeseries",
        "MyFirstChart4" ,
        "100%",
        "450",
        "noise",
        "json",
        $noisetimeSeries
    );

    // Render the chart
    $ChartTemp->render();
    $ChartHum->render();
    $ChartCo2->render();
    $ChartNoise->render();
?>

<h2>Dashboard</h2>
<div class="container-fluid">
    <section class="border p-3 text-center mb-1 shadow-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="thNow" scope="row" class="std" rowspan="3">現在</td>
                    <td class="std">温度</td>
                </tr>
                <tr>
                    <td class="std" scope="row">湿度</td>
                </tr>
                <tr>
                    <td class="std" scope="row">CO2</td>
                </tr>
            </tbody>
        </table>
    </section>
</div>
<hr id="fhr" class="my-5">
<h4>Device 001</h4>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Temperature</h5>
                    <div id="temperature">Chart will render here!</div>
                    <button type="button" class="btn btn-primary">Button</button>
                    <!-- <button type="button"  class="btn realtime-btn btn-primary-grad btn-sm" id="update-data">Update Data</button> -->
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Humidity</h5>
                    <div id="humidity">Chart will render here!</div>
                    <button type="button" class="btn btn-primary">Button</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CO2</h5>
                    <div id="co2">Chart will render here!</div>
                    <button type="button" class="btn btn-primary">Button</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Noise</h5>
                    <div id="noise">Chart will render here!</div>
                    <button type="button" class="btn btn-primary">Button</button>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="my-4">

<script>
    var devices = <?php echo json_encode($devices); ?>;
    // console.log(devices);

    // add new table column
    devices.forEach(device => {
        var columnData = ['部屋 ' + device.room, device.temperature + ' °C', device.humidity + ' %', device.co2 + ' ppm'];
        var table = $('table');
        insertTableColumn(table, columnData, table.find('tr > td:last').index() + 1);
    });

    function insertTableColumn(table, columnData, index) {
        var newColumn = [],
            colsCount = table.find('tr > td:last').index();

        table.find("tr").each(function(rowIndex) {
            var cell = $("<t" + (rowIndex == 0 ? "h" : "d") + "/>").text(columnData[rowIndex]);
            newColumn.push(
                index > colsCount ?
                cell.appendTo(this) :
                cell.insertBefore($(this).children().eq(index))
            );
        });

        return newColumn;
    }
</script>

<style>
    #thNow {
        vertical-align: middle;
    }

    thead {
        border-top: white !important;
    }

    th {
        border: none;
        font-weight: 700 !important;
    }

    .std {
        font-weight: 700 !important;
    }

    body {
        background: #EFEFEF;
    }

    section {
        background: white;
    }

    .row {
        margin-top: 1rem;
    }

    h2 {
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    #fhr {
        margin-bottom: 1.5rem !important;
    }
</style>

<script>
document.getElementById('update-data').addEventListener('click', function() {
    $.ajax({
			url: "<?= $this->Url->build(['controller' => 'Co2datadetails', 'action' => '']) ?>",
			type: "POST",
			data: {
				image: imageURL
			},
			dataType: "html",
			headers: {
				'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
			}
		});
});
</script>

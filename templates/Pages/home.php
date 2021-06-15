<?php
include("fusioncharts.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $data = file_get_contents('templates\Pages\data.json');
    $schema = file_get_contents('templates\Pages\schema.json');
 
    $fusionTable = new FusionTable($schema, $data);
    $timeSeries = new TimeSeries($fusionTable);

    $timeSeries->AddAttribute('chart', '{"theme":"candy"}');
    $timeSeries->AddAttribute('caption', '{"text":"Thermal flow of machinery"}');
    $timeSeries->AddAttribute('subcaption', '{"text":"Observation from east region thermal sensor"}');
    $timeSeries->AddAttribute('yaxis', '[{"plot":{"value":"Heat Flux"},"title":"Heat Flux (in W/m²)","type":"log"}]');


    // chart object
    $Chart = new FusionCharts(
        "timeseries",
        "MyFirstChart" ,
        "100%",
        "700",
        "device1",
        "json",
        $timeSeries
    );

    // Render the chart
    $Chart->render();
    ?>
    <div class="container">
        <h1>Dashboard</h1>
        <div class="row">
            <table class="table table-dark table-bordered">
                <tr>
                    <th scope="col">Device/Data</th>
                    <th scope="col">Device 1</th>
                    <th scope="col">Device 2</th>
                    <th scope="col">Device 3</th>
                </tr>
                <tr>
                    <th scope="col">Temperature</th>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>        
                </tr>
                <tr>
                    <th scope="col">Humidity</th>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>        
                </tr>
                <tr>
                    <th scope="col">CO2</th>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>        
                </tr>
            </table>
        </div>
        <hr>
        <div class="row">
            <h1>Device 1</h1>
            <div class="col" id="device1"></div>
        </div>
    </div>
</body>
</html>
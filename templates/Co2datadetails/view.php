<?php
    include("fusioncharts.php");

    // foreach loop variable declare
    $graph_arr = [$temp, $hum, $co2, $noise, $dv1, $dv2, $dv3];
    $num_name = $schema = 5;
    $chart_id = $graph_id = 1;
    
    foreach($graph_arr as $graph)
    {
        // encode json
        ${"json$num_name"} = json_encode($graph);
        
        // schema for fusionchart
        ${"schema$num_name"} = file_get_contents('webroot\json\schema'.$schema.'.json');
        
        // fusionTable for schema and json data
        ${"FusionTable$num_name"} = new FusionTable(${"schema$num_name"}, ${"json$num_name"});

        // time series graph
        ${"timeSeries$num_name"} = new TimeSeries(${"FusionTable$num_name"});

        // attribute in graph
        ${"timeSeries$num_name"}->AddAttribute('chart', '{"theme":"candy"}');
        ${"timeSeries$num_name"}->AddAttribute('navigator', '{"enabled":0}');
        ${"timeSeries$num_name"}->AddAttribute('series', '"Type"');
        ${"timeSeries$num_name"}->AddAttribute('legend', '{"enabled":"0"}');
        // ${"timeSeries$num_name"}->AddAttribute('yaxis', '[{"plot":"Sale Value"}]');

        // chart object
        ${"Chart$chart_id"} = new FusionCharts(
            "timeseries",
            "MyFirstChart$chart_id",
            "100%",
            "500",
            "graph$graph_id",
            "json",
            ${"timeSeries$num_name"}
        );

        // Render the chart
        ${"Chart$chart_id"}->render();
        $num_name++;
        if ($schema != 9) $schema++; else $schema;
        $chart_id++;
        $graph_id++;
    }
?>

<h2>Dashboard Combination Graph Line</h2>
<h4>Temperature For All Device</h4>
<div id="graph1">Chart wil render here!</div>
<hr><h4>Humidity For All Device</h4>
<div id="graph2">Chart wil render here!</div>
<hr><h4>CO2 For All Device</h4>
<div id="graph3">Chart wil render here!</div>
<hr><h4>Noise For All Device</h4>
<div id="graph4">Chart wil render here!</div>
<hr><h4>Sensor1 For All Data</h4>
<div id="graph5">Chart wil render here!</div>
<hr><h4>Sensor2 For All Data</h4>
<div id="graph6">Chart wil render here!</div>
<hr><h4>Sensor3 For All Data</h4>
<div id="graph7">Chart wil render here!</div>
<?php
    include("fusioncharts.php");

    $graph_arr = [$temp,$hum,$co2,$noise];
    $graph_name_arr = ['temperature', 'humidity', 'co2', 'noise'];
    $num = 0;
    $num_name = 1;
    $i = 1;

    for ($i; $i <=count($num_devices); $i++) {
        
        foreach($graph_arr as $graph)
        {
            // encode json
            ${"json$num_name"} = json_encode($graph);

            // schema for fusionchart
            ${"schema$num_name"} = file_get_contents('webroot\json\schema'.$num_name.'.json');

            // fusionTable for schema and json data
            ${"FusionTable$num_name"} = new FusionTable(${"schema$num_name"}, ${"json$num_name"});

            // time series graph
            ${"timeSeries$num_name"} = new TimeSeries(${"FusionTable$num_name"});

            // attribute in graph
            ${"timeSeries$num_name"}->AddAttribute('chart', '{"exportenabled":true}');
            ${"timeSeries$num_name"}->AddAttribute('navigator', '{"enabled":0}');
            ${"timeSeries$num_name"}->AddAttribute('legend', '{"enabled":"0"}');
            ${"timeSeries$num_name"}->AddAttribute('yaxis', '{"plot":{"value":"","type":"smooth-area"}}');

            // chart object
            ${"Chart$num_name"} = new FusionCharts(
                "timeseries",
                "MyFirstChart$num_name" ,
                "100%",
                "250",
                $graph_name_arr[$num].$i,
                "json",
                ${"timeSeries$num_name"}
            );

            // Render the chart
            ${"Chart$num_name"}->render();
            if ($num == 3) $num = 0; else $num++;
            if ($num_name == 4) $num_name = 1; else $num_name++;
        }   
    }

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

<div class="container-fluid">
<h4>Device 001</h4>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Temperature</h5>
                    <div id="temperature1">Chart will render here!</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Humidity</h5>
                    <div id="humidity1">Chart will render here!</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CO2</h5>
                    <div id="co21">Chart will render here!</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Noise</h5>
                    <div id="noise1">Chart will render here!</div>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-4">
<h4>Device 002</h4>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Temperature</h5>
                    <div id="temperature2">Chart will render here!</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Humidity</h5>
                    <div id="humidity2">Chart will render here!</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CO2</h5>
                    <div id="co22">Chart will render here!</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Noise</h5>
                    <div id="noise2">Chart will render here!</div>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-4">
</div>


<script>
    var devices = <?php echo json_encode($devices); ?>;

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

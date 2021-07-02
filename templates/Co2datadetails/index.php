<style>
    #thNow {
        vertical-align: middle;
    }

    thead {
        border-top: white !important;
    }

    th {
        border: none;
        font-weight: 500 !important;
        font-size: medium;
    }

    .std {
        font-weight: 500 !important;
        font-size: medium;
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

    h4 {
        display: inline-block;
        margin-bottom: .2rem !important;
    }

    button {
        margin-left: 1rem;
    }

    #select-device {
        width: 12.6rem;
    }

    [id^="container-"] {
        margin-top: 1.5rem;
    }
</style>

<!-- Screen Title -->
<h2>デッシュボード</h2>

<!-- Table -->
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
                    <td id="thNow" scope="row" class="std" rowspan="4">現在</td>
                    <td class="std">温度</td>
                </tr>
                <tr>
                    <td class="std" scope="row">湿度</td>
                </tr>
                <tr>
                    <td class="std" scope="row">CO2</td>
                </tr>
                <tr>
                    <td class="std" scope="row">雑音</td>
                </tr>
            </tbody>
        </table>
    </section>
</div>
<hr id="fhr" class="my-5">

<!-- CSV Custom Date Time Download -->
<h2>CSV ダウンロード</h2>
<div class="container-fluid">
    <form action="co2datadetails/csv/" method="get">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-3 text-right">開始日時</div>
            <div class="col-3"><input type="datetime-local" id="start-time" name="start-time" value="" min="<?php echo $startdate; ?>" max="<?php echo $enddate; ?>" required></div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-3 text-right">終了日時</div>
            <div class="col-3"><input type="datetime-local" id="end-time" name="end-time" value="" min="<?php echo $startdate; ?>" max="<?php echo $enddate; ?>" required></div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-3 text-right">デバイスを選択</div>
            <div class="col-3">
                <select id="select-device" name="select-device">
                    <!-- Device Number loop -->
                    <?php
                    $dev_num = 0;
                    if (count($num_devices) != 0) {
                        echo "<option value='dvTest%' selected>All</option>";
                        for ($dev_num; $dev_num < count($num_devices); $dev_num++) {
                            echo "<option value='" . $num_devices[$dev_num][0] . "'>" . $num_devices[$dev_num][0] . "</option>";
                        }
                    } else {
                        echo "<option value='' selected>No Device</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-3 text-right"><input class="btn btn-danger" type="reset" value="クリア"></div>
            <div class="col-3"><input class="btn btn-primary" type="submit" value="ダウンロード"></div>
            <div class="col-3"></div>
        </div>
    </form>
</div>
<hr id="fhr" class="my-5">

<div id="devicesList"></div>

<script>
    var titles = ['温度', '湿度', 'CO2', '雑音'];
    var devices = <?php echo json_encode($devices); ?>;


    // add new table column
    devices.forEach(device => {
        var columnData = ['部屋 ' + device.room, device.temperature + ' °C', device.humidity + ' %', device.co2 + ' ppm', device.noise + ''];
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

    // generate device list with graphs
    $.each(devices, function(index, device) {
        $('#devicesList').append($('<h4>' + device.device + '</h4>'));
        $('#devicesList').append($('<button type="button" class="btn btn-success" id = "eg-' + index + '" onclick="showhidemulti(' + index + ')">' + 'グラフを表示' + '</button>'));
        $('#devicesList').append($('<div id="container-' + index + '" class="container-fluid" style="display:none"></div>'));

        // add row
        for (i = 1; i <= 2; i++) {
            $('#container-' + index).append($('<div id="row-' + index + '-' + i + '" class="row"></div>'));

            // add column
            for (j = 0; j < 2; j++) {
                $('#row-' + index + '-' + i).append($('<div id="row-' + index + '-col-' + i + '-' + j + '" class="col"></div>'));
                addCard('row-' + index + '-col-' + i + '-' + j, i, j);
            }
        }
        $('#container-' + index).after('<hr class="my-4">');

    });

    // card details
    function addCard(id, col, card) {
        var index = card;

        if (col == 2 && card == 0)
            index = 2;
        else if (col == 2 && card == 1)
            index = 3;
        $('#' + id).append($('<div class="card"><div class="card-body"><h5 class="card-title">' + titles[index] + '</h5><div id="' + id + '-graph"></div><div class="row justify-content-end"><div class="col-3"><a href="co2datadetails/detail/' + id + '-graph-' + devices.length + '" class="btn realtime-btn btn-primary btn-sm" id="btnDetails">詳細ビュー</a></div></div></div></div>'));
    }

    function showhidemulti(id) {
        var container = document.getElementById("container-" + id);
        var nextcontainer = document.getElementById("nextcontainer-" + id);
        var csvcontainer = document.getElementById("csvcontainer-" + id);
        var btntext = document.getElementById("eg-" + id);

        if (container.style.display === "none") {
            container.style.display = "block";
            btntext.innerText = "グラフを隠す";
        } else {
            container.style.display = "none";
            btntext.innerText = "グラフを表示";
        }
    }
</script>

<?php
include("fusioncharts.php");

// foreach loop variable declare
$graph_arr = [];
$i = $y = $num_name = $chart_id = 1;
$x = $z = $num = 0;

for ($i; $i <= count($num_devices); $i++) {

    // retrieve array data from controller
    ${"temp$i"} = ${"hum$i"} = ${"co2$i"} = ${"noise$i"} = [];
    ${"temp$i"} = $tempalldata[$i - 1];
    ${"hum$i"} = $humalldata[$i - 1];
    ${"co2$i"} = $co2alldata[$i - 1];
    ${"noise$i"} = $noisealldata[$i - 1];
    $graph_arr = [${"temp$i"}, ${"hum$i"}, ${"co2$i"}, ${"noise$i"}];

    foreach ($graph_arr as $graph) {
        // graph id declare
        $graph_id = 'row-' . $x . '-col-' . $y . '-' . $z . '-graph';

        // encode json
        ${"json$num_name"} = json_encode($graph);

        // schema for fusionchart
        ${"schema$num_name"} = file_get_contents('webroot\json\schema' . $num_name . '.json');

        // fusionTable for schema and json data
        ${"FusionTable$num_name"} = new FusionTable(${"schema$num_name"}, ${"json$num_name"});

        // time series graph
        ${"timeSeries$num_name"} = new TimeSeries(${"FusionTable$num_name"});

        // attribute in graph
        ${"timeSeries$num_name"}->AddAttribute('navigator', '{"enabled":0}');
        ${"timeSeries$num_name"}->AddAttribute('legend', '{"enabled":"0"}');
        ${"timeSeries$num_name"}->AddAttribute('yaxis', '{"plot":{"value":"","type":"smooth-area"}}');
        // chart object
        ${"Chart$chart_id"} = new FusionCharts(
            "timeseries",
            "MyFirstChart$chart_id",
            "100%",
            "250",
            $graph_id,
            "json",
            ${"timeSeries$num_name"}
        );

        // Render the chart
        ${"Chart$chart_id"}->render();
        if ($num == 3) $num = 0;
        else $num++;
        if ($num_name == 4) $num_name = 1;
        else $num_name++;
        $chart_id++;

        // graph id variables
        if ($z == 1) {
            $z = 0;
            $y++;
        } else {
            $z++;
        }
    }
    // graph id variables
    $x++;
    $y = 1;
    $graph_arr = [];
}
?>
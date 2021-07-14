<style>
    section {
        background: white;
    }

    .table {
        margin-bottom: 0rem;
    }

    .table th {
        font-weight: 500;
        font-size: 1rem;
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
    <section class="p-3 text-center shadow-4">
        <table id="tbl" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">デバイス・部屋</th>
                    <th scope="col">温度</th>
                    <th scope="col">湿度</th>
                    <th scope="col">CO2</th>
                    <th scope="col">雑音</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>
</div>
<hr id="fhr" class="my-5">

<div id="devicesList"></div>

<script>
    var titles = ['温度', '湿度', 'CO2', '雑音'];
    var devices = <?php echo json_encode($devices); ?>;

    // add new row to table
    devices.forEach(device => {
        var rowData = [
            device.device + '・' + '部屋 ' + device.room,
            device.temperature + ' °C',
            device.humidity + ' %',
            device.co2 + ' ppm', device.noise + ' dB'
        ];
        var table = $('table');
        insertTableRow(table, rowData, 0);
    });

    function insertTableRow(table, rowData, index) {
        table.find('tbody').eq(index).append($('<tr/>'));
        var newRow = $('tbody > tr:last');
        $(rowData).each(function(colIndex) {
            newRow.append($('<td/>').text(this));
        });

        return newRow;
    }

    // dynamic data
    var data = "";
    setInterval(function() {
        data = function() {
            var tmp = null;
            $.ajax({
                url: "<?= $this->Url->build(['controller' => 'Co2datadetails', 'action' => 'getData']) ?>",
                type: "GET",
                data: {},
                dataType: "html",
                async: false,
                success: function(devices_json_data) {
                    tmp = devices_json_data;
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                }
            });

            return tmp;
        }();
        // console.log(data);
        devices = JSON.parse(data);
        var table = document.getElementById('tbl');

        // add new table column
        var i = 1;
        devices.forEach(device => {
            table.rows[i].cells[1].innerHTML = device.temperature + ' °C';
            table.rows[i].cells[2].innerHTML = device.humidity + ' %';
            table.rows[i].cells[3].innerHTML = device.co2 + ' ppm';
            table.rows[i].cells[4].innerHTML = device.noise + ' dB';
            i++;
        });

    }, 2000);

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
$this->assign('title', 'デッシュボード');

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
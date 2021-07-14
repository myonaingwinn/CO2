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

    ul.pagination {
        margin-bottom: 0rem;
        margin-top: 0rem;
    }
</style>
<!-- Line: declaration for htmlcanvas lib -->
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js">
</script>
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

        <!-- Pagination -->
        <!-- <div class="row justify-content-end"> -->
        <!-- <div class="col-3"></div> -->
        <div class="d-flex justify-content-end mt-3">
            <ul class="pagination">
            </ul>
        </div>
        <!-- </div> -->
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
    // pagination
    var page_number = 1;
    const page_size = 5;

    var titles = ['温度', '湿度', 'CO2', '雑音'];
    var devices = <?php echo json_encode($devices); ?>;

    // Line: Declaration for Notification Time
    var line_send_time_temp = [];
    var line_send_time_hum = [];
    var line_send_time_co2 = [];
    var line_send_time_noise = [];
    //End of Line: Declaration for Notification Time

    // add new row to table
    if (devices) {
        result = devices.length / page_size;
        pages = Math.ceil(result);

        $('ul').append($('<li class="page-item my"><a class="page-link" href="#" onclick="page(1)">最初</a></li>'));

        for (let i = 1; i <= pages; i++) {
            if (i == 1)
                $('ul').append($('<li class="page-item my active"><a class="page-link" href="#" onclick="page(' + i + ')">' + i + '</a></li>'));
            else
                $('ul').append($('<li class="page-item my"><a class="page-link" href="#" onclick="page(' + i + ')">' + i + '</a></li>'));
        }

        $('ul').append($('<li class="page-item my"><a class="page-link" href="#" onclick="page(' + pages + ')">最終</a></li>'));

        device_paginated = paginate(devices, page_size, page_number);
        addRow(device_paginated);
    }

    // add rows to table
    function addRow(device_paginated) {
        device_paginated.forEach(device => {
            var rowData = [
                device.device + '・' + '部屋 ' + device.room,
                device.temperature + ' °C',
                device.humidity + ' %',
                device.co2 + ' ppm', device.noise + ' dB'
            ];
            var table = $('table');
            insertTableRow(table, rowData, 0);
        });
    }

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

        // update table row
        var i = 1;
        if (devices) {
            device_paginated = paginate(devices, page_size, page_number);
            // console.log(device_paginated);
            device_paginated.forEach(device => {
                table.rows[i].cells[1].innerHTML = device.temperature + ' °C';
                table.rows[i].cells[2].innerHTML = device.humidity + ' %';
                table.rows[i].cells[3].innerHTML = device.co2 + ' ppm';
                table.rows[i].cells[4].innerHTML = device.noise + ' dB';

                //Line sendingNoti code for limit over, calling function checkTime 
                // "i" is used to get div-id for each graph
                if (device.temperature > 60) {
                    var device_id = "row-" + (i - 1) + "-col-1-0";
                    checkTime((i - 1), device_id, device.device, device.temperature, "°C", "temperature");
                }
                if (device.humidity > 50) {
                    var device_id = "row-" + (i - 1) + "-col-1-1";
                    checkTime((i - 1), device_id, device.device, device.humidity, " %", "humidity");
                }
                if (device.co2 > 2000) {
                    var device_id = "row-" + (i - 1) + "-col-2-0";
                    checkTime((i - 1), device_id, device.device, device.co2, "ppm", "CO2");
                }
                if (device.noise > 50) {
                    var device_id = "row-" + (i - 1) + "-col-2-1";
                    checkTime((i - 1), device_id, device.device, device.noise, "dB", "noise");
                }
                //End of LineNoti code for limit over, calling function checkTime 
                i++;
            });
        }

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

    // paginate page
    function paginate(array, page_size, page_number) {
        return array.slice((page_number - 1) * page_size, page_number * page_size);
    }

    // go to page of page_number
    function page(page_num) {
        $('#tbl tbody > tr').remove();
        page_number = page_num;
        device_paginated = paginate(devices, page_size, page_number);
        if (device_paginated)
            addRow(device_paginated);
    }

    // add or remove 'active'
    $('li.my').click(function() {
        $('li.my').removeClass('active');
        $(this).addClass('active');
    });

    // remove pagination from sideNav
    $(function() {
        $('ul.sidenav-menu li.page-item.my').remove();
    });

    // Line Function script: check time and send message
    function checkTime(time, device_id, device_name, data_value, unit, line_alert_type) {

        switch (line_alert_type) {
            case "temperature":
                if (line_send_time_temp[time] === undefined) {
                    getGraphImage(device_id, device_name, data_value, unit, "温度");
                    line_send_time_temp[time] = new Date();
                } else {
                    var cur_time = new Date();
                    var dateDifferMillsec = Math.round(Math.abs(cur_time - line_send_time_temp[time]) / 1000);
                    if (dateDifferMillsec > 300) {
                        getGraphImage(device_id, device_name, data_value, unit, "温度");
                        line_send_time_temp[time] = new Date();
                    }
                }
                break;
            case "humidity":
                if (line_send_time_hum[time] === undefined) {
                    getGraphImage(device_id, device_name, data_value, unit, "湿度");
                    line_send_time_hum[time] = new Date();
                } else {
                    var cur_time = new Date();
                    var dateDifferMillsec = Math.round(Math.abs(cur_time - line_send_time_hum[time]) / 1000);
                    if (dateDifferMillsec > 300) {
                        getGraphImage(device_id, device_name, data_value, unit, "湿度");
                        line_send_time_hum[time] = new Date();
                    }
                }
                break;
            case "CO2":
                if (line_send_time_co2[time] === undefined) {
                    getGraphImage(device_id, device_name, data_value, unit, "CO2");
                    line_send_time_co2[time] = new Date();
                } else {
                    var cur_time = new Date();
                    var dateDifferMillsec = Math.round(Math.abs(cur_time - line_send_time_co2[time]) / 1000);
                    if (dateDifferMillsec > 300) {
                        getGraphImage(device_id, device_name, data_value, unit, "CO2");
                        line_send_time_co2[time] = new Date();
                    }
                }
                break;
            case "noise":
                if (line_send_time_noise[time] === undefined) {
                    getGraphImage(device_id, device_name, data_value, unit, "雑音");
                    line_send_time_noise[time] = new Date();
                } else {
                    var cur_time = new Date();
                    var dateDifferMillsec = Math.round(Math.abs(cur_time - line_send_time_noise[time]) / 1000);
                    if (dateDifferMillsec > 300) {
                        getGraphImage(device_id, device_name, data_value, unit, "雑音");
                        line_send_time_noise[time] = new Date();
                    }
                }
                break;
        }
    } // End of Line Function script: check time and send message

    //Line function script: Take the shot of graph image
    function getGraphImage(device_id, device_name, value, unit, message_type) {
        html2canvas(document.querySelector('#' + device_id), {
            scrollY: -window.scrollY
        }).then(canvas => {
            dataURL = canvas.toDataURL();
            post_data(dataURL, device_name, value, unit, message_type);
        });
    } //End of Script Function

    //Line function script: Send Line data to controller function notify
    function post_data(imageURL, device_name, value, unit, message_type) {
        $.ajax({
            url: "<?= $this->Url->build(['controller' => 'Co2datadetails', 'action' => 'notify']) ?>",
            type: "POST",
            data: {
                image: imageURL,
                dev_name: device_name,
                dev_value: value,
                unit: unit,
                msg_type: message_type
            },
            dataType: "html",
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            }
        });
    } //End of Script Function
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
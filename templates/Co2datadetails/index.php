<!-- <?php
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
    $data = file_get_contents('webroot\json\data.json');
    $schema = file_get_contents('webroot\json\schema.json');

    $fusionTable = new FusionTable($schema, $data);
    $timeSeries = new TimeSeries($fusionTable);

    $timeSeries->AddAttribute('chart', '{"theme":"candy"}');
    $timeSeries->AddAttribute('caption', '{"text":"Thermal flow of machinery"}');
    $timeSeries->AddAttribute('subcaption', '{"text":"Observation from east region thermal sensor"}');
    $timeSeries->AddAttribute('yaxis', '[{"plot":{"value":"Heat Flux"},"title":"Heat Flux (in W/m²)","type":"log"}]');


    // chart object
    $Chart = new FusionCharts(
        "timeseries",
        "MyFirstChart",
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
</html> -->

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
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content.
                    </p>
                    <button type="button" class="btn btn-primary">Button</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content.
                    </p>
                    <button type="button" class="btn btn-primary">Button</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content.
                    </p>
                    <button type="button" class="btn btn-primary">Button</button>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="my-4">
<h4>Device 002</h4>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content.
                    </p>
                    <button type="button" class="btn btn-primary">Button</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content.
                    </p>
                    <button type="button" class="btn btn-primary">Button</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content.
                    </p>
                    <button type="button" class="btn btn-primary">Button</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up the bulk of the
                        card's content.
                    </p>
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
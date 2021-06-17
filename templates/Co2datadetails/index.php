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

<h3>Dashboard</h3>
<div class="container-fluid">
    <section class="border p-3 text-center mb-1 shadow-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">部屋１</th>
                    <th scope="col">部屋２</th>
                    <th scope="col">部屋３</th>
                    <th scope="col">部屋４</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th id="thNow" scope="row" rowspan="3">現在</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@fatto joe</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <td scope="row">Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>@fatty</td>
                </tr>
                <tr>
                    <td scope="row">Larry Bird</td>
                    <td>@txa</td>
                    <td>@twitter</td>
                    <td>@twitter weekly</td>
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

<style>
    #thNow {
        vertical-align: middle;
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

    h3 {
        margin-top: 2rem;
    }

    #fhr {
        margin-bottom: 1.5rem !important;
    }
</style>
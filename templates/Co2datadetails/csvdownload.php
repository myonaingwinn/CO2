<!-- CSV Custom Date Time Download -->
<h2 class="text-center">CSV ダウンロード</h2>
<div class="container-fluid">
    <div class="error-container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <!-- Today Data Card -->
    <div class="card border border-primary my-4">
        <!-- Card Header -->
        <div class="card-header text-primary">本日データ</div>
        <!-- Card Body -->
        <div class="card-body">
            <!-- Form Action -->
            <form action="co2datadetails/csvtime/" method="get">
                <!-- First Row // Select Device -->
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5 text-center">デバイスを選択</div>
                    <div class="col-4">
                        <!-- Option Select Dropdown -->
                        <select class="form-control" name="select-device-today" id="select-device-today">
                            <!-- Device Number loop -->
                            <?php
                            $dev_num = 0;
                            if (count($device_number) != 0) {
                                echo "<option value='Sensor%' selected>全て</option>";
                                for ($dev_num; $dev_num < count($device_number); $dev_num++) {
                                    echo "<option value='" . $device_number[$dev_num]->co2_device_id . "'>" . $device_number[$dev_num]->co2_device_id . "</option>";
                                }
                            } else {
                                echo "<option value='' selected>本日データがない</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-2"></div>
                </div>

                <!-- Second Row // Select Start Time -->
                <div class="row my-2">
                    <div class="col-1"></div>
                    <div class="col-5 text-center">開始時間</div>
                    <div class="col-4 md-form">
                        <input type="time" id="start-time" name="start-time" class="form-control" required>
                    </div>
                    <div class="col-2"></div>
                </div>

                <!-- Third Row // Select End Time -->
                <div class="row my-2">
                    <div class="col-1"></div>
                    <div class="col-5 text-center">終了時間</div>
                    <div class="col-4 md-form">
                        <input type="time" id="end-time" name="end-time" class="form-control" required>
                    </div>
                    <div class="col-2"></div>
                </div>

                <!-- Export Download Button -->
                <div class="text-center my-2">
                    <input class="btn btn-primary" type="submit" value="エクスポート">
                </div>
            </form>
        </div>
    </div>

    <!-- Date Data Card -->
    <div class="card border border-primary my-4">
        <!-- Card Header -->
        <div class="card-header text-primary">レポートデータ</div>
        <!-- Card Body -->
        <div class="card-body">
            <!-- Form Action -->
            <form action="co2datadetailshistory/csvdate/" method="get">
                <!-- First Row // Select Device -->
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5 text-center">デバイスを選択</div>
                    <div class="col-4">
                        <!-- Option Select Dropdown -->
                        <select class="form-control" name="select-device-report" id="select-device-report">
                            <!-- Device Number loop -->
                            <?php
                            $dev_num = 0;
                            if (count($device_number_all) != 0) {
                                echo "<option value='Sensor%' selected>全て</option>";
                                for ($dev_num; $dev_num < count($device_number_all); $dev_num++) {
                                    echo "<option value='" . $device_number_all[$dev_num]->co2_device_id . "'>" . $device_number_all[$dev_num]->co2_device_id . "</option>";
                                }
                            } else {
                                echo "<option value='' selected>レポートデータがない</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-2"></div>
                </div>

                <!-- Second Row // Select Start Time -->
                <div class="row my-2">
                    <div class="col-1"></div>
                    <div class="col-5 text-center">開始日付</div>
                    <div class="col-4 md-form">
                        <input type="date" id="start-date" name="start-date" class="form-control" required >
                    </div>
                    <div class="col-2"></div>
                </div>

                <!-- Third Row // Select End Time -->
                <div class="row my-2">
                    <div class="col-1"></div>
                    <div class="col-5 text-center">終了日付</div>
                    <div class="col-4 md-form">
                        <input type="date" id="end-date" name="end-date" class="form-control" required>
                    </div>
                    <div class="col-2"></div>
                </div>

                <!-- Export Download Button -->
                <div class="text-center my-2">
                    <input class="btn btn-primary" type="submit" value="エクスポート">
                </div>
            </form>
        </div>
    </div>

    <!-- History Data Card -->
    <div class="card border border-primary my-4">
        <!-- Card Header -->
        <div class="card-header text-primary">履歴データ</div>
        <!-- Card Body -->
        <div class="card-body">
            <!-- Form Action -->
            <form action="co2datadetailshistory/csvhistory/" method="get">
                <!-- First Row // Select Device -->
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5 text-center">デバイスを選択</div>
                    <div class="col-4">
                        <!-- Option Select Dropdown -->
                        <select class="form-control" name="select-device-history" id="select-device-history" required>
                            <!-- Device Number loop -->
                            <?php
                            $dev_num = 0;
                            if (count($device_number_all) != 0) {
                                echo "<option value='Sensor%' selected>デバイスを選択</option>";
                                for ($dev_num; $dev_num < count($device_number_all); $dev_num++) {
                                    echo "<option value='" . $device_number_all[$dev_num]->co2_device_id . "'>" . $device_number_all[$dev_num]->co2_device_id . "</option>";
                                }
                            } else {
                                echo "<option value='' selected>履歴データがない</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-2"></div>
                </div>

                <!-- Second Row // Select Result Date CSV File -->
                <div class="row my-2">
                    <div class="col-1"></div>
                    <div class="col-5 text-center">履歴データを選択</div>
                    <div class="col-4">
                        <!-- Option Select Dropdown -->
                        <select class="form-control" name="date-history" id="date-history" required disabled>
                        </select>
                    </div>
                    <div class="col-2"></div>

                    <!-- Export Download Button -->
                    <div class="text-center my-2">
                        <input class="btn btn-primary" type="submit" value="エクスポート">
                    </div>
            </form>
        </div>
    </div>

</div>

<script>
    var history_data_list = histroy_data_string_split = [];
    var history_data_string = "";
    <?php
    foreach ($history_date_list_all as $value) {
        foreach ($value as $key) {
    ?>
            var history_data = history_data_list.push('<?php echo $key['co2_device_id'] . '_' . $key['date']; ?>');
    <?php
        }
    } ?>

    $("#select-device-history").change(function() {
        $("#date-history").prop('disabled', false);
        $("#date-history").empty();
        for (var index = 0; index < history_data_list.length; index++) {
            history_data_string = history_data_list[index].toString();
            // console.log(history_data_string);
            histroy_data_string_split = history_data_string.split('_');
            // console.log(histroy_data_string_split[0] + " and " + histroy_data_string_split[1]);

            var select_device = this.value;

            if (select_device == histroy_data_string_split[0]) {
                $("#date-history").append($("<option/>", {
                    "value": histroy_data_string_split[1],
                    "text": histroy_data_string_split[1]
                }));
            }

        }
    });
</script>

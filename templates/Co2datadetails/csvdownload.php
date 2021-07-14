<!-- CSV Custom Date Time Download -->
<h2 class="text-center">CSV ダウンロード</h2>
<div class="container-fluid">
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
                        <select class="form-control" name="select-device" id="select-device">
                            <!-- Device Number loop -->
                            <?php
                            $dev_num = 0;
                            if (count($device_number) != 0) {
                                echo "<option value='dvTest%' selected>全て</option>";
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
            <form action="co2datadetails/csvdate/" method="get">
                <!-- First Row // Select Device -->
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5 text-center">デバイスを選択</div>
                    <div class="col-4">
                        <!-- Option Select Dropdown -->
                        <select class="form-control" name="select-device" id="select-device">
                            <!-- Device Number loop -->
                            <?php
                            $dev_num = 0;
                            if (count($device_number_all) != 0) {
                                echo "<option value='dvTest%' selected>全て</option>";
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
                        <input type="date" id="start-date" name="start-date" class="form-control">
                    </div>
                    <div class="col-2"></div>
                </div>

                <!-- Third Row // Select End Time -->
                <div class="row my-2">
                    <div class="col-1"></div>
                    <div class="col-5 text-center">終了日付</div>
                    <div class="col-4 md-form">
                        <input type="date" id="end-date" name="end-date" class="form-control">
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
            <form action="co2datadetails/csvhistory/" method="get">
                <!-- First Row // Select Device -->
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5 text-center">デバイスを選択</div>
                    <div class="col-4">
                        <!-- Option Select Dropdown -->
                        <select class="form-control" name="select-device" id="select-device">
                            <!-- Device Number loop -->
                            <?php
                            $dev_num = 0;
                            if (count($device_number_all) != 0) {
                                echo "<option value='dvTest%' selected>デバイスを選択</option>";
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
                        <select class="form-control">
                            <option>Default select</option>
                            <option>select1</option>
                            <option>select2</option>
                            <option>select3</option>
                        </select>
                    </div>
                <div class="col-2"></div>

                <!-- Export Download Button -->
                <div class="text-center my-2">
                    <a href="#" class="btn btn-primary">エクスポート</a>
                </div>
            </form>
        </div>
    </div>

</div>
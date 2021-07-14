<?php
$this->assign('title', 'デバイス更新');

?>

<div class="d-flex justify-content-end">
    <?= $this->Html->link(__('デバイス一覧'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
</div>

<?= $this->Form->create($roomInfo) ?>
<input type="hidden" id="hd_pst_code" name="postal_code" value="<?= $roomInfo->postal_code ?>">
<input type="hidden" id="hd_user_uid" name="user_uid" value="<?= $roomInfo->user_uid ?>">

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card text-center">
                <div class="card-body">
                    <h4 id="title" class="card-title">デバイス更新</h4>

                    <select id="select" name="user_uid" class="select select-initialized" required>
                        <option value="" disabled selected>ユーザーを選択</option>
                    </select>

                    <div class="form-outline mb-3">
                        <input type="text" name="device_id" id="dev_no" class="form-control form-control-lg" value="<?= $roomInfo->device_id ?>" disabled />
                        <label class="form-label" for="dev_no">デバイス番号</label>
                    </div>

                    <section class="border p-2 mb-3">
                        <div class="row">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="number" id="pst_code1" class="form-control" maxlength="3" required />
                                    <label class="form-label" for="pst_code1">郵便番号</label>
                                </div>
                            </div>
                            ー
                            <div class="col">
                                <div class="form-outline">
                                    <input type="number" id="pst_code2" class="form-control" maxlength="4" required />
                                    <label class="form-label" for="pst_code2">郵便番号</label>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="form-outline mb-3">
                        <input type="text" name="prefecture" id="pref" class="form-control form-control-lg" value="<?= $roomInfo->prefecture ?>" required />
                        <label class="form-label" for="pref">都道府県</label>
                    </div>

                    <div class="form-outline mb-3">
                        <textarea name="address" class="form-control" id="textAreaExample" rows="4" required><?= $roomInfo->address ?></textarea>
                        <label class="form-label" for="textAreaExample">住所</label>
                    </div>

                    <div class="form-outline">
                        <input type="text" name="room_no" id="rm_no" class="form-control form-control-lg" value="<?= $roomInfo->room_no ?>" required />
                        <label class="form-label" for="rm_no">建物・部屋番号</label>
                    </div>

                    <button id="btnUpdate" type="submit" class="btn btn-primary btn-lg">更新</button>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>
<?= $this->Form->end() ?>

<script>
    var users = <?php echo json_encode($users); ?>;

    // add select items
    $.each(users, function(index, user) {
        if (user.uid == $('#hd_user_uid').val())
            $('#select').append('<option value="' + user.uid + '" selected>' + user.name + '</option>');
        else
            $('#select').append('<option value="' + user.uid + '">' + user.name + '</option>');
    });

    // get uid when user change
    $('select').change(function() {
        uid = $(this).val();
        $('#hd_user_uid').val(uid);
    });

    // set postal code
    postal = $('#hd_pst_code').val().split('-');
    $('#pst_code1').val(postal[0]);
    $('#pst_code2').val(postal[1]);

    $(function() {
        $('input[type=text][readonly]').removeClass('placeholder-active').addClass('form-control-lg');

        // postal code validation
        $('#pst_code1').keyup(function() {
            maxLength = $('#pst_code1').attr('maxlength');
            if ($('#pst_code1').val().length > maxLength) {
                $('#pst_code1').val($('#pst_code1').val().substr(0, maxLength));
            }
        });

        $('#pst_code2').keyup(function() {
            maxLength = $('#pst_code2').attr('maxlength');
            if ($('#pst_code2').val().length > maxLength) {
                $('#pst_code2').val($('#pst_code2').val().substr(0, maxLength));
            }
        });
    });

    // select validation
    $('#btnUpdate').click(function(e) {
        if (!$('#select').val()) {
            e.preventDefault();
        }

        if (($('#pst_code1').val().length == $('#pst_code1').attr('maxlength')) && ($('#pst_code2').val().length == $('#pst_code2').attr('maxlength'))) {
            $('#hd_pst_code').val($('#pst_code1').val() + '-' + $('#pst_code2').val());
        } else {
            $('#pst_code1').val('');
            $('#pst_code2').val('');
            // e.preventDefault();
        }
    });
</script>

<style>
    div.d-flex.justify-content-end {
        margin-bottom: -2rem;
    }

    #title {
        margin-top: .8rem;
        margin-bottom: 2rem !important;
    }

    #text {
        padding-top: 1rem;
        color: yellow;
    }

    #btnUpdate {
        margin-top: 1.5rem;
        margin-bottom: .7rem;
    }

    .card-body {
        padding-left: 5rem !important;
        padding-right: 5rem !important;
    }

    .card {
        margin-bottom: 2rem;
    }

    input[type=text][readonly] {
        outline: none;
        margin-bottom: 1rem;
    }
</style>
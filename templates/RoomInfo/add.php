<?= $this->Form->create($roomInfo) ?>

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="card-title mb-5">Device Registration</h4>

                    <select id="select" name="user_uid" class="select select-initialized" required>
                        <option value="" disabled selected>Choose User</option>
                    </select>

                    <div class="form-outline mb-3">
                        <input type="text" name="device_id" id="dev_no" class="form-control form-control-lg" required />
                        <label class="form-label" for="dev_no">Device No</label>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="text" name="postal_code" id="pst_code" class="form-control form-control-lg" required />
                        <label class="form-label" for="pst_code">Postal Code</label>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="text" name="prefecture" id="pref" class="form-control form-control-lg" required />
                        <label class="form-label" for="pref">Prefecture</label>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="text" name="address" id="addr" class="form-control form-control-lg" required />
                        <label class="form-label" for="addr">Address</label>
                    </div>
                    <div class="form-outline mb-5">
                        <input type="text" name="room_no" id="rm_no" class="form-control form-control-lg" required />
                        <label class="form-label" for="rm_no">Room No</label>
                    </div>
                    <button id="btnReg" type="submit" class="btn btn-primary">Register</button>
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
        $('#select').append('<option value="' + user.uid + '">' + user.name + '</option>');
    });

    $(function() {
        $('input[type=text][readonly]').removeClass('placeholder-active').addClass('form-control-lg');
        // for label
        //.after('<label id="lblSelect" class="form-label select-label active" style="margin-left: 0px;">Choose User</label>');
    });

    // select validation
    $('#btnReg').click(function(e) {
        if (!$('#select').val())
            e.preventDefault();
    });
</script>

<style>
    .card-body {
        padding-left: 5rem !important;
        padding-right: 5rem !important;
    }

    .card {
        margin-bottom: 2rem;
    }

    button {
        margin-bottom: .7rem;
    }

    input[type=text][readonly] {
        outline: none;
        margin-bottom: 1rem;
    }
</style>
<!-- <?php
        /**
         * @var \App\View\AppView $this
         * @var \App\Model\Entity\RoomInfo $roomInfo
         */
        ?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Room Info'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="roomInfo form content">
            <?= $this->Form->create($roomInfo) ?>
            <fieldset>
                <legend><?= __('Add Room Info') ?></legend>
                <?php
                echo $this->Form->control('user_uid');
                echo $this->Form->control('postal_code');
                echo $this->Form->control('prefecture');
                echo $this->Form->control('address');
                echo $this->Form->control('room_no');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div> -->

<?= $this->Form->create($roomInfo) ?>

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="card-title mb-5">Device Registration</h4>
                    <label class="form-label active" for="select" style="margin-left: 0px;">Choose User</label>
                    <select name="user_uid" class="form-select form-control-lg mb-3" id="select">
                        <option value="" disabled selected>Choose user</option>
                        <option value="1">USA</option>
                        <option value="2">Germany</option>
                        <option value="3">France</option>
                        <option value="3">Poland</option>
                        <option value="3">Japan</option>
                    </select>

                    <div class="form-outline mb-3">
                        <input type="text" name="device_id" id="dev_no" class="form-control form-control-lg" />
                        <label class="form-label" for="dev_no">Device No</label>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="text" name="postal_code" id="pst_code" class="form-control form-control-lg" />
                        <label class="form-label" for="pst_code">Postal Code</label>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="text" name="prefecture" id="pref" class="form-control form-control-lg" />
                        <label class="form-label" for="pref">Prefecture</label>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="text" name="address" id="addr" class="form-control form-control-lg" />
                        <label class="form-label" for="addr">Address</label>
                    </div>
                    <div class="form-outline mb-5">
                        <input type="text" name="room_no" id="rm_no" class="form-control form-control-lg" />
                        <label class="form-label" for="rm_no">Room No</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Button</button>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>
<?= $this->Form->end() ?>

<style>
    .card-body {
        padding-left: 5rem !important;
        padding-right: 5rem !important;
    }
</style>
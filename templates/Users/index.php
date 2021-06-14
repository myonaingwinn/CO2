<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */

use PHP_CodeSniffer\Reports\Diff;

?>
<style>
    .capitalize {
        text-transform: capitalize;
    }

    #search {
        width: 300px;
        height: 40px;
        border-radius: 5px;
        margin-top: 30px;
    }

    .btn-user {
        width: 120px;
        height: 40px;
        border-radius: 3px;
        margin-left: 60%;
    }

    .searchArea {
        margin-bottom: 20px;
    }

    select {
        width: 80px;
        height: 30px;
        border-radius: 3px;

    }
</style>
<div class="users index content">
    <br> <br> <br> <br>
    <h3 style="text-align: center;"><?= __('Users List') ?></h3>
    <!-- search area -->
    <div class="searchArea">
        <?= $this->Form->text('search', ['id' => 'search', 'size' => '100', 'maxlength' => '100', 'placeholder' => 'Search...']) ?>
        <!-- <button type="button" class="btn btn-primary">New User</button> -->
        <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'btn btn-primary btn-user']) ?>

    </div>

    <div class="table-responsive">
        <table id="paginationNumbers" class="table" width="100%">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('No') ?></th>
                    <th><?= $this->Paginator->sort('Name') ?></th>
                    <th><?= $this->Paginator->sort('Email') ?></th>
                    <th><?= $this->Paginator->sort('Last_LogIn_date') ?></th>
                    <th><?= $this->Paginator->sort('Role') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $page = $this->Paginator->counter(__('{{page}}'));
                $no = 1;
                if ($page > 2)
                    $no = $page * 20 - 19;
                else if ($page == 2)
                    $no = $page * 10 + 1; ?>
                <?php foreach ($users as $user) : ?>
                    <!-- <input type="hidden" id="id" name="id" value=<?= h($user->id) ?>> -->
                    <?php
                    echo $this->Form->control('id', ['type' => 'hidden', 'id' => 'id', 'value' => $user->id]);
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= h($user->name) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td><?= h($user->last_login) ?></td>
                        <td>

                            <select name=" role" id="role-<?= $user->id ?>">
                                <?php
                                $role = $user->role;
                                if ($role == 'A') {
                                    echo
                                    '<option value="A" selected>Admin</option>
                                         <option value="E">Editor</option>
                                        <option value="U">User</option>';
                                }
                                if ($role == 'E') {
                                    echo
                                    '<option value="A" >Admin</option>
                                        <option value="E" selected>Editor</option>
                                        <option value="U">User</option>';
                                }
                                if ($role == 'U') {
                                    echo
                                    '<option value="A" selected>Admin</option>
                                        <option value="E">Editor</option>
                                        <option value="U" selected>User</option>';
                                }
                                ?>
                            </select>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

<script>
    $('select').change(function() {
        var data = this.value;
        var user_id = this.id.split('-');
        $.ajax({
            method: 'get',
            data: {
                role: data,
                userID: user_id[1]
            },
            url: "<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'edit']); ?>",
            success: function(response) {
                $('.table-responsive').html(response);
            }
        });
    });
    //search
    $('document').ready(function() {
        $('#search').keyup(function() {
            if (!$(this).val() || $(this).val().trim() == '') {
                location.reload();
            } else {
                var searchkey = $(this).val();
                searchUsers(searchkey);
            }
        });

        function searchUsers(keyword) {
            var data = keyword;
            $.ajax({
                method: 'get',
                url: "<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'Search']); ?>",
                data: {
                    keyword: data
                },
                success: function(response) {
                    $('.table-responsive').html(response);
                }
            });
        };
    });
</script>

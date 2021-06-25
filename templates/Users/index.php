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
    .body{
        margin-top:30px;       
    }
</style>
<div class="users index content body">
    <h3 style="text-align: center;"><?= __('ユーザー一覧') ?></h3>
    <!-- search area -->
    <div class="searchArea">
        <?= $this->Form->text('search', ['id' => 'search', 'size' => '100', 'maxlength' => '100', 'placeholder' => '検索...']) ?>
        <?= $this->Html->link(__('ユーザー登録'), ['action' => 'add'], ['class' => 'btn btn-primary btn-user']) ?>
    </div>
    <div class="table-responsive">
        <table id="paginationNumbers" class="table" width="100%">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('順番') ?></th>
                    <th><?= $this->Paginator->sort('名前') ?></th>
                    <th><?= $this->Paginator->sort('メールアドレス') ?></th>
                    <th><?= $this->Paginator->sort('最後ログインしたデート') ?></th>
                    <th><?= $this->Paginator->sort('役割') ?></th>
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
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= h($user->name) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td><?= h($user->last_login) ?></td>
                        <td>
                            <select name="role" id="role-<?= $user->id ?>">                           
                                <?php
                                $role = $user->role;
                                if ($role == 'A') {
                                    echo
                                    '<option value="A" selected>管理者</option>                                   
                                     <option value="U">ユーザー</option>';
                                }
                                
                                if ($role == 'U') {
                                    echo
                                    '<option value="A" selected>管理者</option>
                                    <option value="U" selected>ユーザー</option>';
                                }
                                ?>
                            </select>
                            <input type="hidden" id="origin-<?= $user->id ?>" value=<?= $role?>>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('最初　')) ?>
            <?= $this->Paginator->prev('< ' . __('戻る　')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('次へ') . ' >') ?>
            <?= $this->Paginator->last(__('最終') . ' >>') ?>
        </ul>
              <p><?= $this->Paginator->counter(__('ページ {{page}}/{{pages}}、合計{{count}}つのうち{{current}}つのレコードを表示。')) ?></p>
    </div>
</div>

<script>
    $('select').change(function() {
        var data = this.value;        
        var user_id = this.id.split('-');   
        var id="origin-"+user_id[1];        
        var origin_role=document.getElementById(id).value;          
        if (!confirm("役割を変更してもよろしいですか?")) {
            //cancel
            document.getElementById(this.id).value=origin_role;             
            return false;                              
        }  
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

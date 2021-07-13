<?php
$this->assign('title', 'ユーザー一覧');
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<style>
    .capitalize {
        text-transform: capitalize;
    }

    select {
        width: 80px;
        height: 30px;
        border-radius: 3px;

    }

    .body {
        margin-top: 30px;
    }
</style>
<div class="users index content body">
    <h3 class="text-center mb-4"><?= __('ユーザー一覧') ?></h3>
    <!-- search area -->
    <div class="row mb-3">
        <div class="col-3 text-left">
            <div class="form-outline">
                <input type="text" id="search" class="form-control" maxlength="50" />
                <label class="form-label" for="search">検索</label>
            </div>
        </div>
        <div class="col-3"></div>
        <div class="col-6 text-right">
            <a href="register" class="btn btn-primary">ユーザー登録</a>
        </div>
    </div>
    <div class="table-responsive">
        <table id="paginationNumbers" class="table" width="100%">
            <thead>
                <tr>
                    <th><?= __('順番') ?></th>
                    <th><?= $this->Paginator->sort('名前') ?></th>
                    <th><?= $this->Paginator->sort('メールアドレス') ?></th>
                    <th><?= $this->Paginator->sort('最後ログインしたデート') ?></th>
                    <th><?= __('役割') ?></th>
                    <th><?= __('処理') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $page = $this->Paginator->counter(__('{{page}}'));
                $pages = $this->Paginator->counter(__('{{pages}}'));
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
                            <!-- <select name="role" id="role-<?= $user->id ?>"> -->
                            <?php
                            $role = $user->role;
                            if ($role == 'A') {
                                echo '管理者';
                            }

                            if ($role == 'U') {
                                echo 'ユーザー';
                            }
                            ?>
                            <!-- </select> -->
                            <input type="hidden" id="origin-<?= $user->id ?>" value=<?= $role ?>>
                        </td>
                        <td>
                            <?= $this->Html->link(
                                '<span class="fa fa-edit"></span><span class="sr-only">' . __('Edit') . '</span>',
                                ['action' => 'edit', $user->id],
                                ['escape' => false, 'title' => __('Edit')]
                            ) ?>
                            <!-- <a href="userEdit"><span><i class="fas fa-edit"></i></span></a> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">

        <?php
        if ($pages > 1) { ?>
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('最初')) ?>&nbsp;
                <?= $this->Paginator->prev('< ' . __('戻る')) ?>&nbsp;
                <?= $this->Paginator->numbers() ?>&nbsp;
                <?= $this->Paginator->next(__('次へ') . ' >') ?>&nbsp;
                <?= $this->Paginator->last(__('最終') . ' >>') ?>&nbsp;
            </ul>
        <?php  }
        ?>
        <p><?= $this->Paginator->counter(__('ページ {{page}}/{{pages}}、合計{{count}}つのうち{{current}}つのレコードを表示。')) ?></p>
    </div>
</div>

<script>
    $('select').change(function() {
        var data = this.value;
        var user_id = this.id.split('-');
        var id = "origin-" + user_id[1];
        var origin_role = document.getElementById(id).value;
        if (!confirm("役割を変更してもよろしいですか?")) {
            //cancel
            document.getElementById(this.id).value = origin_role;
            return false;
        }
        $.ajax({
            method: 'get',
            data: {
                role: data,
                userID: user_id[1]
            },
            url: "<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'changeRole']); ?>",
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

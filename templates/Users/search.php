<table id="paginationNumbers" class="table" width="100%">
    <thead>
        <tr>
            <th><?= __('順番') ?></th>
            <th><?= __('名前') ?></th>
            <th><?= __('メールアドレス') ?></th>
            <th><?= __('最後ログインしたデート') ?></th>
            <th><?= __('役割') ?></th>
            <th><?= __('処理') ?></th>
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
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

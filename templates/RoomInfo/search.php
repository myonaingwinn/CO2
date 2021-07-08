<table class="table">
    <thead>
        <tr>
            <th><?= __('順番') ?></th>
            <th><?= __('デバイス') ?></th>
            <th><?= __('ユーザー') ?></th>
            <th><?= __('郵便番号') ?></th>
            <th><?= __('都道府県') ?></th>
            <th><?= __('住所') ?></th>
            <th><?= __('建物・部屋番号') ?></th>
            <th class="actions"><?= __('活動') ?></th>
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

        <?php foreach ($roomInfo as $roomInfo) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= h($roomInfo->device_id) ?></td>
                <td><?= h($roomInfo->user->name) ?></td>
                <td><?= h($roomInfo->postal_code) ?></td>
                <td><?= h($roomInfo->prefecture) ?></td>
                <td><?= h($roomInfo->address) ?></td>
                <td><?= h($roomInfo->room_no) ?></td>
                <td class="actions">
                    <a href="/room-info/edit/<?= $roomInfo->device_id ?>"><i class="fas fa-edit"></i></a>
                    &ensp;
                    <?= $this->Form->postLink('<i class="fa fa-trash text-danger"></i>', ['action' => 'delete', $roomInfo->device_id], ['escape' => false, 'confirm' => __('{0} を消去してもよろしいですか?', $roomInfo->device_id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
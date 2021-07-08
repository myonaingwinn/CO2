<table class="table">
    <thead>
        <tr>
            <th><?= __('順番') ?></th>
            <th><?= $this->Paginator->sort('device_id', 'デバイス') ?></th>
            <th><?= $this->Paginator->sort('user', 'ユーザー') ?></th>
            <th><?= $this->Paginator->sort('postal_code', '郵便番号') ?></th>
            <th><?= $this->Paginator->sort('prefecture', '都道府県') ?></th>
            <th><?= $this->Paginator->sort('address', '住所') ?></th>
            <th><?= $this->Paginator->sort('room_no', '建物・部屋番号') ?></th>
            <!-- <th class="actions"><?= __('活動') ?></th> -->
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
                <!-- <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $roomInfo->device_id]) ?>
                            <?= $this->Html->link(__('<i class="fas fa-edit"></i>'), ['action' => 'edit', $roomInfo->device_id]) ?>
                            <a href="/room-info/delete/<?= $roomInfo->device_id ?>" data-confirm-message="Are you sure you want to delete # devicename100?" onclick="if (confirm(this.dataset.confirmMessage)) { document.post_60e3e756f2189012298213.submit(); } event.returnValue = false; return false;"><i class="fas fa-trash text-danger"></i></a>

                            <a href="/room-info/edit/<?= $roomInfo->device_id ?>"><i class="fas fa-edit"></i></a>

                            <?php
                            $icon = '<script>$("<i class=\'fas fa-trash\'></i>")</script>';
                            ?>

                            <?= $this->Form->postLink(h('<i class="fas fa-edit"></i>'), ['action' => 'delete', $roomInfo->device_id], ['confirm' => __('Are you sure you want to delete # {0}?', $roomInfo->device_id)], ['escape' => false]) ?>
                        </td> -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
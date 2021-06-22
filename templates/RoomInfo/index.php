<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RoomInfo[]|\Cake\Collection\CollectionInterface $roomInfo
 */
?>
<div class="roomInfo index content">
    <?= $this->Html->link(__('New Room Info'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Room Info') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('device_id') ?></th>
                    <th><?= $this->Paginator->sort('user_uid') ?></th>
                    <th><?= $this->Paginator->sort('postal_code') ?></th>
                    <th><?= $this->Paginator->sort('prefecture') ?></th>
                    <th><?= $this->Paginator->sort('address') ?></th>
                    <th><?= $this->Paginator->sort('room_no') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roomInfo as $roomInfo): ?>
                <tr>
                    <td><?= $this->Number->format($roomInfo->id) ?></td>
                    <td><?= h($roomInfo->device_id) ?></td>
                    <td><?= h($roomInfo->user_uid) ?></td>
                    <td><?= h($roomInfo->postal_code) ?></td>
                    <td><?= h($roomInfo->prefecture) ?></td>
                    <td><?= h($roomInfo->address) ?></td>
                    <td><?= h($roomInfo->room_no) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $roomInfo->device_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $roomInfo->device_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $roomInfo->device_id], ['confirm' => __('Are you sure you want to delete # {0}?', $roomInfo->device_id)]) ?>
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

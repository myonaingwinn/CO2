<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RoomInfo $roomInfo
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Room Info'), ['action' => 'edit', $roomInfo->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Room Info'), ['action' => 'delete', $roomInfo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roomInfo->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Room Info'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Room Info'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="roomInfo view content">
            <h3><?= h($roomInfo->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Co2datadetail') ?></th>
                    <td><?= $roomInfo->has('co2datadetail') ? $this->Html->link($roomInfo->co2datadetail->id, ['controller' => 'Co2datadetails', 'action' => 'view', $roomInfo->co2datadetail->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User Uid') ?></th>
                    <td><?= h($roomInfo->user_uid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Postal Code') ?></th>
                    <td><?= h($roomInfo->postal_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prefecture') ?></th>
                    <td><?= h($roomInfo->prefecture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($roomInfo->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Room No') ?></th>
                    <td><?= h($roomInfo->room_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($roomInfo->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

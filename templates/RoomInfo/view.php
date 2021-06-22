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
            <?= $this->Html->link(__('Edit Room Info'), ['action' => 'edit', $roomInfo->device_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Room Info'), ['action' => 'delete', $roomInfo->device_id], ['confirm' => __('Are you sure you want to delete # {0}?', $roomInfo->device_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Room Info'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Room Info'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="roomInfo view content">
            <h3><?= h($roomInfo->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Device Id') ?></th>
                    <td><?= h($roomInfo->device_id) ?></td>
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
            <div class="related">
                <h4><?= __('Related Co2datadetails') ?></h4>
                <?php if (!empty($roomInfo->co2datadetails)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Co2 Device Id') ?></th>
                            <th><?= __('Temperature') ?></th>
                            <th><?= __('Humidity') ?></th>
                            <th><?= __('Co2') ?></th>
                            <th><?= __('Noise') ?></th>
                            <th><?= __('Time Measured') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($roomInfo->co2datadetails as $co2datadetails) : ?>
                        <tr>
                            <td><?= h($co2datadetails->id) ?></td>
                            <td><?= h($co2datadetails->co2_device_id) ?></td>
                            <td><?= h($co2datadetails->temperature) ?></td>
                            <td><?= h($co2datadetails->humidity) ?></td>
                            <td><?= h($co2datadetails->co2) ?></td>
                            <td><?= h($co2datadetails->noise) ?></td>
                            <td><?= h($co2datadetails->time_measured) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Co2datadetails', 'action' => 'view', $co2datadetails->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Co2datadetails', 'action' => 'edit', $co2datadetails->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Co2datadetails', 'action' => 'delete', $co2datadetails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $co2datadetails->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

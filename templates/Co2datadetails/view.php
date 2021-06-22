<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Co2datadetail $co2datadetail
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Co2datadetail'), ['action' => 'edit', $co2datadetail->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Co2datadetail'), ['action' => 'delete', $co2datadetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $co2datadetail->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Co2datadetails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Co2datadetail'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="co2datadetails view content">
            <h3><?= h($co2datadetail->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($co2datadetail->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Co2 Device Id') ?></th>
                    <td><?= h($co2datadetail->co2_device_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Temperature') ?></th>
                    <td><?= $this->Number->format($co2datadetail->temperature) ?></td>
                </tr>
                <tr>
                    <th><?= __('Humidity') ?></th>
                    <td><?= $this->Number->format($co2datadetail->humidity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Co2') ?></th>
                    <td><?= $this->Number->format($co2datadetail->co2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Noise') ?></th>
                    <td><?= $this->Number->format($co2datadetail->noise) ?></td>
                </tr>
                <tr>
                    <th><?= __('Time Measured') ?></th>
                    <td><?= h($co2datadetail->time_measured) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

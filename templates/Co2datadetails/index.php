<!-- <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Co2datadetail[]|\Cake\Collection\CollectionInterface $co2datadetails
 */
?>
<div class="co2datadetails index content">
    <?= $this->Html->link(__('New Co2datadetail'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Co2datadetails') ?></h3>
    <div class="table-responsive table">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('co2_device_id') ?></th>
                    <th><?= $this->Paginator->sort('temperature') ?></th>
                    <th><?= $this->Paginator->sort('humidity') ?></th>
                    <th><?= $this->Paginator->sort('co2') ?></th>
                    <th><?= $this->Paginator->sort('noise') ?></th>
                    <th><?= $this->Paginator->sort('time_measured') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($co2datadetails as $co2datadetail): ?>
                <tr>
                    <td><?= h($co2datadetail->id) ?></td>
                    <td><?= h($co2datadetail->co2_device_id) ?></td>
                    <td><?= $this->Number->format($co2datadetail->temperature) ?></td>
                    <td><?= $this->Number->format($co2datadetail->humidity) ?></td>
                    <td><?= $this->Number->format($co2datadetail->co2) ?></td>
                    <td><?= $this->Number->format($co2datadetail->noise) ?></td>
                    <td><?= h($co2datadetail->time_measured) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $co2datadetail->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $co2datadetail->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $co2datadetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $co2datadetail->id)]) ?>
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
</div> -->

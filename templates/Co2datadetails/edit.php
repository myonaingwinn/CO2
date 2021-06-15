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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $co2datadetail->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $co2datadetail->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Co2datadetails'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="co2datadetails form content">
            <?= $this->Form->create($co2datadetail) ?>
            <fieldset>
                <legend><?= __('Edit Co2datadetail') ?></legend>
                <?php
                    echo $this->Form->control('co2_device_id');
                    echo $this->Form->control('temperature');
                    echo $this->Form->control('humidity');
                    echo $this->Form->control('co2');
                    echo $this->Form->control('noise');
                    echo $this->Form->control('time_measured', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

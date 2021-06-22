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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $roomInfo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $roomInfo->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Room Info'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="roomInfo form content">
            <?= $this->Form->create($roomInfo) ?>
            <fieldset>
                <legend><?= __('Edit Room Info') ?></legend>
                <?php
                    echo $this->Form->control('user_uid');
                    echo $this->Form->control('postal_code');
                    echo $this->Form->control('prefecture');
                    echo $this->Form->control('address');
                    echo $this->Form->control('room_no');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

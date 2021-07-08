<?php
$this->assign('title', 'デバイス一覧');
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RoomInfo[]|\Cake\Collection\CollectionInterface $roomInfo
 */
?>
<div class="index content">
    <!-- <?= $this->Html->link(__('デバイス登録'), ['action' => 'add'], ['class' => 'button float-right']) ?> -->
    <h3 class="text-center mb-4"><?= __('デバイス一覧') ?></h3>
    <div class="row mb-3">
        <div class="col-3 text-left">
            <div class="form-outline">
                <input type="text" id="search" class="form-control" maxlength="50" />
                <label class="form-label" for="search">検索</label>
            </div>
        </div>
        <div class="col-3"></div>
        <div class="col-6 text-right">
            <a href="device_reg" class="btn btn-primary">デバイス登録</a>
        </div>
    </div>
    <div class="table-responsive">
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
    </div>
    <div class="paginator">
        <?php
        if ($pages > 1) : ?>
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
        <?php endif ?>
        <p><?= $this->Paginator->counter(__('ページ {{page}}/{{pages}}、合計{{count}}つのうち{{current}}つのレコードを表示。')) ?></p>
    </div>
</div>

<script>
    $('document').ready(function() {
        $('#search').keyup(function() {
            if (!$(this).val() || $(this).val().trim() == '') {
                location.reload();
            } else {
                var searchkey = $(this).val();
                searchUsers(searchkey);
            }
        });

        function searchUsers(keyword) {
            var data = keyword;
            $.ajax({
                method: 'get',
                url: "<?php echo $this->Url->build(['controller' => 'RoomInfo', 'action' => 'Search']); ?>",
                data: {
                    keyword: data
                },
                success: function(response) {
                    $('.table-responsive').html(response);
                }
            });
        };
    });
</script>
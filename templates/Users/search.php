<table id="paginationNumbers" class="table" width="100%">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('No') ?></th>
            <th><?= $this->Paginator->sort('Name') ?></th>
            <th><?= $this->Paginator->sort('Email') ?></th>
            <th><?= $this->Paginator->sort('Last_LogIn_date') ?></th>
            <th><?= $this->Paginator->sort('Role') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $page = $this->Paginator->counter(__('{{page}}'));
        $no = 1;
        if ($page > 2)
            $no = $page * 20 - 19;
        else if ($page == 2)
            $no = $page * 10 + 1; ?>
        <?php foreach ($users as $user) : ?>
            <!-- <input type="hidden" id="id" name="id" value=<?= h($user->id) ?>> -->
            <?php
            echo $this->Form->control('id', ['type' => 'hidden', 'id' => 'id', 'value' => $user->id]);
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->last_login) ?></td>
                <td>

                    <select name=" role" id="role">
                        <?php
                        $role = $user->role;
                        if ($role == 'A') {
                            echo
                            '<option value="A" selected>Admin</option>
                                         <option value="E">Editor</option>
                                        <option value="U">User</option>';
                        }
                        if ($role == 'E') {
                            echo
                            '<option value="A" >Admin</option>
                                        <option value="E" selected>Editor</option>
                                        <option value="U">User</option>';
                        }
                        if ($role == 'U') {
                            echo
                            '<option value="A" selected>Admin</option>
                                        <option value="E">Editor</option>
                                        <option value="U" selected>User</option>';
                        }
                        ?>
                    </select>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

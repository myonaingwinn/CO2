<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style>
        #register {
            padding-top: 0.7rem;
            padding-left: 0.5rem;
        }

        #title {
            margin-bottom: 2rem;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center" id="title">ユーザー更新画面</h4>
                        <?= $this->Form->create($user) ?>

                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-outline mb-3">
                                    <input type="text" name="name" id="name" class="form-control form-control-lg" value=<?= $user->name ?> />
                                    <label class="form-label" for="name">名前</label>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-outline mb-3">
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" value=<?= $user->email ?> />
                                    <label class="form-label" for="email">メールアドレス </label>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-10 mb-3">
                                <td>
                                    <select name="role" id="role" class="select select-initialized">
                                        <?php
                                        $role = $user->role;
                                        if ($role == 'A') {
                                            echo
                                            '<option value="A" selected>管理者</option>
                                                          <option value="U">ユーザー</option>';
                                        }

                                        if ($role == 'U') {
                                            echo
                                            '<option value="A" selected>管理者</option>
                                                        <option value="U" selected>ユーザー</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </div>
                            <div class="col-sm-1"></div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                </div>
                                <div class="text-center mb-2">
                                    <input type="submit" value="保存" class="btn btn-lg btn-primary">
                                    <?= $this->Form->end() ?>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

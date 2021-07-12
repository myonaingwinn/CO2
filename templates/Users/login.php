<?php
$this->assign('title', 'ログイン');
?>

<style>
    img {
        margin-top: 0.7rem;
        width: 128px;
    }
</style>

    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 text-center">
                            <img src="/img/gic.png" class="img-fluid">
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>

                    <div class="card-body">
                        <h4 class="card-title text-center mb-3" id="title">GICへようこそ</h4>
                        <?= $this->Flash->render() ?>
                        <?= $this->Form->create() ?>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-outline mb-3">
                                    <input type="text" name="email" id="email" class="form-control form-control-lg" required />
                                    <label class="form-label" for="email">メールアドレス</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>

                        <div class="col-sm-10">

                            <div class="form-outline mb-3">
                                <input type="password" name="password" id="password" class="form-control form-control-lg" required />
                                <label class="form-label" for="password">パスワード</label>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-11 mb-4">
                            <?= $this->Html->link("パスワードをお忘れの方", ['controller' => 'Users', 'action' => 'forgotpassword']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
                            <div class="text-center mb-2">
                                <button id="btnReg" type="submit" class="btn btn-lg btn-primary">ログイン</button>
                            </div>

                            <div class="col-md-2">
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
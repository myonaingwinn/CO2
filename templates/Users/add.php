<?php
    $this->assign('title', 'ユーザー登録');
?>

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

<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center" id="title">ユーザー登録</h4>
                    <?= $this->Form->create($user) ?>

                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <div class="form-outline mb-3">
                                <input type="text" name="name" id="name" class="form-control form-control-lg" required />
                                <label class="form-label" for="name">名前</label>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <div class="form-outline mb-3">
                                <input type="email" name="email" id="email" class="form-control form-control-lg" required />
                                <label class="form-label" for="email">メールアドレス

                                </label>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <div class="form-outline mb-3">
                                <input type="password" name="password" id="password" class="form-control form-control-lg" required />
                                <label class="form-label" for="password">パスワード

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">

                        </div>
                        <div class="col-sm-10 mb-3">
                            <section class="border p-3 mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5 id="register">役割</h5>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="btn-group ">
                                            <input type="radio" class="btn-check" name="role" id="option1" value="A" />
                                            <label class="btn btn-lg btn-info" for="option1">管理者</label>

                                            <input type="radio" class="btn-check" name="role" id="option3" value="U" checked />
                                            <label class="btn btn-lg btn-info" for="option3">ユーザー</label>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        </div>
                        <div class="col-sm-1"></div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>
                            <div class="text-center mb-2">
                                <input type="submit" value="登録" class="btn btn-lg btn-primary">
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
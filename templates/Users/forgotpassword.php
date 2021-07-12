<!DOCTYPE html>
<html>

<head>
    <title>パスワードをお忘れの方</title>
    <style>
        img {
            margin-top: 0.7rem;
            width: 128px;
        }
    </style>
</head>

<body>
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
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4 mt-3" id="title">パスワードをお忘れの方</h4>
                        <?= $this->Form->create() ?>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" required />
                                    <label class="form-label" for="email">メールアドレス

                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                </div>
                                <div class="text-center mb-2">
                                    <input type="submit" value="送信" class="btn btn-lg btn-primary">
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
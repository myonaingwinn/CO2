<!DOCTYPE html>
<html>

<head>
    <title>パスワードをお忘れの方</title>
    <style>
        #title {
            margin-bottom: 2.5rem;
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
                        <h4 class="card-title text-center" id="title">パスワードをお忘れの方</h4>
                        <?= $this->Form->create() ?>
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
<!DOCTYPE html>
<html>

<head>
    <title>パスワードのリセット</title>
    <style>
        #title {
            margin-bottom: 1.5rem;
        }

        img {
            margin-top: 0.7rem;
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
                        <h4 class="card-title text-center" id="title">パスワードのリセット</h4>
                        <?= $this->Form->create() ?>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-outline mb-3">
                                    <input type="password" class="form-control form-control-lg" id="password" required />
                                    <label class="form-label" for="password">新しいパスワード

                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-outline mb-3" id="password">
                                    <input type="password" name="password" class="form-control form-control-lg pass" id="confirmPassword" required />
                                    <label class="form-label" for="password">確認パスワード

                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div id="msg"></div>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                </div>
                                <div class="text-center mb-2">
                                    <input type="submit" value="提出" class="btn btn-lg btn-primary" id="btnReset">
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
    <script>
        $(function() {
            $("#confirmPassword, #password").keyup(function() {
                if ($("#password").val() != $("#confirmPassword").val() || $("#confirmPassword").val().trim().length == 0) {
                    // document.getElementById("password").style.border = "1px solid red";
                    $("#msg").html("パスワードが一致しません").css("color", "red");

                } else {
                    // document.getElementById("confirmPassword").style.border = "1px solid red";
                    $("#msg").html("パスワードが一致しました").css("color", "green");
                }
            });
        });

        $('#btnReset').click(function(event) {
            if ($("#password").val() != $("#confirmPassword").val() || $("#confirmPassword").val().trim().length == 0) {
                event.preventDefault();
                $("#password").css("border-color", "red");
                $("#confirmPassword").css("border-color", "red");
            }
        });
    </script>
</body>

</html>
<?php
echo $this->Html->css('form');


?>

<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-5 login">
            <div class="card">

                <div class="card-body">
                    <p class="title">パスワードのリセット</p>
                    <?= $this->Form->create() ?>
                    <div class="password">


                        <p>新しいパスワード</p>
                        <div class="input-group flex-nowrap">

                            <span class="input-group-text"> <i class="fa fa-lock" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" placeholder="新しいパスワード" id="password" aria-label="password" aria-describedby="addon-wrapping" required />

                        </div>
                    </div>

                    <div class="password">


                        <p>確認パスワード</p>
                        <div class="input-group flex-nowrap">

                            <span class="input-group-text"> <i class="fa fa-lock" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" placeholder="確認パスワード" id="confirmPassword" aria-label="password" aria-describedby="addon-wrapping" name="password" required />
                        </div>
                    </div>
                    <div id="msg"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                            </div>

                            <div class="text-center">
                                <input type="submit" value="提出" class="btnsub btn-primary" id="btnReset">
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
                $("#password").css("border-color", "red");
                $("#confirmPassword").css("border-color", "red");
                $("#msg").html("パスワードが一致しません").css("color", "red");

            } else {
                $("#password").css("border-color", "green");
                $("#confirmPassword").css("border-color", "green");
                $("#msg").html("パスワードが一致しました").css("color", "green");
            }
        });
    });

    $('#btnReset').click(function(event) {
        if ($("#password").val() != $("#confirmPassword").val() || $("#confirmPassword").val().trim().length == 0) {
            event.preventDefault();
        }
    });
</script>
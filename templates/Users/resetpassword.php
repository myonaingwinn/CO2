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
                <div class="card mb-4">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 text-center">
                            <img src="/img/gic.png" class="img-fluid">
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center mt-2" id="title">パスワードのリセット</h4>
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

                                <div id="popover-password">
                                    <p>パスワードの強度: <span id="result"> </span></p>
                                    <div class="progress">
                                        <div id="password-strength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                        </div>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li class=""><span class="low-upper-case"><i class="fas fa-file " aria-hidden="true"></i></span>&nbsp; 1 小文字 &amp; 1 大文字</li>
                                        <li class=""><span class="one-number"><i class="fas fa-file" aria-hidden="true"></i></span> &nbsp;1 数 (0-9)</li>
                                        <li class=""><span class="one-special-char"><i class="fas fa-file" aria-hidden="true"></i></span> &nbsp;1 特殊文字 (!@#$%^&*)</li>
                                        <li class=""><span class="eight-character"><i class="fas fa-file" aria-hidden="true"></i></span>&nbsp;少なくとも8文字</li>
                                    </ul>
                                </div>
                                <input type="hidden" id="PasswordType" name="PasswordType">

                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10 mb-3">
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
        $(document).ready(function() {

            $('#confirmPassword').keyup(function() {
                var password = $('#confirmPassword').val();
                if (checkStrength(password) == false) {
                    $('#sign-up').attr('disabled', true);
                }
            });

            function checkStrength(password) {
                var strength = 0;


                //If password contains both lower and uppercase characters, increase strength value.
                if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
                    strength += 1;
                    $('.low-upper-case').addClass('text-success');
                    $('.low-upper-case i').removeClass('fas fa-file').addClass('fa fa-check');
                    $('#popover-password-top').addClass('hide');


                } else {
                    $('.low-upper-case').removeClass('text-success');
                    $('.low-upper-case i').addClass('fas fa-file').removeClass('fa fa-check');
                    $('#popover-password-top').removeClass('hide');
                }

                //If it has numbers and characters, increase strength value.
                if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
                    strength += 1;
                    $('.one-number').addClass('text-success');
                    $('.one-number i').removeClass('fas fa-file').addClass('fa fa-check');
                    $('#popover-password-top').addClass('hide');

                } else {
                    $('.one-number').removeClass('text-success');
                    $('.one-number i').addClass('fas fa-file').removeClass('fa fa-check');
                    $('#popover-password-top').removeClass('hide');
                }

                //If it has one special character, increase strength value.
                if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
                    strength += 1;
                    $('.one-special-char').addClass('text-success');
                    $('.one-special-char i').removeClass('fas fa-file').addClass('fa fa-check');
                    $('#popover-password-top').addClass('hide');

                } else {
                    $('.one-special-char').removeClass('text-success');
                    $('.one-special-char i').addClass('fas fa-file').removeClass('fa fa-check');
                    $('#popover-password-top').removeClass('hide');
                }

                if (password.length > 7) {
                    strength += 1;
                    $('.eight-character').addClass('text-success');
                    $('.eight-character i').removeClass('fas fa-file').addClass('fa fa-check');
                    $('#popover-password-top').addClass('hide');

                } else {
                    $('.eight-character').removeClass('text-success');
                    $('.eight-character i').addClass('fas fa-file').removeClass('fa fa-check');
                    $('#popover-password-top').removeClass('hide');
                }
                // If value is less than 2
                var p_w;
                if (strength < 2) {
                    $('#result').removeClass()
                    $('#password-strength').addClass('progress-bar-danger');
                    p_w = 'W';
                    $('#result').addClass('text-danger').text('Weak');

                    $('#password-strength').css('width', '10%');
                }
                // if (strength == 2) {
                //     $('#result').addClass('good');
                //     $('#password-strength').removeClass('progress-bar-danger');
                //     $('#password-strength').addClass('progress-bar-warning');

                //     $('#result').addClass('text-warning').text('Good')
                //     $('#password-strength').css('width', '60%');
                //     // return 'Weak'
                //     p_w = 'G';
                // }
                if (strength == 4) {
                    $('#result').removeClass()
                    $('#result').addClass('strong');
                    $('#password-strength').removeClass('progress-bar-warning');
                    $('#password-strength').addClass('progress-bar-success');
                    $('#result').addClass('text-success').text('Strong');
                    p_w = 'S';
                    $('#password-strength').css('width', '100%');

                    // return 'Strong'
                }
                document.getElementById('PasswordType').value = p_w;

            }



            $("#confirmPassword, #password").keyup(function() {
                if ($("#password").val() != $("#confirmPassword").val() || $("#confirmPassword").val().trim().length == 0) {

                    $("#msg").html("パスワードが一致しません").css("color", "red");

                } else {

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
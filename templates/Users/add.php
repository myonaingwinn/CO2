<html>

<head>
    <title>登録</title>
    <style>
        #register {
            padding-top: 0.7rem;
            padding-left: 0.5rem;
        }

        #title {
            margin-bottom: 2rem;
            margin-top: 1rem;
        }

        .select-input {
            margin-top: -20px;
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
                                        <li class=""><span class="eight-character"><i class="fas fa-file" aria-hidden="true"></i></span>&nbsp; 少なくとも8文字</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="form-outline mb-3">
                                    <input type="text" name="other" id="other" class="form-control form-control-lg" required />
                                    <label class="form-label" for="other">ラインアカウント</label>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                        <input type="hidden" id="PasswordType" name="PasswordType">
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
                                            　　　　　　　　　　　　　　　　　　　　　　　　　　　
                                            <select name="role" id="role" class="select select-initialized" required>
                                                <option value="A">管理者</option>
                                                　 <option value="U" selected>ユーザー</option>

                                            </select>
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
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('#password').keyup(function() {
            var password = $('#password').val();
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

    });
</script>


</html>
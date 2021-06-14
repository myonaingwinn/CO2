<?php
echo $this->Html->css('form');


?>

<!DOCTYPE html>
<html>

<head>
    <title>ForgetPassword</title>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-5 login">
                <div class="card">

                    <div class="card-body">
                        <p class="title">Forget Password</p>
                        <?= $this->Form->create() ?>
                        <div class="email">


                            <p>Email</p>
                            <div class="input-group flex-nowrap">

                                <span class="input-group-text"> <i class=" fa fas fa-envelope" aria-hidden="true"></i></span>
                                <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping" name="email" id="textbox" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                </div>

                                <div class="text-center">
                                    <input type="submit" value="Submit" class="submit">
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
<?php
echo $this->Html->css('form');
echo $this->Html->script('style');


?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-5 login">
                <div class="card">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <img src="/img/gic.png">
                        </div>
                        <div class="col-sm-4"></div>
                    </div>

                    <div class="card-body">
                        <p class="title">Welcome to GIC</p>


                        <?= $this->Flash->render() ?>

                        <?= $this->Form->create() ?>

                        <div class="row">
                            <div class="col-sm-1"></div>

                            <div class="col-sm-10">

                                <div class="email">


                                    <p>Email</p>
                                    <div class="input-group flex-nowrap">

                                        <span class="input-group-text"> <i class=" fa fas fa-envelope" aria-hidden="true"></i></span>
                                        <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping" name="email" id="textbox" required />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-1"></div>

                        </div>

                        <div class="row">
                            <div class="col-sm-1"></div>

                            <div class="col-sm-10">

                                <div class="password">
                                    <p>Password</p>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" placeholder="Password" aria-label="password" name="password" aria-describedby="addon-wrapping" id="textbox" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>




                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                </div>

                                <div class="text-center">
                                    <input type="submit" value="LogIn" class="submit">

                                </div>

                                <div class="col-md-2">
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-7">
                            </div>

                            <div class="col-md-5">
                                <p class="forgot"> <?= $this->Html->link("Forgot Password?", ['controller' => 'Users', 'action' => 'forgotpassword']); ?>
                                </p>

                            </div>
                            <div class="col-sm-3"></div>


                        </div>
                        <?= $this->Form->end() ?>



                        <!-- 
                        <body style="margin-top: 90px;">
                            <?= $this->Flash->render() ?>
                            <?= $this->Form->create() ?>
                            <?= $this->Form->control('email') ?>
                            <?= $this->Form->control('password') ?>
                            <?= $this->Form->submit() ?>

                            <?= $this->Form->end() ?> -->
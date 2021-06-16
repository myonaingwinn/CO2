<?php

echo $this->Html->css('form');
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
            <div class="col-sm-6 login">
                <div class="card">
                    <div class="card-body">
                        <p class="title">Register</p>
                        <?= $this->Form->create($user) ?>
                        <div class="row">
                            <div class="col-sm-1">

                            </div>
                            <div class="col-sm-4">
                                <p>Name</p>
                            </div>
                            <div class="col-sm-7"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">


                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control " placeholder="UserName" aria-label="Name" name="name" aria-describedby="addon-wrapping" id="textbox" required />
                                </div>

                            </div>
                            <div class="col-sm-1"></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-1">

                            </div>
                            <div class="col-sm-4">
                                <p>Email</p>
                            </div>
                            <div class="col-sm-7"></div>
                        </div>

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
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-4">
                                <p>Password</p>
                            </div>
                            <div class="col-sm-7"></div>
                        </div>

                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" placeholder="Password" aria-label="password" name="password" aria-describedby="addon-wrapping" id="textbox" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="role">Role</p>
                            </div>
                            <div class="col-sm-7">
                                <div class="role-type">
                                    <div class="btn-group">
                                        <input type="radio" class="btn-check" name="role" id="option1" value="A" />
                                        <label class="btn btn-primary" for="option1">Admin</label>

                                        <input type="radio" class="btn-check" name="role" id="option2" value="E" />
                                        <label class="btn btn-primary" for="option2">Editor</label>

                                        <input type="radio" class="btn-check" name="role" id="option3" value="U" checked />
                                        <label class="btn btn-primary" for="option3">User</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                </div>
                                <div class="text-center">
                                    <input type="submit" value="Register" class="submit">
                                    <?= $this->Form->end() ?>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                        </div>
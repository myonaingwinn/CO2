<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <!-- SLPP Modify -->
    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
    <!--  -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700&display=swap" rel="stylesheet" />

    <!-- <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'mdb.min']) ?> -->

    <?= $this->Html->css('mdb.min.css') ?>
    <?= $this->Html->script('jquery-3.5.1.min.js') ?>

    <!-- <?= $this->Html->script(['mdb.min', 'jquery-3.5.1.min']) ?> -->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script('./fusioncharts/fusioncharts.js') ?>
    <?= $this->Html->script('./fusioncharts/themes/fusioncharts.theme.candy.js') ?>
</head>

<body>
    <header>
        <div id="sidenav-1" class="sidenav sidenav-primary ps" role="navigation" data-hidden="false" data-accordion="true" style="width: 240px; height: 100vh; position: fixed; transition: all 0.3s linear 0s; transform: translateX(0%);">
            <!-- <a class="ripple d-flex justify-content-center py-4" href="#!" data-ripple-color="primary">
                <img id="MDB-logo" src="https://mdbootstrap.com/wp-content/uploads/2018/06/logo-mdb-jquery-small.png" alt="MDB Logo" draggable="false">
            </a> -->

            <div class="mt-4">
                <div id="header-content" class="pl-3">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(23).jpg" alt="avatar" class="rounded-circle img-fluid mb-3" style="max-width: 50px;">
                    <h4>
                        <span style="white-space: nowrap;">Ann Smith</span>
                    </h4>
                    <p>ann_s@mdbootstrap.com</p>
                </div>
                <hr class="mb-0">
            </div>

            <ul class="sidenav-menu">
                <li class="sidenav-item">
                    <a class="sidenav-link active ripple-surface" href="" tabindex="-1">
                        <i class="fas fa-chart-area pr-3"></i><span>Webiste traffic</span></a>
                </li>
                <li class="sidenav-item">
                    <a class="sidenav-link ripple-surface" data-toggle="collapse" href="#sidenav-collapse-1-0-0" role="button" tabindex="-1"><i class="fas fa-cogs pr-3"></i><span>Settings</span><i class="fas fa-angle-down rotate-icon"></i></a>
                    <ul class="sidenav-collapse collapse" id="sidenav-collapse-1-0-0">
                        <li class="sidenav-item">
                            <a class="sidenav-link ripple-surface" tabindex="-1">Profile</a>
                        </li>
                        <li class="sidenav-item">
                            <a class="sidenav-link ripple-surface" tabindex="-1">Account</a>
                        </li>
                    </ul>
                </li>
                <li class="sidenav-item">
                    <a class="sidenav-link ripple-surface" data-toggle="collapse" href="#sidenav-collapse-1-0-1" role="button" tabindex="-1"><i class="fas fa-lock pr-3"></i><span>Password</span><i class="fas fa-angle-down rotate-icon"></i></a>
                    <ul class="sidenav-collapse collapse" id="sidenav-collapse-1-0-1">
                        <li class="sidenav-item">
                            <a class="sidenav-link ripple-surface" tabindex="-1">Request password</a>
                        </li>
                        <li class="sidenav-item">
                            <a class="sidenav-link ripple-surface" tabindex="-1">Reset password</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; right: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div> -->
        </div>

        <nav id="main-navbar" class="navbar navbar-light bg-light fixed-top shadow-4">
            <div class="container-fluid">
                <!-- Toggler -->
                <button id="btnBars" data-toggle="sidenav" data-target="#sidenav-1" class="btn shadow-0 p-0 mr-3 d-block d-xxl-none ripple-surface" aria-controls="#sidenav-1" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bars fa-lg"></i>
                </button>

                <!-- Search form -->
                <!-- <form class="d-none d-md-flex input-group w-auto my-auto">
                    <input autocomplete="off" type="search" class="form-control rounded" placeholder="Search (ctrl + &quot;/&quot; to focus)" style="min-width: 225px">
                    <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                </form> -->

                <!-- Right links -->
                <!-- <ul class="navbar-nav ml-auto d-flex flex-row">
                    <li class="nav-item mr-3 mr-lg-0">
                        <a class="nav-link" href="#">
                            <i class="fab fa-github"></i>
                        </a>
                    </li>
                </ul> -->
            </div>
        </nav>
    </header>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
<script type="text/javascript" src="/js/mdb.min.js"></script>
<style>
    body {
        background: #f8faff;
    }

    main {
        margin-top: 5rem;
    }

    .container {
        margin-top: 3rem;
    }

    #btnBars {
        padding-top: 8px !important;
        padding-left: 10px !important;
        padding-bottom: 8px !important;
    }
</style>

</html>
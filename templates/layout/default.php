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

$cakeDescription = 'CO2 ';
?>
<!DOCTYPE html>
<html>

<head>

    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
    <?= $this->Html->charset() ?>
    <!-- SLPP Modify -->
    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
    <!--  -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <!-- <?= $this->Html->meta('icon') ?> -->
    <?= $this->Html->meta('Logo', 'img/gic.logo.png', ['type' => 'icon']); ?>

    <!-- Font Awesome -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" /> -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700&display=swap" rel="stylesheet" />

    <!-- <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'mdb.min']) ?> -->

    <?= $this->Html->css(['mdb.min.css', 'all.css',]) ?>
    <?= $this->Html->script(['jquery-3.5.1.min.js']) ?>

    <!-- <?= $this->Html->script(['mdb.min', 'jquery-3.5.1.min']) ?> -->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script('./fusioncharts/old_version/fusioncharts.js') ?>
    <?= $this->Html->script('./fusioncharts/old_version/themes/fusioncharts.theme.candy.js') ?>
</head>

<body>
    <header>
        <nav id="main-navbar" class="navbar navbar-light bg-light fixed-top shadow-4">
            <div class="container-fluid">
                <!-- Toggler -->
                <?php if ($Auser) : ?>
                    <button id="btnBars" data-toggle="sidenav" data-target="#sidenav-1" class="btn shadow-0 p-0 mr-3 d-block d-xxl-none ripple-surface" aria-controls="#sidenav-1" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bars my-fa-2x"></i>
                    </button>

                    <script>
                        $('#main-navbar').removeClass('my-navbar');
                    </script>
                <?php else : ?>
                    <script>
                        $('#main-navbar').addClass('my-navbar');
                    </script>
                <?php endif; ?>

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

        <div id="sidenav-1" class="sidenav sidenav-primary ps" role="navigation" data-hidden="false" data-accordion="true" style="width: 240px; height: 100vh; position: fixed; transition: all 0.3s linear 0s; transform: translateX(-100%);">
            <!-- <a class="ripple d-flex justify-content-center py-4" href="#!" data-ripple-color="primary">
                <img id="MDB-logo" src="https://mdbootstrap.com/wp-content/uploads/2018/06/logo-mdb-jquery-small.png" alt="MDB Logo" draggable="false">
            </a> -->

            <div class="mt-4">
                <div id="header-content" class="pl-3">
                    <!-- <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(23).jpg" alt="avatar" class="rounded-circle img-fluid mb-3" style="max-width: 50px;"> -->
                    <div class="row my-row">
                        <div class="col text-truncate">
                            <i class="fas fa-user-circle text-success fa-5x mb-3 rounded-circle shadow-2"></i>
                        </div>
                    </div>
                    <div class="row my-row my-row2">
                        <div class="col-12 text-wrap text-break">
                            <h4><?= $Auser['name'] ?></h4>
                        </div>
                    </div>
                    <div class="row my-row">
                        <div class="col-12 text-wrap">
                            <p class="my-p"><?= $Auser['email'] ?></p>
                        </div>
                    </div>
                </div>
                <hr class="mb-0">
            </div>

            <!-- admin -->
            <?php if ($Auser['role'] == 'A') : ?>
                <ul class="sidenav-menu">
                    <li class="sidenav-item">
                        <a class="sidenav-link ripple-surface" href="http://localhost:8765/dashboard" tabindex="-1">
                            <i class="fas fa-chart-area fa-lg pr-2"></i><span>&nbsp;ダッシュボード</span></a>
                    </li>
                    <li class="sidenav-item">
                        <a class="sidenav-link ripple-surface" data-toggle="collapse" href="#sidenav-collapse-1-0-0" role="button" tabindex="-1">
                            <i class="fas fa-users-cog fa-lg pr-2"></i>
                            <span>ユーザー</span></a>
                        <ul class="sidenav-collapse collapse" id="sidenav-collapse-1-0-0">
                            <li class="sidenav-item">
                                <a class="sidenav-link ripple-surface" href="http://localhost:8765/users" tabindex="-1">
                                    <i class="fas fa-users pr-2"></i><span>ユーザー一覧</span></a>
                            </li>
                            <li class="sidenav-item">
                                <a class="sidenav-link ripple-surface" href="http://localhost:8765/register" tabindex="-1">
                                    <i class="fas fa-user-plus pr-2"></i><span>ユーザー登録</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidenav-item">
                        <a class="sidenav-link ripple-surface" data-toggle="collapse" href="#sidenav-collapse-1-0-1" role="button" tabindex="-1">
                            <i class="fas fa-tools fa-lg pr-2"></i>
                            <span>&nbsp;デバイス</span></a>
                        <ul class="sidenav-collapse collapse" id="sidenav-collapse-1-0-1">
                            <li class="sidenav-item">
                                <a class="sidenav-link ripple-surface" href="http://localhost:8765/devices" tabindex="-1">
                                    <i class="fas fa-list-ul pr-2"></i><span>デバイス一覧</span></a>
                            </li>
                            <li class="sidenav-item">
                                <a class="sidenav-link ripple-surface" href="http://localhost:8765/device_reg" tabindex="-1">
                                    <i class="fas fa-plus-circle pr-2"></i><span>デバイス登録</span></a>
                            </li>
                        </ul>
                    </li>
                    <!-- CSV Download Slide -->
                    <li class="sidenav-item">
                        <a class="sidenav-link ripple-surface" href="http://localhost:8765/csvdownloadslide" tabindex="-1">
                            <i class="fas fa-download fa-lg pr-2"></i><span>&ensp;CSVダウンロード</span></a>
                    </li>
                    <li class="sidenav-item">
                        <a class="sidenav-link ripple-surface" href="http://localhost:8765/forgotpassword" tabindex="-1">
                            <i class="fas fa-lock fa-lg pr-2"></i><span>&ensp;パスワードを再設定する</span></a>
                    </li>
                    <li class="sidenav-item">
                        <a class="sidenav-link ripple-surface" href="http://localhost:8765/logout" tabindex="-1">
                            <i class="fas fa-sign-out-alt text-danger fa-lg pr-2"></i><span>&nbsp;ログアウト</span></a>
                    </li>
                </ul>
            <?php endif; ?>

            <!-- user -->
            <?php if ($Auser['role'] == 'U') : ?>
                <ul class="sidenav-menu">
                    <li class="sidenav-item">
                        <a class="sidenav-link ripple-surface" href="http://localhost:8765/dashboard" tabindex="-1">
                            <i class="fas fa-chart-area fa-lg pr-2"></i><span>ダッシュボード</span></a>
                    </li>
                    <!-- CSV Download Slide -->
                    <li class="sidenav-item">
                        <a class="sidenav-link ripple-surface" href="http://localhost:8765/csvdownloadslide" tabindex="-1">
                            <i class="fas fa-download fa-lg pr-2"></i><span>&ensp;CSVダウンロード</span></a>
                    </li>
                    <li class="sidenav-item">
                        <a class="sidenav-link ripple-surface" href="http://localhost:8765/forgotpassword" tabindex="-1">
                            <i class="fas fa-lock fa-lg pr-2"></i><span>&nbsp;パスワードを再設定する</span></a>
                    </li>
                    <li class="sidenav-item">
                        <a class="sidenav-link ripple-surface" href="http://localhost:8765/logout" tabindex="-1">
                            <i class="fas fa-sign-out-alt text-danger fa-lg pr-2"></i><span>ログアウト</span></a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
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

    .my-navbar {
        padding-bottom: 2.5rem;
    }

    .my-row {
        margin-top: 0rem;
    }

    .my-row2 {
        margin-bottom: .3rem;
    }

    .my-p {
        margin-bottom: 0rem;
    }

    #btnBars {
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    }

    .my-fa-2x {
        font-size: 1.7em;
    }
</style>

<script>
    $(function() {
        $('div.sidenav-backdrop').remove();
    });
</script>

</html>
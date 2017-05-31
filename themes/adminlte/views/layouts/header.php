<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <div class="container-fluid">
                        <div class="navbar-custom-menu" id="navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, <?=(!Yii::$app->user->isGuest) ? Yii::$app->user->identity->username:'&nbsp;';?> <span class="caret"></span></a>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><?= Html::a(
                                                'Sign out',
                                                ['/site/logout'],
                                                ['data-method' => 'post']
                                            ) ?></li>
                                  </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<style>
    @media (max-width: 767px) {
        .skin-blue-light .main-header .navbar .dropdown-menu li a {
            color: #000;
        }
        .skin-blue-light .main-header .navbar .dropdown-menu li a:hover {
            color: #fff;
        }
    }
</style>
<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<header class="main-header">
    <?=Html::a('<span class="logo-mini">CMS</span><span class="logo-lg"><span class="logo-lg"> <img width="104px" src="img/logo.png">', Yii::$app->homeUrl, ['class' => 'logo'])?>
    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell"></i>
                        <span class="label label-danger">5</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> Very long description here that may
                                        not fit into the page and may cause design problems
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->


                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">
                        (<?=Yii::$app->user->identity->nama?> )
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">

                            <p>
                                <?=Yii::$app->user->identity->nama?> -

                           
                            <?php
                                $level=Yii::$app->user->identity->level;

                                if($level==1)
                                {
                            ?>
                            <span class="label label-warning">PELAYAN</span>
                            <?php
                                }
                                else if($level==2)
                                {
                            ?>
                            <span class="label label-maroon">DIVISI MAKANAN</span>
                            <?php
                                }
                            
                            else if($level==3)
                            {
                            ?>
                            <span class="label label-info">DIVISI MINUMAN</span>
                            <?php
                                }
                            
                            else if($level==4)
                            {
                            ?>
                            <span class="label label-primary">KASIR</span>
                            <?php
                                }
                            
                            else
                            {
                            ?>
                            <span class="label label-danger">ADMIN</span>
                            <?php
                                }
                            
                            ?>

                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                           
                            <div class="pull-right">
                                <?=Html::a(
    'Sign out',
    ['/site/logout'],
    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
)?>
                            </div>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
    </nav>
</header>

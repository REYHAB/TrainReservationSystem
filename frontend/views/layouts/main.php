<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    </head>
<?php $this->beginBody() ?>

<body class="md-skin">
<div id="wrapper">
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                                  <?php
                                  if(!Yii::$app->user->isGuest){ $path=\Yii::$app->user->identity->IMAGEPATH; }  ?>

                                  <?= Html::img('@web/'.$path, ['alt'=>'', 'class'=>'img-circle']);?>

                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                             <span class="text-muted text-xs block"><?= \Yii::$app->user->identity->FullName;?> <b class="caret"></b></span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/rbac/usernew/userprofile','id'=>Yii::$app->user->identity->id])?>">Profile</a></li>

                        <li class="divider"></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/logout'])?>">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    SGR+
                </div>
            </li>

            <li class="active">
                <a href="<?= Yii::$app->urlManager->createUrl(['/Projects/train/usersearchtrains'])?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>

            </li>


            <?php if (Yii::$app->user->can('admin')) { ?>



                <li>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Station</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/Projects/station/create'])?>">Add station</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/Projects/station/index'])?>">View station</a></li>


                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Trains</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/Projects/train/create'])?>">Add train</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/Projects/train/index'])?>">View trains</a></li>


                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">User Management</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/rbac/route/assignments'])?>">Roles</a></li>



                    </ul>
                </li>



            <?php } ?>




    </div>
    </div>

</nav>

<div id="page-wrapper" class="gray-bg dashbard-1">
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">Welcome to SGR RESERVATION SYSTEM.</span>
            </li>



            <li>
                <a href="<?= Yii::$app->urlManager->createUrl(['/site/logout'])?>">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>

    </nav>
</div>
    <div style="margin-top: 10px; padding: 5px;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>


</div>
</div>

</div>
</div>

</body>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>
    $(document).ready(function() {

        $("body").addClass("md-skin   ");

        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.success( 'Welcome To TRAIN SEAT RESERVATION SYSTEM

        }, 1300);


        var data1 = [
            [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
        ];
        var data2 = [
            [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
            {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#d5d5d5'
                },
                colors: ["#1ab394", "#1C84C6"],
                xaxis:{
                },
                yaxis: {
                    ticks: 4
                },
                tooltip: false
            }
        );



    });
</script>




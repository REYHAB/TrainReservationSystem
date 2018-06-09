

<?php
use yii\helpers\Html;
?>
<script src="/coopesb/assets/fb48c945/jquery.js"></script>

<div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-body profile-information">
                       <div class="col-md-3">
                           <div class="profile-pic text-center">
                              <?php
                    if(!Yii::$app->user->isGuest){ $path=\Yii::$app->user->identity->IMAGEPATH; } ?>
                <?= Html::img('@web/'.$path, ['alt'=>'No Image.Please Update Profile', 'class'=>'thing']);?>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="profile-desk">
                               <h1><?= $model->FullName ?></h1>
                               <span class="text-muted"> Role: <?php // $role=\Yii::$app->authManager->getRolesByUser($model->id); var_dump($role[->name);?></span>
                               </br>
                               </br>
                               <a href="<?= Yii::$app->urlManager->createUrl(['/rbac/usernew/selfupdate','id'=>\Yii::$app->user->identity->id])?>" class="btn btn-primary">Update Profile</a>
                               <a href="<?= Yii::$app->urlManager->createUrl(['/rbac/usernew/changepassword','id'=>\Yii::$app->user->identity->id])?>" class="btn btn-primary">Change Password</a>
                           </div>
                           
                       </div>
                       <div class="col-md-3">
                         
                       </div>
                    </div>
                </section>
            </div>
</div>
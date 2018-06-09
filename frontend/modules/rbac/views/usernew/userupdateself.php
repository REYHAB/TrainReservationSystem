<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\web\UploadedFile;
/* @var $this yii\web\View */
/* @var $model frontend\modules\rbac\models\Usernew */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .panel {
    margin-bottom: 10px !important;
}
</style>

<script src="/coopesb/assets/fb48c945/jquery.js"></script>

<div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <div class="panel-body profile-information">
                       <div class="col-md-3">
                           <div class="profile-pic text-center">
                              <?php
                    if(!Yii::$app->user->isGuest){ $path=\Yii::$app->user->identity->IMAGEPATH; } ?>
                <?= Html::img('@web/'.$path, ['alt'=>'NO Image.Please Upload Image by Updating Profile', 'class'=>'thing']);?> 
                            
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="profile-desk">
                               <h1><?= $model->FullName ?></h1>
                               <span class="text-muted"> Role: <?php // $role=\Yii::$app->authManager->getRolesByUser($model->id); var_dump($role['admin']->name);?></span>
                               </br>
                               </br>
                               <a href="<?= Yii::$app->urlManager->createUrl(['/rbac/usernew/selfupdate','id'=>\Yii::$app->user->identity->id])?>" class="btn btn-primary">Update Profile</a>
                               
                         
                           </div>
                       </div>
                       <div class="col-md-3">
                              <?= Html::a('Back', ['/rbac/usernew/userprofile','id'=>\Yii::$app->user->identity->id], ['class'=>'btn btn-primary btn-xs']) ?> 
           
<!--                           <div class="profile-statistics">
                               <h1>1240</h1>
                               <p>This Week Sales</p>
                               <h1>$5,61,240</h1>
                               <p>This Week Earn</p>
                               <ul>
                                   <li>
                                       <a href="#">
                                           <i class="fa fa-facebook"></i>
                                       </a>
                                   </li>
                                   <li class="active">
                                       <a href="#">
                                           <i class="fa fa-twitter"></i>
                                       </a>
                                   </li>
                                   <li>
                                       <a href="#">
                                           <i class="fa fa-google-plus"></i>
                                       </a>
                                   </li>
                               </ul>
                           </div>-->
                       </div>
                    </div>
                </section>
            </div>
</div>

<div class="tbgeneralparams-form">
   <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                      Hello. <?= $model->username ?>! Please Update your Details.
                        </header>
                        <div class="panel-body">
                            <div >

    <?php $form = ActiveForm::begin(); ?>

                                <div class="row">
                                    <div class="col-lg-6">
                  <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                                    </div>
                                    
                                    <div class="col-lg-6">
                  <?=  $form->field($model, 'email')->textInput(['maxlength' => true]) ?>  
                                 </div>
                                </div>
                                
                                <div class="row">

                                    
                                    <div class="col-lg-6">
                <?= $form->field($model, 'FullName')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-6">
                   
                                    </div>
                                    
                                    <div class="col-lg-6">
                     
                                    </div>
                                </div>
  



    

   

   



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
                                
           

</div>
                        </div>
            </div>
</section>
          </div>
    </div>

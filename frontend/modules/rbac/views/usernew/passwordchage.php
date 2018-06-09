<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model frontend\modules\rbac\models\Usernew */
/* @var $form yii\widgets\ActiveForm */
$model->password_hash='';
?>
<script src="/coopesb/assets/fb48c945/jquery.js"></script>
<div class="tbgeneralparams-form">
   <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                        Change Password
                        </header>
                        <div class="panel-body">
                            <div >

    <?php $form = ActiveForm::begin(); ?>

                                <div class="row">
                                    <div class="col-lg-3">
                                   <div class="form-group">
                        <label for="pwd">Old Password:</label>
                        <input type="password" class="form-control" name="oldpassword" id="pwd" required="true">
                      </div>
                                    </div>
                           </div>
                                
                                
                                
                                   <div class="row">
                                    <div class="col-lg-3">
                                <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true,'placeholder'=>'minimum 6 characters'])->label('New Password') ?>  
                       
                                    </div>
                                    
                                  
                         
                                </div>
                                
                                
                                     <div class="row">
                                    <div class="col-lg-3">
                                   <div class="form-group">
                        <label for="pwd">Confirm Password:</label>
                        <input pattern=".{6,}"  type="password" class="form-control" name="confirmpassword" id="pwd" required="true" placeholder="minimum 6 characters">
                      </div>
                                    </div>
                           </div>
                                
             

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Change Password', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

 <?php ActiveForm::end(); ?>
</div>
                        </div>
            </div>
</section>
          </div>
    </div>
</div>
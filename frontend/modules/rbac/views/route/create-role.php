<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
 <?php 
 
 ?>
 <?php $form = ActiveForm::begin([
	 		'id'=>'rolesform',
	 		'validationUrl' => '../../rbac/route/validate',
	 		'enableAjaxValidation'=>true,
	 		'enableClientValidation'=> false,
 		]);?>
     <div class="row"> 
          <div  id="loader11" class="margin padding left loader" style='display:none; margin-left: 50px;'>
                
                <p style="color: red; float: left;">processing......</p>    
               
                 <?= Html::img('@web/712.gif', ['alt'=>'some', 'class'=>'thing']);?>
                                                </div>
         <h3 style="margin-left: 10px;">Create Role</h3>
       <div id="success1" style="display: none"> <h3 style="color: green;">Role Saved Successfully</h3> </div>
         <div id="fail" style="display: none"> <h3 style="color: red;">Failed To Create Role. Pleas Try Again</h3> </div>
	    <div class="col-md-6 col-lg-6 form-group">
	      <?= $form->field($model, 'type')->hiddenInput(["value"=>1])->label(false) ?>
          <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'enter role name']) ?>
        </div>
     </div>
     <div class="row">     
	    <div class="col-md-8 col-lg-8 form-group">
           <?= $form->field($model, 'description')->textarea(['rows' => 3,'placeholder'=>'enter description here']) ?>
         </div>
     </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <button type="button" class="btn btn-info closemodal">Close</button>
    </div>

<?php ActiveForm::end(); ?>
<?php 
$script= <<< JS
$('form#rolesform').on('beforeSubmit', function(e) {
    var \$form = $(this);
         $('#loader11').show();
    $.post(
        \$form.attr("action"),
        \$form.serialize()
    ).done(function(response) {
         $('#loader11').hide();
         $('#success1').show();
        
        $('#rolesform').trigger("reset");
        callbacksuccess(response,true)
    }).fail(function(){
       $('#fail').show(); 
    });
    return false;
});
JS;
$this->registerJs($script);
?>
 
 <?php 
$script= <<< JS
 $(function () {
         $('.closemodal').click(function(e){
        
        $('#myModal2').modal('toggle');
    });
         });
JS;
$this->registerJs($script);
?>
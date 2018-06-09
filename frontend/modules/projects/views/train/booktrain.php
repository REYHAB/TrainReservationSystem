<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $model frontend\modules\projects\models\Train */


?>
<h4> Selected Train Details</h4>
<?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-10"
<div class="col-sm-12 col-lg-offset-3">
    <p><b><center>ALL PAYMENTS ARE DONE VIA MPESA</center></b></p>
</div>
<div class="col-sm-12 col-lg-offset-3">
       <b>  <h> MPESA ORDERING SYSTEM </h></b>
         <ol>
             <li>Open your SimToolkit and select Mpesa menu</li>
             <li>Click the Lipa na MPESA Menu</li>
             <li>On the next screen that appears click on the Paybill Option</li>
             <li>Cick on Enter Business Number and enter the number as 123456</li>
             <li>On the next window enter your Name as your the Business Number</li>
             <li>Press OK  and enter the correct amount of money required then enter your MPESA pin and click send</li>
             <li>Enter the MPESA Reference Number sent to your phone in text in the form given below</li>
         </ol>
</div>

<div class="col-lg-6">



    <h4> Booking Details</h4>




<div class="col-lg-4">
    <?php
    echo 'Booked Date';
    echo DatePicker::widget([
        'model'=>$model1,
        'name' => 'BookedDate',
        'attribute'=>'BookedDate',


        'type' => DatePicker::TYPE_INPUT,
        'value' => 'BookedDate',
        'convertFormat'=>true,
        'pluginOptions' => [
            'placeholder'=>'Select dat',
            'autoclose'=>true,
            'format' => 'yyyy-MM-dd'
        ]
    ]);
    ?>
</div>

<div class="col-lg-4">
    <?= $form->field($model1, 'Pcategory')->dropDownList([ 'Economy' => 'Economy', 'First class' => 'First class', ], ['prompt' => 'Category']) ?>
</div>
<div class="col-lg-4">
    <?=$form->field($model1, 'MPESAReferenceNumber')->textInput(['maxlength'=>true])?>
</div>


<div class="col-lg-7">
    <?= Html::submitButton($model1->isNewRecord ? 'Book' : 'booktrain', ['class' => $model1->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
</div>

<?php ActiveForm::end(); ?>


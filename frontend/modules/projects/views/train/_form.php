<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use  frontend\modules\projects\models\Station;
use  frontend\modules\projects\models\Trainstatus;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\modules\projects\models\Train */
/* @var $form yii\widgets\ActiveForm */



?>

    <div class="Train-form">
        <?php $form = ActiveForm::begin(); ?>


        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'Train_ID')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-lg-4">

                <?= $form->field($model, 'Train_name')->textInput(['maxlength'=>true]) ?>


            </div>


            <div class="col-lg-4">

                <?= $form->field($model, 'Train_type')->textInput(['maxlength'=>true]) ?>


            </div>
            <div class="col-lg-4">

                <?= $form->field($model, 'Source_stn')->dropDownList(ArrayHelper::map(Station::find()->all(),'Station_name','Station_name'),['prompt'=>'Select...'] )?>


            </div>

            <div class="col-lg-4">

                <?= $form->field($model, 'Destination_stn')->dropDownList(ArrayHelper::map(Station::find()->all(),'Station_name','Station_name'),['prompt'=>'Select...'] )?>


            </div>



            <div class="col-lg-4">

                <?= $form->field($model, 'Economy_classfare')->textInput(['maxlength'=>true]) ?>


            </div>
            <div class="col-lg-4">

                <?= $form->field($model, 'First_classfare')->textInput(['maxlength'=>true]) ?>


            </div>


            <div class="col-lg-4">

                <?= $form->field($model1, 'Economy_seatnumber')->textInput(['maxlength'=>true]) ?>


            </div>
            <div class="col-lg-4">

                <?= $form->field($model1, 'First_seatnumber')->textInput(['maxlength'=>true]) ?>

        </div>
            <div class="col-sm-2">
                <?=  $form->field($model1, 'Available_days[]')->checkboxList(['Mon' => ' Mon', 'Tue' => 'Tue',
                    'Wed' => 'Wed','Thur'=>'Thur','Fri'=>'Fri','Sat'=>'Sat','Sun'=>'Sun'])?>
            </div>
            <div class="col-lg-3">
                <?php
                echo '<label>Arrival time</label>';
                echo TimePicker::widget([
                    'model'=>$model,
                    'name' => 'Arrival_time',
                    'attribute'=>'Arrival_time',
                    'options' =>['placeholder'=>'Select operating time...'],
                    'convertFormat'=>true,
                    'pluginOptions'=>[
                        'format'=>' hh:ii',
                        'startTime'=>' 12:00 AM',
                        'todayHighlight'=>true
                    ]

                ]);?>
            </div>
            <div class="col-lg-3">
                <?php
                echo '<label>Departure time</label>';
                echo TimePicker::widget([
                    'model'=>$model,
                    'name' => 'Departure_time',
                    'attribute'=>'Departure_time',
                    'options' =>['placeholder'=>'Select operating time...'],
                    'convertFormat'=>true,
                    'pluginOptions'=>[
                        'format'=>'hh:ii',
                        'startTme'=>'12:00 AM',
                        'todayHighlight'=>true
                    ]

                ]);?>
            </div>

        <div class="col-lg-12">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>






        <?php ActiveForm::end(); ?>



    </div>



<?php

$script = <<< JS

 $(document).ready(function(){
            $('#example1').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

        });
JS;
$this->registerJs($script);
?>
<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'mybookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div  style="background: #fff; padding: 10px;" class="issuesraised-index">


    <h4> My bookings</h4>


    <table id="example1" class="table table-bordered table-striped display" width="100%">
        <thead>

        <th>Ticket id</th>
        <th>user</th>
        <th>Gender</th>
        <th>Age</th>
        <th>Booked Date</th>
        <th>Category</th>


        <th>Action</th>

        </tr>
        </thead>

        <?php foreach ($model as $account){?>
            <tr>
                <td> <?=$account['Ticket_ID'] ?> </td>
                <td> <?=\Yii::$app->user->identity->username;?></td>
                <td> <?=$account['Pgender'] ?></td>
                <td> <?=$account['Age'] ?></td>
                <td> <?=$account['BookedDate'] ?></td>
                <td> <?=$account['Pcategory'] ?></td>
                <td>
                    <?= Html::a('cancel', ['cancelbooking', 'id' => $account['Ticket_ID']])?>
                </td>

            </tr>
        <?php }?>

    </table>

</div>
<?php

$script = <<< JS

 $(document).ready(function(){
            $('#example1').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                  
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
<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="widget-list">
	<?php
	//var_dump($permissions);
	?>
	<table id="example1" class="table table-striped dataTable">
	  <thead>
	    <tr><th>#</th><th>Name</th><th>Description</th><th>Action</th></tr>
	  </thead>
	  <tbody>
	    <?php $count=1; foreach($permissions as $permission)
     
                {?>
	      <tr>
		      <th><?= $count ?></th>
		      <th><?= $permission->name ?></th>
                      <th> <?= $permission->description ?></th>
		      <?php // Html::a($permission->description, ["#"], ['class'=>'edit-keyword',"data-name"=>"description", "data-title"=>"Edit Description", "data-url"=>Url::to(["/rbac/route/update-column","id"=>$permission->name,]) , "data-type"=>"text"]);  ?>
                      <th><?= Html::a('Edit', ['/setup/tblimits/update','id'=>$permission->name], ['class'=>'btn btn-primary btn-xs']) ?> 
                 </th>
	      </tr>
	    <?php $count++; } ?>
	  </tbody>
	</table>
</div>

 <?php
 
$script = <<< JS


  $(function () {

        
        
    $('#example1 tbody').on( 'click', 'button', function () {
       
        var data = table.row( $(this).parents('tr') ).data();
        id=data.DT_RowId;
        $('#remarksdiv').show();
      
        $('#hiddeninput').attr('value',id);
       
       
               } );
        
        $('#blockbutton').click(function(){
              var id=$('#hiddeninput').val();
               var remarks=$('#remarks').val().trim();
            $('#loader').show();
        $.get('index.php?r=/customercare/tbaccount/actualcloseaccount',{id:id,remarks:remarks},function(data){
               
          if(data==1){
         $('#loader').hide();
        $(".alert-info").show().delay(5000).queue(function(n) {
  $(this).hide(); n();
});
           }
        else{
         $('#loader').hide();
        $(".alert-danger").show().delay(5000).queue(function(n) {
  $(this).hide(); n();
});
       
   }
        
                      });
        
        })
        
      $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
        
   $('#min').on( ' change', function () {
        // getting column index
        var v =$(this).val();  
           var date = v.split('-');
         newDate = date[0] + '-' + date[1].toUpperCase()+ '-' + date[2].substr(2);

        table.columns(6).search(newDate).draw();
        
         
        }); 
        
        
      $('#max').change( function() {
         // getting column index
        var v =$(this).val(); 
        var newDate=$('#min').val();
           var date = v.split('-');
        var newDate1 = date[0] + '-' + date[1].toUpperCase()+ '-' + date[2].substr(2);
        if(newDate!=""){
          table.draw();
        }
        
        else{
         alert("please enter start date")
        return false;
   }
       
       
        }); 
 
        
        $('#closebutton').click(function(){
         $('#remarksdiv').hide();
        
        });
  });

JS;
$this->registerJs($script);
?> 
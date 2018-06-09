<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="widget-list">
	<?php
	//var_dump($permissions);
	?>
	<table id="dynamic_table" class="table table-striped dataTable">
            
             <div  id="loader" class="margin padding left loader" style='display:none; margin-left: 50px;'>
                
                <p style="color: red; float: left;">processing......</p>    
               
                 <?= Html::img('@web/712.gif', ['alt'=>'some', 'class'=>'thing']);?>
                                                </div>
            <div style="display: none" class="alert alert-success">
                <strong>Success!</strong> Role deleted successfully.
              </div>
            
            <div style="display: none"  class="alert alert-danger">
                <strong>Fail!</strong> Failed To deleted Role.
              </div>
	  <thead>
              <tr><th>#</th><th>Role Name</th><th>Role Description</th><th> Action <span class="pull-right"><?= Html::a("Create Role",[false],["class"=>"modal-add-button btn btn-success btn-xs","data-href"=>Url::to(["/rbac/route/create-role"])])?></span></th></tr>
	  </thead>
	  <tbody>
	    <?php $count=1; foreach($roles as $role){?>
              <tr id="<?= $role->name ?>">
		      <th><?= $count ?></th>
		      <th><?= Html::a($role->name, ["#"], ['class'=>'edit-keyword',"data-name"=>"name", "data-title"=>"Edit Name", "data-url"=>Url::to(["/rbac/route/update-column","id"=>$role->name,]) , "data-type"=>"text"]);  ?></th>
		      <th><?= $role->description;  ?></th>
                      <th>
                     
                      <?= Html::a("Edit Role",[false],["class"=>"modal-add-button btn btn-success btn-xs","data-href"=>Url::to(["/rbac/route/editrole",'name'=>$role->name])])?>
                       <button type="button" class="deleterole btn btn-info btn-xs" role="<?= $role->name?>" >Delete </button>
                      </th>
              </tr>
              
	    <?php $count++; } ?>
	  </tbody>
	</table>
</div>
<?php
$script = <<< JS
                    $('a.modal-add-button').click(function(e){
				    e.preventDefault();
			        $('#myModal2').modal('show')
			        .find('.modal-body')
			        .load($(this).attr('data-href'));  
					 $('#myModal2').on('hidden.bs.modal', function() {
                                             location.reload();
						  $(this).removeData();
					 });
		
	});
         $('.deleterole').click (function(e){
        
        var role=$(this).attr('role');
        
         if(confirm("Are you sure you want to delete this?")){
       $('#loader').show();
         $.get('../../rbac/route/deleterole',{role:role},function(data){
                if(data==1){
        $('#loader').hide();
        $('#'+role).remove();
        $('.alert-success').show().delay(5000).fadeOut();
       
                 }
        else{
          $('.alert-danger').show().delay(5000).fadeOut();
            
            
   }
			 });
    }
    else{
        return false;
    }
          
		
         });
JS;
$this->registerJs($script);
?>;

<?php 
use frontend\models\Users;
use common\models\User;
use yii\helpers\Html;
//Yii::$app->authManager->
?>
<div class="widget-list">
   <div class="row" style="margin:3% 3% 0% 3%;">
		<div class="col-md-3 col-xs-12">
		   <input type="text" class='form-control' id="liverolesearch"
				placeholder="Search Roles....">
		</div>
		<div class="col-md-2 col-xs-12">
			<input type="text" class='form-control' id="livesearch"
				placeholder="Search Users...">
		</div>
		<div class="col-md-1 col-xs-12">
			<button class="btn btn-xs btn-success" id="refresh">
				<i class="fa fa-refresh"></i> Refresh
			</button>
		</div>
       <div class="col-md-3 col-xs-12">
           
                            <div  id="loader" class="margin padding left loader" style='display:none; margin-left: 50px;'>
                
                <p style="color: red; float: left;">processing......</p>    
               
                 <?= Html::img('@web/712.gif', ['alt'=>'some', 'class'=>'thing']);?>
                                                </div>
       </div>
		<div class="col-md-3 col-xs-12">
			<input type="text" class='form-control' id="livesearch_to"
				placeholder="Search Users....">
		</div>
	</div>
	<div class="row" style="margin:0 3% 3% 3%;">
		<br />
		<div class="col-xs-3">
		<label>System Roles</label>
		  <select name="role" id="search_roles" class="form-control" size="8"	multiple="multiple">
              <?php $count=1; foreach($roles as $role){  ?>
				 <option value="<?= $role->name ?>"><?= $role->description ?></option>
			  <?php $count++; }  ?>
		  </select>
		</div>
		<div class="col-xs-3">
		    <label>Assigned Users</label>
			<select name="from[]" id="search" class="form-control" size="8" 	multiple="multiple">
				<?php foreach($assigned as $assign){  ?>
				 <option value="<?= $assign ?>"><?= User::findOne($assign)->username ?></option>
			    <?php }  ?>
			</select>
		</div>
		<div class="col-xs-3">
		    <label>Unassign All User(s) (>>)</label>
			<button type="button" id="search_rightAll"
				class="btn btn-block  btn-danger">
				<i class="fa fa-forward"></i>
			</button>
			<label>Unassign selected User(s) (>)</label>
			<button type="button" id="search_rightSelected"
				class="btn btn-block btn-danger">
				<i class="fa fa-chevron-right"></i>
			</button>
			<button type="button" id="search_leftSelected"
				class="btn btn-block  btn-success">
				<i class="fa fa-chevron-left"></i>
			</button>
			<label>Assign Selected User(s) (<)</label>
			<button type="button" id="search_leftAll" 
				class="btn btn-block  btn-success">
				<i class="fa fa-backward"></i>
			</button>
			<label>Assign All User(s) (<<)</label>
		</div>
		<div class="col-xs-3">
		    <label>Unassigned Users</label>
			<select name="to[]" id="search_to" class="form-control" size="8" multiple="multiple">
				<?php foreach($unassigned as $unassign){  ?>
				 <option value="<?= $unassign ?>"><?= User::findOne($unassign)->username ?></option>
			    <?php }  ?>
			</select>
		</div>
	</div>
</div>
<?php
$script = <<< JS
    /* This Removes all users from the 
	 * selected role
	 */	
	$('#search_rightAll').click(function(){
		  var selectedUsers=[];
		
		  $('#search option').each(function(){
	        selectedUsers.push($(this).val());
	      });
		$('#loader').show();
		  var selectedRoles = $('#search_roles :selected').val();
		  $.ajax({ url: '../../rbac/route/assign-unassign',
				 type: 'post',
				 data: {flag:'delete',role:selectedRoles,value:selectedUsers},
		         success:function(){
		              refresh(selectedRoles)
        $('#loader').hide();
				 }
		 });
	});
		
    /* This adds all users from the 
	 * selected role
	 */	
	$('#search_leftAll').click(function(){
		  var selectedUsers=[];
		
		  $('#search_to option').each(function(){
	        selectedUsers.push($(this).val());
	      });
		$('#loader').show();
		  var selectedRoles = $('#search_roles :selected').val();
		  $.ajax({ url: '../../rbac/route/assign-unassign',
				 type: 'post',
				 data: {flag:'add',role:selectedRoles,value:selectedUsers},
		         success:function(){
		               refresh(selectedRoles)
        $('#loader').hide();
				 }
		 });
	});	
		
	
    /* This removes a selected user from 
	 * a given role
	 */
	$('#search_rightSelected').click(function(){
		 var selectedUsers=[];
		
		  $('#search option:selected').each(function(){
	        selectedUsers.push($(this).val());
	      });
		$('#loader').show();
		  var selectedRoles = $('#search_roles :selected').val();
		  $.ajax({ url: '../../rbac/route/assign-unassign',
				 type: 'post',
				 data: {flag:'delete',role:selectedRoles,value:selectedUsers},
		         success:function(){
		               refresh(selectedRoles)
        $('#loader').hide();
				 }
		 });
	});
		
    /* This adds a selected user from 
	 * to a given role
	 */
	$('#search_leftSelected').click(function(){
		  var selectedUsers=[];
		
		  $('#search_to option:selected').each(function(){
	        selectedUsers.push($(this).val());
	      });
         $('#loader').show();
		  var selectedRoles = $('#search_roles :selected').val();
		  $.ajax({ url: '../../rbac/route/assign-unassign',
				 type: 'post',
				 data: {flag:'add',role:selectedRoles,value:selectedUsers},
		         success:function(){
		               refresh(selectedRoles)
        $('#loader').hide();
				 }
		 });
	});
   
    $('#refresh').click(function(e){
		e.preventDefault();
		var selectedRoles = $('#search_roles :selected').val();
		refresh(selectedRoles);
	});
		
	$('#search_roles').click(function(){
	     var role =  $.trim($(this).find('option:selected').val());
		 refresh(role)
	});
	
	function refresh(role='admin'){
        $('#loader').show();
		$.ajax({ url: '../../rbac/route/refresh-roleusers',
						 type: 'post',
						 data: {role:role},
				         success:function(data)
				         {
        $('#loader').hide();
						    if(data[0]!=null && data[1]==null){
				                 $('#search').html(data[0]);
								 $('#search_to').html("");
						    }
	                        if(data[0]==null && data[1]!=null){
		                        $('#search_to').html(data[1]);
							    $('#search').html("");
						    }else{
							    $('#search').html(data[0]);
		                        $('#search_to').html(data[1]);
							}				
			             }
		}); 
    }
$('#search_roles').filterByText($('#liverolesearch'),true);
$('#search').filterByText($('#livesearch'),true);
$('#search_to').filterByText($('#livesearch_to'),true);
JS;
$this->registerJs($script);
?>
<?php
use yii\helpers\Url;
use frontend\modules\rbac\assets\UsersAsset;
UsersAsset::register($this);
$action = Yii::$app->controller->action->id;
?>
<div class="row">
	<div class="col-md-12">
		<section class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="widget">
						<ul class="widget-tabs">



							<li class="widget-tab <?= ($action=='assignments')?'active':'' ?>"><a class="widget-tab-link"
								href="<?= Url::toRoute(['/rbac/route/assignments']) ?>">Roles Assignment</a></li>
							<li class="widget-tab <?= ($action=='manage-roles')?'active':'' ?>"><a class="widget-tab-link"
								href="<?= Url::toRoute(['/rbac/route/manage-roles']) ?>">Manage Roles</a></li>
							

						    
						</ul>
						<?php if($action=='permissions'){?>
						   <?= $this->render('permissions',['assigned'=>$assigned,'unassigned'=>$unassigned])?>
						<?php } ?>
						<?php if($action=='roles'){?>
						   <?= $this->render('roles',['roles'=>$roles,'assigned'=>$assigned,'unassigned'=>$unassigned]) ?>	
						<?php }?>
						<?php if($action=='assignments'){?>
						   <?= $this->render('assignments',['roles'=>$roles,'assigned'=>$assigned,'unassigned'=>$unassigned]) ?>	
						<?php }?>
						<?php if($action=='manage-roles'){?>
						   <?= $this->render('manage-roles',["roles"=>$roles]) ?>	
						<?php }?>
						<?php if($action=='describe-permissions'){?>
						   <?= $this->render('describe-permissions',["permissions"=>$permissions]) ?>	
						<?php }?>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<div aria-hidden="true"  data-keyboard="false" aria-labelledby="mymodallabel" role="dialog" tabindex="-1" id="myModal2" class="modal fade">
			           <div class="modal-dialog">
			                  <div class="modal-md">
                                    <div class="modal-content">
                                        <div class="modal-body">
<!--                                            <h3>Add Role</h3>
                                            <form id="form1" role="form">
                               <div class="form-group">
                                 <label for="email">Role</label>
                                 <input type="test" class="form-control" id="role" required="true" placeholder="enter role name">
                               </div>
                               <div class="form-group">
                                 <label for="pwd">Description</label>
                                 <input type="text" class="form-control" id="desc" required="true" placeholder="enter role description">
                               </div>

                               <button type="submit" class="btn btn-default">Submit</button>
                             </form>-->
										</div>
						           </div>
					          </div>
					      </div>
			    </div>
<?php 
$this->registerJsFile('@web/bktadmin/js/bootstrap-growl/jquery.bootstrap-growl.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$script = <<< JS
	$('.edit-keyword,.edit-cast').editable({
	      display:true,
		  send:"always",
		  title: $(this).attr("data-title"),
	      placement:"top",
		  success: function(response, newValue){
			callbacksuccess(response,false)
		 }
	});
  $('a.modal-add-button').click(function(e){
				    e.preventDefault();
			        $('#myModal2').modal('show')
			        .find('.modal-body')
			        .load($(this).attr('data-href'));  
					 $('#myModal2').on('hidden.bs.modal', function() {
                                                
        
						  $(this).removeData();
					 });
		
	});
JS;
$this->registerJs($script);
?>
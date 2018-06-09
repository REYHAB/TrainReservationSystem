<?php

use yii\helpers\Html;
?>


<div class="widget-list">
						   <div  class="row" style="margin-top:3%;">
						    <div class="col-xs-1"></div>
						    <div class="col-xs-3"><input type="text" class='form-control' id="livesearch" placeholder ="Search...."></div><div class="col-xs-1"><button class="btn btn-xs btn-success" id="refresh"><i class="fa fa-refresh"></i> Refresh</button></div>
						    <div class="col-xs-2"></div>
						    <div class="col-xs-3"><input type="text" class='form-control' id="livesearch_to" placeholder ="Search...."></div>
                                                    <div class="col-xs-1">
                                                        
                                                         <div  id="loader" class="margin padding left loader" style='display:none; margin-left: 50px;'>
                
                <p style="color: red; float: left;">processing......</p>    
               
                 <?= Html::img('@web/712.gif', ['alt'=>'some', 'class'=>'thing']);?>
                                                </div>
                                                    </div>
						   </div>
							<div  class="row" style="margin-bottom:3%;">
							<br/>
							   <div class="col-xs-1"></div>
								<div class="col-xs-3">
								<label>Unassigned Permissions(s)</label>
									<select name="from[]" id="search" class="form-control" size="8"	multiple="multiple">
										<?php $count=1; foreach($unassigned as $route){  ?>
										 <option value="<?= $count ?>"><?= $route ?></option>
										<?php $count++; }  ?>
									</select>
								</div>

								<div class="col-xs-3">
								  <label>Assign All Permissions(s) (>>)</label>
									<button type="button" id="search_rightAll"
										class="btn btn-block btn-success">
										<i class="fa fa-forward"></i>
									</button>
									<label>Assign selected Permissions(s) (>)</label>
									<button type="button" id="search_rightSelected"
										class="btn btn-block btn-success">
										<i class="fa fa-chevron-right"></i>
									</button>
									<button type="button" id="search_leftSelected"
										class="btn btn-block btn-danger">
										<i class="fa fa-chevron-left"></i>
									</button>
									<label>Unassign Selected Permissions(s) (<)</label>
									<button type="button" id="search_leftAll" 
										class="btn btn-block btn-danger">
										<i class="fa fa-backward"></i>
									</button>
									<label>Unassign All Permissions(s) (<<)</label>
								</div>

								<div class="col-xs-3">
								<label>Assigned Permissions(s)</label>
									<select name="to[]" id="search_to" class="form-control"	size="8" multiple="multiple">
										<?php $count1=1; foreach($assigned as $route){  ?>
										 <option value="<?= $count1 ?>"><?= $route ?></option>
										<?php $count1++; }  ?>
									</select>
								</div>
								<div class="col-xs-1"></div>
							</div>
					</div>
<?php 
$script = <<< JS
	/* This transfers all routes from the 
	 * left list box to the right and saves the to db
	*/
	$('#search_leftSelected').click(function(){
		  var selectedValues = []; 
		  $('#search_to :selected').each(function(){
	        selectedValues.push($(this).val());
	      });
           $('#loader').show();
		  $.ajax({ url:  '../rbac/route/save-delete',
				 type: 'post',
				 data: {flag:'delete',value:selectedValues},
		         success:function(){
		               refresh();
                    $('#loader').hide();
				 }
		 });
	});
		
	/* This transfers the selected routes from the 
	 * right list box to the left and deletes the to db
	*/
	$('#search_rightSelected').click(function(){
	    var selectedValues = []; 
	    $('#search :selected').each(function(){
         selectedValues.push($(this).text());
        });
         $('#loader').show();
		 $.ajax({ url:'../rbac/route/save-delete',
				 type: 'post',
				 data: {flag:'add',value:selectedValues},
		         success:function(){
		               refresh();
        $('#loader').hide();
				 }
		});
	});
		
	/* This transfers all routes from the 
	 * left list box to the right and saves the to db
	*/
	$('#search_leftAll').click(function(){
		  var selectedValues = []; 
		  $('#search_to option').each(function(){
	        selectedValues.push($(this).val());
	      });
         $('#loader').show();
		  $.ajax({ url: '../rbac/route/save-delete',
				 type: 'post',
				 data: {flag:'delete',value:selectedValues},
		         success:function(){
		               refresh();
        $('#loader').hide();
				 }
		 });
	});	
		
	/* This transfers all routes from the 
	 * right list box to the left and saves the to db
	*/	
	$('#search_rightAll').click(function(){
		  var selectedValues = []; 
		  $('#search option').each(function(){
	         selectedValues.push($(this).text());
	      });
		  console.log(selectedValues)
        $('#loader').show();
		  $.ajax({ url: '../rbac/route/save-delete',
				 type: 'post',
				 data: {flag:'add',value:selectedValues},
		         success:function(){
		               refresh();
        $('#loader').hide();
				 }
		});
	});
		
	/* This transfers all routes from the 
	 * right list box to the left and saves the to db
	*/	
	$('#search option').on('dblclick',function(){
	   var val =$(this).text()
        $('#loader').show();
	   $.ajax({ url: '../rbac/route/save-delete',
				 type: 'post',
				 data: {flag:'add',value:val},
		         success:function(){
		               refresh();
        $('#loader').hide();
				 }
		}); 
    });
	$('#search_to option').on('dblclick',function(){
	   var val =$(this).text()
        $('#loader').show();
	   $.ajax({ url: '../rbac/route/save-delete',
				 type: 'post',
				 data: {flag:'delete',value:val},
		         success:function(){
		               refresh();
        $('#loader').hide();
				 }
		}); 
    });
		
	$('#refresh').click(function(e){
		e.preventDefault();
		refresh();
	});
	function refresh(){	
                       $('#loader').show();
			$.ajax({ url: '../rbac/route/refresh',
							 type: 'post',
							 data: {post:'post'},
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
	$('#search').filterByText($('#livesearch'),true);
    $('#search_to').filterByText($('#livesearch_to'),true);
JS;
$this->registerJs($script);
?>

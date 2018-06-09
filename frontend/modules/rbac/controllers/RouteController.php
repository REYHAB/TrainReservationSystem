<?php

namespace frontend\modules\rbac\controllers;

use Yii;
use frontend\modules\rbac\models\Route;
use yii\web\Response;
use frontend\models\AuthItem;
use yii\helpers\ArrayHelper;
use frontend\modules\rbac\models\Common;
use frontend\modules\rbac\models\Users;
use common\models\User;
use yii\widgets\ActiveForm;

/**
 * Description of RuleController
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class RouteController extends \yii\web\Controller
{
	//Sets the default Action in this controller
	
	public $defaultAction = 'permissions';
	
	public function actionRefreshSession(){
		$post = Yii::$app->request->post();
		if(Yii::$app->request->isAjax && $post['companyid']){
			$session = Yii::$app->session;
			$session->set('idcompany',$post['companyid']);
		}
	}
	
	/**
	 * Used in Ajax Validation.
	 */
	public function actionValidate() {
		$model = new \frontend\modules\rbac\models\Authitem();
		if (Yii::$app->request->isAjax && $model->load (Yii::$app->request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate ($model);
		}
	}
	public function beforeAction($action) {
		
		$this->enableCsrfValidation = false;
		return parent::beforeAction ( $action );
	}
    /**
     * Shows list of permissions that need to be assigned.
     * @return mixed
     */
    public function actionPermissions()
    {  
      $auth = Yii::$app->authManager;
      $app = Yii::$app;
      $assigned =ArrayHelper::getColumn(ArrayHelper::toArray($auth->getPermissions()),'name');
      $assigned =array_keys($assigned);
      //$unassigned = null;
      $unassigned = [];//array_diff($app->mycomponent->getAppModules($app),$assigned);
      
      return $this->render('tabs',['assigned'=>$assigned,'unassigned'=>$unassigned]);
    }
    
    /**
     * Returns a list of either assigned and unassigned routes.
     * @return mixed
     */
    public function actionRefresh()
    {
    	$auth = Yii::$app->authManager;
    	$app = Yii::$app;
    	$data = [];
    	\Yii::$app->response->format = Response::FORMAT_JSON;
    	if(Yii::$app->request->post()){
    		
	    	$assigned = ArrayHelper::getColumn(ArrayHelper::toArray($auth->getPermissions()),'name');
	    	$assigned = array_keys($assigned);
	    	$unassigned = array_diff($app->mycomponent->getAppModules($app),$assigned);
	    	$data[0][] =null;
	    	if(!empty($unassigned)){
	            foreach($unassigned as $unassign){
	            	$result = "<option>".$unassign."</option>";
	            	$data[0][] = $result;
	            }
    		}
    		$data[1][]=null;
    		if(!empty($assigned)){
	            foreach($assigned as $assign){
	            	$result = "<option>".$assign."</option>";
	            	$data[1][] = $result;
	            }
    		}	
    	}
    	return $data;
    }
    
    /**
     * Returns a list of assigned and unassigned routes.
     * for a given role
     * @return mixed
     */
    public function actionRefreshRoleroutes()
    {
    	
    	$app = Yii::$app;
    	$auth = $app->authManager;
    	$session = $app->session;
    	$data = [];
    	\Yii::$app->response->format = Response::FORMAT_JSON;
    	if(Yii::$app->request->post()){
            $role = trim($_POST['role']);
            $permissions = array_keys(ArrayHelper::getColumn(ArrayHelper::toArray($auth->getPermissions()),'name'));
    		$assigned = array_keys(ArrayHelper::getColumn(ArrayHelper::toArray($auth->getPermissionsByRole($role)),'name'));
    		
    		$unassigned = array_diff($permissions,$assigned);
    		$data[0][] =null;
    		if(!empty($assigned)){
    			foreach($assigned as $assign){
    				if($auth->getPermission($assign) && $auth->getPermission($assign)->description != null){ 
	    				$result = "<option value='".$assign."'>". $auth->getPermission($assign)->description."</option>";
	    				$data[0][] = $result;
    				}
    				
    			}
    		}
    		$data[1][]=null;
    		if(!empty($unassigned)){
    			foreach($unassigned as $unassign){
    			  if($auth->getPermission($unassign) && $auth->getPermission($unassign)->description != null){ 
	    				$result = "<option value='".$unassign."'>". $auth->getPermission($unassign)->description."</option>";
	    				$data[1][] = $result;
    			  }
    			}
    		}
    	}
    	return $data;
    }
    
    /**
     * Returns a list of assigned and unassigned users.
     * for a given role
     * @return mixed
     */
    public function actionRefreshRoleusers()
    {
    	 
    	$model = new Common();
    	$app = Yii::$app;
    	$auth = $app->authManager;
    	$session = $app->session;
    	$data = [];
    	\Yii::$app->response->format = Response::FORMAT_JSON;
    	if(Yii::$app->request->post()){
    		 $role = trim($_POST['role']);
    		 $assigned = ArrayHelper::getColumn($model->getRoleUsers($role),'user_id');
    	     $users = User::find()
    				   ->select('id')
    				   ->all();
    	    $allusers = ArrayHelper::getColumn(ArrayHelper::toArray($users),'id');
    	    $unassigned = array_diff($allusers,$assigned);
    		$data[0][] = null;
    		if(!empty($assigned)){
    			foreach($assigned as $assign){
    				$result = "<option value=".$assign.">".User::findOne($assign)->username."</option>";
    				$data[0][] = $result;
    			}
    		}
    		$data[1][]= null;
    		if(!empty($unassigned)){
    			foreach($unassigned as $unassign){
    				$result = "<option value=".$unassign.">".User::findOne($unassign)->username."</option>";
    				$data[1][] = $result;
    			}
    		}
    	}
    	return $data;
    }
    /**
     * Returns a list of assigned and unassigned routes.
     * for a given default role in this case admin role.
     * It is the default page once you click the roles tab
     * @return mixed
     */  
    public function actionRoles()
    {        
    	$app = Yii::$app;
    	$auth = $app->authManager;
    	$session = $app->session;
    	$roles = $auth->getRoles();
        $assigned = ArrayHelper::getColumn(ArrayHelper::toArray($auth->getPermissionsByRole('admin')),'name');
        $assigned = array_keys($assigned);
        $unassigned = array_diff($app->mycomponent->getAppModules($app),$assigned);
      
      return $this->render('tabs',['roles'=>$roles,'assigned'=>$assigned,'unassigned'=>$unassigned]);
    }
    
    /**
     * Returns a list of assigned and unassigned users.
     * for a given default role in this case admin role.
     * It is the default page once you click the assignments tab
     * @return mixed
     */
    public function actionAssignments(){
    	$model = new Common();
    	$app = Yii::$app;
    	$auth = $app->authManager;
    	$session = $app->session;
    	$assigned = ArrayHelper::getColumn($model->getRoleUsers('admin'),'user_id');
    	$users = User::find()
    				   ->select('id')
    				   ->all();
    	$allusers = ArrayHelper::getColumn(ArrayHelper::toArray($users),'id');
    	$unassigned = array_diff($allusers,$assigned);
    	$roles = $auth->getRoles();
    	return $this->render('tabs',['roles'=>$roles,'assigned'=>$assigned,'unassigned'=>$unassigned,'allusers'=>$allusers]);
    }
    
    /**
     * Saves and Deletes request based on the route and parameter passed.
     * @return mixed
     */
    
    public function actionSaveDelete()
    {
    	$auth = Yii::$app->authManager;
    	$post = Yii::$app->request->post();
    	\Yii::$app->response->format = Response::FORMAT_JSON;
    	  $permission=null;
    	  if(!empty($post['value'])){
    		if($post['flag']=='add'){
    		  if(is_array($post['value'])){
		    	 foreach($post['value'] as $key){
			    	if($auth->getPermission($key)==null){
			    		$permission = $auth->createPermission($key);
			    		$auth->add($permission);
			    	} else {
			    		$permission = $auth->getPermission($key);
			    	}
			     }
			     return 'success';
    		   } else {
    		   	    $key = $post['value'];
	    		  	if($auth->getPermission($key)==null){
	    		  		$permission = $auth->createPermission($key);
	    		  		$auth->add($permission);
	    		  	} else {
	    		  		$permission = $auth->getPermission($key);
	    		  	}
    		    }
	    	} else if($post['flag']=='delete') {
		    	   if(is_array($post['value'])){
			    	  foreach($post['value'] as $key){ 
			    			//$key = trim($key,'/');
				    	    if(($permission= $auth->getPermission($key))!==null){
				    	   		$auth->remove($permission);
				    	   	}
			    	  }
			    	 return 'success';
		    	   } else{
		    	   	    //$key = trim($post['value'],'/');
		    	   	    $key = $post['value'];
			    	   	if(($permission= $auth->getPermission($key))!==null){
			    	   		$auth->remove($permission);
			    	   	}
			    	 return 'success';
		    	   }
	       }
    	}
    	return 'Try Again!!';
    }
    //delete role[
    
    public function actionDeleterole(){
        
        $role= Yii::$app->request->get('role');
        $model= new \frontend\modules\rbac\models\Authitem();
        $model= $model->find()->where(['name'=>$role])->one();
        if($model->delete()){
            echo 1;
        }
 else {
     
     echo 0;
 }
    }
    public function actionAllowDeny(){
    	$auth = Yii::$app->authManager;
    	$post = Yii::$app->request->post();
    	$session = Yii::$app->session;
    	\Yii::$app->response->format = Response::FORMAT_JSON;
        if(!empty($post['value']) && !empty($post['role'])){
    		if($post['flag']=='add'){
    		  if(is_array($post['value'])){
		    	 foreach($post['value'] as $key){
		    	 	$key = trim($key);
		    	 	$role  = trim($post['role']);
			    	if($auth->getPermission($key)!==null && $auth->getRole($role)!==null){
			    		$permission = $auth->getPermission($key);
			    		$role = $auth->getRole($role);
			    		$auth->addChild($role,$permission);
			    	}
			     }
			     return 'success';
    		   } else {
    		   	    $key = trim($post['value']);
    		   	    $role  = trim($post['role']);
	    		  	if($auth->getPermission($key)==null && $auth->getRole($role)!==null){
	    		  		$permission = $auth->getPermission($key);
			    		$role = $auth->getRole($role);
			    		$auth->addChild($role, $permission);
	    		  	}
    		    }
	    	} else if($post['flag']=='delete') {
		    	   if(is_array($post['value'])){
		    	   	foreach($post['value'] as $key){
		    	      $key = trim($key);
		    	 	  $role  = trim($post['role']);
				    	if($auth->getPermission($key)!==null && $auth->getRole($role)!==null){
				    		$permission = $auth->getPermission($key);
				    		$role = $auth->getRole($role);
				    		$auth->removeChild($role,$permission);
				    	}
		    	   	 }
			    	 return 'success';
		    	   } else{
		    	   	    $key = trim($post['value']);
		    	   	    $role  = trim($post['role']);
			    	   	if(($permission= $auth->getPermission($key))!==null && $auth->getRole($role)!==null){
			    	   		$permission = $auth->getPermission($key);
				    		$role = $auth->getRole($role);
				    		$auth->removeChild($role,$permission);
			    	   	}
			    	 return 'success';
		    	   }
	       }
    	}
    	return 'Try Again!!';
    }
    
    public function actionAssignUnassign(){
    	$auth = Yii::$app->authManager;
    	$post = Yii::$app->request->post();
    	$session = Yii::$app->session;
    	\Yii::$app->response->format = Response::FORMAT_JSON;
    	if(!empty($post['value']) && !empty($post['role'])){
    		if($post['flag']=='add'){
    			if(is_array($post['value'])){
    				foreach($post['value'] as $value){
    					$value = trim($value);
    					$role  = trim($post['role']);
    					if($auth->getRole($role)!==null){
    						$role = $auth->getRole($role);
    						$auth->assign($role,$value);
    					}
    				}
    				return 'success';
    			} else {
    				$value = trim($post['value']);
    				$role  = trim($post['role']);
    				if($auth->getRole($role)!==null){
    					$role = $auth->getRole($role);
    					$auth->addChild($role, $value);
    				}
    			}
    		} else if($post['flag']=='delete') {
    			if(is_array($post['value'])){
    				foreach($post['value'] as $value){
    					$value = trim($value);
    					$role  = trim($post['role']);
    					if($auth->getRole($role)!==null){
    						$role = $auth->getRole($role);
    						$auth->revoke($role,$value);
    					}
    				}
    				return 'success';
    			} else{
    				$value = trim($post['value']);
    				$role  = trim($post['role']);
    				if($auth->getRole($role)!==null){
    					$role = $auth->getRole($role);
    					$auth->revoke($role,$value);
    				}
    				return 'success';
    			}
    		}
    	}
    	return 'Try Again!!';
    }
    
    
    
   /**
     * Finds all users by assignment role
     *
     * @param  \yii\rbac\Role $role
     * @return static|null
     */
    public function getRoleUsers($role,$cmpid)
    {
    	$connection = \Yii::$app->db;
    	$connection->open();
    	$sql="SELECT user_id FROM auth_assignment"; 
    	$sql.=" WHERE auth_assignment.item_name = '".$role->name."'";
    	$command = $connection->createCommand($sql);
    	$users = $command->queryAll();
    	$connection->close();
    	return $users;
    }
    /**
     * 
     * Finds all permissions for the application save in the db 
     * 
     * @return array
     */
    public function actionDescribePermissions(){
    	$auth = Yii::$app->authManager;
    	$permissions = $auth->getPermissions();
    	return $this->render('tabs',["permissions"=>$permissions]);
    }
    
/**
     * This function updates an object cast.
     *
     * @param integer $pk,$value
     * @return mixed
     */
    public function actionUpdateColumn($id=null) {
    	$value = Yii::$app->request->post ( 'value' );
    	$column = Yii::$app->request->post ( 'name' );
    	Yii::$app->response->format = Response::FORMAT_JSON;
    	if (($model = $this->findModel ( $id )) !== null) {
    				$model->attributes = [$column=>$value];
    				if($model->save(false)){
    				   return 'saved';
    				} else {
    				   return 'unsaved';
    				}
    	}
    	return 'error';
    }
    
    /**
     * Finds the Authitem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Authitem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
    	if (($model = \common\modules\users\models\Authitem::findOne(["name"=>$id])) !== null) {
    		return $model;
    	} else {
    		return null;
    	}
    }
    
    public function actionManageRoles(){
    	$auth = Yii::$app->authManager;
    	$roles = $auth->getRoles();
    	return $this->render('tabs',["roles"=>$roles]);
    }
    
    public function actionCreateRole(){
        
        //$role=Yii::$app->request->get('role');
        //$desc=Yii::$app->request->get('desc');
    	$model = new \frontend\modules\rbac\models\Authitem();
    	
    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		if($model->save(false)){
    			return 'saved';
    		} else {
    			return 'unsaved';
    		}
    	} else {
    		return $this->renderAjax('create-role', [
    				'model' => $model,
    		]);
    	}
    }
    
    //edit role
    
        public function actionEditrole($name){
        
        //$role=Yii::$app->request->get('role');
        //$desc=Yii::$app->request->get('desc');
    	$model = new \frontend\modules\rbac\models\Authitem();
        $model= $model->find()->where(['name'=>$name])->one();
    	
    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		if($model->save(false)){
    			return 'saved';
    		} else {
    			return 'unsaved';
    		}
    	} else {
    		return $this->renderAjax('edit-role', [
    				'model' => $model,
    		]);
    	}
    }
    
}

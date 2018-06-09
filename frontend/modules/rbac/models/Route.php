<?php
namespace frontend\models;

use Yii;
/**
 * Route
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Route extends \yii\base\Model
{
    /**
     * @var string Route value. 
     */
    public $route;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return[
            [['route'],'safe'],
        ];
    }
    
    public function ifChildExists($role,$permission){
    	$auth = Yii::$app->authManager;
    	$role = $auth->getRole($role);
    	$permission = $auth->getPermission($permission);
    	if($role!==null && $permission!==null && $auth->hasChild($role,$permission)){
    		return true;
    	} else {
    		return false;
    	}
    }
}

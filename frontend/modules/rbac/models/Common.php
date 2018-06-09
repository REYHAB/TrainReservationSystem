<?php
namespace frontend\modules\rbac\models;
use Yii;
use yii\db\Query;

class Common{	
	/**
	 * gets file Associated with a certain user task.
	 *
	 * @param string utsid(User Task id)
	 * @return mixed
	 * @author Mwaura Simon
	 */
	public function getTaskFiles($utsid){
		$usertaskdocs = TaskDocuments::find()
		->where(['uts_id'=>$utsid])
		->all();
		return $usertaskdocs;
	}
	
	/**
	* Converts bytes into human readable file size.
	*
	* @param string $bytes
	* @return string human readable file size (2,87 Мб)
	* @author Mogilev Arseny
	*/ 
	public function FileSizeConvert($bytes)
	{
		$result=0;
		$bytes = floatval($bytes);
		$arBytes = array(
				0 => array(
						"UNIT" => "TB",
						"VALUE" => pow(1024, 4)
				),
				1 => array(
						"UNIT" => "GB",
						"VALUE" => pow(1024, 3)
				),
				2 => array(
						"UNIT" => "MB",
						"VALUE" => pow(1024, 2)
				),
				3 => array(
						"UNIT" => "KB",
						"VALUE" => 1024
				),
				4 => array(
						"UNIT" => "B",
						"VALUE" => 1
				),
		);
	
		foreach($arBytes as $arItem)
		{
			if($bytes >= $arItem["VALUE"])
			{
				$result = $bytes / $arItem["VALUE"];
				$result = str_replace(".", "." , strval(round($result, 2)))." ".$arItem["UNIT"];
				break;
			}
		}
		return $result;
	}
	
	/**
	 * Finds all users by assignment role
	 *
	 * @param  \yii\rbac\Role $role
	 * @return static|null
	 */
	public function getRoleUsers($role)
	{
		$connection = \Yii::$app->db;
		$query = (new Query)->select('user_id')
		->from('auth_assignment')
		->where(['item_name' =>$role]);
		$users = $query->all();
		return $users;
	}
	
}

<?php
namespace frontend\modules\rbac\components;

use Yii;
use yii\base\Component;
use yii\helpers\Inflector;
/**
 * Description of Routes Component
 *
 * @author Simon Mwaura <mwauraj09@gmail.com>
 * 
 */
class Routes extends Component{
	
	/* List all the modules and  submodules within an 
	 * application.
	 * $return 2d array  
	 */
	
	public function getAppModules($modules){
		//Declare the routes paths' array 
		$paths=[];
		//Get all the registered modules
		foreach($modules->getModules() as $id => $childmodule){
			//Get module names 
			$module = (string)$id;
			$newroutes = [];
			//Get the controllers namespace for each module 
			if(!empty($modules->getModule($module)->controllerNamespace)){
			    $namespace = $modules->getModule($module)->controllerNamespace;
			    //Get all Application routes from each module 
			    $newroutes = ($this->getAppRoutes($module,$namespace)==null)?null:$this->getAppRoutes($module,$namespace);
			    //Add the new routes to the routes paths' array
			    is_null($paths)?array_push($paths,$newroutes):$paths = array_merge($paths,$newroutes);
			    $newroutes = null;
			} 
		}
		return $paths;
	}
	
	/* List all the routes based on the Module and the controller Namespace passed
	 * 
	 * application.
	 * 
	 * $return 2d array
	 */
    public function getAppRoutes($module='planning',$namespace="frontend\modules\planning\controllers")
    {
    	/*converts a controller namespace into a full path 
    	 * e.g. frontend\modules\planning\controllers 
    	 * to  /home/apps/frontend/modules/planning/controllers
    	 */ 
    	$path = @Yii::getAlias('@' . str_replace('\\', '/', $namespace));
    	
    	//intialise a controllers array to populate Controllers files Names. 
    	$controllerlist = [];
    	
    	//Check whether the path is a directory
        if(is_dir($path)){
        	/*open the directory using the path and loop through 
        	 * and get all the filenames with the suffix Controller.php
        	 * and populate them in the controllerlist array 
        	 */
	    	if (($handle = opendir($path))) {
	    		while (false !== ($file = readdir($handle))) {
	    			if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
	    				$controllerlist[] = $file;
	    			}
	    		}
	    		closedir($handle);
	    	}
	    	//Sort out the filenames
	    	asort($controllerlist);
        }
        //Declare the paths array
    	$fulllist = [];
    	if(!empty($controllerlist)){
    		//if controllerlist is not empty loop through the  array
	    	foreach ($controllerlist as $controller):
	    	 // Get the controller prefix 
	    	 $controllerprefix = str_replace('Controller.php', '', $controller);
	    	 $handle = fopen($path.'/'.$controller, "r");
	    	 if($handle){
	    	 	/* Loop through the controllers get all the functions 
	    	 	 * whose prefix is function action.
	    	 	 */ 
	    		while (($line = fgets($handle)) !== false) {
	    			if (preg_match('/function action(.*?)\(/', $line, $display)):
	    			if (strlen($display[1]) > 2):
	    			   /*inflect the action name
	    			    * e.g. PostTag
	    			    * to post-tag
	    			    */ 
	    			   $action =  Inflector::camel2id($display[1]);
	    			   //Write the full path and add it to the routes array
	    			   $fulllist[] = strtolower($module.'/'.$controllerprefix.'/'.$action);
	    			endif;
	    			endif;
	    		}
	    	}
	    	fclose($handle);
	    	endforeach;
    	}
    	return $fulllist;
    }
}
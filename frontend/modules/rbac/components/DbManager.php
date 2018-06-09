<?php
namespace frontend\modules\rbac\components;

use Yii;
use yii\db\Connection;
use yii\db\Query;
use yii\di\Instance;
use yii\rbac\Item;
use yii\rbac\Permission;
use yii\rbac\Assignment;
use yii\rbac\Role;
use yii\rbac\Rule;

/**
 * DbManager represents an authorization manager that stores authorization information in database.
 *
 * The database connection is specified by [[$db]]. The database schema could be initialized by applying migration:
 *
 * ~~~
 * yii migrate --migrationPath=@yii/rbac/migrations/
 * ~~~
 *
 * If you don't want to use migration and need SQL instead, files for all databases are in migrations directory.
 *
 * You may change the names of the three tables used to store the authorization data by setting [[\yii\rbac\DbManager::$itemTable]],
 * [[\yii\rbac\DbManager::$itemChildTable]] and [[\yii\rbac\DbManager::$assignmentTable]].
 *
 * @author Simon Mwaura  <smjoshua09@gmail.com@gmail.com>
 * @since 1.0
 */
class DbManager extends \yii\rbac\DbManager
{
   


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db, Connection::className());
        if ($this->cache !== null) {
            $this->cache = Instance::ensure($this->cache, Cache::className());
        }
    }
    /**
     * @inheritdoc
     */
    public function getAssignment($roleName, $userId,$cmpid=1)
    {
    	if (empty($userId)) {
    		return null;
    	}
    
    	$row = (new Query)->from($this->assignmentTable)
    	->where(['user_id' => (string) $userId, 'item_name' => $roleName,'cmp_id'=>$cmpid])
    	->one($this->db);
    
    	if ($row === false) {
    		return null;
    	}
    
    	return new Assignment([
    			'userId' => $row['user_id'],
    			'roleName' => $row['item_name'],
    			'createdAt' => $row['created_at'],
    	]);
    }
    
    /**
     * @inheritdoc
     */
    public function getAssignments($userId,$cmpid=1)
    {
    	if (empty($userId)) {
    		return [];
    	}
    
    	$query = (new Query)
    	->from($this->assignmentTable)
    	->where(['user_id' => (string) $userId,'cmp_id'=>$cmpid]);
    
    	$assignments = [];
    	foreach ($query->all($this->db) as $row) {
    		$assignments[$row['item_name']] = new Assignment([
    				'userId' => $row['user_id'],
    				'roleName' => $row['item_name'],
    				'createdAt' => $row['created_at'],
    		]);
    	}
    
    	return $assignments;
    }
    
    public function addchild($parent,$child,$cmpid=1){
    	if ($parent->name === $child->name) {
    		throw new InvalidParamException("Cannot add '{$parent->name}' as a child of itself.");
    	}
    	
    	if ($parent instanceof Permission && $child instanceof Role) {
    		throw new InvalidParamException("Cannot add a role as a child of a permission.");
    	}
    	
    	if ($this->detectLoop($parent, $child)) {
    		throw new InvalidCallException("Cannot add '{$child->name}' as a child of '{$parent->name}'. A loop has been detected.");
    	}
    	
    	if (!is_int((int)$cmpid)) {
    		throw new InvalidCallException($cmpid."is not a valid company id.");
    	}
    	
    	$this->db->createCommand()
    	->insert($this->itemChildTable, ['cmp_id' => trim($cmpid),'parent' => $parent->name, 'child' => $child->name])
    	->execute();
    	$this->invalidateCache();
    	
    	return true;
    }
    
    
    /**
     * @inheritdoc
     */
    public function getPermissionsByRole($roleName,$cmpid=1)
    {
    	$childrenList = $this->getChildrenList($cmpid);
    	$result = [];
    	$this->getChildrenRecursive($roleName, $childrenList, $result);
    	if (empty($result)) {
    		return [];
    	}
    	$query = (new Query)->from($this->itemTable)->where([
    			'type' => Item::TYPE_PERMISSION,
    			'name' => array_keys($result),
    	]);
    	$permissions = [];
    	foreach ($query->all($this->db) as $row) {
    		$permissions[$row['name']] = $this->populateItem($row);
    	}
    	return $permissions;
    }
    
    /**
     * @inheritdoc
     */
    public function getPermissionsByUser($userId,$cmpid=1)
    {
    	if (empty($userId)) {
    		return [];
    	}
    
    	$query = (new Query)->select('item_name')
    	->from($this->assignmentTable)
    	->where(['user_id' => (string) $userId]);
    
    	$childrenList = $this->getChildrenList($cmpid);
    	$result = [];
    	foreach ($query->column($this->db) as $roleName) {
    		$this->getChildrenRecursive($roleName, $childrenList, $result);
    	}
    
    	if (empty($result)) {
    		return [];
    	}
    
    	$query = (new Query)->from($this->itemTable)->where([
    			'type' => Item::TYPE_PERMISSION,
    			'name' => array_keys($result),
    	]);
    	$permissions = [];
    	foreach ($query->all($this->db) as $row) {
    		$permissions[$row['name']] = $this->populateItem($row);
    	}
    	return $permissions;
    }
    
    /**
     * Returns the children for every parent.
     * @return array the children list. Each array key is a parent item name,
     * and the corresponding array value is a list of child item names.
     */
    protected function getChildrenList($cmpid=1)
    {
    	$query = (new Query)->from($this->itemChildTable)
    	->where(['cmp_id'=>$cmpid]);
    	$parents = [];
    	foreach ($query->all($this->db) as $row) {
    		$parents[$row['parent']][] = $row['child'];
    	}
    	return $parents;
    }
    
    /**
     * Recursively finds all children and grand children of the specified item.
     * @param string $name the name of the item whose children are to be looked for.
     * @param array $childrenList the child list built via [[getChildrenList()]]
     * @param array $result the children and grand children (in array keys)
     */
    protected function getChildrenRecursive($name, $childrenList, &$result)
    {
    	if (isset($childrenList[$name])) {
    		foreach ($childrenList[$name] as $child) {
    			$result[$child] = true;
    			$this->getChildrenRecursive($child, $childrenList, $result);
    		}
    	}
    }
    
    /**
     * @inheritdoc
     */
    public function assign($role, $userId,$cmpid=1)
    {
    	$assignment = new Assignment([
    			'userId' => $userId,
    			'roleName' => $role->name,
    			'createdAt' => time(),
    	]);
    
    	$this->db->createCommand()
    	->insert($this->assignmentTable, [
    			'cmp_id'=>$cmpid,
    			'user_id' => $assignment->userId,
    			'item_name' => $assignment->roleName,
    			'created_at' => $assignment->createdAt,
    	])->execute();
    
    	return $assignment;
    }
    
    
    /**
     * @inheritdoc
     */
    public function revoke($role,$userId,$cmpid=1)
    {
    	if (empty($userId)) {
    		return false;
    	}
    
    	return $this->db->createCommand()
    	->delete($this->assignmentTable, ['user_id' => (string) $userId, 'item_name' => $role->name,'cmp_id'=>$cmpid])
    	->execute() > 0;
    }
    
    /**
     * @inheritdoc
     */
    public function removeChild($parent,$child,$cmpid=1)
    {
    	$result = $this->db->createCommand()
    	->delete($this->itemChildTable, ['cmp_id' => trim($cmpid),'parent' => $parent->name, 'child' => $child->name])
    	->execute() > 0;
    
    	$this->invalidateCache();
    
    	return $result;
    }
    
    /**
     * @inheritdoc
     */
    public function loadFromCache($cmpid=0)
    {
    	
    	if ($this->items !== null || !$this->cache instanceof Cache) {
    		return;
    	}
    
    	$data = $this->cache->get($this->cacheKey);
    	if (is_array($data) && isset($data[0], $data[1], $data[2])) {
    		list ($this->items, $this->rules, $this->parents) = $data;
    		return;
    	}
    
    	$query = (new Query)->from($this->itemTable);
    	$this->items = [];
    	foreach ($query->all($this->db) as $row) {
    		$this->items[$row['name']] = $this->populateItem($row);
    	}
    
    	$query = (new Query)->from($this->ruleTable)
    	                    ->where(['cmp_id'=>$cmpid]);
    	$this->rules = [];
    	foreach ($query->all($this->db) as $row) {
    		$this->rules[$row['name']] = unserialize($row['data']);
    	}
    
    	$query = (new Query)->from($this->itemChildTable)
    						->where(['cmp_id'=>$cmpid]);
    	$this->parents = [];
    	foreach ($query->all($this->db) as $row) {
    		if (isset($this->items[$row['child']])) {
    			$this->parents[$row['child']][] = $row['parent'];
    		}
    	}
    
    	$this->cache->set($this->cacheKey, [$this->items, $this->rules, $this->parents]);
    }
    
    /**
     * @inheritdoc
     */
    public function checkAccess($userId, $permissionName, $params = [],$cmpid=0)
    {
    	$assignments = $this->getAssignments($userId,$cmpid);
    	$this->loadFromCache($cmpid);
    	if ($this->items !== null) {
    		return $this->checkAccessFromCache($userId, $permissionName, $params, $assignments);
    	} else {
    		return $this->checkAccessRecursive($userId,$permissionName, $params, $assignments,$cmpid);
    	}
    }
    /**
     * @inheritdoc
     */
    protected function checkAccessRecursive($user, $itemName, $params, $assignments,$cmpid=0)
    {
    	if (($item = $this->getItem($itemName)) === null) {
    		return false;
    	}
    
    	Yii::trace($item instanceof Role ? "Checking role: $itemName" : "Checking permission: $itemName", __METHOD__);
    
    	if (!$this->executeRule($user, $item, $params)) {
    		return false;
    	}
    
    	if (isset($assignments[$itemName]) || in_array($itemName, $this->defaultRoles)) {
    		return true;
    	}
    
    	$query = new Query;
    	$parents = $query->select(['parent'])
    	->from($this->itemChildTable)
    	->where(['child' => $itemName,'cmp_id'=>$cmpid])
    	->column($this->db);
    	foreach ($parents as $parent){
    		if ($this->checkAccessRecursive($user, $parent, $params, $assignments,$cmpid)) {
    			return true;
    		}
    	}
    	return false;
    }
    
}

<?
class Mapper_AbstractMapper
{

	public function __call ($method, $args)
	{
		$watch = array('findBy', 'findAllBy');
		foreach ($watch as $found) {
			if (stristr($method, $found)) {
				$fields = str_replace($found, '', $method);
				return $this->{'_' . $found}($fields, $args);
			}
		}
	}

	public function saveNew($obj)
	{
		$data = array();
		foreach (get_object_vars($obj) as $key => $val) {
			if($key[0] == '_') continue;
			$method = 'save' . ucfirst($key);
			if (!method_exists($this, $method) && is_null($val)) {
				$data[$key] = '';
			}
			elseif (method_exists($this, $method)) {
				$this->$method($obj, $data);
			}
			else {
				$data[$key] = $val;
			}
		}
			
		$table = Xscript_Registry::getDbtable($this->_familyClass);
		$id = $table->insert($data);
		$obj->id = $id;
	}


	protected function _findBy ($columns, $args)
	{
		$sql = $this->_buildQuery($columns, $args);
		$table = Xscript_Registry::getDbtable($this->_familyClass);
		$result = $table->fetchOne($sql);
		if(!$result) return false;
		$fabric = Xscript_Registry::getFabric($this->_familyClass);
		$domainObject = $fabric::getObject($result);
		return $domainObject;
	}

	protected function _findAllBy ($columns, $args)
	{
		$sql = $this->_buildQuery($columns, $args);
		$table = Xscript_Registry::getDbtable($this->_familyClass);
		$result = array();
		foreach ($table->fetchAll($sql) as $row) {
			$result[] = $row;
		}
		return $result;
	}
	protected function _buildQuery ($columns, $args)
	{
		$table = Xscript_Registry::getDbtable($this->_familyClass);
		$columns = $columns ? explode('And', $columns) : array();
		$fields = array();
		foreach ($columns as $i => $column) {
			$fields[] = $this->_underscore($column) . " = '" . $args[$i] . "'";
		}
		$sql = "select * from ".$table->getName()." where " . implode(" and ", $fields);
		return $sql;
	}

	protected function _underscore ($word)
	{
		$word = preg_replace('/([A-Z]+)([A-Z])/', '\1_\2', $word);
		return strtolower(preg_replace('/([a-z])([A-Z])/', '\1_\2', $word));
	}


}
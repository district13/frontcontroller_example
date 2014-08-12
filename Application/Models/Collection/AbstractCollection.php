<?
class Collection_AbstractCollection implements Iterator 
{
	protected $total = 0;

	protected $pointer = 0;
	protected $objects = array();

	protected $_findValue = 0;
	protected $_findField = 0;
	protected $run = false;

	protected $_familyClass = "";

	function __construct ($objects = null, $findField = '')
	{
		if($findField) {
			$this->_findValue = $objects;
			$this->_findField = $findField;
			return;
		}
		else if (is_array($objects)) {
			$this->objects = $objects;
			$this->total = count($objects);
			$this->run = true;
		}
	}

	protected function notifyAccess ()
	{
		if (!$this->run && $this->_findValue) {
			$mapper = Xscript_Registry::getMapper($this->_familyClass);
			$table = Xscript_Registry::getDbtable($this->_familyClass);
			$this->objects = $table->fetchAll("select * from " .$table->getName(). " where $this->_findField = $this->_findValue");
			$this->total = count($this->objects);
		}
		$this->run = true;
	}		
	
	function add ($obj)
	{
		$this->notifyAccess();
		$this->objects[$this->total] = $obj;
		$this->total++;
	}


	private function getRow ($num)
	{
		$this->notifyAccess();
		if ($num >= $this->total || $num < 0) {
			return null;
		}
		if (isset($this->objects[$num])) {
			$fabric = Xscript_Registry::getFabric($this->_familyClass);
			if(is_array($this->objects[$num]))
			{
				return $fabric::getObject($this->objects[$num]);
			}
			else {
				return $this->objects[$num];
			}
		}
	}

	public function current ()
	{
		return $this->getRow($this->pointer);
	}

	public function next ()
	{
		$this->pointer++;
		if ($row = $this->getRow($this->pointer))
		return $row;
	}

	public function key ()
	{
		return $this->pointer;
	}

	public function valid ()
	{
		return (!is_null($this->current()));
	}

	public function rewind ()
	{
		$this->pointer = 0;
	}


}

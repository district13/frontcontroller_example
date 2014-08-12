<?

class Map
{
	private $all = array();

	private $dirty = array();
	private $new = array();

	private static $instance;

	private function __construct ()
	{
	}

	static function instance ()
	{
		if (!isset(self::$instance)) {
			self::$instance = new Map();
		}
		return self::$instance;
	}

	public static function addDirty ($obj)
	{
		$inst = self::instance();
		if (!in_array($obj, $inst->new, true)) {
			//			echo get_class($obj)." --- dirty<br>";
			$inst->dirty[$inst->globalKey($obj)] = $obj;
		}
	}

	public static function addNew ($obj)
	{
		//		echo get_class($obj)." ---<b>new</b><br>";
		$inst = self::instance();
		$inst->new[] = $obj;
	}

	public static function addClean ($obj)
	{
		$self = self::instance();
		unset($self->dirty[$self->globalKey($obj)]);
		if (in_array($obj, $self->new, true)) {
			$pruned = array();
			foreach ($self->new as $newobj) {
				if (!($newobj === $obj)) {
					$pruned[] = $newobj;
				}
			}
			$self->new = $pruned;
		}
	}


	public function commit ()
	{
		if (!sizeof($this->dirty) && !sizeof($this->new)) return;

		foreach ($this->dirty as $key => $obj) {
			//вызов маппера для измененных объектов 
		}

		foreach ($this->new as $key => $obj) {
			$mapper = Xscript_Registry::getMapper(get_class($obj));
			$mapper->saveNew($obj);
			$this->addClean($obj);
		}

		$this->dirty = array();
		$this->new = array();
	}


	public function globalKey ($obj)
	{
		$key = get_class($obj) . "." . $obj->id;
		return $key;
	}

	static function add ($obj)
	{
		$inst = self::instance();
		$inst->all[$inst->globalKey($obj)] = $obj;
	}

	static function exists ($classname, $id)
	{
		$inst = self::instance();
		$key = "$classname.$id";
		if (isset($inst->all[$key])) {
			return $inst->all[$key];
		}
		return null;
	}

}


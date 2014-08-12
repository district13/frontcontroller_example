<?

class Xscript_Controller_ApplicationHelper {

	protected static $_instance = null;

	protected $_config = array();

	public static function instance() 
	{
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		 
		return self::$_instance;
	}

	public function init($config) 
	{
		$this->_config = $config;
		$this->_initAutoloader();
		$this->_initDb();
	}

	protected function _initAutoloader() 
	{
		require_once $this->_config['library_path'] . 'Xscript/Autoloader.php';
		$loader = new Xscript_Autoloader($this->_config);
	}

	protected function _initDb() 
	{
		$pgstr = "host=" .$this->_config['host']. 
				 " port=" .$this->_config['port']. 
				 " dbname=" .$this->_config['dbname']. 
				 " user=" .$this->_config['username'] .
				 " password=" .$this->_config['password'];
		$db = pg_connect($pgstr);
		Xscript_Registry::set("db", $db);
	}
}
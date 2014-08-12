<?
class Xscript_Controller_Front 
{
	protected $_applicationHelper;

	protected $_config = array();
	
	static function run($config_file) 
	{
		$instance = new Xscript_Controller_Front();
		$instance->_initConfigFile($config_file);
		$instance->init();
		$instance->process();
	}

	protected function _initConfigFile($config_file) 
	{
		$this->_config = parse_ini_file($config_file);
	}
	
	function init() 
	{
		
		require_once $this->_config['library_path'] . "Xscript/Controller/ApplicationHelper.php";
		$_applicationHelper = Xscript_Controller_ApplicationHelper::instance();
		$_applicationHelper->init($this->_config);
	}

	function process() 
	{
		$request = new Xscript_Controller_Request();
		$response = new Xscript_Controller_Response();
		$dispatcher = new Xscript_Controller_Dispatcher();
		$dispatcher->dispatch($request, $response);
		$response->sendResponse();
	}
}

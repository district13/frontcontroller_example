<?
class Xscript_Controller_Request 
{

	protected $_controller;
	protected $_action;

	protected $_params = array();
	public function __construct()
	{
		$parts = explode("/", $_SERVER['REQUEST_URI']);
		$this->_controller = (@$parts[1] ? $parts[1] : "index" );
		$this->_action = (@$parts[2] ? $parts[2] : "index" );
	}

	public function getControllerName()
	{
		return $this->_controller;
	}

	public function getActionName()
	{
		return $this->_action;
	}

	public function setControllerName($controllerName)
	{
		$this->_controller = $controllerName;
	}

	public function setActionName($actionName)
	{
		$this->_action = $actionName;
	}

	public function getParam($name)
	{
		if(isset($_REQUEST[$name]) && $_REQUEST[$name]) return $_REQUEST[$name];
		return false;
	}
	
	public function getCookie($name)
	{
		if(isset($_COOKIE[$name]) && $_COOKIE[$name]) return $_COOKIE[$name];
		return false;
	}

}
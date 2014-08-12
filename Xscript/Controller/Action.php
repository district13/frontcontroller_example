<?
class Xscript_Controller_Action 
{

	protected $view = null;
	protected $_request = null;
	protected $_response = null;

	function __construct($request, $response) 
	{
		$this->view = new Xscript_View();
		$this->_request = $request;
		$this->_response = $response;
	}

	protected function _preDispatch() {}
	protected function _postDispatch() {}

	public function dispatch($actionName)
	{
		$this->_preDispatch();
		$this->$actionName();
		$this->_postDispatch();
		$this->view->render($this->_request, $this->_response);
	}


}
<?
class Xscript_View 
{
	protected $content;

	protected $_defaultLayoutFile = 'layout.phtml';
	protected $_defaultExtTemplate = '.phtml';

	protected $_isRenderLayout = true;

	public function render($request, $response) 
	{
		$controller = $request->getControllerName();
		$action = $request->getActionName();
		ob_start();
		require_once $controller. '/' .$action. $this->_defaultExtTemplate;
		$this->content = ob_get_contents();
		ob_end_clean();
			
		if($this->_isRenderLayout) {
			ob_start();
			require_once $this->_defaultLayoutFile;
			$this->content = ob_get_contents();
			ob_end_clean();
		}
			
		$response->add($this->content);

	}

	public function noRenderLayout() 
	{
		$this->_isRenderLayout = false;
	}
}
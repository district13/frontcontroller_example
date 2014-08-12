<?
class Xscript_Controller_Dispatcher 
{

	public function dispatch($request, $response) 
	{
		$controllerName = ucfirst($request->getControllerName()) . "Controller";
		$actionName = $request->getActionName() . "Action";
		require_once $controllerName . '.php';
		$controller = new $controllerName($request, $response);
		$controller->dispatch($actionName);
			
	}
}
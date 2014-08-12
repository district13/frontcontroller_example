<?

class BaseController extends Xscript_Controller_Action 
{

	public function _preDispatch() {
		$this->authService = Service_AuthService::getInstance();
		$this->authService->auth($this->_request);
		$this->user = $this->authService->authUser;
	}

	public function _initAjax() {
		$this->view->noRenderLayout();
	}

	public function _postDispatch() {
		$this->view->authUser = $this->authService->authUser;
		Map::instance()->commit();
	}
}
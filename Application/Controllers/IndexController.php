<?

class IndexController extends BaseController
{
	public function indexAction()
	{
		$userMapper = Xscript_Registry::getMapper("User");
		$user = $userMapper->findById(73);
		$this->view->user = $user;
	}

	public function loginAction()
	{
		$this->_initAjax();
		$login = $this->_request->getParam('login');
		$pass = $this->_request->getParam('pass');
		$user = $this->authService->login($_REQUEST['login'], $_REQUEST['pass']);
		$this->view->user = $user;
	}

	public function logoutAction()
	{
		$this->authService->logout();
	}
}
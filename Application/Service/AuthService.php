<?
class Service_AuthService 
{
	public static $authUser;
	protected $_secret_word = "secret_word";
	private static $_authService = null;

	public static function getInstance()
	{
		if (self::$_authService === null) {
			self::$_authService = new Service_AuthService();
		}
		return self::$_authService;
	}


	public function login($login, $pass)
	{
		$userMapper = Xscript_Registry::getMapper("User");
		$user = $userMapper->findByLoginAndPass($login, $pass);
		if($user) {
			$this->_setCookie( $user->id. ',' .md5($user->pass . $this->_secret_word) );
			$this->authUser = $user;
			return $user;
		}
		else
			return false;
	}

	public function auth($request)
	{
		$userMapper = Xscript_Registry::getMapper("User");
		$login = $request->getCookie('login');
		if($login) {
			list($user_id, $secret) = explode(",", $login);
			$user = $userMapper->findById($user_id);
			if( md5($user->pass . $this->_secret_word) == $secret ) {
				$this->authUser = $user;
				return;
			}
		}
		$this->authUser = $userMapper->getAnonymousUser();
	}

	public function logout() 
	{
		$userMapper = Xscript_Registry::getMapper("User");
		$this->_setCookie();
		$this->authUser = $userMapper->getAnonymousUser();
	}

	protected function _setCookie($val = '') 
	{
		setcookie('login', $val, time() + 36000, "/", ".wb2.agoora.ru", 0, true);
	}

}
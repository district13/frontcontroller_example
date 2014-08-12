<?
class Xscript_Autoloader 
{

	function autoload($class) 
	{
		$file = $this->_getFileFromClass($class);
		require_once ucfirst($file);
	}

	protected function _getFileFromClass($class)
	{
		$file = str_replace("Model_", "", $class);
		return str_replace('_', '/', $file) . '.php';
	}
	 
	function __construct($config) 
	{
		spl_autoload_register(array(__CLASS__, 'autoload'));
		$dirs = implode(":", array($config['library_path'],
								   $config['controller_path'],
								   $config['model_path'],
								   $config['service_path'],
								   $config['view_path'],
								   $config['layout_path'],
								  )
		);
		set_include_path($dirs);
	} 
	 
}
<?
class Fabric_AbstractFabric {
	protected static $_familyClass = "";

	public static function createObject ($raw)
	{
		$obj = new static::$_familyClass();
		foreach (get_object_vars($obj) as $key => $val) {
			if($key[0] == '_') continue;
			if (method_exists(get_called_class(), $method = 'load' . ucfirst($key))) {
				static::$method($raw, $obj);
			} elseif(isset($raw[$key])&&!is_null($raw[$key])) {
				$obj->$key = $raw[$key];
			}
		}
		Map::addClean($obj);
		return $obj;
	}

	public static function find ($id)
	{
		$old = Map::exists(static::$_familyClass, $id);
		if ($old) {
			return $old;
		}
	}

	public static function getObject ($raw)
	{
		$old = isset($raw['id']) && $raw['id'] ? self::find($raw['id']) : null;
		if ($old) return $old;
		$obj = static::createObject($raw);
		Map::add($obj);
		Map::addClean($obj);
		return $obj;
	}
		

}
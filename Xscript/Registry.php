<? 
	class Xscript_Registry extends ArrayObject {
		private static $_registry = null;
		
	    public static function getInstance()
	    {
	        if (self::$_registry === null) {
	          	self::$_registry = new Xscript_Registry();
	        }
	        return self::$_registry;
	    }
	    
	    public static function get($index)
	    {
	        $instance = self::getInstance();
	        return $instance->offsetGet($index);
    	}	    

    	public static function set($index, $value)
	    {
	        $instance = self::getInstance();
	        $instance->offsetSet($index, $value);
	    }
    	
		public static function getMapper($familyClass) {
			$class = "Mapper_" .$familyClass. "Mapper";
			return new $class;
		}
		
		public static function getDbtable($familyClass) {
			$class = "Dbtable_" .$familyClass. "s";
			return new $class;
		}
		
		public static function getFabric($familyClass) {
			$class = "Fabric_" .$familyClass. "Fabric";
			return $class;
		}
	
	}
<? 
	class Model_Abstract 
	{

		public function __construct (array $data = null)
		{
			if (!is_null($data)) {
				foreach ($data as $name => $value) {
					$this->{$name} = $value;
				}
			}
			Map::addClean($this);
			if (!isset($data['id'])) {
				Map::addNew($this);
			}
		}
		
		public function __set ($name, $value)
		{
			if (isset($this->id) && $this->id) {
				Map::addDirty($this);
			}
		}
		
		
	}
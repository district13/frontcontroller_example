<?
 
	class Dbtable_Abstract {
		
		protected $_db = null;
		protected $_name = "";
		
		function __construct() {
			$this->_db = Xscript_Registry::get('db');
		}
		
		public function insert($data) {
			pg_insert($this->_db, $this->_name, $data);
			$result = pg_query($this->_db, "SELECT CURRVAL('".$this->_name."_id_seq') AS last_insert_id");
			$res = pg_fetch_assoc($result);
			return $res['last_insert_id'];
		}
		
		public function fetchOne($sql) {
			$result = pg_query($this->_db, $sql);
			return pg_fetch_assoc($result);			
		}
		
		public function fetchAll($sql) {
			$result = pg_query($this->_db, $sql);
			$resultArray = array();
			while ($row = pg_fetch_assoc($result)) {
				$resultArray[] = $row;
			}
			return $resultArray;
		}
		
		public function getName() {
			return $this->_name;
		}
		
	}
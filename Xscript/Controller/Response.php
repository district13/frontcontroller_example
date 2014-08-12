<? 
	class Xscript_Controller_Response {
		protected $_html = '';
		
		public function sendResponse() {
			echo $this->_html;
		}
		
		public function add($html) {
			$this->_html .= $html;
		}
	}	
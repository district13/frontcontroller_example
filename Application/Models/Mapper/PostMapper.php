<? 
	class Mapper_PostMapper extends Mapper_AbstractMapper {
		
		protected $_familyClass = "Post";
		
		public function saveUser($obj, &$data) 
		{
			$data['user_id'] = $obj->user->id;
		}
		
		public function saveComments($obj, $data) {}
	}	
	
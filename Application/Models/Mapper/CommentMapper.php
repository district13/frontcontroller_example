<? 
	class Mapper_CommentMapper extends Mapper_AbstractMapper 
	{
		
		protected $_familyClass = "Comment";
		
		public function saveUser($obj, &$data) 
		{
			if(!$obj->user) return;
			$data['user_id'] = $obj->user->id;
		}

		public function savePost($obj, &$data) 
		{
			$data['post_id'] = $obj->post->id;
		}
		
	}	
	
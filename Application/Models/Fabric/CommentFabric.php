<? 
	class Fabric_CommentFabric extends Fabric_AbstractFabric {
		protected static $_familyClass = "Comment";
		
		
		static public function loadUser ($raw, $obj) 
		{
			$userMapper = new Mapper_UserMapper();
			if(!$raw['user_id']) {
				$obj->user = $userMapper->getAnonymousUser();
			}
			else {
				$obj->user = $userMapper->findById($raw['user_id']);
			}
		}
		
		static public function loadPost ($raw, $obj)
		{
			$mapper = new Mapper_PostMapper();
			$obj->post = $mapper->findById($raw['post_id']);
		}
	}
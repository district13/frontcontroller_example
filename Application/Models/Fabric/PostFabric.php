<?
	class Fabric_PostFabric extends Fabric_AbstractFabric 
	{
		protected static $_familyClass = "Post";
				
		static public function loadUser ($raw, $obj) 
		{
			$userMapper = new Mapper_UserMapper();
			$obj->user = $userMapper->findById($raw['user_id']);
		}
		
		static public function loadComments ($raw, $obj) 
		{
			$obj->comments = new Collection_CommentsCollection($raw['id'], 'post_id');
		}
		 
	}
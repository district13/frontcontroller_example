<?
	class Fabric_UserFabric extends Fabric_AbstractFabric 
	{
		protected static $_familyClass = "User";
				
		static public function loadPosts ($raw, $obj) {
			$obj->posts = new Collection_PostsCollection($raw['id'], 'user_id');
		}
		
	} 
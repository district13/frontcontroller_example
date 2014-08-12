<? 
	class Mapper_UserMapper extends Mapper_AbstractMapper {
		
		protected $_familyClass = "User";
		
		public function getAnonymousUser()
		{
			$user = new AnonymousUser();
			$user->name = "Anonymous";
			Map::addClean($user);
			return $user;		
		}
		
	}
	
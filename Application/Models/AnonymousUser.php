<? 
	class AnonymousUser extends User {
		
		public $name = "Anonymous";
		
		public function canAddPost() 
		{
			return false;
		}
		
	}	
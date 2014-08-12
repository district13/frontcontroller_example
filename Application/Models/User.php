<? 
	class User extends Model_Abstract {
		public $id;
		public $login = '';
		public $name = '';
		public $pass = '';
		public $posts = null;
		
		public function addPost($title, $text) {
			$post = new Post();
			$post->user = $this;
			$post->title = $title;
			$post->create_datetime = date("Y-m-d H:i:s");
			$post->text = $text;
			
			$this->posts->add($post);
			return $post;
		}
		
		public function addCommentToPost(Post $post, $text) {
			return $post->addComment($this, $text);
		}
		
		public function canAddPost() 
		{
			return true;
		}
		
	}	
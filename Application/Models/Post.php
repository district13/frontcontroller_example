<?
class Post extends Model_Abstract 
{
	public $id;
	public $title;
	public $text;
	public $create_datetime;
	public $user = null;
	public $comments = null;

	public function addComment(User $user, $text) 
	{
		$comment = new Comment();
		$comment->user = $user;
		$comment->text = $text;
		$comment->create_datetime = date("Y-m-d H:i:s");
		$comment->post = $this;
			
		return $this->comments->add($comment);
	}

}
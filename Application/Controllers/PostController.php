<?
class PostController extends BaseController
{

	public function indexAction()
	{
		$post_id = $this->_request->getParam('post_id');
		$postMapper = Xscript_Registry::getMapper("Post");
		$post = $postMapper->findById($post_id);
		$this->view->post = $post;
	}

	public function addcommentAction()
	{
		$this->_initAjax();
			
		$postMapper = Xscript_Registry::getMapper("Post");
		$post_id = $this->_request->getParam('post_id');
		$comment_text = $this->_request->getParam('comment_text');
		$post = $postMapper->findById($post_id);
		$this->user->addCommentToPost($post, $comment_text);
			
		$this->view->post = $post;
	}

	public function addpostformAction()
	{
	}

	public function addpostAction()
	{
		if(!$this->user->canAddPost()) return;
		$title = $this->_request->getParam('title');
		$text = $this->_request->getParam('text');
		$post = $this->user->addPost($title, $text);
		$this->view->post = $post;
	}

}
<?php
class commentComponents extends sfComponents
{
	public function executeComment_form() {
		if ($this->getUser()->isAuthenticated() && $this->film){
			$this->form = new CommentsForm();
		}
	}
	
	public function executeLast_comments() {
		$c = new Criteria();
		$c->setLimit(sfConfig::get('app_last_comments', 5));
		$c->addDescendingOrderByColumn(CommentsPeer::CREATED_AT);
		$this->comments = CommentsPeer::doSelectJoinAll($c);
	}

}
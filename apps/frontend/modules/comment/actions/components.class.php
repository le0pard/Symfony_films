<?php
class commentComponents extends sfComponents
{
	public function executeComment_form() {
		if ($this->getUser()->isAuthenticated()){
			if (isset($this->data)){
				$this->form = new CommentsForm();
				$this->form->setDefaults($this->data);
			}
		}
	}
	
	public function executeLast_comments() {
		$c = new Criteria();
		$c->setLimit(sfConfig::get('app_last_comments', 5));
		$c->addDescendingOrderByColumn(CommentsPeer::CREATED_AT);
		$this->comments = CommentsPeer::doSelect($c);
	}

}
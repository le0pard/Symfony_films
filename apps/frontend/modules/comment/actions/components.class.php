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

}
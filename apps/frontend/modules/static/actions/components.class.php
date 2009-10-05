<?php
class staticComponents extends sfComponents
{
	public function executeMenu() {
		$this->static_pages = StaticPagesPeer::doSelectVisible();
	}

}
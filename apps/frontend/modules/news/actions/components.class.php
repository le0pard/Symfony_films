<?php
class newsComponents extends sfComponents
{
	
	public function executeLatest() {
		$this->news = NewsPeer::getLatest();
	}

}
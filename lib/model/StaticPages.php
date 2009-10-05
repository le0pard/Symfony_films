<?php

class StaticPages extends BaseStaticPages
{
	public function __toString(){
    	return $this->getTitle();
    }
	
	public function setTitle($title){
	  parent::setTitle($title);
	  $this->setUrl(System::slugify($title));
	}
}

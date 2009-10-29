<?php

class Comments extends BaseComments
{
	
	public function isFor($val = null){
		if ($this->getCommentTypeName() == $val){
			return true;
		} else {
			return false;
		}
	}
	
	public function getObjectByType(){
		if ($this->getCommentTypeName() == 'Film'){
			return FilmPeer::retrieveByPK($this->getCommentTypeId());
		} else {
			return false;
		}
	}
	
}

<?php

class Users extends BaseUsers
{
	public function __toString() {
    	return $this->getLogin();
    }
	
	public function setPassword($password){
		if (!$password && 0 == strlen($password)){
			return false;
		}
		$salt = "$2a$07$".System::generateRandomKey(20)."$";
		parent::setPasswordSalt($salt);
		parent::setPassword(crypt($password, $salt));
    }
    
	public function getViewAvatar(){
		if (is_null($this->getAvatar()) || $this->getAvatar() == ''){
			return 'default/blank_ava.jpg';
		} else {
			return $this->getAvatar();
		}
    }
    
    public function getGenderName(){
    	$gender = array('Не определился', 'Мужской', 'Женский');
    	return $gender[$this->getGender()];
    }
	
	public function getUnpublicFilms(){
		return FilmPeer::doSelect(FilmPeer::doSelectUnpublicCriteria());
	}
	
	public function getUnpublicFilmsCount(){
		return FilmPeer::doCount(FilmPeer::doSelectUnpublicCriteria());
	}
	
	public function getAllPermissions(){
		$names_array = array();
		foreach($this->getUsersUsersGroupsJoinUsersGroup() as $key=>$row){
			$group = $row->getUsersGroup();
			
			$names_array[$group->getName()] = $group;
		}
		return $names_array;
	}
	
	public function getAllPermissionNames(){
		return array_keys($this->getAllPermissions());
	}
	
	public function delete(PropelPDO $con = null) {
		//verlihub begin
		if (sfConfig::get('app_integration_is_verlihub')){
			$verli_config = sfConfig::get('app_integration_verlihub_config');
			$verl_hub = new VerlihubMysql(
				$verli_config['host'],
				$verli_config['user'],
				$verli_config['password'],
				$verli_config['database']
			);
			$verl_hub->delete_user($this->getLogin());
			
		}
		//verlihub end
		//jabber begin
		if (sfConfig::get('app_integration_is_jabber')){
			JabberOpenfire::delete_user($this->getLogin());
		}
		//jabber end
		return parent::delete($con);
	}

}

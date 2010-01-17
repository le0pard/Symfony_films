<?php
class afishaComponents extends sfComponents
{
	public function executeSelectors() {
		if ($this->selected_city){
			$this->countries = AfishaCountryPeer::forSelector();
			$this->selected_country = $this->selected_city->getAfishaCountry();
		} else {
			$this->countries = AfishaCountryPeer::forSelector();
			$this->selected_country = AfishaCountryPeer::getByTitle(sfConfig::get('app_default_country', "Украина"));
			$this->selected_city = AfishaCityPeer::getByTitle(sfConfig::get('app_default_city', "Киев"));
		}
	}
	
	public function executeToday(){
		$selected_day = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
  		$this->selected_day = array('y' => date('Y',$selected_day), 'm' => date('m',$selected_day), 'd' => date('d',$selected_day), 't' => date('c', $selected_day), 'w' => date('w', $selected_day));
  		$this->city = AfishaCityPeer::getByTitle(sfConfig::get('app_default_city', "Киев"));
  		$this->afisha = AfishaPeer::getByDateRangeAndCity($this->selected_day['t'], $this->selected_day['t'], $this->city->getId(), 10);
	}

}
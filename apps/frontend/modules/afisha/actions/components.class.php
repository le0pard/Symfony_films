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

}
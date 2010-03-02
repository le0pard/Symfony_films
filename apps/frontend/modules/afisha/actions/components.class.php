<?php
class afishaComponents extends sfComponents
{
	public function executeSelectors() {
		$this->days_of_week = array("Вск", "Пнд", "Втр", "Срд", "Чтв", "Птн", "Сбт");
  	
	    $today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	  	$this->date_today = array('y' => date('Y',$today), 'm' => date('m',$today), 'd' => date('d',$today), 't' => date('c', $today), 'w' => date('w', $today));
	  	
	  	$first_day = $today - 2*86400;
	  	$last_day = $today + 7*86400;
		$this->date_range = $this->createDateRangeArray($first_day, $last_day);
		
		if ($this->selected_city){
			//$this->countries = AfishaCountryPeer::forSelector();
			$this->selected_country = $this->selected_city->getAfishaCountry();
		} else {
			//$this->countries = AfishaCountryPeer::forSelector();
			$this->selected_country = AfishaCountryPeer::getByTitle(sfConfig::get('app_default_country', "Украина"));
			$this->selected_city = AfishaCityPeer::getByTitle(sfConfig::get('app_default_city', "Киев"));
		}
	}
	
	public function executeToday(){
		//$this->afisha_films = AfishaFilmPeer::getForTop(12);
		$city = AfishaCityPeer::getByTitle(sfConfig::get('app_default_city', "Киев"));
		if ($city){
			$this->afisha_films = AfishaPeer::getForTopMain($city);
		}
	}
	
	public function executeToday_films(){
		//$this->afisha_films = AfishaFilmPeer::getForTop(12);
		$this->selected_city = AfishaCityPeer::getByTitle(sfConfig::get('app_default_city', "Киев"));
		if ($this->selected_city){
			$this->afisha_films = AfishaPeer::getForTodayFilms($this->selected_city);
			$this->selected_country = $this->selected_city->getAfishaCountry();
		}
	}
	
  protected function createDateRangeArray($iDateFrom, $iDateTo) {
	  $aryRange=array();
	
	  if ($iDateTo>=$iDateFrom) {
	    array_push($aryRange,array('y' => date('Y',$iDateFrom), 'm' => date('m',$iDateFrom), 'd' => date('d',$iDateFrom), 't' => date('c', $iDateFrom), 'w' => date('w', $iDateFrom)));
	
	    while ($iDateFrom<$iDateTo) {
	      $iDateFrom+=86400; // add 24 hours
	      array_push($aryRange,array('y' => date('Y',$iDateFrom), 'm' => date('m',$iDateFrom), 'd' => date('d',$iDateFrom), 't' => date('c', $iDateFrom), 'w' => date('w', $iDateFrom)));
	    }
	  }
	  return $aryRange;
  }

}
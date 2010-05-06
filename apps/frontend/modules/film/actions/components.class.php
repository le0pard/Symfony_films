<?php
class filmComponents extends sfComponents
{
	public function executeTypes() {
		$this->film_types = FilmTypesPeer::doSelectAllActive();
	}
	
	public function executeTopNew() {
		$this->films = FilmPeer::getTopNewFilms();
	}
	
	public function executeTopRating() {
		$this->top_films = FilmTotalRatingPeer::getTopFilms();
	}

}
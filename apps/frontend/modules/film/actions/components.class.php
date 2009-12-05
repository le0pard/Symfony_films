<?php
class filmComponents extends sfComponents
{
	public function executeTypes() {
		$c = new Criteria();
		$c->add(FilmTypesPeer::IS_VISIBLE, true);
		$c->addAscendingOrderByColumn(FilmTypesPeer::TITLE);
		$this->film_types = FilmTypesPeer::doSelect($c);
	}
	
	public function executeTopNew() {
		$this->films = FilmPeer::getTopNewFilms();
	}

}
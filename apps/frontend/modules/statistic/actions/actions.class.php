<?php

/**
 * statistic actions.
 *
 * @package    symfony_films
 * @subpackage statistic
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class statisticActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
  }
  
  public function executeCathegory_films() {
  	  $c = new Criteria();
	  $c->add(FilmTypesPeer::IS_VISIBLE, true);
	  $c->addAscendingOrderByColumn(FilmTypesPeer::TITLE);
	  $film_types = FilmTypesPeer::doSelect($c);
	  $c = new Criteria();
	  $film_types_count = FilmFilmTypesPeer::doCount($c);
	  
	  $chatData = array();
	  $data = array();
	  foreach($film_types as $film_type){
	  	$chatData[] = $film_type->getTitle();
	  	$data[] = round($film_type->countFilmFilmTypess() * 100 / $film_types_count, 2);
	  }
	 
	  //Creating a stGraph object       
	  $g = new stGraph();
	 
	  //set background color
	  $g->bg_colour = '#E4F5FC';
	 
	  //Set the transparency, line colour to separate each slice etc.
	  $g->pie(80,'#78B9EC','{font-size: 12px; color: #78B9EC;');
	 
	  //array two arrray one containing data while other contaning labels 
	  $g->pie_values($data, $chatData);
	 
	  //Set the colour for each slice. Here we are defining three colours 
	  //while we need 7 colours. So, the same colours will be 
	  //repeated for the all remaining slices in the same order  
	  $g->pie_slice_colours( array('#d01f3c','#356aa0','#c79810') );
	 
	  //To display value as tool tip
	  $g->set_tool_tip( '#val#%' );
	 
	  $g->title('Категории фильмов', '{font-size:18px; color: #18A6FF}');
	  echo $g->render();
	 
	  return sfView::NONE;
  }
}

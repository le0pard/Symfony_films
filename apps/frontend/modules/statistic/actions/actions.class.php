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
  
  public function executeFilms_by_day(){
  	  $titleData = array();
  	  $chartData = array();
	  $aryRange=array();
	  $tommorow  = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
	  $lastmonth = mktime(0, 0, 0, date("m")-1, date("d"), date("Y"));
	  while ($tommorow>=$lastmonth) {
	  	$titleData[] = date("d/m/y", $lastmonth);
	  	$chartData[] = FilmPeer::countByDateRange(
				mktime(0, 0, 0, date("m", $lastmonth), date("d", $lastmonth), date("Y", $lastmonth)), 
				mktime(23, 59, 59, date("m", $lastmonth), date("d", $lastmonth), date("Y", $lastmonth))
		);
		$lastmonth += 86400;
	  }
	 
	  //Create new stGraph object
	  $g = new stGraph();
	 
	  // Chart Title
	  $g->title( 'Опубликовано за день', '{font-size: 20px;}' );
	  $g->bg_colour = '#E4F5FC';
	  $g->set_inner_background( '#E3F0FD', '#CBD7E6', 90 );
	  $g->x_axis_colour( '#8499A4', '#E4F5FC' );
	  $g->y_axis_colour( '#8499A4', '#E4F5FC' );
	 
	  //Use line_dot to set line dots diameter, text, color etc.
	  $g->line_dot(2, 3, '#3495FE', 'Количество опубликованых фильмов в день', 10);
	 
	  //In case of line chart data should be passed to stGraph object
	  //unsing set_data
	  $g->set_data( $chartData );
	 
	  //Setting labels for X-Axis
	  $g->set_x_labels($titleData);
	 
	  //to set the format of labels on x-axis e.g. font, color, step
	  $g->set_x_label_style( 10, '#18A6FF', 0, 3 );
	 
	  //set maximum value for y-axis
	  //we can fix the value as 20, 10 etc.
	  //but its better to use max of data
	  $g->set_y_max(max($chartData));
	 
	  $g->y_label_steps(15);
	 
	  // display the data
	  echo $g->render();
	 
	  echo $g->render();
	 
	  return sfView::NONE;

  }
}

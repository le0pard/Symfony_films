<?php

/**
 * mobile actions.
 *
 * @package    symfony_films
 * @subpackage mobile
 * @author     leopard
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mobileActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeFilm_poster(sfWebRequest $request)
  {
    $this->film = FilmPeer::retrieveByPK($request->getParameter('id'));
  	$this->forward404Unless($this->film);
  	
  	if (($poster = $this->film->getThumbLogo()) == true){
  		
  		$img = new sfImage(sfConfig::get('sf_upload_dir').'/posters/'.$poster);
		$response = $this->getResponse();
		$response->setContentType($img->getMIMEType());    
		$img->thumbnail(100,100);
		$img->setQuality(85);
		$response->setContent($img); 
  	}
  	return sfView::NONE;
  }
}

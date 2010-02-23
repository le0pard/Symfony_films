<?php

/**
 * film actions.
 *
 * @package    symfony_films
 * @subpackage film
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class filmActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  
  public function executeShow(sfWebRequest $request)
  {
    $this->film = $this->getRoute()->getObject();
	$this->pager = new sfPropelPager(
		'Comments',
		sfConfig::get('app_pages_comments_page', 50)
	);
	$this->pager->setCriteria(CommentsPeer::getByFilmId($this->film->getId()));
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->init();
  }

/* Step 1 */  
  public function executeAdd_step1(sfWebRequest $request)
  {
    $this->form = new FrontFilmForm();
	if ($request->isMethod('post')){
		$this->form->bind($request->getParameter('film_add'), $request->getFiles('film_add'));
		if ($this->form->isValid()){			
			$film = $this->form->getObject();
			$film->setUserId($this->getUser()->getAuthUser()->getId());
			$film->setModifiedAt(time());
			$film->setIsVisible(false);
			$film->setIsPublic(false);
			$this->form->save();
			$this->getUser()->setFlash('confirm', 'Данные по фильму добавленны. Не забудте про ссылки и галерею.');
			$this->redirect('film_add_step2', $film);
		}
	}
  }
  
  public function executeEdit_step1(sfWebRequest $request)
  {
  	$this->film = $this->getRoute()->getObject();
    $this->form = new FrontFilmForm($this->film);
	if ($request->isMethod('post')){
		$this->form->bind($request->getParameter('film_add'), $request->getFiles('film_add'));
		if ($this->form->isValid()){
			$this->form->save();
			$this->getUser()->setFlash('confirm', 'Данные успешно обновленны.');
			$this->redirect('film_edit_step1', $this->film);
		}
	}
  }

/* Step 2*/  
  protected function callStep2Forms(){
  	$this->film = $this->getRoute()->getObject();
	$this->form = new sfForm();
	if (!$this->film->isNew()){
		$i = 1;
		foreach ($this->film->getGallery() as $subitems) {  
			$subitems_form = new FrontFilmGalleryForm($subitems);  
			$this->form->embedForm('gallery'.$subitems->getId(), $subitems_form);
			$this->form->getWidgetSchema()->setLabel('gallery'.$subitems->getId(), 'Скриншот #'.$i);
			$i++;
		}
	}
	
	if (sfConfig::get('app_films_max_gallery', 10) > $this->film->getGalleryCount()){
		$this->form_add = new FrontFilmGalleryForm();
		$this->form_add->setDefault('film_id', $this->film->getId());
		$this->form_add->getObject()->setFilm($this->film);
		$this->form_add->redefineFieldsByDef();	
	}
  }
  
  public function executeAdd_step2(sfWebRequest $request)
  {
  	$this->callStep2Forms();
	
	if ($request->isMethod('post')){
		if ($request->hasParameter('gallery') && isset($this->form_add)){
			$this->form_add->bind($request->getParameter('gallery'), $request->getFiles('gallery'));
			if ($this->form_add->isValid()){
				$this->form_add->save();
				$this->getUser()->setFlash('confirm', 'Скриншот успешно добавлен.');
				$this->redirect('film_add_step2', $this->film);
			}
		}
	}
  }
  
  public function executeAdd_swf_step2(sfWebRequest $request)
  {
  	$this->callStep2Forms();
	
	if ($request->isMethod('post')){
		if ($request->hasParameter('gallery') && isset($this->form_add)){
			$this->form_add->bind($request->getParameter('gallery'), $request->getFiles('gallery'));
			if ($this->form_add->isValid()){
				$this->form_add->save();
			}
		}
	}
  	return $this->renderText(print_r($this->form_add['thumb_img']->renderError()));
  }
  
  public function executeEdit_step2(sfWebRequest $request)
  {
  	$this->callStep2Forms();

	if ($request->isMethod('post')){
		if ($request->hasParameter('gallery')){
			$params = $request->getParameter('gallery');
			$all_forms = $this->form->getEmbeddedForms();
			if (isset($all_forms['gallery'.$params['id']])){
				$this->form_edit = $all_forms['gallery'.$params['id']];
				$this->form_edit->bind($params, $request->getFiles('gallery'));
				if ($this->form_edit->isValid()){
					$this->form_edit->save();
					$this->getUser()->setFlash('confirm', 'Данные успешно обновленны.');
					$this->redirect('film_add_step2', $this->film);
				}
			}
		}
	}
	$this->setTemplate('add_step2');
  }
  
  public function executeSort_step2(sfWebRequest $request)
  {

	if ($request->isXmlHttpRequest() && $request->isMethod('post')){
		$this->film = $this->getRoute()->getObject();
		$params = $request->getParameter('add_gallery_list');
		if ($this->film && $params){
			foreach($params as $key=>$row){
				$gallery = FilmGalleryPeer::retrieveByPK($row, $this->film->getId());
				if ($gallery){
					$gallery->setSort($key);
					$gallery->save();
				}
			}
		}
	}
	return $this->renderText('');
  }
  
  public function executeDelete_film(sfWebRequest $request)
  {
  	$this->film = $this->getRoute()->getObject();
	if (($this->film->getUsersRelatedByUserId() && $this->film->getUserId() == $this->getUser()->getAuthUser()->getId()) || $this->getUser()->hasCredential(array('admin', 'super_admin', 'moder'), false)){
		$this->getUser()->setFlash('confirm', 'Фильм удален.');
		$this->film->delete();
	}
	$this->redirect('@homepage');
  }
  
  public function executeDelete_gallery(sfWebRequest $request)
  {
  	$this->film_gallery = $this->getRoute()->getObject();
    $film = $this->film_gallery->getFilm();
    if ($film){
		if (($film->getUserId() == $this->getUser()->getAuthUser()->getId() && !$film->getIsPublic()) || $this->getUser()->hasCredential(array('admin', 'super_admin', 'moder'), false)){
			$this->getUser()->setFlash('confirm', 'Скриншот успешно удален.');
			$this->film_gallery->delete();
		}
    }
	$this->redirect('film_add_step2', $film);
  }
  

/* Step 3*/  
  protected function callStep3Forms(){
  	$this->film = $this->getRoute()->getObject();
	$this->form = new sfForm();
  	if (!$this->film->isNew()){
		$i = 1;
		foreach ($this->film->getLinks() as $subitems) {  
			$subitems_form = new FrontFilmLinksForm($subitems);  
			$this->form->embedForm('links'.$subitems->getId(), $subitems_form);
			$this->form->getWidgetSchema()->setLabel('links'.$subitems->getId(), 'Ссылка #'.$i);
			$i++;
		}
	}
	if (sfConfig::get('app_films_max_links', 100) > $this->film->getLinksCount()){
		$this->form_add = new FrontFilmLinksForm();
		$this->form_add->setDefault('film_id', $this->film->getId());
		$this->form_add->getObject()->setFilm($this->film);
	}
  }
  
  
  public function executeAdd_step3(sfWebRequest $request)
  {
  	$this->callStep3Forms();
	
	if ($request->isMethod('post')){
		if ($request->hasParameter('film_links') && isset($this->form_add)){
			$this->form_add->bind($request->getParameter('film_links'), $request->getFiles('film_links'));
			if ($this->form_add->isValid()){
				$this->form_add->save();
				$this->getUser()->setFlash('confirm', 'Ссылка успешно добавлена.');
				$this->redirect('film_add_step3', $this->film);
			}
		}
	}
	
  }
  
  public function executeEdit_step3(sfWebRequest $request)
  {
  	$this->callStep3Forms();
	
	if ($request->isMethod('post')){
		if ($request->hasParameter('film_links')){
			$params = $request->getParameter('film_links');
			$all_forms = $this->form->getEmbeddedForms();
			if (isset($all_forms['links'.$params['id']])){
				$this->form_edit = $all_forms['links'.$params['id']];
				$this->form_edit->bind($params, $request->getFiles('film_links'));
				if ($this->form_edit->isValid()){
					$this->form_edit->save();
					$this->getUser()->setFlash('confirm', 'Данные успешно обновленны.');
					$this->redirect('film_add_step3', $this->film);
				}
			}
		}
	}
	$this->setTemplate('add_step3');
  }
  
  public function executeSort_step3(sfWebRequest $request)
  {

	if ($request->isXmlHttpRequest() && $request->isMethod('post')){
		$this->film = $this->getRoute()->getObject();
		$params = $request->getParameter('add_link_list');
		if ($this->film && $params){
			foreach($params as $key=>$row){
				$link = FilmLinksPeer::retrieveByPK($row, $this->film->getId());
				if ($link){
					$link->setSort($key);
					$link->save();
				}
			}
		}
	}
	return $this->renderText('');
  }
  
  public function executeDelete_link(sfWebRequest $request)
  {
  	$this->film_link = $this->getRoute()->getObject();
    $film = $this->film_link->getFilm();
    if ($film){
		if (($film->getUserId() == $this->getUser()->getAuthUser()->getId() && !$film->getIsPublic()) || $this->getUser()->hasCredential(array('admin', 'super_admin', 'moder'), false)){
			$this->getUser()->setFlash('confirm', 'Ссылка успешно удалена.');
			$this->film_link->delete();
		}
    }
	$this->redirect('film_add_step3', $film);
  }
  
/* Step 4 */ 
  protected function callStep4Forms(){
  	$this->film = $this->getRoute()->getObject();
	if (sfConfig::get('app_films_max_trailers', 3) > $this->film->countFilmTrailers()){
		$this->form = new FrontFilmTrailerForm();
	}
	$this->forms = new sfForm();
  	if (!$this->film->isNew()){
		$i = 1;
		foreach ($this->film->getTrailers() as $subitems) {  
			$subitems_form = new FrontFilmTrailerForm($subitems);  
			$this->forms->embedForm('trailer_'.$subitems->getId(), $subitems_form);
			$this->forms->getWidgetSchema()->setLabel('trailer_'.$subitems->getId(), 'Трейлер #'.$i);
			$i++;
		}
	}
  }
  
  public function executeAdd_step4(sfWebRequest $request)
  {
  	$this->callStep4Forms();
	
	if ($request->isMethod('post')){
		if ($request->hasParameter('film_trailer') && isset($this->form)){
			$this->form->bind($request->getParameter('film_trailer'), $request->getFiles('film_trailer'));
			if ($this->form->isValid()){
				$trailer = $this->form->getObject();
				$trailer->setFilmId($this->film->getId());
				$this->form->save();
				$this->getUser()->setFlash('confirm', 'Трейлер успешно добавлен.');
				$this->redirect('film_add_step4', $this->film);
			}
		}
	}
	
  }
  
  public function executeSort_step4(sfWebRequest $request)
  {

	if ($request->isXmlHttpRequest() && $request->isMethod('post')){
		$this->film = $this->getRoute()->getObject();
		$params = $request->getParameter('add_trailer_list');
		if ($this->film && $params){
			foreach($params as $key=>$row){
				$trailer = FilmTrailerPeer::retrieveByPK($row, $this->film->getId());
				if ($trailer){
					$trailer->setSort($key);
					$trailer->save();
				}
			}
		}
	}
	return $this->renderText('');
  }
  
  public function executeDelete_trailer(sfWebRequest $request)
  {
  	$this->film_trailer = $this->getRoute()->getObject();
    $film = $this->film_trailer->getFilm();
    if ($film){
		if (($film->getUserId() == $this->getUser()->getAuthUser()->getId() && !$film->getIsPublic()) || $this->getUser()->hasCredential(array('admin', 'super_admin', 'moder'), false)){
			$this->getUser()->setFlash('confirm', 'Трейлер успешно удален.');
			$this->film_trailer->delete();
		}
    }
	$this->redirect('film_add_step4', $film);
  }
  
  public function executeEdit_step4(sfWebRequest $request)
  {
  	$this->callStep4Forms();
	
	if ($request->isMethod('post')){
		if ($request->hasParameter('film_trailer')){
			$params = $request->getParameter('film_trailer');
			$all_forms = $this->forms->getEmbeddedForms();
			if (isset($all_forms['trailer_'.$params['id']])){
				$this->form_edit = $all_forms['trailer_'.$params['id']];
				$this->form_edit->bind($params, $request->getFiles('film_trailer'));
				if ($this->form_edit->isValid()){
					$this->form_edit->save();
					$this->getUser()->setFlash('confirm', 'Данные успешно обновленны.');
					$this->redirect('film_add_step4', $this->film);
				}
			}
		}
	}
	$this->setTemplate('add_step4');
  }
  
/* Final step */  
  public function executeAdd_final(sfWebRequest $request)
  {
  	$this->film = $this->getRoute()->getObject();
    if ($request->isMethod('post')){
		if ($request->hasParameter('pub')){
			$this->film->setModifiedAt(time());
			$this->film->setIsPublic(true);
			if ($this->getUser()->hasCredential(array('super_admin', 'admin', 'moder'), false)){
				$this->film->setIsVisible(true);
				$this->film->setModifiedUserId($this->getUser()->getAuthUser()->getId());
				$this->getUser()->setFlash('confirm', 'Ваша публикация уже опубликована.');
				$this->film->save();
				$this->redirect('film_show', $this->film);
			} else {
				$this->getUser()->setFlash('confirm', 'Ваша публикация отправленна на расмотрение.');
				$this->film->save();
			}
		}
		$this->redirect('@homepage');
	}
  }

/* Twitter */
  public function executeTwitter(sfWebRequest $request){
  	$film = $this->getRoute()->getObject();
  	if ($this->getUser()->hasCredential(array('super_admin', 'admin'), false)){
	  	if (sfConfig::get('app_integration_is_twitter') && $film){
			try{
				$url = $this->generateUrl('film_show', $film, true);
				$url = $this->bitLyUrl($url);
				$t = new Twitter(sfConfig::get('app_integration_twitter_username'), sfConfig::get('app_integration_twitter_password'));
				$str = $film->getTitle()." (".$film->getOriginalTitle().") ".$url;
				if (strlen($str) > 140){
					$str = $film->getTitle()." ".$url;
				}
				
				$t->updateStatus($str);
				$this->getUser()->setFlash('notice', 'Твиттернул.');
			} catch (Exception $e) {
				$this->getUser()->setFlash('error', 'Не твиттернул.');	
			}
		}
  	}
    $this->redirect('film_show', $film);
  }

/* Raiting */
  public function executeRaiting(sfWebRequest $request)
  {
  	if ($this->getRequest()->isXmlHttpRequest() && $request->hasParameter('rating')){
		$film = $this->getRoute()->getObject();
		$rating_val = $request->getParameter('rating');
		if (($rating = $film->getUserRaiting($this->getUser()->getAuthUser()->getId())) == false && $rating_val > 0 && $rating_val < 11){
			$rating = new FilmRaiting();
			$rating->setFilmId($film->getId());
			$rating->setUserId($this->getUser()->getAuthUser()->getId());
			$rating->setRating($rating_val);
			if ($rating->save()){
				$this->updateGlobalRaiting($film);
			}
		}
		return $this->renderPartial('film/rating', array('film' => $film, 'sf_cache_key' => $film->getId(), 'ajax' => true));
	} else {
		return $this->renderText("");
	}
  } 
  
  
  protected function updateGlobalRaiting($film){
  	if ($film){
  		if (($ratings = $film->getFilmTotalRatings()) == true){
  			$rating = null;
  			foreach($ratings as $row){
  				$rating = $row;
  			}
  			$rating->setTotalRating($film->getRating());
  			$rating->save();
  		} else {
  			$rating = new FilmTotalRating();
  			$rating->setFilmId($film->getId());
  			$rating->setTotalRating($film->getRating());
  			$rating->save();
  		}
  	}
  }
  
  protected function bitLyUrl($url){
		$api_call = file_get_contents("http://api.bit.ly/shorten?version=2.0.1&longUrl=".$url."&login=".sfConfig::get('app_integration_bitly_login')."&apiKey=".sfConfig::get('app_integration_bitly_api'));
		$bitlyinfo=json_decode(utf8_encode($api_call),true);
		if ($bitlyinfo['errorCode']==0) {
			return $bitlyinfo['results'][urldecode($url)]['shortUrl'];
		} else {
			return $url;
		}
  }
  
}

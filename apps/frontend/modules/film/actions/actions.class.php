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
  
  public function executeAdd_step1(sfWebRequest $request)
  {
    $this->form = new FrontFilmForm();
	if ($request->isMethod('post')){
		$this->form->bind($request->getParameter('film_add'), $request->getFiles('film_add'));
		if ($this->form->isValid()){			
			$film = $this->form->getObject();
			$film->setUsersRelatedByUserId($this->getUser()->getAuthUser());
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
	if (($this->film->getUsers() && $this->film->getUserId() == $this->getUser()->getAuthUser()->getId()) || $this->getUser()->hasCredential(array('admin', 'super_admin'), false)){
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
		if (($film->getUserId() == $this->getUser()->getAuthUser()->getId() && !$film->getIsPublic()) || $this->getUser()->hasCredential(array('admin', 'super_admin'), false)){
			$this->getUser()->setFlash('confirm', 'Скриншот успешно удален.');
			$this->film_gallery->delete();
		}
    }
	$this->redirect('film_add_step2', $film);
  }
  
  
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
		if (($film->getUserId() == $this->getUser()->getAuthUser()->getId() && !$film->getIsPublic()) || $this->getUser()->hasCredential(array('admin', 'super_admin'), false)){
			$this->getUser()->setFlash('confirm', 'Ссылка успешно удалена.');
			$this->film_link->delete();
		}
    }
	$this->redirect('film_add_step3', $film);
  }
  
  
  public function executeAdd_final(sfWebRequest $request)
  {
  	$this->film = $this->getRoute()->getObject();
    if ($request->isMethod('post')){
		if ($request->hasParameter('pub')){
			$this->film->setModifiedAt(time());
			$this->film->setIsPublic(true);
			if ($this->getUser()->hasCredential(array('super_admin', 'admin', 'moder'), false)){
				$this->film->setIsVisible(true);
				$this->getUser()->setFlash('confirm', 'Ваша публикация уже опубликована.');
			} else {
				$this->getUser()->setFlash('confirm', 'Ваша публикация отправленна на расмотрение.');
			}
			$this->film->save();
			$this->redirect('@homepage');
		}
	}
  }
  
}

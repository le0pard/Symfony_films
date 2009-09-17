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
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  public function executeAdd_step1(sfWebRequest $request)
  {
    $this->form = new FrontFilmForm();
	if ($request->isMethod('post')){
		$this->form->bind($request->getParameter('film_add'), $request->getFiles('film_add'));
		if ($this->form->isValid()){			
			$film = $this->form->getObject();
			$film->setUsers($this->getUser()->getAuthUser());
			$film->setUpdateData(time());
			$film->setIsVisible(false);
			$film->setIsPublic(false);
			$this->form->save();
			$this->getUser()->setFlash('confirm', 'Данные по фильму добавленны. Не забудте про ссылки и галерею.');
			$this->redirect($this->generateUrl('film_add_step2', $film));
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
			$this->redirect($this->generateUrl('film_edit_step1', $this->film));
		}
	}
  }
  
  public function executeAdd_step2(sfWebRequest $request)
  {
  	$this->film = $this->getRoute()->getObject();
	$this->form = new GalleryFilmForm($this->film);
	if (sfConfig::get('app_films_max_gallery', 10) > $this->film->getGalleryCount()){
		$this->form_add = new FrontFilmGalleryForm();
		$this->form_add->setDefault('film_id', $this->film->getId());
		$this->form_add->getObject()->setFilm($this->film);
		$this->form_add->redefineFieldsByDef();	
	}

	if ($request->isMethod('post')){
		if ($request->hasParameter('gallery') && isset($this->form_add)){
			$this->form_add->bind($request->getParameter('gallery'), $request->getFiles('gallery'));
			if ($this->form_add->isValid()){
				$this->form_add->save();
				$this->getUser()->setFlash('confirm', 'Скриншот успешно добавлен.');
			}
		}
		$this->redirect($this->generateUrl('film_add_step2', $this->film));
	}
  }
  
  public function executeEdit_step2(sfWebRequest $request)
  {
  	$this->film = $this->getRoute()->getObject();
	$this->form = new GalleryFilmForm($this->film);

	if ($request->isMethod('post')){
		if ($request->hasParameter('film_gallery')){
			$this->form->bind($request->getParameter('film_gallery'), $request->getFiles('film_gallery'));
			if ($this->form->isValid()){
				$this->form->save();
				$this->getUser()->setFlash('confirm', 'Данные успешно обновленны.');
			}
		}
		$this->redirect($this->generateUrl('film_add_step2', $this->film));
	}
  }
  
  public function executeDelete_gallery(sfWebRequest $request)
  {
  	$this->film_gallery = $this->getRoute()->getObject();
    $film = $this->film_gallery->getFilm();
	if ($film->getUserId() == $this->getUser()->getAuthUser()->getId()){
		$this->getUser()->setFlash('confirm', 'Скриншот успешно удален.');
		$this->film_gallery->delete();
	}
	$this->redirect($this->generateUrl('film_add_step2', $film));
  }
}

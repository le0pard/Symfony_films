<?php

/**
 * android actions.
 *
 * @package    symfony_films
 * @subpackage android
 * @author     leopard
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class androidActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->setLayout(false);
  }
  
  public function executeDownload(sfWebRequest $request){
  	$file = sfConfig::get('sf_web_dir').'/download/android/androidCoocooAfisha.apk1';
  	if (file_exists($file)) {
	  	$response = $this->getResponse();
	  	$response->clearHttpHeaders();
	  	$response->setContentType('application/octet-stream');   
	  	$response->setHttpHeader('Content-Description', "File Transfer");
	  	$response->setHttpHeader('Content-Transfer-Encoding', "binary");
	  	$response->setHttpHeader('Expires', "0");
	  	$response->setHttpHeader('Pragma', "public");
	    $response->setHttpHeader('Content-Disposition', "attachment; filename=\"PopCornUA.apk\"");
	    $response->setHttpHeader('Content-Length', filesize($file));
	    $response->addCacheControlHttpHeader('must-revalidate, post-check=0, pre-check=0');
	    $response->sendHttpHeaders();
	    
      $response->setContent(readfile($file));
	    $response->sendContent();

	    return sfView::NONE;
  	} else {
  		$this->redirect('android_page');
  	}
  }
}

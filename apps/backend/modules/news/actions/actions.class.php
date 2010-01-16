<?php

require_once dirname(__FILE__).'/../lib/newsGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/newsGeneratorHelper.class.php';

/**
 * news actions.
 *
 * @package    symfony_films
 * @subpackage news
 * @author     leopard
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class newsActions extends autoNewsActions
{
	public function executeTwitter(sfWebRequest $request){
		$news = $this->getRoute()->getObject();
		if (sfConfig::get('app_integration_is_twitter')){
			try{
				//$url = $this->generateUrl('news_one', $news, true);
				$url = "http://films.leo.local/news/".$news->getId()."/".$news->getUrl().".html";
				$t = new Twitter(sfConfig::get('app_integration_twitter_username'), sfConfig::get('app_integration_twitter_password'));
				$t->updateStatus($news->getTitle()." ".$url);
				$this->getUser()->setFlash('notice', 'Твиттернул.');
			} catch (Exception $e) {
				$this->getUser()->setFlash('error', 'Не твиттернул.');	
			}
		}
		
    	$this->redirect('news_edit', $news);
	}
}

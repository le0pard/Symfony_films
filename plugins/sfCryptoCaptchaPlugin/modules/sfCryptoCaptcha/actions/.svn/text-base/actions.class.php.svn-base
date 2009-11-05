<?php

/**
 * captcha actions. The captcha display an Demo action to test the captcha form.
 *
 * @package    sfCryptoCaptchaPlugin
 * @subpackage action
 * @author     HeNeArKrXeRn <henearkrxern [at] hotmail.fr>
 */
class sfCryptoCaptchaActions extends sfActions
{
 /**
  * Executes default action
  *
  * @param sfRequest $request A request object
  */
  public function executeCaptcha(sfWebRequest $request)
  {
    $this->setLayout(false);
  
    $captcha = new sfCryptoCaptcha();
    $captcha->getCaptchaImage();
    
    sfConfig::set('sf_web_debug', false);
    return sfView::NONE;
  }
  /**
  * Executes the captcha demo form and validation with POST request
  *
  * @param sfRequest $request A request object
  */
  public function executeCaptchaDemo(sfWebRequest $request)
  {
    $captcha_form = new sfCryptoCaptchaForm();
    $this->form = $captcha_form;
    
    $this->good = false;
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('captcha_demo'));
      if ($this->form->isValid())
      {
        //do something ?
        $this->good = true; //display the "good captcha" message
      }
    }

    
    return sfView::SUCCESS;
  }
}

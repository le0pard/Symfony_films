<?php
/**
 * sfCryptoCaptcha Routing Configuration .
 *
 * The sfCryptoCaptchaPlugin routing system
 *
 * @package    sfCryptoCaptchaPlugin
 * @subpackage routing
 * @author     HeNeArKrXeRn <henearkrxern [at] hotmail.fr>
 */

class sfCryptoCaptchaPluginRouting
{
  /**
   * Adds routing rules
   *
   * @param $event sfEvent The symfony event manager
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $routing = $event->getSubject();
    // add plug-in routing rules on top of the existing ones
    $routing->prependRoute('captcha', new sfRoute('/captcha', array('module' => 'sfCryptoCaptcha','action'=>'captcha')));
    $routing->prependRoute('captcha_refresh', new sfRoute('/captcha/:random', array('module' => 'sfCryptoCaptcha','action'=>'captcha')));
    $routing->prependRoute('captcha_demo', new sfRoute('/captcha_demo', array('module' => 'sfCryptoCaptcha','action'=>'captchaDemo')));
  }
}

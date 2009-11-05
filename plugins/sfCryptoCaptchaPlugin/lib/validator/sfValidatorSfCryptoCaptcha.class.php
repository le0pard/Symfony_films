<?php

/**
 * sfValidatorsfCryptoCaptcha checks that the token is valid.
 *
 * @package    sfCryptoCaptchaPlugin
 * @subpackage validator
 * @author     HeNeArKrXeRn <henearkrxern [at] hotmail.fr>
 */
class sfValidatorSfCryptoCaptcha extends sfValidatorBase
{
  /**
   * @see sfValidatorBase
   */
  public function configure($options = array(), $messages = array())
  {
    $this->setOption('trim', true);
    $this->setOption('required', true);

    $this->addMessage('wrong_captcha', 'Wrong captcha code.');
  }
  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    if($this->getOption('trim') == true)
    {
      $clean = trim($value);
    }
    $clean = $value;
    
    if (empty($clean))
    {
      throw new sfValidatorError($this, 'required');
    }
    
    if (!$this->check($clean))
    {
      throw new sfValidatorError($this, 'wrong_captcha');
    }
    return $clean;
  }
  /**
   * Returns true if the captcha is valid. (cleans the captcha attributes if all ok)
   *
   * @param $posted_captcha string The string of entered text
   *
   * @return boolean true if the captcha is valid, false otherwise
   */
  protected function check($posted_captcha)
  {
    $captcha = new sfCryptoCaptcha(false);
    //The "false" option here is very important (or the captcha will display the flood error [Error - you're refreshing too fast])
    return $captcha->testCaptcha($posted_captcha);
  }
}

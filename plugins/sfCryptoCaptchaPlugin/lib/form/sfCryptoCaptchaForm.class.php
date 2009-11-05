<?php
/**
 * sfCryptoCaptcha Démo Form .
 *
 * Prevents bots of sending spam
 *
 * @package    sfCryptoCaptchaPlugin
 * @subpackage form
 * @author     HeNeArKrXeRn <henearkrxern [at] hotmail.fr>
 */
class sfCryptoCaptchaForm extends sfForm {
  
  public function configure ()
  {
    $this->setWidgets(array(
      'captcha'       => new sfWidgetFormInput(),
    ));
     $this->widgetSchema->setLabels(array(
      'captcha'       => 'Please copy the security code.',
    ));
    $this->setValidators(array(
      'captcha'    => new sfValidatorSfCryptoCaptcha(array('required' => true, 'trim' => true),
                                                     array('wrong_captcha' => 'The code you copied is not valid.',
                                                           'required' => 'You did not copy any code. Please copy the code.')),
    ));
    $this->widgetSchema->setNameFormat('captcha_demo[%s]');
    $this->widgetSchema->setFormFormatterName('table');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }
}

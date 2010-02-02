<?php
class ForgotPassForm extends BaseForm{
  public function configure()
  {
  	
    $this->setWidgets(array(
      'email'    => new sfWidgetFormInputText(),
      'captcha'  => new sfWidgetFormInputText()
    ));
	$this->widgetSchema->setLabels(array(
	  'email'   => 'Email',
	  'captcha' => 'Картинка'
	));
	$this->widgetSchema->setHelps(array(
	  'email' => 'Введите email, кот орый вы указывали при регистрации.',
	  'captcha' => 'Повторите циферки на картинке.'
	));
	
	$this->widgetSchema->setNameFormat('forgot_pass[%s]');
	
	$this->setValidators(array(
      'email'    => new sfValidatorAnd(array(
				  		new sfValidatorString(array('required' => true, 'trim' => true), array('required' => 'Email должен быть указан.')),
						new sfValidatorEmail(array(), array('invalid' => 'Email неверного формата.'))
					), array('required' => true, 'trim' => true), array('required' => 'Email должен быть указан.')),
	  'captcha'  => new sfValidatorSfCryptoCaptcha(array('required' => true, 'trim' => true),
                                                   array('wrong_captcha' => 'Неверные циферки.',
                                                         'required' => 'Нам нужны эти циферки.'))
    ));
	
	$this->validatorSchema->setOption('allow_extra_fields', true);

  }
}
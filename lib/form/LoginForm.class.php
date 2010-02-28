<?php
class LoginForm extends BaseForm{
  public function configure()
  {
  	
    $this->setWidgets(array(
      'login'    => new sfWidgetFormInputText(),
      'password' => new sfWidgetFormInputPassword(),
	  'not_remember' => new sfWidgetFormInputCheckbox(array('label' => '&nbsp;', 'value_attribute_value' => 1), array('value' => 1))
    ));
	$this->widgetSchema->setLabels(array(
	  'login'   => 'Логин или email',
	  'password'   => 'Пароль',
	  'not_remember' => 'Чужой компьютер'
	));
	$this->widgetSchema->setHelps(array(
	  'login' => 'Логин или email не чуствителен к регистру.',
	  'password' => 'Внимание! Пароль чуствителен к регистру.',
	  'not_remember' => 'Если требуется что бы вход на сайт автоматически НЕ производился'
	));
	
	$this->widgetSchema->setNameFormat('login[%s]');
	
	$this->setValidators(array(
      'login'    => new sfValidatorString(array('required' => true, 'trim' => true), array('required' => 'Логин или email должен быть указан.')),
	  'password'    => new sfValidatorString(array('required' => true), array('required' => 'Пароль должен быть указан.')),
	  'not_remember' => new sfValidatorBoolean(array('required' => false))
    ));
	
	$this->validatorSchema->setOption('allow_extra_fields', true);
	$this->getWidgetSchema()->getFormFormatter()->setHelpFormat('%help%');

  }
}
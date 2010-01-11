<?php
class ForgotPassTokenForm extends BaseForm{
  public function configure()
  {
  	
    $this->setWidgets(array(
      'password'    => new sfWidgetFormInputPassword()
    ));
	
	$this->setValidators(array(
		'password'    => new sfValidatorString(array('required' => true, 'min_length' => 3, 'max_length' => 20), 
	  					array('required' => 'Пароль должен быть указан.',
							  'min_length' => '"%value%" слишком короткое (минимальная длинна %min_length% символа).',
							  'max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
    ));
	
	$this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->widgetSchema['password_confirmation'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password_confirmation'] = clone $this->validatorSchema['password'];
 
    $this->widgetSchema->moveField('password_confirmation', 'after', 'password');
    
    $this->widgetSchema->setLabels(array(
	  'password'   => 'Новый пароль',
      'password_confirmation'   => 'Повторите новый пароль'
	));
    
    $this->widgetSchema->setHelps(array(
	  'password' => 'Длинна пароля от 3 до 20 символов',
	  'password_confirmation' => 'Повторите введенный Вами пароль',
	));
	
	$this->widgetSchema->setNameFormat('forgot_pass[%s]');

	$this->validatorSchema->setOption('allow_extra_fields', true);
	
	$this->validatorSchema->setPostValidator(
	 	new sfValidatorAnd(array(
	 	    new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_confirmation', array(), array('invalid' => 'Пароли должны совпадать.'))
	)));

  }
}
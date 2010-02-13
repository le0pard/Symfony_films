<?php
class ChangePasswordForm extends BaseForm{
  public function configure()
  {
  	$this->setWidgets(array(
      'old_password'   => new sfWidgetFormInputPassword(),
      'password' => new sfWidgetFormInputPassword(),
  	  'password_confirmation' => new sfWidgetFormInputPassword(),
  	  'verlihub_change' => new sfWidgetFormInputCheckbox(array('label' => 'Также изменить пароль для DC++', 'value_attribute_value' => 1), array('value' => 1)),
  	  'jabber_change' => new sfWidgetFormInputCheckbox(array('label' => 'Также изменить пароль для Jabber', 'value_attribute_value' => 1), array('value' => 1))
    ));
    
    $this->setValidators(array(
	  'password'    => new sfValidatorString(array('required' => false, 'min_length' => 3, 'max_length' => 20), 
	  					array('min_length' => '"%value%" слишком короткое (минимальная длинна %min_length% символа).',
							  'max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
	  'verlihub_change' => new sfValidatorBoolean(array('required' => false)),
	  'jabber_change' => new sfValidatorBoolean(array('required' => false))
    ));
  	
    $this->validatorSchema['password_confirmation'] = clone $this->validatorSchema['password'];
    $this->validatorSchema['old_password'] = clone $this->validatorSchema['password'];
    
    $this->widgetSchema->setLabels(array(
	  'old_password'	=> 'Старый пароль',
	  'password'   => 'Новый пароль',
	  'password_confirmation' => 'Повторите новый пароль'
	));
	
	$this->widgetSchema->setHelps(array(
	    'old_password'	=> 'Сюда вводите свой старый пароль',
		'password' => 'Поля для изменения текущего пароля. Длинна пароля от 3 до 20 символов',
		'password_confirmation' => 'Поля для изменения текущего пароля. Повторите введенный Вами пароль'
	));
	
	$this->widgetSchema->setNameFormat('change_password[%s]');
	
	$this->validatorSchema->setOption('allow_extra_fields', true);
	$this->getWidgetSchema()->getFormFormatter()->setHelpFormat('%help%');
	
	$this->validatorSchema->setPostValidator(
	 	new sfValidatorAnd(array(
	 	    new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_confirmation', array(), array('invalid' => 'Пароли должны совпадать.'))
	)));
  }
}  
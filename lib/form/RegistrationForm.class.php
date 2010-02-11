<?php
class RegistrationForm extends BaseUsersForm{
  public function configure()
  {
  	
	unset(
      $this['created_at'], $this['updated_at'],
      $this['is_active'], $this['is_super_admin'], 
	  $this['last_login'], $this['right_id'],
	  $this['about'], $this['avatar'],
	  $this['website_blog'], $this['film_raiting_list'],
	  $this['users_users_group_list'], $this['count_of_films'],
	  $this['persistence_token'], $this['password_salt']
    );
	
    $this->setValidators(array(
      'login'    => new sfValidatorString(array('required' => true, 'trim' => true, 'min_length' => 3, 'max_length' => 20), 
	  					array('required' => 'Логин должен быть указан.', 
							  'min_length' => '"%value%" слишком короткое (минимальная длинна %min_length% символа).',
							  'max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
	  'password'    => new sfValidatorString(array('required' => true, 'min_length' => 3, 'max_length' => 20), 
	  					array('required' => 'Пароль должен быть указан.',
							  'min_length' => '"%value%" слишком короткое (минимальная длинна %min_length% символа).',
							  'max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
	  'email'    => new sfValidatorAnd(array(
				  		new sfValidatorString(array('required' => true, 'trim' => true), array('required' => 'Email должен быть указан.')),
						new sfValidatorEmail(array(), array('invalid' => 'Email неверного формата.'))
					), array('required' => true, 'trim' => true), array('required' => 'Email должен быть указан.'))
    ));
	
	$this->widgetSchema['captcha'] = new sfWidgetFormInputText();
	$this->validatorSchema['captcha'] = new sfValidatorSfCryptoCaptcha(array('required' => true, 'trim' => true),
                                                   array('wrong_captcha' => 'Неверные циферки.',
                                                         'required' => 'Нам нужны эти циферки.'));
	
	$this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->widgetSchema['password_confirmation'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password_confirmation'] = clone $this->validatorSchema['password'];
 
    $this->widgetSchema->moveField('password_confirmation', 'after', 'password');
 
	$this->widgetSchema->setLabels(array(
	  'login'   => 'Логин',
	  'email'	=> 'E-mail',
	  'password'   => 'Пароль',
	  'password_confirmation' => 'Повторите пароль',
	  'captcha' => 'Картинка'
	));
	
	$this->widgetSchema['rights'] = new sfWidgetFormInputCheckbox(array(
      'label' => 'Ознакомлен и согласен с правилами',
	  'value_attribute_value' => 1
    ), array('value' => 1));
	
	$this->validatorSchema['rights'] = new sfValidatorBoolean(
                                          array('required' => true),
                                          array('required'=> 'Вы должны ознакомится и согласится с правилами')
                                        );

	$this->widgetSchema->setHelps(array(
		'login' => 'Длинна логина от 3 до 20 символов',
		'password' => 'Длинна пароля от 3 до 20 символов',
		'password_confirmation' => 'Повторите введенный Вами пароль',
		'email' => 'Пожалуйста, введите верный e-mail (не показывается на сайте)',
		'captcha' => 'Нам нужны эти циферки',
		'rights' => ''
	));

	
	$this->widgetSchema->setNameFormat('registration[%s]');
	
	$this->validatorSchema->setOption('allow_extra_fields', true);
	
	$this->validatorSchema->setPostValidator(
	 	new sfValidatorAnd(array(
	 		new sfValidatorPropelUnique(array('model' => 'Users', 'column' => array('login')), array('invalid' => 'Такой логин уже зарегестрирован')),
	 	    new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_confirmation', array(), array('invalid' => 'Пароли должны совпадать.')),
	 		new sfValidatorPropelUnique(array('model' => 'Users', 'column' => array('email')), array('invalid' => 'Такой email уже зарегестрирован'))
	 )));

  }
}
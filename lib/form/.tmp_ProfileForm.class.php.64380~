<?php
class ProfileForm extends BaseUsersForm{
  public function configure()
  {
  	
	unset(
      $this['created_at'], $this['updated_at'],
      $this['is_active'], $this['is_super_admin'], 
	  $this['last_login'], $this['right_id'],
	  $this['login'], $this['email'], 
	  $this['film_raiting_list']
    );
	
	$this->widgetSchema['id'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['about'] = new sfWidgetFormTextarea(array(), array('rows' => 5, 'cols' => 30));
	
    $this->setValidators(array(
	  'id'              => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'website_blog'    => new sfValidatorString(array('required' => false, 'max_length' => 30),
	  						array('max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
	  'about'    => new sfValidatorString(array('required' => false)),
	  'password'    => new sfValidatorString(array('required' => false, 'min_length' => 3, 'max_length' => 20), 
	  					array('min_length' => '"%value%" слишком короткое (минимальная длинна %min_length% символа).',
							  'max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
    ));
	
	$this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->widgetSchema['password_confirmation'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password_confirmation'] = clone $this->validatorSchema['password'];
 
    $this->widgetSchema->moveField('password_confirmation', 'after', 'password');
 
	$this->widgetSchema->setLabels(array(
	  'website_blog'   => 'Сайт/Блог',
	  'about'	=> 'Текст',
	  'password'   => 'Пароль',
	  'password_confirmation' => 'Повторите пароль',
	  'avatar' => 'Аватарка'
	));

	$this->widgetSchema->setHelps(array(
		'password' => 'Поля для изменения текущего пароля. Длинна пароля от 3 до 20 символов',
		'password_confirmation' => 'Поля для изменения текущего пароля. Повторите введенный Вами пароль',
		'about'	=> 'Сюда пишется все что угодно',
		'avatar' => 'Ваш фейс на сайте'
	));
	
	$this->widgetSchema['avatar'] = new sfWidgetFormInputFileEditable(array(
      'label'     => 'Аватарка',
      'file_src'  => '/uploads/avatars/'.$this->getObject()->getAvatar(),
      'is_image'  => true,
	  'delete_label' => 'Удалить?',
      'edit_mode' => !$this->isNew(),
      'template'  => '%file%<br />%input%<br />%delete% %delete_label%',
    ));
	
	$this->validatorSchema['avatar'] = new sfValidatorFile(array(
	  'required'   => false,
	  'path'       => sfConfig::get('sf_upload_dir').'/avatars',
	  'mime_types' => 'web_images',
	  'validated_file_class' => 'sfAvatarFile'
	));
 
    $this->validatorSchema['avatar_delete'] = new sfValidatorPass();

	
	$this->widgetSchema->setNameFormat('profile[%s]');
	
	$this->validatorSchema->setOption('allow_extra_fields', true);
	
	$this->validatorSchema->setPostValidator(
	 	new sfValidatorAnd(array(
	 	    new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_confirmation', array(), array('invalid' => 'Пароли должны совпадать.'))
	 )));

  }
}
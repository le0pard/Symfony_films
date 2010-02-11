<?php
class ProfileForm extends BaseUsersForm{
	
  protected static $genders = array(' -- Не выбран -- ', 'Мужской', 'Женский');
  	
  public function configure()
  {
  	
	unset(
      $this['created_at'], $this['updated_at'],
      $this['is_active'], $this['is_super_admin'], 
	  $this['last_login'], $this['right_id'],
	  $this['login'], $this['email'], $this['password'], $this['password_salt'], 
	  $this['film_raiting_list'], $this['users_users_group_list'],
	  $this['count_of_films'], $this['persistence_token']
    );
	
	$this->widgetSchema['id'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['about'] = new sfWidgetFormTextarea(array(), 
					array('rows' => 5, 'cols' => 30, 'class' => 'TinyMCE'));
	$this->widgetSchema['gender'] = new sfWidgetFormSelect(array('multiple' => false, 'choices' => self::$genders));
	
    $this->setValidators(array(
	  'id'              => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'gender'    		=> new sfValidatorChoice(array('choices' => array_keys(self::$genders), 'required' => false), 
    					array('invalid' => 'Неверно.')),
      'website_blog'    => new sfValidatorString(array('required' => false, 'max_length' => 30),
	  						array('max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
	  'about'           => new sfValidatorString(array('required' => false))
    ));
 
	$this->widgetSchema->setLabels(array(
	  'gender'   => 'Пол',
	  'website_blog'   => 'Сайт/Блог',
	  'about'	=> 'Текст',
	  'avatar' => 'Аватарка'
	));

	$this->widgetSchema->setHelps(array(
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
	$this->getWidgetSchema()->getFormFormatter()->setHelpFormat('%help%');

  }
}
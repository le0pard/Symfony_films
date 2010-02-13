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
	  $this['count_of_films'], $this['persistence_token'], $this['id']
    );
	
	$this->widgetSchema['about'] = new sfWidgetFormTextarea(array(), 
					array('rows' => 8, 'cols' => 60, 'class' => 'TinyMCE'));
	$this->widgetSchema['gender'] = new sfWidgetFormSelect(array('multiple' => false, 'choices' => self::$genders));
	
    $this->setValidators(array(
      'gender'    		=> new sfValidatorChoice(array('choices' => array_keys(self::$genders), 'required' => false), 
    					array('invalid' => 'Неверно.')),
      'website_blog'    => new sfValidatorString(array('required' => false, 'max_length' => 40),
	  						array('max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
	  'about'           => new sfValidatorString(array('required' => false))
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
	  'validated_file_class' => 'sfAvatarFile',
	  'max_size' => 1048576
	),
	array(
		'mime_types' => 'Это не картинка',
		'max_size' => 'Аватарка до 1 Мб размером должна быть'
	));
 
    $this->validatorSchema['avatar_delete'] = new sfValidatorPass();
 
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
	
	
	$this->widgetSchema->setNameFormat('profile[%s]');
	
	$this->validatorSchema->setOption('allow_extra_fields', true);
	$this->getWidgetSchema()->getFormFormatter()->setHelpFormat('%help%');

  }
}
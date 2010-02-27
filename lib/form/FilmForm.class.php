<?php

/**
 * Film form.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class FilmForm extends BaseFilmForm
{
  public function configure()
  {
  	unset(
      $this['created_at'], $this['updated_at'],
      $this['url'],
	  $this['film_raiting_list'], $this['normal_logo'],
	  $this['modified_user_id'], $this['modified_text']
    );
	
    $years = range(date("Y", time()) + 5, 1900);
	$this->setWidgets(array(
	  'id'                   => new sfWidgetFormInputHidden(),
      'title'                => new sfWidgetFormInputText(),
      'original_title'       => new sfWidgetFormInputText(),
	  'user_id'              => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => false)),
	  'film_film_types_list' => new sfWidgetFormPropelChoice(array('model' => 'FilmTypes', 'multiple' => true), array('size' => 8)),
      'pub_year'             => new sfWidgetFormSelect(array('multiple' => false, 'choices' => array_combine($years, $years))),
      'director'             => new sfWidgetFormInputText(),
      'cast_people'          => new sfWidgetFormInputText(),
      'about'                => new sfWidgetFormTextareaTinyMCE(
	  				array('theme' => 'advanced','config' => '
							skin : "o2k7", 
							language : "ru",
							plugins : "safari,spellchecker,table,advimage,advlink,searchreplace,contextmenu,paste,directionality,fullscreen,inlinepopups",
							theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
							theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,forecolor,backcolor",
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : true,
							'), 
					array('rows' => 5, 'cols' => 50, 'class' => 'TinyMCE')),
      'country'              => new sfWidgetFormInputText(),
      'duration'             => new sfWidgetFormInputText(),
      'file_info'            => new sfWidgetFormTextarea(),
	  'is_visible'           => new sfWidgetFormInputCheckbox(),
      'is_private'           => new sfWidgetFormInputCheckbox(),
      'is_public'            => new sfWidgetFormInputCheckbox(),
	  'modified_user_id'     => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
	  'modified_at'          => new sfWidgetFormDateTime(),
	  'modified_text'        => new sfWidgetFormInputText()			
    ));

    $this->setValidators(array(
	  'id'                   => new sfValidatorPropelChoice(array('model' => 'Film', 'column' => 'id', 'required' => false)),
      'title'                => new sfValidatorString(array('required' => true, 'max_length' => 150), 
	  						array('required' => 'Название должно быть указано.', 
								  'max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
      'original_title'       => new sfValidatorString(array('required' => true, 'max_length' => 150), 
	  						array('required' => 'Ориг. название должно быть указано.', 
								  'max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
      'pub_year'             => new sfValidatorInteger(array('max' => date("Y", time()) + 5, 'min' => 1900, 'required' => true), 
	  						array('required' => 'Год выпуска должен быть указан.',
								  'max' => '"%value%" должно быть меньше %max%.',
								  'min' => '"%value%" должно быть больше %min%.')),
      'director'             => new sfValidatorString(array('required' => true, 'max_length' => 150), 
	  						array('required' => 'Режисер должнен быть указан.', 
								  'max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
      'cast_people'         => new sfValidatorString(array('max_length' => 1000, 'required' => false), 
	  						array('max_length' => 'Слишком длинное (Максимальная длинна %max_length% символа).')),
      'about'                => new sfValidatorString(array('required' => true), array('required' => 'Нужно указать эту информацию.')),
      'country'              => new sfValidatorString(array('max_length' => 80, 'required' => true), 
	  						array('required' => 'Страна должна быть указана.', 
								  'max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
      'duration'             => new sfValidatorString(array('max_length' => 100, 'required' => true), 
	  						array('required' => 'Укажите качество видео.', 
								  'max_length' => '"%value%" слишком длинное (Максимальная длинна %max_length% символа).')),
      'file_info'            => new sfValidatorString(array('required' => true), 
	  						array('required' => 'Нужно указать эту информацию.')),
      'film_film_types_list' => new sfValidatorPropelChoice(array('model' => 'FilmTypes', 'required' => true, 'multiple' => true), 
	  						array('required' => 'Укажите хотя бы одну категорию.')),
	  'is_visible'           => new sfValidatorBoolean(),
      'is_private'           => new sfValidatorBoolean(),
      'is_public'            => new sfValidatorBoolean(),
	  'modified_user_id'     => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'modified_at'          => new sfValidatorDateTime(array('required' => false)),
	  'modified_text'        => new sfValidatorString(array('max_length' => 500, 'required' => false)),
	  'user_id'              => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id'))
    ));
	
	$this->widgetSchema['thumb_logo'] = new sfWidgetFormInputFileEditable(array(
      'label'     => 'Постер',
      'file_src'  => '/uploads/posters/'.$this->getObject()->getThumbLogo(),
      'is_image'  => true,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div class="poster">%file%<br />%input%</div>',
    ));
	
	$this->widgetSchema->moveField('thumb_logo', 'after', 'film_film_types_list');
	
	if ($this->getObject()->isNew()){
		
		$this->validatorSchema['thumb_logo'] = new sfValidatorFile(array(
		  'required'   => true,
		  'max_size'   => sfConfig::get('app_films_poster_size'),
		  'path'       => sfConfig::get('sf_upload_dir').'/posters',
		  'mime_types' => 'web_images',
		  'validated_file_class' => 'sfPosterFile'
		), array('required' => 'Без постера не так красиво', 'max_size' => 'Загружать до '.round((sfConfig::get('app_films_poster_size')/1048576), 3).' Мб!', 'mime_types' => 'Загружать можно только картинки!'));
		
	} else {
	
		$this->validatorSchema['thumb_logo'] = new sfValidatorFile(array(
		  'required'   => false,
		  'max_size'   => sfConfig::get('app_films_poster_size'),
		  'path'       => sfConfig::get('sf_upload_dir').'/posters',
		  'mime_types' => 'web_images',
		  'validated_file_class' => 'sfPosterFile'
		), array('required' => 'Без постера не так красиво', 'max_size' => 'Загружать до '.round((sfConfig::get('app_films_poster_size')/1048576), 3).' Мб!', 'mime_types' => 'Загружать можно только картинки!'));
	}
	
	$this->widgetSchema->setLabels(array(
	  'title'   => 'Название фильма/сериала',
	  'original_title'	=> 'Оригинальное название',
	  'user_id' => 'Пользователь',
	  'film_film_types_list'   => 'Категория',
	  'thumb_logo' => 'Постер к фильму',
	  'pub_year' => 'Год выпуска',
	  'director' => 'Режисер',
	  'cast_people' => 'В ролях',
	  'about' => 'О чем картина',
	  'country' => 'Страна выпуска',
	  'duration' => 'Качество видео',
	  'file_info' => 'Информация про файл(ы)',
	  'is_visible' => 'Видимый?',
	  'is_private' => 'Приватный?',
	  'is_public' => 'Опубликован?',
	  'modified_user_id' => 'Кто обновлял',
	  'modified_at' => 'Дата',
	  'modified_text' => 'Текст обновления'
	));
	
    $this->setDefaults(array(
		'pub_year' => date("Y", time())
	));

	
	$this->widgetSchema->setNameFormat('film_add[%s]');
	
	$this->validatorSchema->setOption('allow_extra_fields', true);
  }
}

<?php

/**
 * Film form.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class FrontFilmForm extends BaseFilmForm
{
  public function configure()
  {
  	unset(
      $this['created_at'], $this['updated_at'],
      $this['update_data'], $this['url'],
	  $this['is_private'], $this['is_visible'],
	  $this['user_id'], $this['film_raiting_list'],
	  $this['thumb_logo'], $this['is_public']
    );
	
    $years = range(date("Y", time()) + 5, 1900);
	$this->setWidgets(array(
	  'id'                   => new sfWidgetFormInputHidden(),
      'title'                => new sfWidgetFormInput(),
      'original_title'       => new sfWidgetFormInput(),
	  'film_film_types_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'FilmTypes'), array('size' => 8)),
      'pub_year'             => new sfWidgetFormSelect(array('multiple' => false, 'choices' => array_combine($years, $years))),
      'director'             => new sfWidgetFormInput(),
      'cast'                 => new sfWidgetFormInput(),
      'about'                => new sfWidgetFormTextarea(),
      'country'              => new sfWidgetFormInput(),
      'duration'             => new sfWidgetFormInput(),
      'file_info'            => new sfWidgetFormTextarea()
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
      'cast'                 => new sfValidatorString(array('max_length' => 1000, 'required' => false), 
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
      'film_film_types_list' => new sfValidatorPropelChoiceMany(array('model' => 'FilmTypes', 'required' => true), 
	  						array('required' => 'Укажите хотя бы одну категорию.')),
    ));
	
	if ($this->getObject()->isNew()){
		$this->widgetSchema['normal_logo'] = new sfWidgetFormInputFileEditable(array(
	      'label'     => 'Постер',
	      'file_src'  => '/uploads/posters/'.$this->getObject()->getNormalLogo(),
	      'is_image'  => true,
	      'edit_mode' => false,
	      'template'  => '%file%<br />%input%',
	    ));
		
		$this->widgetSchema->moveField('normal_logo', 'after', 'film_film_types_list');
		
		$this->validatorSchema['normal_logo'] = new sfValidatorFile(array(
		  'required'   => true,
		  'max_size'   => sfConfig::get('app_films_poster_size'),
		  'path'       => sfConfig::get('sf_upload_dir').'/posters',
		  'mime_types' => 'web_images',
		  'validated_file_class' => 'sfPosterFile'
		), array('required' => 'Без постера не так красиво', 'max_size' => 'Загружать до '.round((sfConfig::get('app_films_poster_size')/1048576), 3).' Мб!', 'mime_types' => 'Загружать можно только картинки!'));
		
	}
	
	$this->widgetSchema->setLabels(array(
	  'title'   => 'Название фильма/сериала',
	  'original_title'	=> 'Оригинальное название',
	  'film_film_types_list'   => 'Категория',
	  'thumb_logo' => 'Постер к фильму',
	  'pub_year' => 'Год выпуска',
	  'director' => 'Режисер',
	  'cast' => 'В ролях',
	  'about' => 'О чем картина',
	  'country' => 'Страна выпуска',
	  'duration' => 'Качество видео',
	  'file_info' => 'Информация про файл(ы)'
	));
	
    $this->setDefaults(array(
		'pub_year' => date("Y", time())
	));

	
	$this->widgetSchema->setNameFormat('film_add[%s]');
	
	$this->validatorSchema->setOption('allow_extra_fields', true);
  }
}

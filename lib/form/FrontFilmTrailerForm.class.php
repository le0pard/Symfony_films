<?php

/**
 * FilmTrailer form.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class FrontFilmTrailerForm extends BaseFilmTrailerForm
{
  private $trailer_types = array(' -- Выберите источник видео -- ', 'Youtube', 'Vimeo', 'Rutube');
	
  public function configure()
  {
  	unset(
  	  $this['film_id'], $this['sort'],
      $this['created_at'], $this['updated_at']
    );
    
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'trailer_type' => new sfWidgetFormSelect(array('multiple' => false, 'choices' => $this->trailer_types)),
      'trailer_code' => new sfWidgetFormInputText()
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'FilmTrailer', 'column' => 'id', 'required' => false)),
      'trailer_type' => new sfValidatorInteger(array('min' => 1, 'max' => 10, 'required' => true), 
    					array('required' => 'Нужно указать источник видео.', 
							  'min' => 'Нужно указать источник видео.',
    						  'max' => 'Нужно указать источник видео.')),
      'trailer_code' => new sfValidatorString(array('max_length' => 500, 'required' => true), 
    					array('required' => 'Код нужно указать.', 
							  'max_length' => 'Cлишком длинный код (Максимальная длинна %max_length% символов).'))
    ));
    
    $this->widgetSchema->setLabels(array(
	  'trailer_type'   => 'Источник трейлера',
	  'trailer_code'	=> 'Код'
	));

    $this->widgetSchema->setNameFormat('film_trailer[%s]');
    $this->validatorSchema->setOption('allow_extra_fields', true);
  }
}

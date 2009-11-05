<?php

/**
 * FilmFilmTypes form base class.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseFilmFilmTypesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'film_id'       => new sfWidgetFormInputHidden(),
      'film_genre_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'film_id'       => new sfValidatorPropelChoice(array('model' => 'Film', 'column' => 'id', 'required' => false)),
      'film_genre_id' => new sfValidatorPropelChoice(array('model' => 'FilmTypes', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('film_film_types[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmFilmTypes';
  }


}

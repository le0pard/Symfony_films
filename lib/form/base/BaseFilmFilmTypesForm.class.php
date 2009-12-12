<?php

/**
 * FilmFilmTypes form base class.
 *
 * @method FilmFilmTypes getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFilmFilmTypesForm extends BaseFormPropel
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

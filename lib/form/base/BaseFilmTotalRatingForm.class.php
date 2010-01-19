<?php

/**
 * FilmTotalRating form base class.
 *
 * @method FilmTotalRating getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFilmTotalRatingForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'film_id'      => new sfWidgetFormInputHidden(),
      'total_rating' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'FilmTotalRating', 'column' => 'id', 'required' => false)),
      'film_id'      => new sfValidatorPropelChoice(array('model' => 'Film', 'column' => 'id', 'required' => false)),
      'total_rating' => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('film_total_rating[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmTotalRating';
  }


}

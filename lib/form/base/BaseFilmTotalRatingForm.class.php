<?php

/**
 * FilmTotalRating form base class.
 *
 * @method FilmTotalRating getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 */
abstract class BaseFilmTotalRatingForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'film_id'      => new sfWidgetFormPropelChoice(array('model' => 'Film', 'add_empty' => false)),
      'total_rating' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'film_id'      => new sfValidatorPropelChoice(array('model' => 'Film', 'column' => 'id')),
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

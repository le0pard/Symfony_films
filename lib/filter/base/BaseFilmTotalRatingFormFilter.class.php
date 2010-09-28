<?php

/**
 * FilmTotalRating filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 */
abstract class BaseFilmTotalRatingFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'film_id'      => new sfWidgetFormPropelChoice(array('model' => 'Film', 'add_empty' => true)),
      'total_rating' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'film_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Film', 'column' => 'id')),
      'total_rating' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('film_total_rating_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmTotalRating';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'film_id'      => 'ForeignKey',
      'total_rating' => 'Number',
    );
  }
}

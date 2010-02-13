<?php

/**
 * FilmFilmTypes filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 */
abstract class BaseFilmFilmTypesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('film_film_types_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmFilmTypes';
  }

  public function getFields()
  {
    return array(
      'film_id'       => 'ForeignKey',
      'film_genre_id' => 'ForeignKey',
    );
  }
}

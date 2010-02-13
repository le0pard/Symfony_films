<?php

/**
 * FilmTrailer filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 */
abstract class BaseFilmTrailerFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'trailer_type' => new sfWidgetFormFilterInput(),
      'trailer_code' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sort'         => new sfWidgetFormFilterInput(),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'trailer_type' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'trailer_code' => new sfValidatorPass(array('required' => false)),
      'sort'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('film_trailer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmTrailer';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'film_id'      => 'ForeignKey',
      'trailer_type' => 'Number',
      'trailer_code' => 'Text',
      'sort'         => 'Number',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}

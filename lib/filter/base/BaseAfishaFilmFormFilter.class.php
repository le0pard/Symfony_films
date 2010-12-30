<?php

/**
 * AfishaFilm filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 */
abstract class BaseAfishaFilmFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'external_id' => new sfWidgetFormFilterInput(),
      'title'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'orig_title'  => new sfWidgetFormFilterInput(),
      'year'        => new sfWidgetFormFilterInput(),
      'poster'      => new sfWidgetFormFilterInput(),
      'link'        => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'video_tag'   => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'casts'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'external_id' => new sfValidatorPass(array('required' => false)),
      'title'       => new sfValidatorPass(array('required' => false)),
      'orig_title'  => new sfValidatorPass(array('required' => false)),
      'year'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'poster'      => new sfValidatorPass(array('required' => false)),
      'link'        => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'video_tag'   => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'casts'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('afisha_film_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaFilm';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'external_id' => 'Text',
      'title'       => 'Text',
      'orig_title'  => 'Text',
      'year'        => 'Number',
      'poster'      => 'Text',
      'link'        => 'Text',
      'description' => 'Text',
      'video_tag'   => 'Text',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'casts'       => 'Text',
    );
  }
}

<?php

/**
 * Afisha filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAfishaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'external_id'       => new sfWidgetFormFilterInput(),
      'afisha_theater_id' => new sfWidgetFormPropelChoice(array('model' => 'AfishaTheater', 'add_empty' => true)),
      'afisha_film_id'    => new sfWidgetFormPropelChoice(array('model' => 'AfishaFilm', 'add_empty' => true)),
      'afisha_zal_id'     => new sfWidgetFormPropelChoice(array('model' => 'AfishaZal', 'add_empty' => true)),
      'link'              => new sfWidgetFormFilterInput(),
      'description'       => new sfWidgetFormFilterInput(),
      'date_begin'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'date_end'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'times'             => new sfWidgetFormFilterInput(),
      'prices'            => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'external_id'       => new sfValidatorPass(array('required' => false)),
      'afisha_theater_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AfishaTheater', 'column' => 'id')),
      'afisha_film_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AfishaFilm', 'column' => 'id')),
      'afisha_zal_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AfishaZal', 'column' => 'id')),
      'link'              => new sfValidatorPass(array('required' => false)),
      'description'       => new sfValidatorPass(array('required' => false)),
      'date_begin'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'date_end'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'times'             => new sfValidatorPass(array('required' => false)),
      'prices'            => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('afisha_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Afisha';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'external_id'       => 'Text',
      'afisha_theater_id' => 'ForeignKey',
      'afisha_film_id'    => 'ForeignKey',
      'afisha_zal_id'     => 'ForeignKey',
      'link'              => 'Text',
      'description'       => 'Text',
      'date_begin'        => 'Date',
      'date_end'          => 'Date',
      'times'             => 'Text',
      'prices'            => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}

<?php

/**
 * AfishaTheater filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAfishaTheaterFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'external_id'    => new sfWidgetFormFilterInput(),
      'afisha_city_id' => new sfWidgetFormPropelChoice(array('model' => 'AfishaCity', 'add_empty' => true)),
      'title'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'link'           => new sfWidgetFormFilterInput(),
      'address'        => new sfWidgetFormFilterInput(),
      'phone'          => new sfWidgetFormFilterInput(),
      'description'    => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'external_id'    => new sfValidatorPass(array('required' => false)),
      'afisha_city_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AfishaCity', 'column' => 'id')),
      'title'          => new sfValidatorPass(array('required' => false)),
      'link'           => new sfValidatorPass(array('required' => false)),
      'address'        => new sfValidatorPass(array('required' => false)),
      'phone'          => new sfValidatorPass(array('required' => false)),
      'description'    => new sfValidatorPass(array('required' => false)),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('afisha_theater_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaTheater';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'external_id'    => 'Text',
      'afisha_city_id' => 'ForeignKey',
      'title'          => 'Text',
      'link'           => 'Text',
      'address'        => 'Text',
      'phone'          => 'Text',
      'description'    => 'Text',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}

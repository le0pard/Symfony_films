<?php

/**
 * AfishaZalTime filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAfishaZalTimeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'afisha_zal_id' => new sfWidgetFormPropelChoice(array('model' => 'AfishaZal', 'add_empty' => true)),
      'afisha_id'     => new sfWidgetFormPropelChoice(array('model' => 'Afisha', 'add_empty' => true)),
      'time'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'afisha_zal_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AfishaZal', 'column' => 'id')),
      'afisha_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Afisha', 'column' => 'id')),
      'time'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('afisha_zal_time_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaZalTime';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'afisha_zal_id' => 'ForeignKey',
      'afisha_id'     => 'ForeignKey',
      'time'          => 'Date',
    );
  }
}

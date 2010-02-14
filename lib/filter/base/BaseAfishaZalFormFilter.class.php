<?php

/**
 * AfishaZal filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 */
abstract class BaseAfishaZalFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'external_id'       => new sfWidgetFormFilterInput(),
      'afisha_theater_id' => new sfWidgetFormPropelChoice(array('model' => 'AfishaTheater', 'add_empty' => true)),
      'title'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'external_id'       => new sfValidatorPass(array('required' => false)),
      'afisha_theater_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AfishaTheater', 'column' => 'id')),
      'title'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('afisha_zal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaZal';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'external_id'       => 'Text',
      'afisha_theater_id' => 'ForeignKey',
      'title'             => 'Text',
    );
  }
}

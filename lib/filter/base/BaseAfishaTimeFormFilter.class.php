<?php

/**
 * AfishaTime filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 */
abstract class BaseAfishaTimeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'afisha_id' => new sfWidgetFormPropelChoice(array('model' => 'Afisha', 'add_empty' => true)),
      'time'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'price'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'afisha_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Afisha', 'column' => 'id')),
      'time'      => new sfValidatorPass(array('required' => false)),
      'price'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('afisha_time_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaTime';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'afisha_id' => 'ForeignKey',
      'time'      => 'Text',
      'price'     => 'Text',
    );
  }
}

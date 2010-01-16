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
      'afisha_zal_date_id' => new sfWidgetFormPropelChoice(array('model' => 'AfishaZalDate', 'add_empty' => true)),
      'time'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'price'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'afisha_zal_date_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AfishaZalDate', 'column' => 'id')),
      'time'               => new sfValidatorPass(array('required' => false)),
      'price'              => new sfValidatorPass(array('required' => false)),
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
      'id'                 => 'Number',
      'afisha_zal_date_id' => 'ForeignKey',
      'time'               => 'Text',
      'price'              => 'Text',
    );
  }
}

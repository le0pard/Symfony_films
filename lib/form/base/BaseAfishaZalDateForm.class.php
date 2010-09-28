<?php

/**
 * AfishaZalDate form base class.
 *
 * @method AfishaZalDate getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAfishaZalDateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'afisha_id'  => new sfWidgetFormPropelChoice(array('model' => 'Afisha', 'add_empty' => false)),
      'date_begin' => new sfWidgetFormDateTime(),
      'date_end'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'AfishaZalDate', 'column' => 'id', 'required' => false)),
      'afisha_id'  => new sfValidatorPropelChoice(array('model' => 'Afisha', 'column' => 'id')),
      'date_begin' => new sfValidatorDateTime(),
      'date_end'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('afisha_zal_date[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaZalDate';
  }


}

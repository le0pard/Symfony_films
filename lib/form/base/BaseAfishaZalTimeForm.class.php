<?php

/**
 * AfishaZalTime form base class.
 *
 * @method AfishaZalTime getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAfishaZalTimeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'afisha_id' => new sfWidgetFormPropelChoice(array('model' => 'Afisha', 'add_empty' => false)),
      'time'      => new sfWidgetFormInputText(),
      'price'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'AfishaZalTime', 'column' => 'id', 'required' => false)),
      'afisha_id' => new sfValidatorPropelChoice(array('model' => 'Afisha', 'column' => 'id')),
      'time'      => new sfValidatorString(array('max_length' => 200)),
      'price'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('afisha_zal_time[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaZalTime';
  }


}

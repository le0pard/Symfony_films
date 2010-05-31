<?php

/**
 * AfishaZal form base class.
 *
 * @method AfishaZal getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 */
abstract class BaseAfishaZalForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'external_id'       => new sfWidgetFormInputText(),
      'afisha_theater_id' => new sfWidgetFormPropelChoice(array('model' => 'AfishaTheater', 'add_empty' => false)),
      'title'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'external_id'       => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'afisha_theater_id' => new sfValidatorPropelChoice(array('model' => 'AfishaTheater', 'column' => 'id')),
      'title'             => new sfValidatorString(array('max_length' => 500, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('afisha_zal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaZal';
  }


}

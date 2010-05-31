<?php

/**
 * AfishaCountry form base class.
 *
 * @method AfishaCountry getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 */
abstract class BaseAfishaCountryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'external_id' => new sfWidgetFormInputText(),
      'title'       => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'external_id' => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 500)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('afisha_country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaCountry';
  }


}

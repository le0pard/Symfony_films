<?php

/**
 * AfishaCity form base class.
 *
 * @method AfishaCity getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 */
abstract class BaseAfishaCityForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'afisha_country_id' => new sfWidgetFormPropelChoice(array('model' => 'AfishaCountry', 'add_empty' => false)),
      'external_id'       => new sfWidgetFormInputText(),
      'title'             => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'afisha_country_id' => new sfValidatorPropelChoice(array('model' => 'AfishaCountry', 'column' => 'id')),
      'external_id'       => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'title'             => new sfValidatorString(array('max_length' => 500)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('afisha_city[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaCity';
  }


}

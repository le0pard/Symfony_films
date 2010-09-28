<?php

/**
 * AfishaTheater form base class.
 *
 * @method AfishaTheater getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 */
abstract class BaseAfishaTheaterForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'external_id'      => new sfWidgetFormInputText(),
      'afisha_city_id'   => new sfWidgetFormPropelChoice(array('model' => 'AfishaCity', 'add_empty' => false)),
      'title'            => new sfWidgetFormInputText(),
      'link'             => new sfWidgetFormInputText(),
      'address'          => new sfWidgetFormInputText(),
      'phone'            => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormTextarea(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'latitude'         => new sfWidgetFormInputText(),
      'longitude'        => new sfWidgetFormInputText(),
      'normal_telephone' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'external_id'      => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'afisha_city_id'   => new sfValidatorPropelChoice(array('model' => 'AfishaCity', 'column' => 'id')),
      'title'            => new sfValidatorString(array('max_length' => 500)),
      'link'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address'          => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'phone'            => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'description'      => new sfValidatorString(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
      'latitude'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'longitude'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'normal_telephone' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('afisha_theater[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaTheater';
  }


}

<?php

/**
 * AfishaTheater form base class.
 *
 * @method AfishaTheater getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAfishaTheaterForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'afisha_city_id' => new sfWidgetFormPropelChoice(array('model' => 'AfishaCity', 'add_empty' => false)),
      'title'          => new sfWidgetFormInputText(),
      'logo'           => new sfWidgetFormInputText(),
      'link'           => new sfWidgetFormInputText(),
      'description'    => new sfWidgetFormTextarea(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'AfishaTheater', 'column' => 'id', 'required' => false)),
      'afisha_city_id' => new sfValidatorPropelChoice(array('model' => 'AfishaCity', 'column' => 'id')),
      'title'          => new sfValidatorString(array('max_length' => 500)),
      'logo'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'    => new sfValidatorString(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
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

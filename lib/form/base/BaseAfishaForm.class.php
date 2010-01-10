<?php

/**
 * Afisha form base class.
 *
 * @method Afisha getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAfishaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'afisha_theater_id' => new sfWidgetFormPropelChoice(array('model' => 'AfishaTheater', 'add_empty' => false)),
      'title'             => new sfWidgetFormInputText(),
      'logo'              => new sfWidgetFormInputText(),
      'link'              => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'Afisha', 'column' => 'id', 'required' => false)),
      'afisha_theater_id' => new sfValidatorPropelChoice(array('model' => 'AfishaTheater', 'column' => 'id')),
      'title'             => new sfValidatorString(array('max_length' => 500)),
      'logo'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'       => new sfValidatorString(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('afisha[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Afisha';
  }


}

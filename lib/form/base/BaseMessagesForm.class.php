<?php

/**
 * Messages form base class.
 *
 * @method Messages getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMessagesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'from_user_id' => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
      'to_user_id'   => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => false)),
      'message_type' => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'Messages', 'column' => 'id', 'required' => false)),
      'from_user_id' => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'to_user_id'   => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id')),
      'message_type' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'description'  => new sfValidatorString(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('messages[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Messages';
  }


}

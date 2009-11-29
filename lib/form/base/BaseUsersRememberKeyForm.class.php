<?php

/**
 * UsersRememberKey form base class.
 *
 * @method UsersRememberKey getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseUsersRememberKeyForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'      => new sfWidgetFormInputHidden(),
      'remember_key' => new sfWidgetFormInputText(),
      'ip_address'   => new sfWidgetFormInputHidden(),
      'created_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'user_id'      => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'remember_key' => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'ip_address'   => new sfValidatorPropelChoice(array('model' => 'UsersRememberKey', 'column' => 'ip_address', 'required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('users_remember_key[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsersRememberKey';
  }


}

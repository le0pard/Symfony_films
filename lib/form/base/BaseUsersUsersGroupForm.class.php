<?php

/**
 * UsersUsersGroup form base class.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseUsersUsersGroupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'  => new sfWidgetFormInputHidden(),
      'group_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'user_id'  => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'group_id' => new sfValidatorPropelChoice(array('model' => 'UsersGroup', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('users_users_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsersUsersGroup';
  }


}

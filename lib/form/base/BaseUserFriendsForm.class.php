<?php

/**
 * UserFriends form base class.
 *
 * @method UserFriends getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 */
abstract class BaseUserFriendsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'   => new sfWidgetFormInputHidden(),
      'friend_id' => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => false)),
      'commit'    => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'user_id'   => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'friend_id' => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id')),
      'commit'    => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('user_friends[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserFriends';
  }


}

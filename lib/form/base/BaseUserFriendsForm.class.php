<?php

/**
 * UserFriends form base class.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseUserFriendsForm extends BaseFormPropel
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

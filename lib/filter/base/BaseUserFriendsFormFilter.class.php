<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * UserFriends filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseUserFriendsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'friend_id' => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
      'commit'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'friend_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Users', 'column' => 'id')),
      'commit'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('user_friends_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserFriends';
  }

  public function getFields()
  {
    return array(
      'user_id'   => 'ForeignKey',
      'friend_id' => 'ForeignKey',
      'commit'    => 'Boolean',
    );
  }
}

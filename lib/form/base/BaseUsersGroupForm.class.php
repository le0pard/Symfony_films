<?php

/**
 * UsersGroup form base class.
 *
 * @method UsersGroup getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 */
abstract class BaseUsersGroupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'name'                   => new sfWidgetFormInputText(),
      'description'            => new sfWidgetFormTextarea(),
      'users_users_group_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Users')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorPropelChoice(array('model' => 'UsersGroup', 'column' => 'id', 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 255)),
      'description'            => new sfValidatorString(array('required' => false)),
      'users_users_group_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Users', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'UsersGroup', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('users_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsersGroup';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['users_users_group_list']))
    {
      $values = array();
      foreach ($this->object->getUsersUsersGroups() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('users_users_group_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveUsersUsersGroupList($con);
  }

  public function saveUsersUsersGroupList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['users_users_group_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(UsersUsersGroupPeer::GROUP_ID, $this->object->getPrimaryKey());
    UsersUsersGroupPeer::doDelete($c, $con);

    $values = $this->getValue('users_users_group_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new UsersUsersGroup();
        $obj->setGroupId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}

<?php

/**
 * Users form base class.
 *
 * @method Users getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseUsersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'login'                  => new sfWidgetFormInputText(),
      'password'               => new sfWidgetFormInputText(),
      'password_salt'          => new sfWidgetFormInputText(),
      'email'                  => new sfWidgetFormInputText(),
      'website_blog'           => new sfWidgetFormInputText(),
      'avatar'                 => new sfWidgetFormInputText(),
      'gender'                 => new sfWidgetFormInputText(),
      'about'                  => new sfWidgetFormTextarea(),
      'last_login'             => new sfWidgetFormDateTime(),
      'is_active'              => new sfWidgetFormInputCheckbox(),
      'persistence_token'      => new sfWidgetFormInputText(),
      'is_super_admin'         => new sfWidgetFormInputCheckbox(),
      'count_of_films'         => new sfWidgetFormInputText(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'film_raiting_list'      => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Film')),
      'users_users_group_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'UsersGroup')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'login'                  => new sfValidatorString(array('max_length' => 100)),
      'password'               => new sfValidatorString(array('max_length' => 100)),
      'password_salt'          => new sfValidatorString(array('max_length' => 100)),
      'email'                  => new sfValidatorString(array('max_length' => 100)),
      'website_blog'           => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'avatar'                 => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'gender'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'about'                  => new sfValidatorString(array('required' => false)),
      'last_login'             => new sfValidatorDateTime(array('required' => false)),
      'is_active'              => new sfValidatorBoolean(),
      'persistence_token'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'is_super_admin'         => new sfValidatorBoolean(),
      'count_of_films'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
      'film_raiting_list'      => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Film', 'required' => false)),
      'users_users_group_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'UsersGroup', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'Users', 'column' => array('login'))),
        new sfValidatorPropelUnique(array('model' => 'Users', 'column' => array('email'))),
      ))
    );

    $this->widgetSchema->setNameFormat('users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['film_raiting_list']))
    {
      $values = array();
      foreach ($this->object->getFilmRaitings() as $obj)
      {
        $values[] = $obj->getFilmId();
      }

      $this->setDefault('film_raiting_list', $values);
    }

    if (isset($this->widgetSchema['users_users_group_list']))
    {
      $values = array();
      foreach ($this->object->getUsersUsersGroups() as $obj)
      {
        $values[] = $obj->getGroupId();
      }

      $this->setDefault('users_users_group_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveFilmRaitingList($con);
    $this->saveUsersUsersGroupList($con);
  }

  public function saveFilmRaitingList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['film_raiting_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(FilmRaitingPeer::USER_ID, $this->object->getPrimaryKey());
    FilmRaitingPeer::doDelete($c, $con);

    $values = $this->getValue('film_raiting_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new FilmRaiting();
        $obj->setUserId($this->object->getPrimaryKey());
        $obj->setFilmId($value);
        $obj->save();
      }
    }
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
    $c->add(UsersUsersGroupPeer::USER_ID, $this->object->getPrimaryKey());
    UsersUsersGroupPeer::doDelete($c, $con);

    $values = $this->getValue('users_users_group_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new UsersUsersGroup();
        $obj->setUserId($this->object->getPrimaryKey());
        $obj->setGroupId($value);
        $obj->save();
      }
    }
  }

}

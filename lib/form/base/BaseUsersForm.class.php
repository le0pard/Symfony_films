<?php

/**
 * Users form base class.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseUsersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'login'                  => new sfWidgetFormInput(),
      'password'               => new sfWidgetFormInput(),
      'email'                  => new sfWidgetFormInput(),
      'website_blog'           => new sfWidgetFormInput(),
      'avatar'                 => new sfWidgetFormInput(),
      'about'                  => new sfWidgetFormTextarea(),
      'last_login'             => new sfWidgetFormDateTime(),
      'is_active'              => new sfWidgetFormInputCheckbox(),
      'is_super_admin'         => new sfWidgetFormInputCheckbox(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'users_users_group_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'UsersGroup')),
      'film_raiting_list'      => new sfWidgetFormPropelChoiceMany(array('model' => 'Film')),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'login'                  => new sfValidatorString(array('max_length' => 100)),
      'password'               => new sfValidatorString(array('max_length' => 100)),
      'email'                  => new sfValidatorString(array('max_length' => 100)),
      'website_blog'           => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'avatar'                 => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'about'                  => new sfValidatorString(array('required' => false)),
      'last_login'             => new sfValidatorDateTime(array('required' => false)),
      'is_active'              => new sfValidatorBoolean(),
      'is_super_admin'         => new sfValidatorBoolean(),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
      'users_users_group_list' => new sfValidatorPropelChoiceMany(array('model' => 'UsersGroup', 'required' => false)),
      'film_raiting_list'      => new sfValidatorPropelChoiceMany(array('model' => 'Film', 'required' => false)),
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

    if (isset($this->widgetSchema['users_users_group_list']))
    {
      $values = array();
      foreach ($this->object->getUsersUsersGroups() as $obj)
      {
        $values[] = $obj->getGroupId();
      }

      $this->setDefault('users_users_group_list', $values);
    }

    if (isset($this->widgetSchema['film_raiting_list']))
    {
      $values = array();
      foreach ($this->object->getFilmRaitings() as $obj)
      {
        $values[] = $obj->getFilmId();
      }

      $this->setDefault('film_raiting_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveUsersUsersGroupList($con);
    $this->saveFilmRaitingList($con);
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

    if (is_null($con))
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

    if (is_null($con))
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

}

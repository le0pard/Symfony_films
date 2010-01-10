<?php

/**
 * Users filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseUsersFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'login'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'website_blog'           => new sfWidgetFormFilterInput(),
      'avatar'                 => new sfWidgetFormFilterInput(),
      'about'                  => new sfWidgetFormFilterInput(),
      'last_login'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'is_active'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'persistence_token'      => new sfWidgetFormFilterInput(),
      'is_super_admin'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'count_of_films'         => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'film_raiting_list'      => new sfWidgetFormPropelChoice(array('model' => 'Film', 'add_empty' => true)),
      'users_users_group_list' => new sfWidgetFormPropelChoice(array('model' => 'UsersGroup', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'login'                  => new sfValidatorPass(array('required' => false)),
      'password'               => new sfValidatorPass(array('required' => false)),
      'email'                  => new sfValidatorPass(array('required' => false)),
      'website_blog'           => new sfValidatorPass(array('required' => false)),
      'avatar'                 => new sfValidatorPass(array('required' => false)),
      'about'                  => new sfValidatorPass(array('required' => false)),
      'last_login'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'is_active'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'persistence_token'      => new sfValidatorPass(array('required' => false)),
      'is_super_admin'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'count_of_films'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'film_raiting_list'      => new sfValidatorPropelChoice(array('model' => 'Film', 'required' => false)),
      'users_users_group_list' => new sfValidatorPropelChoice(array('model' => 'UsersGroup', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('users_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addFilmRaitingListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(FilmRaitingPeer::USER_ID, UsersPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(FilmRaitingPeer::FILM_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(FilmRaitingPeer::FILM_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addUsersUsersGroupListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(UsersUsersGroupPeer::USER_ID, UsersPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(UsersUsersGroupPeer::GROUP_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(UsersUsersGroupPeer::GROUP_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Users';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'login'                  => 'Text',
      'password'               => 'Text',
      'email'                  => 'Text',
      'website_blog'           => 'Text',
      'avatar'                 => 'Text',
      'about'                  => 'Text',
      'last_login'             => 'Date',
      'is_active'              => 'Boolean',
      'persistence_token'      => 'Text',
      'is_super_admin'         => 'Boolean',
      'count_of_films'         => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'film_raiting_list'      => 'ManyKey',
      'users_users_group_list' => 'ManyKey',
    );
  }
}

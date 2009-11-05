<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * UsersGroup filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseUsersGroupFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(),
      'description'            => new sfWidgetFormFilterInput(),
      'users_users_group_list' => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'description'            => new sfValidatorPass(array('required' => false)),
      'users_users_group_list' => new sfValidatorPropelChoice(array('model' => 'Users', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('users_group_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
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

    $criteria->addJoin(UsersUsersGroupPeer::GROUP_ID, UsersGroupPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(UsersUsersGroupPeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(UsersUsersGroupPeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'UsersGroup';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'name'                   => 'Text',
      'description'            => 'Text',
      'users_users_group_list' => 'ManyKey',
    );
  }
}

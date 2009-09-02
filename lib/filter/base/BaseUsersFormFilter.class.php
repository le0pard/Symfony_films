<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Users filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseUsersFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'login'             => new sfWidgetFormFilterInput(),
      'password'          => new sfWidgetFormFilterInput(),
      'email'             => new sfWidgetFormFilterInput(),
      'website_blog'      => new sfWidgetFormFilterInput(),
      'avatar'            => new sfWidgetFormFilterInput(),
      'about'             => new sfWidgetFormFilterInput(),
      'right_id'          => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'film_raiting_list' => new sfWidgetFormPropelChoice(array('model' => 'Film', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'login'             => new sfValidatorPass(array('required' => false)),
      'password'          => new sfValidatorPass(array('required' => false)),
      'email'             => new sfValidatorPass(array('required' => false)),
      'website_blog'      => new sfValidatorPass(array('required' => false)),
      'avatar'            => new sfValidatorPass(array('required' => false)),
      'about'             => new sfValidatorPass(array('required' => false)),
      'right_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'film_raiting_list' => new sfValidatorPropelChoice(array('model' => 'Film', 'required' => false)),
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

  public function getModelName()
  {
    return 'Users';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'login'             => 'Text',
      'password'          => 'Text',
      'email'             => 'Text',
      'website_blog'      => 'Text',
      'avatar'            => 'Text',
      'about'             => 'Text',
      'right_id'          => 'Number',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'film_raiting_list' => 'ManyKey',
    );
  }
}

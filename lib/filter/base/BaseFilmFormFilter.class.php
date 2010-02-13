<?php

/**
 * Film filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 */
abstract class BaseFilmFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'              => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
      'title'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'original_title'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'normal_logo'          => new sfWidgetFormFilterInput(),
      'thumb_logo'           => new sfWidgetFormFilterInput(),
      'url'                  => new sfWidgetFormFilterInput(),
      'pub_year'             => new sfWidgetFormFilterInput(),
      'director'             => new sfWidgetFormFilterInput(),
      'cast'                 => new sfWidgetFormFilterInput(),
      'about'                => new sfWidgetFormFilterInput(),
      'country'              => new sfWidgetFormFilterInput(),
      'duration'             => new sfWidgetFormFilterInput(),
      'file_info'            => new sfWidgetFormFilterInput(),
      'is_visible'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_private'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_public'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'modified_user_id'     => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
      'modified_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'modified_text'        => new sfWidgetFormFilterInput(),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'film_raiting_list'    => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
      'film_film_types_list' => new sfWidgetFormPropelChoice(array('model' => 'FilmTypes', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Users', 'column' => 'id')),
      'title'                => new sfValidatorPass(array('required' => false)),
      'original_title'       => new sfValidatorPass(array('required' => false)),
      'normal_logo'          => new sfValidatorPass(array('required' => false)),
      'thumb_logo'           => new sfValidatorPass(array('required' => false)),
      'url'                  => new sfValidatorPass(array('required' => false)),
      'pub_year'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'director'             => new sfValidatorPass(array('required' => false)),
      'cast'                 => new sfValidatorPass(array('required' => false)),
      'about'                => new sfValidatorPass(array('required' => false)),
      'country'              => new sfValidatorPass(array('required' => false)),
      'duration'             => new sfValidatorPass(array('required' => false)),
      'file_info'            => new sfValidatorPass(array('required' => false)),
      'is_visible'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_private'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_public'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'modified_user_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Users', 'column' => 'id')),
      'modified_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'modified_text'        => new sfValidatorPass(array('required' => false)),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'film_raiting_list'    => new sfValidatorPropelChoice(array('model' => 'Users', 'required' => false)),
      'film_film_types_list' => new sfValidatorPropelChoice(array('model' => 'FilmTypes', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('film_filters[%s]');

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

    $criteria->addJoin(FilmRaitingPeer::FILM_ID, FilmPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(FilmRaitingPeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(FilmRaitingPeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addFilmFilmTypesListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(FilmFilmTypesPeer::FILM_ID, FilmPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(FilmFilmTypesPeer::FILM_GENRE_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(FilmFilmTypesPeer::FILM_GENRE_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Film';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'user_id'              => 'ForeignKey',
      'title'                => 'Text',
      'original_title'       => 'Text',
      'normal_logo'          => 'Text',
      'thumb_logo'           => 'Text',
      'url'                  => 'Text',
      'pub_year'             => 'Number',
      'director'             => 'Text',
      'cast'                 => 'Text',
      'about'                => 'Text',
      'country'              => 'Text',
      'duration'             => 'Text',
      'file_info'            => 'Text',
      'is_visible'           => 'Boolean',
      'is_private'           => 'Boolean',
      'is_public'            => 'Boolean',
      'modified_user_id'     => 'ForeignKey',
      'modified_at'          => 'Date',
      'modified_text'        => 'Text',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
      'film_raiting_list'    => 'ManyKey',
      'film_film_types_list' => 'ManyKey',
    );
  }
}

<?php

/**
 * FilmTypes filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFilmTypesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'url'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'logo'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'          => new sfWidgetFormFilterInput(),
      'is_visible'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_not_main'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'film_film_types_list' => new sfWidgetFormPropelChoice(array('model' => 'Film', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'title'                => new sfValidatorPass(array('required' => false)),
      'url'                  => new sfValidatorPass(array('required' => false)),
      'logo'                 => new sfValidatorPass(array('required' => false)),
      'description'          => new sfValidatorPass(array('required' => false)),
      'is_visible'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_not_main'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'film_film_types_list' => new sfValidatorPropelChoice(array('model' => 'Film', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('film_types_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
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

    $criteria->addJoin(FilmFilmTypesPeer::FILM_GENRE_ID, FilmTypesPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(FilmFilmTypesPeer::FILM_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(FilmFilmTypesPeer::FILM_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'FilmTypes';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'title'                => 'Text',
      'url'                  => 'Text',
      'logo'                 => 'Text',
      'description'          => 'Text',
      'is_visible'           => 'Boolean',
      'is_not_main'          => 'Boolean',
      'created_at'           => 'Date',
      'film_film_types_list' => 'ManyKey',
    );
  }
}

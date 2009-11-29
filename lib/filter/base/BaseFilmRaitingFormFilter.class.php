<?php

/**
 * FilmRaiting filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseFilmRaitingFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'raiting' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'raiting' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('film_raiting_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmRaiting';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'film_id' => 'ForeignKey',
      'user_id' => 'ForeignKey',
      'raiting' => 'Number',
    );
  }
}

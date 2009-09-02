<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * FilmRaiting filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseFilmRaitingFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'raiting' => new sfWidgetFormFilterInput(),
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

<?php

/**
 * FilmRaiting form base class.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseFilmRaitingForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'film_id' => new sfWidgetFormInputHidden(),
      'user_id' => new sfWidgetFormInputHidden(),
      'raiting' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorPropelChoice(array('model' => 'FilmRaiting', 'column' => 'id', 'required' => false)),
      'film_id' => new sfValidatorPropelChoice(array('model' => 'Film', 'column' => 'id', 'required' => false)),
      'user_id' => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'raiting' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('film_raiting[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmRaiting';
  }


}

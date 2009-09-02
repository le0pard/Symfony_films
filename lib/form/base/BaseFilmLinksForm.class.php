<?php

/**
 * FilmLinks form base class.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseFilmLinksForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'film_id' => new sfWidgetFormInputHidden(),
      'title'   => new sfWidgetFormInput(),
      'url'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorPropelChoice(array('model' => 'FilmLinks', 'column' => 'id', 'required' => false)),
      'film_id' => new sfValidatorPropelChoice(array('model' => 'Film', 'column' => 'id', 'required' => false)),
      'title'   => new sfValidatorString(array('max_length' => 200)),
      'url'     => new sfValidatorString(array('max_length' => 500)),
    ));

    $this->widgetSchema->setNameFormat('film_links[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmLinks';
  }


}

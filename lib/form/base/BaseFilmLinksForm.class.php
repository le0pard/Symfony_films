<?php

/**
 * FilmLinks form base class.
 *
 * @method FilmLinks getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 */
abstract class BaseFilmLinksForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'film_id'    => new sfWidgetFormInputHidden(),
      'title'      => new sfWidgetFormInputText(),
      'url'        => new sfWidgetFormInputText(),
      'sort'       => new sfWidgetFormInputText(),
      'hash'       => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'film_id'    => new sfValidatorPropelChoice(array('model' => 'Film', 'column' => 'id', 'required' => false)),
      'title'      => new sfValidatorString(array('max_length' => 200)),
      'url'        => new sfValidatorString(array('max_length' => 500)),
      'sort'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'hash'       => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
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

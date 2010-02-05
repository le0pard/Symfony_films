<?php

/**
 * FilmNews form base class.
 *
 * @method FilmNews getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFilmNewsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'title'       => new sfWidgetFormInputText(),
      'url'         => new sfWidgetFormInputText(),
      'img'         => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'is_visible'  => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'FilmNews', 'column' => 'id', 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 500)),
      'url'         => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'img'         => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'is_visible'  => new sfValidatorBoolean(),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('film_news[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmNews';
  }


}

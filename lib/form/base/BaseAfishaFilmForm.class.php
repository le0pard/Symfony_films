<?php

/**
 * AfishaFilm form base class.
 *
 * @method AfishaFilm getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAfishaFilmForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'external_id' => new sfWidgetFormInputText(),
      'title'       => new sfWidgetFormInputText(),
      'orig_title'  => new sfWidgetFormInputText(),
      'year'        => new sfWidgetFormInputText(),
      'poster'      => new sfWidgetFormInputText(),
      'link'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'video_tag'   => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'AfishaFilm', 'column' => 'id', 'required' => false)),
      'external_id' => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 500)),
      'orig_title'  => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'year'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'poster'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'video_tag'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('afisha_film[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaFilm';
  }


}

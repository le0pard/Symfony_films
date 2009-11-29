<?php

/**
 * FilmGallery form base class.
 *
 * @method FilmGallery getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseFilmGalleryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'film_id'    => new sfWidgetFormInputHidden(),
      'thumb_img'  => new sfWidgetFormInputText(),
      'normal_img' => new sfWidgetFormInputText(),
      'sort'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'FilmGallery', 'column' => 'id', 'required' => false)),
      'film_id'    => new sfValidatorPropelChoice(array('model' => 'Film', 'column' => 'id', 'required' => false)),
      'thumb_img'  => new sfValidatorString(array('max_length' => 500)),
      'normal_img' => new sfValidatorString(array('max_length' => 500)),
      'sort'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('film_gallery[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmGallery';
  }


}

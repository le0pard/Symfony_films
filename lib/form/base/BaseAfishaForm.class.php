<?php

/**
 * Afisha form base class.
 *
 * @method Afisha getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAfishaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'external_id'       => new sfWidgetFormInputText(),
      'afisha_theater_id' => new sfWidgetFormPropelChoice(array('model' => 'AfishaTheater', 'add_empty' => false)),
      'afisha_film_id'    => new sfWidgetFormPropelChoice(array('model' => 'AfishaFilm', 'add_empty' => false)),
      'afisha_zal_id'     => new sfWidgetFormPropelChoice(array('model' => 'AfishaZal', 'add_empty' => false)),
      'link'              => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
      'date_begin'        => new sfWidgetFormDateTime(),
      'date_end'          => new sfWidgetFormDateTime(),
      'times'             => new sfWidgetFormTextarea(),
      'prices'            => new sfWidgetFormTextarea(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'Afisha', 'column' => 'id', 'required' => false)),
      'external_id'       => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'afisha_theater_id' => new sfValidatorPropelChoice(array('model' => 'AfishaTheater', 'column' => 'id')),
      'afisha_film_id'    => new sfValidatorPropelChoice(array('model' => 'AfishaFilm', 'column' => 'id')),
      'afisha_zal_id'     => new sfValidatorPropelChoice(array('model' => 'AfishaZal', 'column' => 'id')),
      'link'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'       => new sfValidatorString(array('required' => false)),
      'date_begin'        => new sfValidatorDateTime(),
      'date_end'          => new sfValidatorDateTime(),
      'times'             => new sfValidatorString(array('required' => false)),
      'prices'            => new sfValidatorString(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('afisha[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Afisha';
  }


}

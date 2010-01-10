<?php

/**
 * AfishaZal form base class.
 *
 * @method AfishaZal getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAfishaZalForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'afisha_theater_id' => new sfWidgetFormPropelChoice(array('model' => 'AfishaTheater', 'add_empty' => false)),
      'afisha_id'         => new sfWidgetFormPropelChoice(array('model' => 'Afisha', 'add_empty' => false)),
      'title'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'AfishaZal', 'column' => 'id', 'required' => false)),
      'afisha_theater_id' => new sfValidatorPropelChoice(array('model' => 'AfishaTheater', 'column' => 'id')),
      'afisha_id'         => new sfValidatorPropelChoice(array('model' => 'Afisha', 'column' => 'id')),
      'title'             => new sfValidatorString(array('max_length' => 500)),
    ));

    $this->widgetSchema->setNameFormat('afisha_zal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AfishaZal';
  }


}

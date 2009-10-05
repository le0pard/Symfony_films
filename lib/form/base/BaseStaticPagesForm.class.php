<?php

/**
 * StaticPages form base class.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseStaticPagesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'title'       => new sfWidgetFormInput(),
      'url'         => new sfWidgetFormInput(),
      'sort'        => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
      'is_visible'  => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'StaticPages', 'column' => 'id', 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 500)),
      'url'         => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'sort'        => new sfValidatorInteger(array('required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'is_visible'  => new sfValidatorBoolean(),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('static_pages[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StaticPages';
  }


}

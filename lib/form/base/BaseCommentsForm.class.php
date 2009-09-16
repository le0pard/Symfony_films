<?php

/**
 * Comments form base class.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCommentsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => false)),
      'comment_type_id'   => new sfWidgetFormInput(),
      'comment_type_name' => new sfWidgetFormInput(),
      'description'       => new sfWidgetFormTextarea(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'Comments', 'column' => 'id', 'required' => false)),
      'user_id'           => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id')),
      'comment_type_id'   => new sfValidatorInteger(),
      'comment_type_name' => new sfValidatorString(array('max_length' => 500)),
      'description'       => new sfValidatorString(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('comments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comments';
  }


}

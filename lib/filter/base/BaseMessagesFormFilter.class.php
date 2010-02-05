<?php

/**
 * Messages filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMessagesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'from_user_id' => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
      'to_user_id'   => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
      'message_type' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'from_user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Users', 'column' => 'id')),
      'to_user_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Users', 'column' => 'id')),
      'message_type' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description'  => new sfValidatorPass(array('required' => false)),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('messages_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Messages';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'from_user_id' => 'ForeignKey',
      'to_user_id'   => 'ForeignKey',
      'message_type' => 'Number',
      'description'  => 'Text',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}

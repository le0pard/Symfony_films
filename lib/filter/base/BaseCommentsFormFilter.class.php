<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Comments filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseCommentsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
      'comment_type_id'   => new sfWidgetFormFilterInput(),
      'comment_type_name' => new sfWidgetFormFilterInput(),
      'description'       => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Users', 'column' => 'id')),
      'comment_type_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comment_type_name' => new sfValidatorPass(array('required' => false)),
      'description'       => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('comments_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comments';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'user_id'           => 'ForeignKey',
      'comment_type_id'   => 'Number',
      'comment_type_name' => 'Text',
      'description'       => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}

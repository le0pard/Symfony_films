<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * FilmGallery filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseFilmGalleryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'thumb_img'  => new sfWidgetFormFilterInput(),
      'normal_img' => new sfWidgetFormFilterInput(),
      'sort'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'thumb_img'  => new sfValidatorPass(array('required' => false)),
      'normal_img' => new sfValidatorPass(array('required' => false)),
      'sort'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('film_gallery_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmGallery';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'film_id'    => 'ForeignKey',
      'thumb_img'  => 'Text',
      'normal_img' => 'Text',
      'sort'       => 'Number',
    );
  }
}

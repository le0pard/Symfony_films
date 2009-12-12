<?php

/**
 * FilmGallery filter form base class.
 *
 * @package    symfony_films
 * @subpackage filter
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFilmGalleryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'thumb_img'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'normal_img' => new sfWidgetFormFilterInput(array('with_empty' => false)),
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

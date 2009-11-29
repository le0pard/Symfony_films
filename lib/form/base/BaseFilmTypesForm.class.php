<?php

/**
 * FilmTypes form base class.
 *
 * @method FilmTypes getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseFilmTypesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'title'                => new sfWidgetFormInputText(),
      'url'                  => new sfWidgetFormInputText(),
      'logo'                 => new sfWidgetFormInputText(),
      'description'          => new sfWidgetFormTextarea(),
      'is_visible'           => new sfWidgetFormInputCheckbox(),
      'is_not_main'          => new sfWidgetFormInputCheckbox(),
      'created_at'           => new sfWidgetFormDateTime(),
      'film_film_types_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Film')),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorPropelChoice(array('model' => 'FilmTypes', 'column' => 'id', 'required' => false)),
      'title'                => new sfValidatorString(array('max_length' => 500)),
      'url'                  => new sfValidatorString(array('max_length' => 500)),
      'logo'                 => new sfValidatorString(array('max_length' => 500)),
      'description'          => new sfValidatorString(array('required' => false)),
      'is_visible'           => new sfValidatorBoolean(),
      'is_not_main'          => new sfValidatorBoolean(),
      'created_at'           => new sfValidatorDateTime(array('required' => false)),
      'film_film_types_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Film', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('film_types[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'FilmTypes';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['film_film_types_list']))
    {
      $values = array();
      foreach ($this->object->getFilmFilmTypess() as $obj)
      {
        $values[] = $obj->getFilmId();
      }

      $this->setDefault('film_film_types_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveFilmFilmTypesList($con);
  }

  public function saveFilmFilmTypesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['film_film_types_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(FilmFilmTypesPeer::FILM_GENRE_ID, $this->object->getPrimaryKey());
    FilmFilmTypesPeer::doDelete($c, $con);

    $values = $this->getValue('film_film_types_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new FilmFilmTypes();
        $obj->setFilmGenreId($this->object->getPrimaryKey());
        $obj->setFilmId($value);
        $obj->save();
      }
    }
  }

}

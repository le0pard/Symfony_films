<?php

/**
 * Film form base class.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseFilmForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'user_id'              => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => false)),
      'title'                => new sfWidgetFormInput(),
      'original_title'       => new sfWidgetFormInput(),
      'normal_logo'          => new sfWidgetFormInput(),
      'thumb_logo'           => new sfWidgetFormInput(),
      'url'                  => new sfWidgetFormInput(),
      'pub_year'             => new sfWidgetFormInput(),
      'director'             => new sfWidgetFormInput(),
      'cast'                 => new sfWidgetFormInput(),
      'about'                => new sfWidgetFormTextarea(),
      'country'              => new sfWidgetFormInput(),
      'duration'             => new sfWidgetFormInput(),
      'file_info'            => new sfWidgetFormTextarea(),
      'is_visible'           => new sfWidgetFormInputCheckbox(),
      'is_private'           => new sfWidgetFormInputCheckbox(),
      'is_public'            => new sfWidgetFormInputCheckbox(),
      'update_data'          => new sfWidgetFormDateTime(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
      'film_film_types_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'FilmTypes')),
      'film_raiting_list'    => new sfWidgetFormPropelChoiceMany(array('model' => 'Users')),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorPropelChoice(array('model' => 'Film', 'column' => 'id', 'required' => false)),
      'user_id'              => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id')),
      'title'                => new sfValidatorString(array('max_length' => 500)),
      'original_title'       => new sfValidatorString(array('max_length' => 500)),
      'normal_logo'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'thumb_logo'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'                  => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'pub_year'             => new sfValidatorInteger(array('required' => false)),
      'director'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'cast'                 => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'about'                => new sfValidatorString(array('required' => false)),
      'country'              => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'duration'             => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'file_info'            => new sfValidatorString(array('required' => false)),
      'is_visible'           => new sfValidatorBoolean(),
      'is_private'           => new sfValidatorBoolean(),
      'is_public'            => new sfValidatorBoolean(),
      'update_data'          => new sfValidatorDateTime(array('required' => false)),
      'created_at'           => new sfValidatorDateTime(array('required' => false)),
      'updated_at'           => new sfValidatorDateTime(array('required' => false)),
      'film_film_types_list' => new sfValidatorPropelChoiceMany(array('model' => 'FilmTypes', 'required' => false)),
      'film_raiting_list'    => new sfValidatorPropelChoiceMany(array('model' => 'Users', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('film[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Film';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['film_film_types_list']))
    {
      $values = array();
      foreach ($this->object->getFilmFilmTypess() as $obj)
      {
        $values[] = $obj->getFilmGenreId();
      }

      $this->setDefault('film_film_types_list', $values);
    }

    if (isset($this->widgetSchema['film_raiting_list']))
    {
      $values = array();
      foreach ($this->object->getFilmRaitings() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('film_raiting_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveFilmFilmTypesList($con);
    $this->saveFilmRaitingList($con);
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

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(FilmFilmTypesPeer::FILM_ID, $this->object->getPrimaryKey());
    FilmFilmTypesPeer::doDelete($c, $con);

    $values = $this->getValue('film_film_types_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new FilmFilmTypes();
        $obj->setFilmId($this->object->getPrimaryKey());
        $obj->setFilmGenreId($value);
        $obj->save();
      }
    }
  }

  public function saveFilmRaitingList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['film_raiting_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(FilmRaitingPeer::FILM_ID, $this->object->getPrimaryKey());
    FilmRaitingPeer::doDelete($c, $con);

    $values = $this->getValue('film_raiting_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new FilmRaiting();
        $obj->setFilmId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}

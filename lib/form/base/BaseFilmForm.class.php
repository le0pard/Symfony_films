<?php

/**
 * Film form base class.
 *
 * @method Film getObject() Returns the current form's model object
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 */
abstract class BaseFilmForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'user_id'              => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => false)),
      'title'                => new sfWidgetFormInputText(),
      'original_title'       => new sfWidgetFormInputText(),
      'normal_logo'          => new sfWidgetFormInputText(),
      'thumb_logo'           => new sfWidgetFormInputText(),
      'url'                  => new sfWidgetFormInputText(),
      'pub_year'             => new sfWidgetFormInputText(),
      'director'             => new sfWidgetFormInputText(),
      'cast_people'          => new sfWidgetFormInputText(),
      'about'                => new sfWidgetFormTextarea(),
      'country'              => new sfWidgetFormInputText(),
      'duration'             => new sfWidgetFormInputText(),
      'file_info'            => new sfWidgetFormTextarea(),
      'is_visible'           => new sfWidgetFormInputCheckbox(),
      'is_private'           => new sfWidgetFormInputCheckbox(),
      'is_public'            => new sfWidgetFormInputCheckbox(),
      'modified_user_id'     => new sfWidgetFormPropelChoice(array('model' => 'Users', 'add_empty' => true)),
      'modified_at'          => new sfWidgetFormDateTime(),
      'modified_text'        => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
      'film_raiting_list'    => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Users')),
      'film_film_types_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'FilmTypes')),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'              => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id')),
      'title'                => new sfValidatorString(array('max_length' => 500)),
      'original_title'       => new sfValidatorString(array('max_length' => 500)),
      'normal_logo'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'thumb_logo'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'                  => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'pub_year'             => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'director'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'cast_people'          => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'about'                => new sfValidatorString(array('required' => false)),
      'country'              => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'duration'             => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'file_info'            => new sfValidatorString(array('required' => false)),
      'is_visible'           => new sfValidatorBoolean(),
      'is_private'           => new sfValidatorBoolean(),
      'is_public'            => new sfValidatorBoolean(),
      'modified_user_id'     => new sfValidatorPropelChoice(array('model' => 'Users', 'column' => 'id', 'required' => false)),
      'modified_at'          => new sfValidatorDateTime(array('required' => false)),
      'modified_text'        => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'created_at'           => new sfValidatorDateTime(array('required' => false)),
      'updated_at'           => new sfValidatorDateTime(array('required' => false)),
      'film_raiting_list'    => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Users', 'required' => false)),
      'film_film_types_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'FilmTypes', 'required' => false)),
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

    if (isset($this->widgetSchema['film_raiting_list']))
    {
      $values = array();
      foreach ($this->object->getFilmRaitings() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('film_raiting_list', $values);
    }

    if (isset($this->widgetSchema['film_film_types_list']))
    {
      $values = array();
      foreach ($this->object->getFilmFilmTypess() as $obj)
      {
        $values[] = $obj->getFilmGenreId();
      }

      $this->setDefault('film_film_types_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveFilmRaitingList($con);
    $this->saveFilmFilmTypesList($con);
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

    if (null === $con)
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

}

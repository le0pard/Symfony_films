<?php

/**
 * AfishaTheater form.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class BackendAfishaTheaterForm extends BaseAfishaTheaterForm
{
  public function configure()
  {
  	unset(
      $this['created_at'], $this['updated_at'],
      $this['external_id'], $this['afisha_city_id']
    );
    
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'title'                => new sfWidgetFormInputText(),
      'link'                 => new sfWidgetFormInputText(),
      'address'              => new sfWidgetFormInputText(),
      'phone'                => new sfWidgetFormInputText(),
      'latitude'             => new sfWidgetFormInputText(),
      'longitude'            => new sfWidgetFormInputText(),
      'normal_telephone'     => new sfWidgetFormInputText(),
      'description'          => new sfWidgetFormTextareaTinyMCE(array(
          'config' => 'language : "ru"'), 
          array('rows' => 5, 'cols' => 30, 'class' => 'TinyMCE'))
    ));
    
    $this->widgetSchema->setLabels(array(
	    'title'   => 'Название',
	    'link'  => 'Ссылка',
	    'address' => 'Адрес',
	    'phone'   => 'Телефоны',
	    'description' => 'Описание',
	    'latitude' => 'Широта',
	    'longitude' => 'Долгота',
	    'normal_telephone' => 'Телефон для бронирования'
	  ));
 
    $this->validatorSchema->setOption('allow_extra_fields', true);
    
    $this->widgetSchema->setNameFormat('afisha_theater[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

  }
}

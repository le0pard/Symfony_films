<?php

/**
 * FilmLinks form.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class FrontFilmLinksForm extends BaseFilmLinksForm
{
	
  public function __construct(BaseObject $object = null, $options = array(), $CSRFSecret = null)
  {
    parent::__construct($object, $options, false);
  }
	
  public function configure()
  {
  	unset(
      $this['created_at'], $this['updated_at']
    );
	$this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'film_id'    => new sfWidgetFormInputHidden(),
      'title'      => new sfWidgetFormInput(),
      'url'        => new sfWidgetFormInput()
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'FilmLinks', 'column' => 'id', 'required' => false)),
      'film_id'    => new sfValidatorPropelChoice(array('model' => 'Film', 'column' => 'id', 'required' => true)),
      'title'      => new sfValidatorString(array('max_length' => 100, 'required' => true), 
	  					array('required' => 'Название для ссылки нужно указать.', 
							  'max_length' => 'Cлишком длинное название (Максимальная длинна %max_length% символа).')),
      'url'        => new sfValidatorAnd(array(
	  					new sfValidatorString(array('max_length' => 300, 'required' => true), 
	  					array('required' => 'Ссылку нужно указать.', 
							  'max_length' => 'Cлишком длинная ссылка (Максимальная длинна %max_length% символа).')),
						new sfValidatorRegex(array('pattern' => '~^(https?://|ftps?://|magnet\:\?xt=)(\S+)$~ix'), array('invalid' => 'Некрасивая ссылка.'))
					  ), array('required' => true), 
					  	 array('required' => 'Ссылку нужно указать.'))
    ));

    $this->widgetSchema->setNameFormat('film_links[%s]');
	
	$this->widgetSchema->setLabels(array(
	  'title'   => 'Заглавие для ссылки',
	  'url'	=> 'Ссылка'
	));
	
	$this->validatorSchema->setOption('allow_extra_fields', true);
  }
}

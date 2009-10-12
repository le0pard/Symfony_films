<?php

/**
 * FilmTypes form.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class BackendFilmTypesForm extends BaseFilmTypesForm
{
  public function configure()
  {
  	unset(
      $this['created_at'], $this['url'],
      $this['logo'], $this['film_film_types_list']
    );
	
	$this->widgetSchema['description'] = new sfWidgetFormTextareaTinyMCE(array(
					'config' => 'language : "ru"'), 
					array('rows' => 5, 'cols' => 30, 'class' => 'TinyMCE'));
	
	$this->widgetSchema['logo'] = new sfWidgetFormInputFileEditable(array(
      'label'     => 'Иконка',
      'file_src'  => '/uploads/cathegory/'.$this->getObject()->getLogo(),
      'is_image'  => true,
	  'delete_label' => 'Удалить?',
      'edit_mode' => !$this->isNew(),
      'template'  => '%file%<br />%input%<br />%delete% %delete_label%',
    ));
	$this->validatorSchema['logo'] = new sfValidatorFile(array(
	  'required'   => false,
	  'path'       => sfConfig::get('sf_upload_dir').'/cathegory',
	  'mime_types' => 'web_images'
	));
 
    $this->validatorSchema['logo_delete'] = new sfValidatorPass();
	
	$this->validatorSchema->setOption('allow_extra_fields', true);

  }
}

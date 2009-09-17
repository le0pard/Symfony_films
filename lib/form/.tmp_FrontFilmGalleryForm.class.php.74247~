<?php

/**
 * FilmGallery form.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class FrontFilmGalleryForm extends BaseFilmGalleryForm
{
  public function configure()
  {
  	unset(
      $this['normal_img']
    );
	
	$this->widgetSchema['id'] = new sfWidgetFormInputHidden();
	$this->validatorSchema['id'] = new sfValidatorPropelChoice(array('model' => 'FilmGallery', 'column' => 'id', 'required' => false));
	
	$this->widgetSchema['film_id'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['film_id'] = new sfValidatorPropelChoice(array('model' => 'Film', 'column' => 'id', 'required' => false));
	
	if ($this->getObject()->isNew()){
		$this->redefineFieldsByDef();
	} else {
		$this->widgetSchema['thumb_img'] = new sfWidgetFormInputFileEditable(array(
	      'label'     => '&nbsp;',
	      'file_src'  => '/uploads/gallery/'.$this->getObject()->getFilmId().'/'.$this->getObject()->getThumbImg(),
	      'is_image'  => true,
		  'delete_label' => 'Удалить?',
	      'edit_mode' => !$this->isNew(),
	      'template'  => '<div class="gallery_cell">%file% %input%</div>',
	    ));
		$this->validatorSchema['thumb_img'] = new sfValidatorFile(array(
		  'required'   => true,
		  'max_size'   => sfConfig::get('app_films_gallery_size'),
		  'path'       => sfConfig::get('sf_upload_dir').'/gallery/'.$this->getObject()->getFilmId(),
		  'mime_types' => 'web_images',
		  'validated_file_class' => 'sfGalleryFile'
		), array('required' => 'А где картинка?', 'max_size' => 'Загружать до '.round((sfConfig::get('app_films_gallery_size')/1048576), 3).' Мб!', 'mime_types' => 'Загружать можно только картинки!'));
		$this->widgetSchema->setHelp('thumb_img', '<span class="delete"><a onclick="javascript:return confirm(\'Действительно удалить скриншот?\');" href="'.sfContext::getInstance()->getRouting()->generate('film_delete_gallery', $this->getObject()).'">Удалить</a></span>');
	}
	
	$this->widgetSchema->setNameFormat('gallery[%s]');
	
	$this->validatorSchema->setOption('allow_extra_fields', true);
  }
  
  public function redefineFieldsByDef(){
  	$this->widgetSchema['thumb_img'] = new sfWidgetFormInputFileEditable(array(
      'label'     => '&nbsp;',
      'file_src'  => '/uploads/gallery/'.$this->getDefault('film_id').'/'.$this->getObject()->getThumbImg(),
      'is_image'  => true,
	  'delete_label' => 'Удалить?',
      'edit_mode' => !$this->isNew(),
      'template'  => '<div class="gallery_cell">%file% %input%</div>',
    ));
	$this->validatorSchema['thumb_img'] = new sfValidatorFile(array(
	  'required'   => true,
	  'max_size'   => sfConfig::get('app_films_gallery_size'),
	  'path'       => sfConfig::get('sf_upload_dir').'/gallery/'.$this->getDefault('film_id'),
	  'mime_types' => 'web_images',
	  'validated_file_class' => 'sfGalleryFile'
	), array('required' => 'А где картинка?', 'max_size' => 'Загружать до '.round((sfConfig::get('app_films_gallery_size')/1048576), 3).' Мб!', 'mime_types' => 'Загружать можно только картинки!'));
  }
}

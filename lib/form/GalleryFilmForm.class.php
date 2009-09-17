<?php

/**
 * Film form.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class GalleryFilmForm extends BaseFilmForm
{
  public function configure()
  {
  	unset(
      $this['created_at'], $this['updated_at'],
      $this['update_data'], $this['url'],
	  $this['is_private'], $this['is_visible'],
	  $this['user_id'], $this['film_raiting_list'],
	  $this['thumb_logo'], $this['id'], 
	  $this['title'], $this['original_title'], 
	  $this['film_film_types_list'], $this['pub_year'], 
	  $this['director'], $this['cast'], 
	  $this['about'], $this['country'], 
	  $this['duration'], $this['file_info'], 
	  $this['normal_logo'], $this['is_public']
    );
	
	if (!$this->getObject()->isNew()){
		$i = 1;
		foreach ($this->getObject()->getGallery() as $subitems) {  
			$subitems_form = new FrontFilmGalleryForm($subitems);  
			$this->embedForm('gallery'.$subitems->getId(), $subitems_form);
			$this->widgetSchema->setLabel('gallery'.$subitems->getId(), 'Скриншот #'.$i);
			$i++;
		}
	}
	
	$this->widgetSchema->setNameFormat('film_gallery[%s]');
	
	$this->validatorSchema->setOption('allow_extra_fields', true);

  }
}

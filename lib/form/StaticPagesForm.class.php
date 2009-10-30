<?php

/**
 * StaticPages form.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class StaticPagesForm extends BaseStaticPagesForm
{
  public function configure()
  {
  	unset(
      $this['created_at'], $this['updated_at'], $this['url']
    );
	
	$this->widgetSchema['description'] = new sfWidgetFormTextareaTinyMCE(array(
					'config' => 'language : "ru"'), 
					array('rows' => 10, 'cols' => 50, 'class' => 'TinyMCE'));
	
	$this->validatorSchema->setOption('allow_extra_fields', true);
  }
}

<?php

/**
 * Comments form.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class CommentsForm extends BaseCommentsForm
{
  public function configure()
  {
  	unset(
      $this['created_at'], $this['updated_at'],
      $this['user_id'], $this['film_id']
    );
	
	$this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'description'       => new sfWidgetFormTextareaTinyMCE(
	  				array('theme' => 'advanced','config' => '
							skin : "o2k7", 
							language : "ru",
							plugins : "inlinepopups",
							theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code",
							theme_advanced_buttons2 : "",
							theme_advanced_buttons3 : "",
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom"
							'), 
					array('rows' => 5, 'cols' => 50, 'class' => 'TinyMCE')
	)
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'Comments', 'column' => 'id', 'required' => false)),
      'description'       => new sfValidatorString(array('required' => true), array('required' => 'Коментарий нужно написать'))
    ));
	
	$this->widgetSchema->setLabels(array(
	  'description'   => 'Коментарий'
	));

    $this->widgetSchema->setNameFormat('comments[%s]');
  }
}

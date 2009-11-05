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
      $this['user_id']
    );
	
	$this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'comment_type_id'   => new sfWidgetFormInputHidden(),
      'comment_type_name' => new sfWidgetFormInputHidden(),
      'description'       => new sfWidgetFormTextareaTinyMCE(
	  				array('theme' => 'advanced','config' => '
							skin : "o2k7", 
							language : "ru",
							plugins : "safari,spellchecker,table,advimage,advlink,searchreplace,contextmenu,paste,directionality,fullscreen",
							theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
							theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,forecolor,backcolor",
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : true,
							'), 
					array('rows' => 5, 'cols' => 50, 'class' => 'TinyMCE')
	)
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'Comments', 'column' => 'id', 'required' => false)),
      'comment_type_id'   => new sfValidatorInteger(array('required' => true, 'min' => 1), array('required' => 'НЛОшибка!', 'min' => 'НЛОшибка!')),
      'comment_type_name' => new sfValidatorString(array('max_length' => 500, 'required' => true), array('required' => 'НЛОшибка!', 'max_length' => 'НЛОшибка!')),
      'description'       => new sfValidatorString(array('required' => true), array('required' => 'Коментарий нужно написать'))
    ));
	
	$this->widgetSchema->setLabels(array(
	  'description'   => 'Коментарий'
	));

    $this->widgetSchema->setNameFormat('comments[%s]');
  }
}

<?php
class ForgotPassForm extends BaseForm{
  public function configure()
  {
  	
    $this->setWidgets(array(
      'email'    => new sfWidgetFormInputText()
    ));
	$this->widgetSchema->setLabels(array(
	  'email'   => 'Email'
	));
	$this->widgetSchema->setHelps(array(
	  'email' => 'Введите email, кот орый вы указывали при регистрации.'
	));
	
	$this->widgetSchema->setNameFormat('forgot_pass[%s]');
	
	$this->setValidators(array(
      'email'    => new sfValidatorAnd(array(
				  		new sfValidatorString(array('required' => true, 'trim' => true), array('required' => 'Email должен быть указан.')),
						new sfValidatorEmail(array(), array('invalid' => 'Email неверного формата.'))
					), array('required' => true, 'trim' => true), array('required' => 'Email должен быть указан.'))
    ));
	
	$this->validatorSchema->setOption('allow_extra_fields', true);

  }
}
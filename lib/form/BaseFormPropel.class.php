<?php

/**
 * Project form base class.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormBaseTemplate.php 9304 2008-05-27 03:49:32Z dwhittle $
 */
abstract class BaseFormPropel extends sfFormPropel
{
  public function setup()
  {
  	//sfForm::enableCSRFProtection();
    //$this->addCSRFProtection('caf5940426dbad42b7637db63ed5b658');
    $this->getWidgetSchema()->getFormFormatter()->setHelpFormat('%help%');
  }
}

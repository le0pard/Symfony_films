<?php

/**
 * BannedIps form.
 *
 * @package    symfony_films
 * @subpackage form
 * @author     leopard
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class BannedIpsForm extends BaseBannedIpsForm
{
  public function configure()
  {
  	unset(
      $this['created_at'], $this['updated_at']
    );
  }
}

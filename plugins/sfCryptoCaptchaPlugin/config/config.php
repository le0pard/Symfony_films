<?php
/**
 * sfCryptoCaptcha Config file (mainly for routing)
 *
 * @package    sfCryptoCaptchaPlugin
 * @subpackage config
 * @author     HeNeArKrXeRn <henearkrxern [at] hotmail.fr>
 */

$this->dispatcher->connect('routing.load_configuration', array('sfCryptoCaptchaPluginRouting', 'listenToRoutingLoadConfigurationEvent'));


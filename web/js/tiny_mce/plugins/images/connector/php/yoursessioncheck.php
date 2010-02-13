<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/../config/ProjectConfiguration.class.php';
/**
 * Файл служит проверкой доступа по сессии,
 * вместо user подставьте ваше значение.
 * 
 * Если вы понятия не имеете о чем идет речь
 * и вам безразлична явная уязвимость в безопасности,
 * просто закомментируйте или удалите этот код.
 * 
 */
$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'dev', false);
$context = sfContext::createInstance($configuration);
if($context->getUser()->hasCredential(array('super_admin', 'admin'), false)) {
	echo 'В доступе отказано';
	exit();
}

?>
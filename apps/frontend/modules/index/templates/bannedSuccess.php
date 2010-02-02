<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo sfConfig::get('sf_charset', 'utf-8') ?>" />
<title>Ваш IP заблокирован</title>

<link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>
<div class="sfTContainer">
  <div class="sfTMessageContainer sfTAlert">
    <div class="sfTMessageWrap">
      <h1>Ваш IP (<?php echo $banned->getIp() ?>) заблокирован</h1>
      <h3>Причина: <?php echo $banned->getDescription(ESC_RAW) ?></h3>
    </div>
  </div>
</div>
</body>
</html>


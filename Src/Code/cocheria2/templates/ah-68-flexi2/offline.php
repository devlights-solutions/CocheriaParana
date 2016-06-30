<?php
/*--------------------------------------------------------------------------------
# ah-68-Flexi 2.5 - Dezember 2012 (J2.5)
# Copyright (C) 2006-2012 www.ah-68.de All Rights Reserved.
----------------------------------------------------------------------------------*/

defined('_JEXEC') or die;
$app = JFactory::getApplication();
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="templates/<?php echo $this->template ?>/css/offline.css" type="text/css" />
</head>
<body>
<div id="wrapper" class="outline">
  <jdoc:include type="message" />
  <h1> <?php echo $app->getCfg('sitename'); ?> </h1>
  <p> <?php echo $app->getCfg('offline_message'); ?> </p>
  <div style="margin: 20px 80px;">
    <form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="form-login">
      <fieldset class="input">
      <p id="form-login-username">
        <label for="username"><?php echo JText::_('JGLOBAL_USERNAME') ?></label>
        <input name="username" id="username" type="text" class="inputbox" size="18" />
      </p>
      <p id="form-login-password">
        <label for="passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
        <input type="password" name="password" class="inputbox" size="18" id="passwd" />
      </p>
      <p id="form-login-remember">
        <label for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME') ?></label>
        <input type="checkbox" name="remember" class="inputbox" value="yes" id="remember" />
      </p>
      <input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN') ?>" />
      <input type="hidden" name="option" value="com_users" />
      <input type="hidden" name="task" value="user.login" />
      <input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>" />
      <?php echo JHtml::_('form.token'); ?>
      </fieldset>
    </form>
  </div>
</div>
</body>
</html>

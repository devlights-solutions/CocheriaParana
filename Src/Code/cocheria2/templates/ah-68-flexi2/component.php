<?php  
/*--------------------------------------------------------------------------------
# ah-68-Flexi 2.5 - Dezember 2012 (J2.5)
# Copyright (C) 2006-2012 www.ah-68.de All Rights Reserved.
----------------------------------------------------------------------------------*/
 
// Don't allow direct access
defined( '_JEXEC' ) or die;

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" >
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/print.css" />
</head>
<body id="print">
<div id="all">
  <jdoc:include type="message" />
  <jdoc:include type="component" />
</div>
</body>
</html>

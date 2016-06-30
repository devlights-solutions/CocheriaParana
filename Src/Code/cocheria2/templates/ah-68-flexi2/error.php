<?php 
/*--------------------------------------------------------------------------------
# ah-68-Flexi 2.5 - Dezember 2012 (J2.5)
# Copyright (C) 2006-2012 www.ah-68.de All Rights Reserved.
----------------------------------------------------------------------------------*/

// Don't allow direct access
defined( '_JEXEC' ) or die; 

// Template path
$templatepath = $this->baseurl.'/templates/'.$this->template;

defined('_JEXEC') or die;
if (!isset($this->error)) {
	$this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	$this->debug = false;
}
//get language and direction
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
<title>
<?php 
		echo $this->error->getCode().' - '.$this->title;
	?>
</title>
<link rel="stylesheet" href="<?php echo $templatepath; ?>/css/error.css" type="text/css" />
<link href="<?php echo $templatepath; ?>/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
</head>
<body>
<!-- Start Wrapper -->
<div id="wrapper">
  <!-- Start Wrap -->
  <div id="wrap">
    <div id="content">
      <h1><a href="<?php echo $this->baseurl; ?>/index.php">404</a></h1>
      <div id="errorboxbody">
        <?php 
				echo $this->error->getCode().' - '.$this->error->getMessage(); 
				if (($this->error->getCode()) == '404') {
					echo '<br />';
					echo JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND');
				}
			?>
        <br />
        <p><strong><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></strong></p>
        <ol>
          <li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
          <li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
          <li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
          <li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
          <li><?php echo JText::_('JERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'); ?></li>
          <li><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></li>
        </ol>
        <p><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>: <a href="<?php echo $this->baseurl; ?>/index.php"><?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a>.</p>
      </div>
    </div>
    <!-- Ende Wrap -->
  </div>
  <!-- Ende Wrapper -->
</div>
</body>
</html>

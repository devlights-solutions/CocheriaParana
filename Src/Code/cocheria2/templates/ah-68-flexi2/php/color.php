<style type="text/css">
/*--------------------------------------------------------------------------------
# ah-68-Flexi 2.5 - Dezember 2012 (J2.5)
# Copyright (C) 2006-2012 www.ah-68.de All Rights Reserved.
----------------------------------------------------------------------------------*/

body {
    font-family: <?php echo $this->params->get('bodyfontfamily');?> !important;
	font-size: <?php echo $this->params->get('bodyfontsize');?>px !important;
	line-height: <?php echo $this->params->get('bodylineheight');?>% !important;
    color: <?php echo $this->params->get('bodyColor');?>;
	background-color: <?php echo $this->params->get('bodybgColor');?>;
	<?php if (($this->params->get('bodybguploadchoice')) !=1) : ?>		
	background-image: url(<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/bg/<?php echo $this->params->get('bodybg');?>);
	<?php endif; ?>	
	background-repeat: <?php echo $this->params->get('bodybgrepeat');?>;
}
body {
<?php if (($this->params->get('bodybguploadchoice')) !=0) : ?>		
	background-image: url(<?php echo $this->params->get('bodybgupload');?>);<?php endif; ?>	
}
h1 {
    color: <?php echo $this->params->get('h1color');?>;
}
h2 {
    color: <?php echo $this->params->get('h2color');?>;
}
h3 {
    color: <?php echo $this->params->get('h3color');?>;
}
h4, h5, h6 {
    color: <?php echo $this->params->get('h4h5h6');?>;
}
a, a:link, a:visited, a:active, a:focus {
   color: <?php echo $this->params->get('alinkColor');?>;
}
a:hover {
   color: <?php echo $this->params->get('ahoverlinkColor');?>;
}
.highlight {
	color : <?php echo $this->params->get('highlight');?>;
}
.invalid {
	border-color: <?php echo $this->params->get('invalid');?> !important;
}
label.invalid {
	color : <?php echo $this->params->get('labelinvalid');?>;
}
.item-separator, #article-index {
	border-color: <?php echo $this->params->get('separator');?> !important;
	border-bottom: <?php echo $this->params->get('separatorsize');?>px;
	border-bottom-style: <?php echo $this->params->get('separatorstyle');?>	
}
.top-line {
	background-color: <?php echo $this->params->get('topstripeColor');?>;
	height: <?php echo $this->params->get('topstripeHeight');?>px;
}
.bottom-line {
	background-color: <?php echo $this->params->get('bottomstripeColor');?>;
	height: <?php echo $this->params->get('bottomstripeHeight');?>px;
}
.gotop {
	color: <?php echo $this->params->get('alinkColor');?>;
}
.gotop:hover {
	color: <?php echo $this->params->get('ahoverlinkColor');?>
}
.logo {
	height: <?php echo $this->params->get('logoheight');?>px;
	width: <?php echo $this->params->get('logowidth');?>px;
}
<?php if ($this->countModules('multimenu')): ?>
ul.menumulti-menu li a, ul.menumulti-menu li a.dc-mega, ul.menumulti-menu li .separator {
    font-size: <?php echo $this->params->get('multifontsize');?>px;
	font-weight: <?php echo $this->params->get('multifontweight');?>;
	color: <?php echo $this->params->get('alinkmultimenuColor');?>;
	border-color: <?php echo $this->params->get('bordermultimenuColor');?> !important;
}
ul.menumulti-menu li.multi-hover a, ul.menumulti-menu li a:hover {
	color : <?php echo $this->params->get('ahoverlinkmultimenuColor');?>;
	border-color: <?php echo $this->params->get('bordermultimenuhoverColor');?> !important;
}
ul.menumulti-menu li.active a {
	color : <?php echo $this->params->get('activelinkmultimenuColor');?>;
	border-color: <?php echo $this->params->get('bordermultimenuactiveColor');?> !important;
}
ul.menumulti-menu li .sub li.mega-hdr a.mega-hdr-a {
     font-size: <?php echo $this->params->get('multimegafontsize');?>px;
	 font-weight: <?php echo $this->params->get('multimegafontweight');?>;
     color : <?php echo $this->params->get('megahdrColor');?>;
     background-color: <?php echo $this->params->get('megahdrbg');?>;
}
ul.menumulti-menu li .sub li.mega-hdr a.mega-hdr-a:hover {
     color : <?php echo $this->params->get('megahdrhoverColor');?>;
     background-color: <?php echo $this->params->get('megahdrhoverbg');?>;
}
ul.menumulti-menu li .sub-container.non-mega li a, ul.menumulti-menu li .sub a {
     font-size: <?php echo $this->params->get('submegafontsize');?>px;
	 font-weight: <?php echo $this->params->get('submegafontweight');?>;
	 background-color: <?php echo $this->params->get('submegabg');?>;
}
ul.menumulti-menu li .sub-container.non-mega li a:hover {
	background-color: <?php echo $this->params->get('submegahoverbg');?>;
}
ul.menumulti-menu .sub li.mega-hdr li a {
	background-color: <?php echo $this->params->get('submegabg');?>;
}
ul.menumulti-menu .sub li.mega-hdr li a:hover {
	background-color: <?php echo $this->params->get('submegahoverbg');?>;
}
<?php endif; ?>
<?php if ($this->countModules('superfish')): ?>
ul.menusf-menu li a, .menusf-menu li .separator  {
	font-size: <?php echo $this->params->get('sffontsize');?>px;
	font-weight: <?php echo $this->params->get('sffontweight');?>;
	color: <?php echo $this->params->get('alinksupermenuColor');?>;
	border-color: <?php echo $this->params->get('bordersupermenuColor');?> !important;
}
ul.menusf-menu li a:hover {
	color : <?php echo $this->params->get('ahoverlinksupermenuColor');?>;
	border-color: <?php echo $this->params->get('bordersupermenuhoverColor');?> !important;
}
ul.menusf-menu li.active > a {
	color : <?php echo $this->params->get('activelinksupermenuColor');?>;
	border-color: <?php echo $this->params->get('bordersupermenuactiveColor');?> !important;
}
ul.menusf-menu ul li a {
    color: <?php echo $this->params->get('alinksfmenuColor');?>;
	background-color: <?php echo $this->params->get('subsuperbg');?>;
  	font-size: <?php echo $this->params->get('sfsubfontsize');?>px;
	font-weight: <?php echo $this->params->get('sfsubfontweight');?>;
}
ul.menusf-menu ul li a:hover {
    color: <?php echo $this->params->get('alinksfhovermenuColor');?>;
	background-color: <?php echo $this->params->get('subsuperhoverbg');?>;
}
ul.menusf-menu ul li.active > a {
    color: <?php echo $this->params->get('alinksfactivemenuColor');?>;
	background-color: <?php echo $this->params->get('subsuperactivebg');?>;
}
<?php endif; ?>
ul.menusf-vmenu li a  {
    color: <?php echo $this->params->get('alinksfvmenuColor');?>;
	background-color: <?php echo $this->params->get('subsupervbg');?>;
	font-size: <?php echo $this->params->get('sfvfontsize');?>px;
	font-weight: <?php echo $this->params->get('sfvfontweight');?>;
}
ul.menusf-vmenu li a:hover {
    color: <?php echo $this->params->get('alinksfvhovermenuColor');?>;
	background-color: <?php echo $this->params->get('subsupervhoverbg');?>;
}
ul.menusf-vmenu li.active > a {
	color : <?php echo $this->params->get('alinksfvactivemenuColor');?>;
	background-color: <?php echo $this->params->get('subsupervactivebg');?>;
}
ul.menusf-vmenu ul li a  {
    color: <?php echo $this->params->get('alinksfvmenuColor');?>;
	background-color: <?php echo $this->params->get('subsupervbg');?>;
	font-size: <?php echo $this->params->get('sfsubvfontsize');?>px;
	font-weight: <?php echo $this->params->get('sfsubvfontweight');?>;
}
ul.menusf-vmenu ul li a:hover {
    color: <?php echo $this->params->get('alinksfvhovermenuColor');?>;
	background-color: <?php echo $this->params->get('subsupervhoverbg');?>;
}
ul.menusf-vmenu ul li.active > a {
	color : <?php echo $this->params->get('alinksfvactivemenuColor');?>;
	background-color: <?php echo $this->params->get('subsupervactivebg');?>;
}
.inputbox, input, textarea {
	color: <?php echo $this->params->get('inputColor');?>;
	background-color: <?php echo $this->params->get('inputbgColor');?>;
}
.inputbox:hover, input:hover, textarea:hover {
	color: <?php echo $this->params->get('inputhoverColor');?>;
	background-color: <?php echo $this->params->get('inputbghoverColor');?>;
}
.cat-list-row0 {
	background-color : <?php echo $this->params->get('row0');?>;
	border-bottom-color: <?php echo $this->params->get('row0borderColor');?> !important;
}
.cat-list-row1 {
	background-color : <?php echo $this->params->get('row1');?>;
	border-bottom-color: <?php echo $this->params->get('row1borderColor');?> !important;
}
td.hits {
	border-left-color: <?php echo $this->params->get('hitsborderColor');?> !important;
}
.button, .validate, button, input.button, button.button, button.validate {
	color: <?php echo $this->params->get('abuttonColor');?>;
	background-color: <?php echo $this->params->get('bgbuttonColor');?>;
}
.button:hover, .validate:hover, button:hover, input.button:hover, button.button:hover, button.validate:hover {
	color: <?php echo $this->params->get('abuttonhoverColor');?>;
	background-color: <?php echo $this->params->get('bgbuttonhoverColor');?>;
}
.readmore {
    color: <?php echo $this->params->get('areadmoreColor');?>;
	background-color: <?php echo $this->params->get('bgreadmoreColor');?>;
}
.readmore:hover {	
    color: <?php echo $this->params->get('areadmorehoverColor');?>;
	background-color: <?php echo $this->params->get('bgreadmorehoverColor');?>;
}
.readmore a, a.readmore {
	color: <?php echo $this->params->get('areadmoreColor');?>;
}
.readmore a:hover, a:hover.readmore {
    color: <?php echo $this->params->get('areadmorehoverColor');?>;
}
.moduletable_text h3, .module_text h3, div.moduletable h3, div.module h3, div.module_menu h3, div.moduletable_menu h3, div.moduletablenew h3, div.moduletablehot h3, div.modulenew h3, div.modulehot h3 {
    color:  <?php echo $this->params->get('moduleh3Color');?>;
	background-color: <?php echo $this->params->get('moduleh3bgColor');?>;
}
div.module div div div, div.module_menu div div div, div.moduletable div div div, .moduletable, div.moduletable_menu, div.moduletablenew, div.moduletablehot, div.modulenew, div.modulehot {
    color: <?php echo $this->params->get('modulefontColor');?>;
	background-color: <?php echo $this->params->get('modulebgColor');?>;
}
</style>

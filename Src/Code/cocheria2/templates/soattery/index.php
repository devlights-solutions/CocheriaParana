<?php

/****************************************************
#####################################################
##-------------------------------------------------##
##                   SOATTERY                      ##
##-------------------------------------------------##
## Copyright = globbersthemes.com- 2012            ##
## Date      = SEPTEMBRE 2012                      ##
## Author    = globbers                            ##
## Websites  = http://www.globbersthemes.com       ##
##                                                 ##
#####################################################
****************************************************/

// no direct access
defined('_JEXEC') or die('Restricted access');
/* The following line loads the MooTools JavaScript Library */
JHtml::_('behavior.framework', true);

/* The following line gets the application object for things like displaying the site name */
$app = JFactory::getApplication();
$csite_name	= $app->getCfg('sitename');
$path = $this->baseurl.'/templates/'.$this->template;
 
?>
	  
	  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
	  
	  <head>	
	  <jdoc:include type="head" />	
	   <?php 
      $newsflash = $this->params->get("newsflash", "welcome on soattery joomla template!!!! design globbersthemes.com.."); 
	  ?>
	   <?php 
	  $mod_left = $this->countModules( 'position-7' );     
      if ( $mod_left ) { $width = '';    } else { $width = '-full';}  
	   ?>

	  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/soattery/css/tdefaut.css" type="text/css" media="all" /> 
	  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/soattery/css/box.css" type="text/css" media="all" /> 
	  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/mootools.js"></script>    
	  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/script.js"></script> 
	  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/jquery.js"></script>   
	  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/superfish.js"></script>  
	  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/hoverIntent.js"></script>
	  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/cufon-yui.js"></script>
      <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/cufon-replace.js"></script>
      <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/Lobster_400.font.js"></script>
	  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/nivo.slider.js"></script>
	  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/scroll.js"></script> 
	  <link rel="icon" type="image/gif" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/favicon.gif" />
	  
      
	  
	 <script type="text/javascript">    
 window.addEvent('domready', function() {    
 SqueezeBox.initialize({});    
 $$('a.modal').each(function(el) {    
 el.addEvent('click', function(e) {    
 new Event(e).stop();    SqueezeBox.fromElement(el);    
 }); }); });    
 </script>    
 
 <script type="text/javascript">      
 var $j = jQuery.noConflict(); 	$j(document).ready(function() {	    	
 $j('.navigation ul').superfish({		  	
 delay:       800,                            		 	
 animation:   {opacity:'show',height:'show'},  		  	
 speed:       'normal',                          		 	
 autoArrows:  false,                           		  	
 dropShadows: true                           	  	
 });	   }); 	
 </script>	
 
 <script type="text/javascript">    
 var $j = jQuery.noConflict();    
 jQuery(document).ready(function ($){    
 $j("#slider").nivoSlider(    
 {effect: "sliceUpDown",    
 slices: 15,    
 boxCols: 8,    
 boxRows: 4,    
 animSpeed: 1000,    
 pauseTime: 3000,    
 captionOpacity: 1    
 }); });    
 </script>		
 
	  </head> 
	  <body>     
	        <div id="header">	   
	            <div class="pagewidth">	 
	                <div id="sitename">			
	                    <a href="index.php"><img src="templates/<?php echo $this->template ?>/images/logo.png" width="254" height="103" alt="logotype" /></a>				    
	                </div>			
	                    <div id="block-top">		
	                        <div id="social-icons">			
	                            <div id="rss"><a href="#"><img src="templates/<?php echo $this->template ?>/images/rss.png" width="28" height="28" alt="flux rss" /></a></div>             
	                            <div id="facebook"><a href="#"><img src="templates/<?php echo $this->template ?>/images/facebook.png" width="28" height="28" alt="facebook" /></a></div>  
	                            <div id="twitter"><a href="#"><img src="templates/<?php echo $this->template ?>/images/twitter.png" width="28" height="28" alt="twitter" /></a></div>		
	                        </div>				  
	                            <div id="topmenu">		  
	                                <div class="navigation">          
	                                    <jdoc:include type="modules" name="position-1" />                                            	  
	                                </div>               
	                            </div>						
	                    </div>			      
	            </div>  
	         </div>    
	            <?php $menu = JSite::getMenu(); ?>            
	            <?php $lang = JFactory::getLanguage(); ?>       
	            <?php if ($menu->getActive() == $menu->getDefault($lang->getTag())) { ?>        
	            <?php if ($this->params->get( 'slidedisable' )) : ?>      
	            <?php include "slideshow.php"; ?><?php endif; ?>              
                <?php } ?>    
				    <div id="slide-bottom">
                        <div class="pagewidth">
						    <div id="tool">	
		                        <div id="toolitem">
				                    <div id="loginbt">
                                        <div class="text-login">	
						                    <a href="#helpdiv" class="modal"  style="cursor:pointer" title="Login"  rel="{size: {x: 206, y: 320}, ajaxOptions: {method: &quot;get&quot;}}">
                                                <img src="templates/<?php echo $this->template ?>/images/login.png" width="90" height="27"  alt="login" />
						                    </a>
					                    </div>
                                    </div>
                                        <div style="display:none;">
                                            <div id="helpdiv" >
                                                <jdoc:include type="modules" name="login" style="xhtml" />
                                            </div>
                                        </div>
					
					                    <div id="search">
                                            <div class="text-login">	
						                        <a href="#helpdiv2" class="modal"  style="cursor:pointer" title="search"  rel="{size: {x: 206, y: 50}, ajaxOptions: {method: &quot;get&quot;}}">
                                                    <img src="templates/<?php echo $this->template ?>/images/search.png" width="90" height="27"  alt="search" />       
							                    </a>
					                        </div>
                                        </div>
                                             <div style="display:none;">
                                                <div id="helpdiv2" >
                                                    <jdoc:include type="modules" name="position-0" />
                                                </div>
                                            </div>
			                    </div>
		                    </div>
							    <div id="newsflash">
			                        <p> <a href="http://www.globbersthemes.com"><?php echo $newsflash ?></a> </p> 
			                    </div>
                        </div>						
	                </div>
                        <div class="pagewidth">
						    <?php if ($this->countModules('position-7')) { ?>
                                <div id="colonne">	                                    
                                    <div id="left">	                                        
                                        <jdoc:include type="modules" name="position-7" style="xhtml" />	                                    
                                    </div>
                                </div>												
                            <?php } ?>
							    <div id="main<?php echo $width ?>">				                        
                                    <jdoc:include type="component" />									
                                </div>
						</div>
                            <?php if ($this->countModules('position-2')) { ?>
                                <div id="pathway-bg">
								    <div class="pagewidth">
                                        <div id="pathway">	                                        
                                            <jdoc:include type="modules" name="position-2"  />	                                    
                                        </div>
									</div>
								</div>
                            <?php } ?>	
                                <?php if ($this->countModules('position-3') || $this->countModules('position-4') || $this->countModules('position-6')) { ?>
				                    <div id="footer">
									    <div class="pagewidth">
					                        <?php if ($this->countModules('position-3')) { ?> 
					                            <div class="box">
						                            <jdoc:include type="modules" name="position-3" style="xhtml" />
						                        </div>
						                    <?php } ?>
						                    <?php if ($this->countModules('position-4')) { ?> 
						                        <div class="box">
						                            <jdoc:include type="modules" name="position-4" style="xhtml" />
						                        </div>
						                    <?php } ?>
						                    <?php if ($this->countModules('position-6')) { ?> 
						                        <div class="box">
						                            <jdoc:include type="modules" name="position-6" style="xhtml" />
									            </div>
						                    <?php } ?>
					                    </div>
									</div>
				                <?php } ?>
                                    <div id="ft">
									    <div class="pagewidth">
								            <div class="ftb">
							                    <?php echo date( 'Y' ); ?>&nbsp; <?php echo $csite_name; ?>&nbsp;&nbsp;<?php require("template.php"); ?>
                                            </div>
								            <div id="top">
                                                <div class="top_button">
                                                    <a href="#" onclick="scrollToTop();return false;">
						                           <img src="templates/<?php echo $this->template ?>/images/top.png" width="30" height="30" alt="top" /></a>
                                                </div>
					                        </div>			
								        </div>
                                    </div>									
						          						
	  </body> 
	  </html>
	  
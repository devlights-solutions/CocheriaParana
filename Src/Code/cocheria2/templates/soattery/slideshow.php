<?php     

 $caption1 = $this->params->get("caption1", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu pellentesque dui. Maecenas commodo tellus non neque fermentum tempus.");   
 $caption2 = $this->params->get("caption2", "Whenever i look into your eyes..");  
 $caption3 = $this->params->get("caption3", "You are always on my mind...");	
 $slidedisable	= $this->params->get("slidedisable");
 
 ?>

 <div id="wrapper-slide">	   
 <div class="pagewidth">	 
 <div id ="slide">		  
 <div id="slider" class="nivoSlider"> 		
 <img src="templates/<?php echo $this->template ?>/images/slide1.jpg" alt="image1" title="<?php echo $caption1 ?>" />		
 <img src="templates/<?php echo $this->template ?>/images/slide2.jpg" alt="image1" title="<?php echo $caption2 ?>" />			
 <img src="templates/<?php echo $this->template ?>/images/slide3.jpg" alt="image1" title="<?php echo $caption3 ?>" />		
 </div>	 
 </div>   
 </div>
 </div>				

		

		

		

		

		

		

		

		

		
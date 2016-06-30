<?php
/*--------------------------------------------------------------------------------
# ah-68-Flexi 2.5 - Dezember 2012 (J2.5)
# Copyright (C) 2006-2012 www.ah-68.de All Rights Reserved.
----------------------------------------------------------------------------------*/


//Content Based Combos
if ( $this->countModules('left and right') == 0)  $content = 'content_large';
if ( $this->countModules('left or right') == 1)  $content = 'content_med';		
if ( $this->countModules('left and right') == 1)  $content = 'content_small';

//Users Based Combos
$top_container = 0;
$bottom_container = 0;
$content_top_container = 0;
$content_bottom_container = 0;
$footer_container = 0;


// Top Container Based Combos
if ( $this->countModules('top1 and top2 and top3 and top4')){
    $top_container = 'mini-top-container';		
} else if  ( $this->countModules('top1 and top2 and top3 or top1 and top2 and top4 or top2 and top3 and top4 or top1 and top3 and top4')){
    $top_container = 'small-top-container';			
} else if ( $this->countModules('top1 and top2') || $this->countModules('top1 and top3') || $this->countModules('top2 and top3') || $this->countModules('top1 and top4') || $this->countModules('top2 and top4') || $this->countModules('top3 and top4')){
    $top_container = 'large-top-container';
}
// Content Top Container Based Combos
if ( $this->countModules('content-top1 and content-top2 and content-top3')){
    $content_top_container = 'small-content-top-container';		
} else if ( $this->countModules('content-top1 and content-top2') || $this->countModules('content-top1 and content-top3') || $this->countModules('content-top2 and content-top3')){
    $content_top_container = 'large-content-top-container';
}
// Content Top Container Based Combos
if ( $this->countModules('content-bottom1 and content-bottom2 and content-bottom3')){
    $content_bottom_container = 'small-bottom-container';		
} else if ( $this->countModules('content-bottom1 and content-bottom2') || $this->countModules('content-bottom1 and content-bottom3') || $this->countModules('content-bottom2 and content-bottom3')){
    $content_bottom_container = 'large-bottom-container';
}
// Bottom Container Based Combos
if ( $this->countModules('bottom1 and bottom2 and bottom3 and bottom4')){
    $bottom_container = 'mini-bottom-container';		
} else if  ( $this->countModules('bottom1 and bottom2 and bottom3 or bottom1 and bottom2 and bottom4 or bottom2 and bottom3 and bottom4 or bottom1 and bottom3 and bottom4')){
    $bottom_container = 'small-bottom-container';			
} else if ( $this->countModules('bottom1 and bottom2') || $this->countModules('bottom1 and bottom3') || $this->countModules('bottom2 and bottom3') || $this->countModules('bottom1 and bottom4') || $this->countModules('bottom2 and bottom4') || $this->countModules('bottom3 and bottom4')){
    $bottom_container = 'large-bottom-container';
}

// Footer Container Based Combos
if ( $this->countModules('footer1 and footer2 and footer3 and footer4')){
    $footer_container = 'mini-footer-container';		
} else if  ( $this->countModules('footer1 and footer2 and footer3 or footer1 and footer2 and footer4 or footer2 and footer3 and footer4 or footer1 and footer3 and footer')){
    $footer_container = 'small-footer-container';			
} else if ( $this->countModules('footer1 and footer2') || $this->countModules('footer1 and footer3') || $this->countModules('footer2 and footer3') || $this->countModules('footer1 and footer4') || $this->countModules('footer2 and footer4') || $this->countModules('footer3 and footer4')){
    $footer_container = 'large-footer-container';
}



?>
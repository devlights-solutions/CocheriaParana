<?php
/**
 * @copyright	Copyright (C) 2012 Cedric KEIFLIN alias ced1870
 * http://www.joomlack.fr
 * Module Accordeonmenu CK
 * @license		GNU/GPL
 * */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
?>
<div class="accordeonck <?php echo $params->get('moduleclass_sfx'); ?>">
<ul class="menu<?php echo $class_sfx;?>" id="<?php echo $menuID; ?>">
<?php
foreach ($list as $i => &$item) :
	$class = $item->classe;
	// if ($item->id == $active_id) {
		// $class .= 'current ';
	// }

	// if (in_array($item->id, $path)) {
		// $class .= ' active';
	// }
	// elseif ($item->type == 'alias') {
		// $aliasToId = $item->params->get('aliasoptions');
		// if (count($path) > 0 && $aliasToId == $path[count($path)-1]) {
			// $class .= ' active';
		// }
		// elseif (in_array($aliasToId, $path)) {
			// $class .= ' alias-parent-active';
		// }
	// }
    
	if ($item->deeper) {
		$class .= ' parent';
	}
	
	// if ($item->parent) {
		// $class .= 'parent ';
	// }

	$class .= ' level' . $item->level;
	
	if (!empty($class)) {
		$class = ' class="'.trim($class) .'"';
	}

	echo '<li id="item-'.$item->id.'"'.$class.'>';
        
	if ($item->content) {
        echo $item->content;
    } else {
		$style= '';
		$imageevent = "";
		// Note. It is important to remove spaces between elements.
		if ($item->deeper AND $params->get('eventtarget') == 'link') {
			$class = 'toggler toggler_'.($item->level-($params->get('startLevel')-1)).' '.$item->anchor_css.' ';
			if ($params->get('eventtype') == 'click')
				$item->flink = 'javascript:void(0);';
		} elseif($item->deeper AND $params->get('eventtarget') == 'image') {
			$class = $item->anchor_css ? $item->anchor_css.' ' : '';
			$imageevent = "<img src=\"".JURI::root() . $params->get('imageplus', 'modules/mod_accordeonck/assets/plus.png') . "\" class=\"toggler toggler_".($item->level-($params->get('startLevel')-1)) . "\" align=\"" . $imageposition . "\"/>";
		} else {
			$class = $item->anchor_css ? $item->anchor_css.' ' : '';
		}

		if (	$item->type == 'alias' &&
					in_array($item->params->get('aliasoptions'),$path)
				||	in_array($item->id, $path)) {
			  $class .= 'isactive ';
			}
			
			$class = (isset($class) AND $class) ? 'class="' . $class . '" ' : '';
			
		$title = $item->anchor_title ? 'title="'.$item->anchor_title.'" ' : '';
		if ($item->menu_image) {
				if ($params->get('imgalignement', 'none') != 'none') {
					$imgalignement = ( $params->get('imgalignement') == 'left' ) ? ' align="left"' : ' align="right"' ;
				} else {
					$imgalignement = '';
				}
				$item->params->get('menu_text', 1 ) ? 
				$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->ftitle.'"'. $imgalignement .' /><span class="image-title">'.$item->ftitle.$item->desc.'</span> ' :
				$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->ftitle.'"'. $imgalignement .' />';
		} 
		else { 
			$linktype = $item->ftitle.$item->desc;
		}
		// Render the menu item.
		switch ($item->type) :
			case 'separator':
				echo $imageevent; ?><a <?php echo $class; ?>href="javascript:void(0);"<?php echo $style; ?>><span class="separator"><?php echo $linktype; ?></span></a><?php
				break;
			case 'url':
			case 'component':
			default:
				switch ($item->browserNav) :
						default:
						case 0:
							echo $imageevent; ?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" <?php echo $title.$style; ?>><?php echo $linktype; ?></a><?php
							break;
						case 1:
							// _blank
							echo $imageevent; ?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" target="_blank" <?php echo $title.$style; ?>><?php echo $linktype; ?></a><?php
							break;
						case 2:
							// window.open
							$attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$params->get('window_open');
							echo $imageevent; ?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" onclick="window.open(this.href,'targetWindow','<?php echo $attribs;?>');return false;" <?php echo $title.$style; ?>><?php echo $linktype; ?></a><?php
							break;
					endswitch;	
				break;
		endswitch;
	}
	

	// The next item is deeper.
	if ($item->deeper) {
        $ulstyles = (!$item->isactive) ? 'height: 0px; padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden;' : '';
		echo '<ul class="content_'.($item->level-($params->get('startLevel')-1)).'" style="'.$ulstyles.'">';
	}
	// The next item is shallower.
	else if ($item->shallower) {
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else {
		echo '</li>';
	}
endforeach;
?></ul></div>

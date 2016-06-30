<?php
/*------------------------------------------------------------------------
04.# plg_flike
05.# ------------------------------------------------------------------------
06.# Gyula Komar
07.# copyright Copyright (C) 2011 Build Web.eu All Rights Reserved.
08.# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
09.# Websites: http://www.buildweb.eu
10.# Technical Support:  Forum - http://www.buildweb.eu/index.php?option=com_content&view=article&id=58&Itemid=81&lang=en
11.-------------------------------------------------------------------------*/
defined( '_JEXEC' ) or die();

jimport( 'joomla.event.plugin' );

class plgContentfshare extends JPlugin 
{

	function plgContentfshare( &$subject, $params ) 
	{
		parent::__construct( $subject, $params );
 	}

	function onContentPrepare( $context, &$row, &$params, $limitstart=0 )
	{
		global $mainframe;

		static $first_og=1;

		$regex = '/{(fshare)\s*(.*?)}/i';

		$plugin	=& JPluginHelper::getPlugin('content', 'fshare');
		$pluginParams = $this->params;

		$app_id=$pluginParams->get('app_id','');
		$title=$pluginParams->get('title','');
		$og_url=$pluginParams->get('og_url','');
		$og_image=$pluginParams->get('og_image','');
		$share_url=$pluginParams->get('share_url','');

		$uri =& JURI::getInstance();
		$curl = $uri->toString();

		$config =& JFactory::getConfig();
		$doc =& JFactory::getDocument();

		$base = JURI::base(true);
		$doc->addStyleSheet($base.'/plugins/content/fshare/fshare.css');

		$lang=&JFactory::getLanguage();
		$lang_tag=$lang->getTag();
		$lang_tag=str_replace("-","_",$lang_tag);

		$matches = array();
		preg_match_all( $regex, $row->text, $matches, PREG_SET_ORDER );

		$doc =& JFactory::getDocument();
		if ($first_og && (count($matches)>0))
		{
			if ($og_url=="1")
			{
				$doc->addCustomTag('<meta property="og:url" content="'.$curl.'"/>');
			}
			if ($og_image!="") $doc->addCustomTag('<meta property="og:image" content="'.$og_image.'"/>');
		}
		$first_og=0;

		foreach ($matches as $args) 
		{
			$args=str_replace(" ","&", $args);
			parse_str( $args[2], $pars );

			$str="";

			$uri =& JURI::getInstance();
			$curl = $uri->toString();

			$curl = str_replace("https://","http://",$curl);

			$id="";if (isset($pars['id'])) {$id=$pars['id'];}
			if ($id!="")
			{
				$article = JTable::getInstance('content');
				$article->load($id);
				$slug = $article->get('id').':'.$article->get('alias');
				$catid = $article->get('catid');
				$catslug = $catid ? $catid .':'.$article->get('category_alias') : $catid;
				$sectionid = $article->get('sectionid');
			
				$curl = 'http://';
				if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"]==”on”) {$curl='https://';};
				$curl .= $_SERVER["SERVER_NAME"];
				$curl .= JRoute::_(ContentHelperRoute::getArticleRoute($slug, $catslug, $sectionid));
			}

			$url="<plugin name=fshare version=1.7.7/>";

			if ($share_url=='1')
			{
				$sh_url='http://www.facebook.com/sharer.php?u='.urlencode($curl);
			} else
			{
				$sh_url ='http://www.facebook.com/dialog/feed?';
				if ($app_id!='') $sh_url.='app_id='.$app_id.'&';
				if ($og_image!='') $sh_url.='image='.urlencode($og_image).'&';
				//$sh_url.='name='.urlencode($article->get('title')).'&';
				$sh_url.='caption='.urlencode($config->getValue('config.sitename')).'&';
				//if ($article->metadesc!="") $sh_url.='description='.urlencode($article->metadesc).'&';
				$sh_url.='link='.urlencode($curl).'&';
				$sh_url.='redirect_uri='.urlencode($curl);
			}

			if ($title=='') $title='Share';
			$url .= '<div class="fshare" onclick="window.open(\''.$sh_url.'\');"><a class="fshare_icon"></a>'.$title.'</div>';

			//$url = '<a '.$css_class.'name="fb_share" type="'.$type.'" share_url="'.$curl.'">'.$title.'</a>';
			//$url .= '<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>';

			$row->text = preg_replace($regex, $url, $row->text, 1);
		}
	}
}
?>
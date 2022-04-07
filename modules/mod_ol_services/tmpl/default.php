<?php

/*------------------------------------------------------------------------
# mod_ol_services Extension
# ------------------------------------------------------------------------
# author    olwebdesign
# copyright Copyright (C) 2019 olwebdesign.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.olwebdesign.com
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die;
if(!defined('DS')){
define( 'DS', DIRECTORY_SEPARATOR );
}
$slide = $params->get('slides');
$cacheFolder = JURI::base(true).'/cache/';
$modID = $module->id;
$modPath = JURI::base(true).'/modules/mod_ol_services/';
$document = JFactory::getDocument(); 
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$jqueryload = $params->get('jqueryload');
$showarrows = $params->get('showarrows');
$customone = $params->get('customone');
$bg_color = $params->get('bg_color');
$tx_color = $params->get('tx_color');
$sliderload = $params->get('sliderload');
$ju_image_width = $params->get('ju_image_width');
$ju_image_width_tabl = $params->get('ju_image_width_tabl');
$ju_image_width_tabp = $params->get('ju_image_width_tabp');
$ju_image_width_mobl = $params->get('ju_image_width_mobl');
$ju_image_width_mobp = $params->get('ju_image_width_mobp');
$team_manager    = $params->get('team_manager');
$name           = $params->get('name', '');
$img      = $params->get('img', '');
$title = $params->get('title', '');
$info = $params->get('info', '');
$url1 = $params->get('url1', '');
$url2   = $params->get('url2', '');
$url3   = $params->get('url3', '');
$url4  = $params->get('url4', '');
$url5  = $params->get('url5', '');
$setStyle  = $params->get('setStyle', '');
$ju_type            = $params->get('ju_type');
$get_target           = $params->get('get_target');

if($jqueryload) $document->addScript($modPath.'assets/js/jquery.min.js');
if($jqueryload) $document->addScript($modPath.'assets/js/jquery-noconflict.js');
$document->addStyleSheet($modPath.'assets/css/style.css');
$document->addStyleSheet($modPath.'assets/flaticon.css');
$document->addStyleDeclaration('.mainteam' . $modID . ' .fix-padd { position:relative;margin:'.$params->get('container_fix',6).'px; }'); 
$document->addStyleDeclaration('.mainteam' . $modID . ' .serv-gate {display: inline-block;width:' . $ju_image_width . ';}
@media only screen and (min-width: 960px) and (max-width: 1280px) {.mainteam' . $modID . ' .serv-gate {width:' . $ju_image_width_tabl . ';}}
@media only screen and (min-width: 768px) and (max-width: 959px) {.mainteam' . $modID . ' .serv-gate {width:' . $ju_image_width_tabp . ';}}
@media only screen and ( max-width: 767px ) {.mainteam' . $modID . ' .serv-gate {width:' . $ju_image_width_mobl . ';}}
@media only screen and (max-width: 440px) {.mainteam' . $modID . ' .serv-gate {width:' . $ju_image_width_mobp . ';}}');
?>

<div class="mainteam<?php echo $modID; ?>">
<div id="ol-style"> 
<div id="ol-fixheight">
<?php foreach ($team_manager as $item) : ?>
<div class="serv-gate"> 
<div class="fix-padd">
<div class="services-block-four">
<div class="inner-box">
<div class="overlay-box">
<div class="overlay-inner">
<div class="content">
<div class="left-layer"></div>
<div class="right-layer"></div>
<div class="sicon-box">
<span class="sicon <?php echo $item->ju_image; ?>" ></span>
</div>
<h4><?php if (!empty($item->ju_target_url)) : ?><a href="<?php echo $item->ju_target_url; ?>" target="<?php echo $get_target; ?>"><?php endif; ?><?php echo $item->ju_title; ?><?php if (!empty($item->ju_target_url)) : ?></a><?php endif; ?></h4>
<?php if ($item->ju_text != '') : ?><div class="text"><?php echo $item->ju_text; ?></div><?php endif; ?>
<?php if (!empty($item->ju_target_url)) : ?><a href="<?php echo $item->ju_target_url; ?>" target="<?php echo $get_target; ?>" class="button-link"> Read More </a><?php endif; ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div><?php endforeach; ?>
</div>
</div>
</div>

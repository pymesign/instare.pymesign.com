<?php
/**
* @title			Article Show
* @version   		4.0.7
* @copyright   		Copyright (C) 2020 olwebdesign.com, All rights reserved.
* @license   		GNU General Public License version 3 or later.
* @author url   	http://www.olwebdesign.com/
* @author email   	info@olwebdesign.com
* @developers   	olwebdesign.com
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$document = JFactory::getDocument();
$modID = $module->id;
$sl_items = $params->get('sl_items');
$get_target = $params->get('get_target');
$customstyle = $params->get('customstyle');
$btx_color = $params->get('btx_color');
$loadjquery = $params->get('loadjquery');
$modPath = JURI::root(true).'/modules/' . $module->module;

if($loadjquery) $document->addScript($modPath.'/assets/js/jquery.js');
$document->addScript($modPath.'/assets/js/jquery.owl.carousel.js');
$document->addScript($modPath.'/assets/js/theme.js');
$document->addStyleSheet($modPath.'/assets/css/owl.carousel.css');
$document->addStyleDeclaration(' #npost'.$modID.' .nspost_sett { margin:'.$params->get('container_fix',6).'px;}');
$document->addStyleSheet($modPath.'/assets/css/style.css');
if($customstyle) $document->addStyleDeclaration('#npost' . $modID . ' a:hover,#npost' . $modID . ' a,#npost' . $modID . ' .entry-title a:hover, #npost' . $modID . ' .entry-description a,#npost' . $modID . ' .entry-meta a i {color: ' . $btx_color . ';}#npost' . $modID . ' .blog-entry-image .entry-date {background-color: ' . $btx_color . ';}'); 
ImageHelper::setDefault($params);
?>            
<div id="npost<?php echo $modID ?>">
<div class="owl-carousel <?php echo $params->get('navStyle')?> <?php echo $params->get('navPosit')?> <?php echo $params->get('navRounded')?>" data-dots="false" data-autoplay="<?php echo $params->get('autoplay')?>" data-autoplay-hover-pause="<?php echo $params->get('autoplay-hover-pause')?>" data-autoplay-timeout="<?php echo $params->get('autoplay-timeout')?>" data-autoplay-speed="<?php echo $params->get('autoplay-speed')?>" data-loop="<?php echo $params->get('dataLoop')?>" data-nav="<?php echo $params->get('dataNav')?>" data-nav-speed="<?php echo $params->get('autoplay-speed')?>" data-items="<?php echo $params->get('image_width')?>" data-tablet-landscape="<?php echo $params->get('image_width_tabl')?>" data-tablet-portrait="<?php echo $params->get('image_width_tabp')?>" data-mobile-landscape="<?php echo $params->get('image_width_mobl')?>" data-mobile-portrait="<?php echo $params->get('image_width_mobp')?>">
<?php  $i = 0;  foreach($list as $item){ $i++;
$last_class = ($i == count($list))?' last':'';
$img = OlArticleShowHelper::getAImage($item, $params);
?>
<div class="nspost_sett<?php echo $modID ?>">
<div class="nspost_sett">
<div class="blog-entry border">
<div class="blog-entry-image">
<img class="img-responsive" alt="" src="<?php echo JURI::base(true) ?>/<?php
echo OlArticleShowHelper::imageSrc($img);
?>">
<?php if($params->get('item_date_display')== 1): ?><div class="entry-date"><time datetime="<?php echo  $item->created; ?>"><?php echo  $item->created; ?></time></div><?php endif; ?>	
</div>
<div class="entry-content">
<div class="entry-title">
<h3><a href="<?php echo $item->link ?>" title="<?php echo OlArticleShowHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>" <?php echo OlArticleShowHelper::parseTarget($params->get('link_target')); ?>><?php echo OlArticleShowHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?></a></h3>
</div>
<div class="entry-meta">
<?php if($params->get('author_display')== 1): ?><p><i class="fa fa-user"></i> By <?php echo $item->author; ?></p><?php endif; ?>
<?php if($params->get('cat_title_display')== 1): ?><a href="<?php echo $item->catlink; ?>" title="<?php echo $item->category_title; ?>" <?php echo OlArticleShowHelper::parseTarget($params->get('link_target')); ?>><i class="fa fa-comments-o"></i> <?php echo JText::_('Category: ');?> <?php echo $item->category_title; ?></a><?php endif; ?>
</div>
<div class="entry-description">
<div class="mos-img"><?php echo OlArticleShowHelper::truncate($item->introtext, $params->get('item_desc_max_characs',200)); ?></div>
<?php if($params->get('item_readmore_display')== 1): ?><a href="<?php echo $item->link ?>" title="<?php echo OlArticleShowHelper::truncate($item->title, $params->get('item_title_max_characs',25)); ?>" <?php echo OlArticleShowHelper::parseTarget($params->get('link_target')); ?>><?php echo $params->get('item_readmore_text'); ?> <i class="fa fa-angle-double-right"></i></a><?php endif; ?>
</div>
</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>

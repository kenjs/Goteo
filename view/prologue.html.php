<?php
/*
 *  Copyright (C) 2012 Platoniq y Fundación Fuentes Abiertas (see README for details)
 *	This file is part of Goteo.
 *
 *  Goteo is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Goteo is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with Goteo.  If not, see <http://www.gnu.org/licenses/agpl.txt>.
 *
 */

use Goteo\Core\View,
    Goteo\Model\Image,
    Goteo\Library\Text;

//@NODESYS

$fbCode = Text::widget(Text::get('social-account-facebook'), 'fb');

// metas og: para que al compartir en facebook coja las imagenes de novedades
if($_SERVER['REQUEST_URI']=="/"):
    $ogmeta = array(
        'title' => GOTEO_META_TITLE,
        'description' => GOTEO_META_DESCRIPTION,
        'url' => SITE_URL,
        'image' => array(SITE_URL . '/view/css/ogimg.png')
    );
elseif(strstr($_SERVER['REQUEST_URI'],'project')):
    if(!empty($this['project']->subtitle)) {
        $description = $this['project']->subtitle;
    } else {
        $description = $this['project']->description;
    }
    $i = 1; foreach ($project->gallery as $image) :
        $gallery = $image->getLink(580, 580);
    $i++; endforeach;
    $ogmeta = array(
        'title' => $this['project']->name,
        'description' => $description,
        'url' => SITE_URL.$_SERVER['REQUEST_URI'],
        'image' => array($gallery)
    );
endif;
if (!empty($this['posts'])) {
    foreach ($this['posts'] as $post) {
        if (count($post->gallery) > 1) {
            foreach ($post->gallery as $pbimg) {
                if ($pbimg instanceof Image) {
                    $ogmeta['image'][] = $pbimg->getLink(500, 285);
                }
            }
        } elseif (!empty($post->image)) {
            $ogmeta['image'][] = $post->image->getLink(500, 285);
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo GOTEO_META_TITLE ?></title>
    <link rel="icon" type="image/png" href="/favicon.ico" />
    <meta name="description" content="<?php echo GOTEO_META_DESCRIPTION ?>" />
    <meta name="keywords" content="<?php echo GOTEO_META_KEYWORDS ?>" />
    <meta name="author" content="<?php echo GOTEO_META_AUTHOR ?>" />
    <meta name="copyright" content="<?php echo GOTEO_META_COPYRIGHT ?>" />
    <meta name="robots" content="all" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <?php if (isset($ogmeta)) : ?>
        <meta property="og:title" content="<?php echo $ogmeta['title'] ?>" />
        <? if($_SERVER['REQUEST_URI']=="/"): ?>
        <meta property="og:type" content="website" />
        <? else: ?>
        <meta property="og:type" content="article" />
        <? endif; ?>
        <meta property="og:site_name" content="<?php echo $ogmeta['title'] ?>" />
        <meta property="og:description" content="<?php echo $ogmeta['description'] ?>" />
        <?php if (is_array($ogmeta['image'])) :
            foreach ($ogmeta['image'] as $ogimg) : ?>
                <meta property="og:image" content="<?php echo $ogimg ?>" />
            <?php endforeach;
        else : ?>
            <meta property="og:image" content="<?php echo $ogmeta['image'] ?>" />
        <?php endif; ?>
        <meta property="og:url" content="<?php echo $ogmeta['url'] ?>" />
        <meta property="og:locale" content="ja_JP" />
        <meta property="fb:app_id" content="<?= OAUTH_FACEBOOK_ID ?>" />
    <?php else : ?>
        <meta property="og:title" content="<?php echo $ogmeta['title'] ?>" />
        <meta property="og:description" content="<?php echo GOTEO_META_DESCRIPTION ?>" />
        <meta property="og:image" content="<?php echo SITE_URL ?>/view/css/header/logo.png" />
        <meta property="og:url" content="<?php echo SITE_URL ?>" />
        <meta property="og:locale" content="ja_JP" />
        <meta property="fb:app_id" content="<?= OAUTH_FACEBOOK_ID ?>" />
    <?php endif; ?>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo SRC_URL ?>/view/css/goteo.css" />
    <?php if (!isset($useJQuery) || !empty($useJQuery)): ?>
        <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery.tipsy.min.js"></script>
        <!-- custom scrollbars -->
        <link type="text/css" href="<?php echo SRC_URL ?>/view/css/jquery.jscrollpane.min.css" rel="stylesheet" media="all" />
        <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery.mousewheel.min.js"></script>
        <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery.jscrollpane.min.js"></script>
        <!-- end custom scrollbars -->
        <!-- sliders -->
        <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery.slides.min.js"></script>
        <!-- end sliders -->
        <!-- fancybox-->
        <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery.fancybox.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo SRC_URL ?>/view/css/fancybox/jquery.fancybox.min.css" media="screen" />
        <!-- end custom fancybox-->

        <script type="text/javascript" src="<?php echo SITE_URL ?>/view/js/watchdog.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL ?>/view/js/heightLine.js"></script>

        <script type="text/javascript" src="<?php echo SITE_URL ?>/view/js/localgood.js"></script>

    <?php endif; ?>

    <?php if (isset($jsreq_autocomplete)) : ?>
        <link href="<?php echo SRC_URL ?>/view/css/jquery-ui-1.10.3.autocomplete.min.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo SRC_URL ?>/view/js/jquery-ui-1.10.3.autocomplete.min.js"></script>
    <?php endif; ?>

    <?php if(defined('GOTEO_ANALYTICS_TRACKER')){
        echo GOTEO_ANALYTICS_TRACKER;
    }  ?>
</head>

<body id="page_top" <?php if (isset($bodyClass)) echo ' class="' . htmlspecialchars($bodyClass) . '"' ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&appId=<?= OAUTH_FACEBOOK_ID ?>&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<?php
/*
*** Uncomment this lines and change __YOUR_APP_ID__
*
if (isset($fbCode)) : ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo \Goteo\Library\i18n\Lang::locale(); ?>/all.js#xfbml=1&appId=__YOUR_APP_ID__";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php endif;  
*
*/ ?>
<script type="text/javascript">
    // Mark DOM as javascript-enabled
    jQuery(document).ready(function ($) {
        $('body').addClass('js');
        $('.tipsy').tipsy();
        /* Rolover sobre los cuadros de color */
        $("li").not(".header .nav_wrapper ul li, li.forbidden").hover(
            function () { $(this).addClass('active') },
            function () { $(this).removeClass('active') }
        );
        $('.activable').hover(
            function () { $(this).addClass('active') },
            function () { $(this).removeClass('active') }
        );
        $(".a-null, li.forbidden > a").click(function (event) {
            event.preventDefault();
        });
    });
</script>
<noscript><!-- Please enable JavaScript --></noscript>
<div id="wrapper">

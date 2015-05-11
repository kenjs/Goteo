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

use Goteo\Library\Text,
    Goteo\Model\Category,
    Goteo\Model\Post,
    Goteo\Model\Sponsor;
//@NODESYS

$lang = (LANG != 'es') ? '?lang='.LANG : '';

$categories = Category::getList();  // categorias que se usan en proyectos
$posts      = Post::getList('footer');
$sponsors   = Sponsor::getList();
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.scroll-pane').jScrollPane({showArrows: true});
});
</script>

    <!-- <div id="footer"> -->
    <div class="footer">
<?/*
		<div class="w940 inner">
        	<div class="block categories">
                <h8 class="title"><?php echo Text::get('footer-header-categories') ?></h8>
                <ul class="scroll-pane">
                <?php foreach ($categories as $id=>$name) : ?>
                    <li><a href="/discover/results/<?php echo $id.'/'.$name; ?>"><?php echo $name; ?></a></li>
                <?php endforeach; ?>
                </ul>
            </div>

            <div class="block projects">
                <h8 class="title"><?php echo Text::get('footer-header-projects') ?></h8>
                <ul class="scroll-pane">
                    <li><a href="/"><?php echo Text::get('home-promotes-header') ?></a></li>
                    <li><a href="/discover/view/popular"><?php echo Text::get('discover-group-popular-header') ?></a></li>
                    <li><a href="/discover/view/outdate"><?php echo Text::get('discover-group-outdate-header') ?></a></li>
                    <li><a href="/discover/view/recent"><?php echo Text::get('discover-group-recent-header') ?></a></li>
                    <li><a href="/discover/view/success"><?php echo Text::get('discover-group-success-header') ?></a></li>
                    <li><a href="/discover/view/archive"><?php echo Text::get('discover-group-archive-header') ?></a></li>
                    <li><a href="/project/create"><?php echo Text::get('regular-create') ?></a></li>
                </ul>
            </div>

            <div class="block resources">
                <h8 class="title"><?php echo Text::get('footer-header-resources') ?></h8>
                <ul class="scroll-pane">
                    <li><a href="/faq"><?php echo Text::get('regular-header-faq') ?></a></li>
                    <li><a href="/glossary"><?php echo Text::get('footer-resources-glossary') ?></a></li>
                    <li><a href="/press"><?php echo Text::get('footer-resources-press') ?></a></li>
                    <?php foreach ($posts as $id=>$title) : ?>
                    <li><a href="/blog/<?php echo $id ?>"><?php echo Text::recorta($title, 50) ?></a></li>
                    <?php endforeach; ?>
                    <li><a href="https://github.com/Goteo/Goteo" target="_blank"><?php echo Text::get('footer-resources-source_code') ?></a></li>
                </ul>
            </div>
			<script type="text/javascript">
				$(function(){
					$('#slides_sponsor').slides({
						container: 'slides_container',
						effect: 'fade', 
						crossfade: false,
						fadeSpeed: 350,
						play: 5000, 
						pause: 1
					});
				});
			</script>
           <div id="slides_sponsor" class="block sponsors">
                <h8 class="title"><?php echo Text::get('footer-header-sponsors') ?></h8>
				<div class="slides_container">
					<?php $i = 1; foreach ($sponsors as $sponsor) : ?>
					<div class="sponsor" id="footer-sponsor-<?php echo $i ?>">
						<a href="<?php echo $sponsor->url ?>" title="<?php echo $sponsor->name ?>" target="_blank" rel="nofollow"><img src="<?php echo $sponsor->image->getLink(150, 85) ?>" alt="<?php echo $sponsor->name ?>" /></a>
					</div>
					<?php $i++; endforeach; ?>
				</div>
				<div class="slidersponsors-ctrl">
					<a class="prev">prev</a>
					<ul class="paginacion"></ul>
					<a class="next">next</a>
				</div>
            </div>

            <div class="block services">
                
                <h8 class="title"><?php echo Text::get('footer-header-services') ?></h8>
                <ul>
                    <li><a href="/blog"><?php echo Text::get('regular-header-blog'); ?></a></li>
                    <li><a href="/about"><?php echo Text::get('regular-header-about'); ?></a></li>
                    <li><a href="/user/login"><?php echo Text::get('regular-login'); ?></a></li>
                    <li><a href="/contact"><?php echo Text::get('regular-footer-contact'); ?></a></li>
                </ul>
                
            </div>
         
            <div class="block social" style="border-right:#ebe9ea 2px solid;">
                <h8 class="title"><?php echo Text::get('footer-header-social') ?></h8>
                <ul>
                    <li class="twitter"><a href="<?php echo Text::get('social-account-twitter') ?>" target="_blank"><?php echo Text::get('regular-twitter') ?></a></li>
                    <li class="facebook"><a href="<?php echo Text::get('social-account-facebook') ?>" target="_blank"><?php echo Text::get('regular-facebook') ?></a></li>
                    <li class="identica"><a href="<?php echo Text::get('social-account-identica') ?>" target="_blank"><?php echo Text::get('regular-identica') ?></a></li>
                    <li class="gplus"><a href="<?php echo Text::get('social-account-google') ?>" target="_blank"><?php echo Text::get('regular-google') ?></a></li>
                    <li class="rss"><a rel="alternate" type="application/rss+xml" title="RSS" href="/rss<?php echo $lang ?>" target="_blank"><?php echo Text::get('regular-share-rss'); ?></a></li>

                </ul>
            </div>

		</div>
*/?>

        <div class="footer_link_wrapper">
            <?/*
            <div id="to_page_top" style="bottom:0; margin-left: 880px;">
                <a href="#page_top"><img src="/view/css/page_topBtn.png" alt="ページの上部へ" /></a>
            </div><!--#to_page_top-->
            */?>
            <div class="inner cf">
                <ul>
                    <li><a href="<?= LOCALGOOD_WP_BASE_URL ?>/about/">LOCAL GOODについて</a></li>
                    <li><a href="<?= LG_INTEGRATION_URL ?>/riyou_kiyaku_menu/">利用規約</a></li>
                    <li><a href="<?= LOCALGOOD_WP_BASE_URL ?>/syoutorihikihou/">特定商取引法に基づく表記</a></li>
                    <li><a href="<?= LOCALGOOD_WP_BASE_URL ?>/user_guide/">ユーザーガイド</a></li>
                    <li><a href="<?= LOCALGOOD_WP_BASE_URL ?>/privacypolicy/">プライバシーポリシー</a></li>
                    <li><a href="<?= LOCALGOOD_WP_BASE_URL ?>/mailnews/">メルマガ登録</a></li>
                    <li><a href="<?= LOCALGOOD_WP_BASE_URL ?>/contact/">お問い合わせ</a></li>
                    <li class="integration"><a href="<?= LG_INTEGRATION_URL ?>/">LOCAL GOOD全国版トップページ</a></li>
                </ul>
                <?/*
                <ul class="sns_link">
                    <li class="fb_btn"><a href="https://www.facebook.com/LOCALGOODYOKOHAMA" target="_blank"><img src="/view/css/fb_btn.png" alt="facebook" /></a></li>
                    <li class="tw_btn"><a href="https://twitter.com/LogooYOKOHAMA" target="_blank"><img src="/view/css/tw_btn.png" alt="twitter" /></a></li>
                    <li class="g_plus"><a href="https://plus.google.com/112981975493826894716/" target="_blank"><img src="/view/css/gplus_btn.png" alt="google plus" /></a></li>
                    <li class="rss"><a href="#/view/css/rss_btn.png" alt="rss" /><img src="/view/css/rss_btn.png" alt="google plus" /></a></li>
                </ul>
                */?>
            </div>
        </div>
        <div class="foot_bar_wrapper">
            <div class="foot_bar_inner cf">
                <a class="three_left" href="http://yokohamalab.jp/" target="_blank"><img src="/view/css/ycdl_logo.png" alt="Yokohama Community Design Lab." /></a>
                <a class="three_center" href="http://www.accenture.com/jp-ja/Pages/index.aspx" target="_blank"><img src="/view/css/accenture_logo.png" alt="accenture" /></a>
                <img class="three_right" src="/view/css/open_yokohama_logo.png" alt="Open Yokohama" />

            </div>
        </div>
        <p class="copyright">
            <span>&copy; Local Good YOKOHAMA. Some rights reserved.</span>
        </p>

        <div class="platoniq">
            <?php // You are not allowed to remove this links. If so, you'll make a legal fault regarding the release license. You can read it at https://github.com/Goteo/Goteo/blob/master/GNU-AGPL-3.0 ?>
            <span class="text"><a href="http://goteo.org" target="_blank" class="poweredby">Powered by Goteo.org</a></span>
            <?php // You are not allowed to remove this links. If so, you'll make a legal fault regarding the release license. You can read it at https://github.com/Goteo/Goteo/blob/master/GNU-AGPL-3.0 ?>
            <span class="logo"><a href="http://fuentesabiertas.org" target="_blank" class="foundation">FFA</a></span>
            <?php // You are not allowed to remove this links. If so, you'll make a legal fault regarding the release license. You can read it at https://github.com/Goteo/Goteo/blob/master/GNU-AGPL-3.0 ?>
            <span class="logo"><a href="https://github.com/Goteo/Goteo" target="_blank" class="growby">GNU-AGPL-3</a></span>
            <?php // You are not allowed to remove this links. If so, you'll make a legal fault regarding the release license. You can read it at https://github.com/Goteo/Goteo/blob/master/GNU-AGPL-3.0 ?>
        </div>

    </div>

    <!-- <div id="sub-footer"> -->

<?/*
    <div class="foot_bar_wrapper">
		<div class="w940">
                <ul class="foot_bar_inner">
                    <li><a href="/legal/terms"><?php echo Text::get('regular-footer-terms'); ?></a></li>
                    <li><a href="/legal/privacy"><?php echo Text::get('regular-footer-privacy'); ?></a></li>
                </ul>

                <div class="platoniq">
<?php // You are not allowed to remove this links. If so, you'll make a legal fault regarding the release license. You can read it at https://github.com/Goteo/Goteo/blob/master/GNU-AGPL-3.0 ?>    
                   <span class="text"><a href="http://goteo.org" class="poweredby">Powered by Goteo.org</a></span>
<?php // You are not allowed to remove this links. If so, you'll make a legal fault regarding the release license. You can read it at https://github.com/Goteo/Goteo/blob/master/GNU-AGPL-3.0 ?>    
                   <span class="logo"><a href="http://fuentesabiertas.org" target="_blank" class="foundation">FFA</a></span>
<?php // You are not allowed to remove this links. If so, you'll make a legal fault regarding the release license. You can read it at https://github.com/Goteo/Goteo/blob/master/GNU-AGPL-3.0 ?>    
                   <span class="logo"><a href="https://github.com/Goteo/Goteo" target="_blank" class="growby">GNU-AGPL-3</a></span>
<?php // You are not allowed to remove this links. If so, you'll make a legal fault regarding the release license. You can read it at https://github.com/Goteo/Goteo/blob/master/GNU-AGPL-3.0 ?>    
                </div>
       
        </div>

    </div>
*/?>


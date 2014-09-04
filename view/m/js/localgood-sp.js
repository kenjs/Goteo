$ = jQuery;

$(function () {

    // グロナビ, プルダウン
    $('.nav_inner ul li').hover(
        function(){
            $(this).children('ul.sub:hidden').slideToggle();
        },
        function(){
            $(this).children('ul.sub:visible').slideToggle();
        }
    );

    // スマフォナビゲーション
    Flipsnap('.flipsnap');

    // 投稿画像etcを画面幅に収める
    var post_width = $('.post_body').width();
    if ( post_width < $('.post_body div').width() ) {
        $('.post_body div').css({
            width: post_width + 'px'
        });
    }
    if ( post_width < $('.post_body img').width() ) {
        $('.post_body img').css({
            width: post_width + 'px'
        });
    }


});


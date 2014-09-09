$ = jQuery;

$(function () {
    // android対策 強制width:320px
    var portraitWidth,landscapeWidth;
    $(window).bind("resize", function(){
        if(Math.abs(window.orientation) === 0){
            if(/Android/.test(window.navigator.userAgent)){
                if(!portraitWidth)portraitWidth=$(window).width();
            }else{
                portraitWidth=$(window).width();
            }
            $("html").css("zoom" , portraitWidth/320 );
        }else{
            if(/Android/.test(window.navigator.userAgent)){
                if(!landscapeWidth)landscapeWidth=$(window).width();
            }else{
                landscapeWidth=$(window).width();
            }
            $("html").css("zoom" , landscapeWidth/320 );
        }
    }).trigger("resize");

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

    var flipsnap = Flipsnap('.flipsnap', {
        distance: 116
    });
    var $next = $('.next').click(function() {
        flipsnap.toNext();
    });
    var $prev = $('.prev').click(function() {
        flipsnap.toPrev();
    });
    flipsnap.element.addEventListener('fspointmove', function() {
        $next.attr('disabled', !flipsnap.hasNext());
        $prev.attr('disabled', !flipsnap.hasPrev());
    }, false);
    

    Flipsnap('.flipsnap_projectnav');

    var flipsnap2 = Flipsnap('.flipsnap_projectnav', {
        distance: 111
    });
    var $next2 = $('.next2').click(function() {
        flipsnap2.toNext();
    });
    var $prev2 = $('.prev2').click(function() {
        flipsnap2.toPrev();
    });
    flipsnap2.element.addEventListener('fspointmove', function() {
        $next2.attr('disabled', !flipsnap2.hasNext());
        $prev2.attr('disabled', !flipsnap2.hasPrev());
    }, false);

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


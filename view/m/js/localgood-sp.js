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

    if($('.flipsnap').length > 0){
        // sp nav
        Flipsnap('.flipsnap');
        var flipsnap = Flipsnap('.flipsnap', {
            distance: 70
        });
    }

    if($('.flipsnap_projectnav').length > 0){
        // sp project-nav
        Flipsnap('.flipsnap_projectnav');
        var flipsnap = Flipsnap('.flipsnap_projectnav', {
            distance: 74
        });
    }

    if($('.flipsnap_dashboard').length > 0){
        // sp dashboard-nav
        Flipsnap('.flipsnap_dashboard');
        var flipsnap = Flipsnap('.flipsnap_dashboard', {
            distance: 20
        });
    }

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


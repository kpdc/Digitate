jQuery(document).ready(function($) {
    
    $(document).scroll(function() {
    var demo = $(this).scrollTop();
        if($(window).width() < 855) {
            if(demo > 100) {
                $('.feature-nav').css({
                    'position': 'fixed',
                    'top': '0',
                    'width': '100%',
                    'z-index': '8'
                });
            } else {
                $('.feature-nav').removeAttr('style');
            }
        } else if($(window).width() > 855) {
            if(demo > 100) {
                $('.feature-nav').css({
                    'top': '50px'
                });
            } else {
                $('.feature-nav').removeAttr('style');
            }
        }
    });
});
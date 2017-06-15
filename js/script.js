jQuery(document).ready(function($) {
	// To Narrow down header menu
	if($(window).width() > 855) {
		$(document).scroll(function() {
			var demo = $(this).scrollTop();
			if(demo > 100) {
				$('.home-button').css({
					'padding': '10px'
					});
				$('.headbrand').css({
					'width': '120px'
					});
				$('.site-header-menu').css({
					'margin-top': '0',
					'padding-bottom': '0'
					});
				$('.feature-nav').css({
					'top': '50px'
				});
			} else {
				$('.home-button, .site-header-menu, .headbrand, .feature-nav').removeAttr('style');
			}
		});
	}

	// Add class if the list has a child list
	$('.site-header-menu li:has(ul)').addClass('has-child');

	// Toggle menu
	$('.toggle').click(function() {
		var dropdown = $('.toggle, .site-header-menu');

		if(dropdown.hasClass('active')) {
			dropdown.removeClass('active');
		} else {
			dropdown.addClass('active');
		}
	});

	$('.sub-headbrand').hide();

	if($(window).width() < 855) {
		$('.toggle').click(function() {
			$('.home-button, .sub-headbrand').fadeToggle(1200);
		});

		$('.has-child').append('<span></span>');

		$('.has-child span').click(function() {
			if( $('.has-child ul').hasClass('active') ) {
				$('.has-child ul').removeClass('active');
			} else {
				$(this).parent().find('ul').addClass('active');
			}
		});

		$(document).scroll(function() {
			var toggle_shadow = $(this).scrollTop();
			if(toggle_shadow > 100) {
				$('.toggleWrap').css({
					'box-shadow': '1px 1px 2px rgba(0, 0, 0, 0.45)'
				});
			} else {
				$('.toggleWrap').removeAttr('style');
			}
		});
	} else {
		if($(window).width() > 855) {
			$('.home-button').removeAttr('style');
			$('.has-child').find("span").remove();
		}
	}

	$(window).resize(function() {
		$('.site-header-menu, .toggle').removeClass('active');

		if($(this).width() > 855) {
			$('.has-child').find("span").remove();
		}
	});

	$('.demo-button, .demo-query-button').click(function() {
		var popup = $('.demo-button, .eform, .container');

		if(popup.hasClass('active')) {
			popup.removeClass('active');
		} else {
			popup.addClass('active');
		}

		$('.close').click(function() {
			popup.removeClass('active');
		});
	});

	// remove p tag that wrap the img
	$('p > img').unwrap();

	// ScrollTo
	$('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 100
        }, 1000);
        return false;
      }
    }
  });
});
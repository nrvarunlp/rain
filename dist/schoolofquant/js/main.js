(function($){
    "use strict";
    
	$(".carousel-inner .item:first-child").addClass("active");
	
    /* Mobile menu click then remove
    ==========================*/
    $(".mainmenu-area #mainmenu li a").on("click", function () {
        $(".navbar-collapse").removeClass("in");
    });
    /*WoW js Active
    =================*/
    new WOW().init({
        mobile: true,
    });
    /* Scroll to top
    ===================*/
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });
 
    /*--------------------
       MAGNIFIC POPUP JS
       ----------------------*/
    let magnifPopup = function () {
        $('.work-popup').magnificPopup({
            type: 'image',
            removalDelay: 300,
            mainClass: 'mfp-with-zoom',
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true, 

                duration: 300, 
                easing: 'ease-in-out',

                opener: function (openerElement) {
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            }
        });
    };

    magnifPopup();

    $('.header-area').parallax("50%", -0.4);
    $('.price-area').parallax("50%", -0.5);
    $('.testimonial-area').parallax("10%", -0.2);


    $('#accordion .panel-title a').prepend('<span></span>');

    function doAnimations(elems) {
        let animEndEv = 'webkitAnimationEnd animationend';

        elems.each(function () {
            let $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
            });
        });
    }
	
	function setVidDim(){
		let modalW = 0.75, ratio = 0.5625;
		$('.modal .modal-content').height(Math.round($(window).width() * modalW * ratio)+'px');
		$('.modal .modal-content').width(Math.round($(window).width() * modalW)+'px');    
	}

    let $myCarousel = $('.caption-slider'),
        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");

    $myCarousel.carousel({interval:10000});

    doAnimations($firstAnimatingElems);

    $myCarousel.carousel('pause');
 
    $myCarousel.on('slide.bs.carousel', function (e) {
        let $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
        doAnimations($animatingElems);
    });

    $('.mainmenu-area a[href*="#"]')
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function (event) {
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                let target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

                if (target.length) {

                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function () {

                        let $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { 
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); 
                            $target.focus(); 
                        };
                    });
                }
            }
        });

	$('#SOQintro').on('hide.bs.modal', function(){
		$(this).find('iframe:first').attr('src', '');
	});

	$('#SOQintro').on('show.bs.modal', function(){
		let str = $(this).find('iframe:first').attr('src');
		if(str == ''){
			$(this).find('iframe:first').attr('src', 'https://www.youtube.com/embed/8EAbY0-C7Ec?rel=0');
		}
		setVidDim();
	});

    /* Preloader Js
    ===================*/
    $(window).on("load", function () {
        $('.preloader').fadeOut(500);
    });
	
    $(window).on("resize", function () {
		if($('#SOQintro').css('display') == 'block'){
			setVidDim();
		}
    });	
	
})(jQuery);
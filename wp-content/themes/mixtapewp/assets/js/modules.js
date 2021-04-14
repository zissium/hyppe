(function($) {
    "use strict";

    window.qodef = {};
    qodef.modules = {};

    qodef.scroll = 0;
    qodef.window = $(window);
    qodef.document = $(document);
    qodef.windowWidth = $(window).width();
    qodef.windowHeight = $(window).height();
    qodef.body = $('body');
    qodef.html = $('html, body');
    qodef.htmlEl = $('html');
    qodef.menuDropdownHeightSet = false;
    qodef.defaultHeaderStyle = '';
    qodef.minVideoWidth = 1500;
    qodef.videoWidthOriginal = 1280;
    qodef.videoHeightOriginal = 720;
    qodef.videoRatio = 1280/720;

    function qodefTransitionEvent() {
        var el = document.createElement('transitionDetector'),
            transEndEventNames = {
                'WebkitTransition' : 'webkitTransitionEnd',// Saf 6, Android Browser
                'MozTransition'    : 'transitionend',      // only for FF < 15
                'transition'       : 'transitionend'       // IE10, Opera, Chrome, FF 15+, Saf 7+
            };

        for(var t in transEndEventNames){
            if( el.style[t] !== undefined ){
                return transEndEventNames[t];
            }
        }
    }

    qodef.transitionEnd = qodefTransitionEvent();

    qodef.qodefOnDocumentReady = qodefOnDocumentReady;
    qodef.qodefOnWindowLoad = qodefOnWindowLoad;
    qodef.qodefOnWindowResize = qodefOnWindowResize;
    qodef.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodef.scroll = $(window).scrollTop();

        //set global variable for header style which we will use in various functions
        if(qodef.body.hasClass('qodef-dark-header')){ qodef.defaultHeaderStyle = 'qodef-dark-header';}
        if(qodef.body.hasClass('qodef-light-header')){ qodef.defaultHeaderStyle = 'qodef-light-header';}

    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodef.windowWidth = $(window).width();
        qodef.windowHeight = $(window).height();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {
        qodef.scroll = $(window).scrollTop();
    }



    //set boxed layout width variable for various calculations

    switch(true){
        case qodef.body.hasClass('qodef-grid-1300'):
            qodef.boxedLayoutWidth = 1350;
            break;
        case qodef.body.hasClass('qodef-grid-1200'):
            qodef.boxedLayoutWidth = 1250;
            break;
        case qodef.body.hasClass('qodef-grid-1000'):
            qodef.boxedLayoutWidth = 1050;
            break;
        case qodef.body.hasClass('qodef-grid-800'):
            qodef.boxedLayoutWidth = 850;
            break;
        default :
            qodef.boxedLayoutWidth = 1150;
            break;
    }

})(jQuery);
(function($) {
	"use strict";

    var common = {};
    qodef.modules.common = common;

    common.qodefIsTouchDevice = qodefIsTouchDevice;
    common.qodefDisableSmoothScrollForMac = qodefDisableSmoothScrollForMac;
    common.qodefFluidVideo = qodefFluidVideo;
    common.qodefPreloadBackgrounds = qodefPreloadBackgrounds;
    common.qodefPrettyPhoto = qodefPrettyPhoto;
    common.qodefCheckHeaderStyleOnScroll = qodefCheckHeaderStyleOnScroll;
    common.qodefInitParallax = qodefInitParallax;
    //common.qodefSmoothScroll = qodefSmoothScroll;
    common.qodefEnableScroll = qodefEnableScroll;
    common.qodefDisableScroll = qodefDisableScroll;
    common.qodefWheel = qodefWheel;
    common.qodefKeydown = qodefKeydown;
    common.qodefPreventDefaultValue = qodefPreventDefaultValue;
    common.qodefSlickSlider = qodefSlickSlider;
    common.qodefInitSelfHostedVideoPlayer = qodefInitSelfHostedVideoPlayer;
    common.qodefSelfHostedVideoSize = qodefSelfHostedVideoSize;
    common.qodefInitBackToTop = qodefInitBackToTop;
    common.qodefBackButtonShowHide = qodefBackButtonShowHide;
    common.qodefSmoothTransition = qodefSmoothTransition;
    common.qodefInitVideoBackgroundSize = qodefInitVideoBackgroundSize;

    common.qodefOnDocumentReady = qodefOnDocumentReady;
    common.qodefOnWindowLoad = qodefOnWindowLoad;
    common.qodefOnWindowResize = qodefOnWindowResize;
    common.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefIsTouchDevice();
        qodefDisableSmoothScrollForMac();
        qodefFluidVideo();
        qodefPreloadBackgrounds();
        qodefPrettyPhoto();
        qodefInitElementsAnimations();

        qodefInitVideoBackground();
        qodefInitVideoBackgroundSize();
        qodefSetContentBottomMargin();
        //qodefSmoothScroll();
		qodefSlickSlider();
        qodefInitSelfHostedVideoPlayer();
        qodefSelfHostedVideoSize();
        qodefInitBackToTop();
        qodefBackButtonShowHide();

    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {

        qodefCheckHeaderStyleOnScroll(); //called on load since all content needs to be loaded in order to calculate row's position right
        qodefInitParallax();
        qodefSmoothTransition();
	    qodefInitOverlapingAnimation();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefInitVideoBackgroundSize();
        qodefSelfHostedVideoSize();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {
        
    }

    /*
     ** Disable shortcodes animation on appear for touch devices
     */
    function qodefIsTouchDevice() {
        if(Modernizr.touch && !qodef.body.hasClass('qodef-no-animations-on-touch')) {
            qodef.body.addClass('qodef-no-animations-on-touch');
        }
    }

    /*
     ** Disable smooth scroll for mac if smooth scroll is enabled
     */
    function qodefDisableSmoothScrollForMac() {
        var os = navigator.appVersion.toLowerCase();

        if (os.indexOf('mac') > -1 && qodef.body.hasClass('qodef-smooth-scroll')) {
            qodef.body.removeClass('qodef-smooth-scroll');
        }
    }

	function qodefFluidVideo() {
        fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

	/**
     * Init Slick Carousel
     */
    function qodefSlickSlider() {

        var sliders = $('.qodef-slick-slider:not(.slick-initialized)');

        if (sliders.length) {
            sliders.each(function(){

                var slider = $(this);
				slider.slick({
					infinite: true,
					autoplay: true,
					slidesToShow : 1,
					arrows: true,
					dots: false,
					adaptiveHeight: true,
					prevArrow: '<span class="qodef-slick-prev qodef-prev-icon"><span class="fa fa-chevron-left"></span></span>',
					nextArrow: '<span class="qodef-slick-next qodef-next-icon"><span class="fa fa-chevron-right"></span></span>'
				});

            });
        }

    }


    /*
     *	Preload background images for elements that have 'qodef-preload-background' class
     */
    function qodefPreloadBackgrounds(){

        $(".qodef-preload-background").each(function() {
            var preloadBackground = $(this);
            if(preloadBackground.css("background-image") !== "" && preloadBackground.css("background-image") !== "none") {

                var bgUrl = preloadBackground.attr('style');

                bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
                bgUrl = bgUrl ? bgUrl[1] : "";

                if (bgUrl) {
                    var backImg = new Image();
                    backImg.src = bgUrl;
                    $(backImg).load(function(){
                        preloadBackground.removeClass('qodef-preload-background');
                    });
                }
            }else{
                $(window).load(function(){ preloadBackground.removeClass('qodef-preload-background'); }); //make sure that qodef-preload-background class is removed from elements with forced background none in css
            }
        });
    }

    function qodefPrettyPhoto() {
        /*jshint multistr: true */
        var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"> \
                                        <div class="qodef-stripes"> \
                                            <div class="qodef-rect1"></div> \
                                            <div class="qodef-rect2"></div> \
                                            <div class="qodef-rect3"></div> \
                                            <div class="qodef-rect4"></div> \
                                            <div class="qodef-rect5"></div> \
                                        </div> \
                                    </div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="fa fa-angle-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="fa fa-angle-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';

        $("a[data-rel^='prettyPhoto']").prettyPhoto({
            hook: 'data-rel',
            animation_speed: 'normal', /* fast/slow/normal */
            slideshow: false, /* false OR interval time in ms */
            autoplay_slideshow: false, /* true/false */
            opacity: 0.80, /* Value between 0 and 1 */
            show_title: true, /* true/false */
            allow_resize: true, /* Resize the photos bigger than viewport. true/false */
            horizontal_padding: 0,
            default_width: 960,
            default_height: 540,
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            deeplinking: false,
            custom_markup: '',
            social_tools: false,
            markup: markupWhole
        });
    }

    /*
     *	Check header style on scroll, depending on row settings
     */
    function qodefCheckHeaderStyleOnScroll(){

        if($('[data-qodef_header_style]').length > 0 && qodef.body.hasClass('qodef-header-style-on-scroll')) {

            var waypointSelectors = $('.wpb_row.qodef-section');
            var changeStyle = function(element){
                (element.data("qodef_header_style") !== undefined) ? qodef.body.removeClass('qodef-dark-header qodef-light-header').addClass(element.data("qodef_header_style")) : qodef.body.removeClass('qodef-dark-header qodef-light-header').addClass(''+qodef.defaultHeaderStyle);
            };

            waypointSelectors.waypoint( function(direction) {
                if(direction === 'down') { changeStyle($(this.element)); }
            }, { offset: 0});

            waypointSelectors.waypoint( function(direction) {
                if(direction === 'up') { changeStyle($(this.element)); }
            }, { offset: function(){
                return -$(this.element).outerHeight();
            } });
        }
    }

    /*
     *	Start animations on elements
     */
    function qodefInitElementsAnimations(){

        var touchClass = $('.qodef-no-animations-on-touch'),
            noAnimationsOnTouch = true,
            elements = $('.qodef-grow-in, .qodef-fade-in-down, .qodef-element-from-fade, .qodef-element-from-left, .qodef-element-from-right, .qodef-element-from-top, .qodef-element-from-bottom, .qodef-flip-in, .qodef-x-rotate, .qodef-z-rotate, .qodef-y-translate, .qodef-fade-in, .qodef-fade-in-left-x-rotate'),
            clasess,
            animationClass,
            animationData;

        if (touchClass.length) {
            noAnimationsOnTouch = false;
        }

        if(elements.length > 0 && noAnimationsOnTouch){
            elements.each(function(){
				$(this).appear(function() {
					animationData = $(this).data('animation');
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						$(this).addClass(animationClass+'-on');
					}
                },{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            });
        }

    }


/*
 ** Sections with parallax background image
 */
    function qodefInitParallax(){

        if($('.qodef-parallax-section-holder').length){
            $('.qodef-parallax-section-holder').each(function() {

                var parallaxElement = $(this);
                if(parallaxElement.hasClass('qodef-full-screen-height-parallax')){
                    parallaxElement.height(qodef.windowHeight);
                    parallaxElement.find('.qodef-parallax-content-outer').css('padding',0);
                }
                var speed = parallaxElement.data('qodef-parallax-speed')*0.4;
                parallaxElement.parallax("50%", speed);
            });
        }
    }



/*
 **	Video background initialization
 */
function qodefInitVideoBackground(){

    $('.qodef-section .qodef-video-wrap .qodef-video').mediaelementplayer({
        enableKeyboard: false,
        iPadUseNativeControls: false,
        pauseOtherPlayers: false,
        // force iPhone's native controls
        iPhoneUseNativeControls: false,
        // force Android's native controls
        AndroidUseNativeControls: false
    });

    //mobile check
    if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
        qodefInitVideoBackgroundSize();
        $('.qodef-section .qodef-mobile-video-image').show();
        $('.qodef-section .qodef-video-wrap').remove();
    }
}

    /*
     **	Calculate video background size
     */
    function qodefInitVideoBackgroundSize(){

        $('.qodef-section .qodef-video-wrap').each(function(){

            var element = $(this);
            var sectionWidth = element.closest('.qodef-section').outerWidth();
            element.width(sectionWidth);

            var sectionHeight = element.closest('.qodef-section').outerHeight();
            qodef.minVideoWidth = qodef.videoRatio * (sectionHeight+20);
            element.height(sectionHeight);

            var scaleH = sectionWidth / qodef.videoWidthOriginal;
            var scaleV = sectionHeight / qodef.videoHeightOriginal;
            var scale =  scaleV;
            if (scaleH > scaleV)
                scale =  scaleH;
            if (scale * qodef.videoWidthOriginal < qodef.minVideoWidth) {scale = qodef.minVideoWidth / qodef.videoWidthOriginal;}

            element.find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * qodef.videoWidthOriginal +2));
            element.find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * qodef.videoHeightOriginal +2));
            element.scrollLeft((element.find('video').width() - sectionWidth) / 2);
            element.find('.mejs-overlay, .mejs-poster').scrollTop((element.find('video').height() - (sectionHeight)) / 2);
            element.scrollTop((element.find('video').height() - sectionHeight) / 2);
        });

    }

    /*
     **	Set content bottom margin because of the uncovering footer
     */
    function qodefSetContentBottomMargin(){
        var uncoverFooter = $('.qodef-footer-uncover');

        if(uncoverFooter.length){
            $('.qodef-content').css('margin-bottom', $('.qodef-footer-inner').height());
        }
    }

	/*
	** Initiate Smooth Scroll
	*/
	//function qodefSmoothScroll(){
	//
	//	if(qodef.body.hasClass('qodef-smooth-scroll')){
	//
	//		var scrollTime = 0.4;			//Scroll time
	//		var scrollDistance = 300;		//Distance. Use smaller value for shorter scroll and greater value for longer scroll
	//
	//		var mobile_ie = -1 !== navigator.userAgent.indexOf("IEMobile");
	//
	//		var smoothScrollListener = function(event){
	//			event.preventDefault();
	//
	//			var delta = event.wheelDelta / 120 || -event.detail / 3;
	//			var scrollTop = qodef.window.scrollTop();
	//			var finalScroll = scrollTop - parseInt(delta * scrollDistance);
	//
	//			TweenLite.to(qodef.window, scrollTime, {
	//				scrollTo: {
	//					y: finalScroll, autoKill: !0
	//				},
	//				ease: Power1.easeOut,
	//				autoKill: !0,
	//				overwrite: 5
	//			});
	//		};
	//
	//		if (!$('html').hasClass('touch') && !mobile_ie) {
	//			if (window.addEventListener) {
	//				window.addEventListener('mousewheel', smoothScrollListener, false);
	//				window.addEventListener('DOMMouseScroll', smoothScrollListener, false);
	//			}
	//		}
	//	}
	//}

    function qodefDisableScroll() {

        if (window.addEventListener) {
            window.addEventListener('wheel', qodefWheel, {passive: false});
        }
        // window.onmousewheel = document.onmousewheel = qodefWheel;
        document.onkeydown = qodefKeydown;

        if(qodef.body.hasClass('qodef-smooth-scroll')){
            window.removeEventListener('mousewheel', smoothScrollListener, {passive: false});
            window.removeEventListener('wheel', smoothScrollListener, {passive: false});
        }
    }

    function qodefEnableScroll() {
        if (window.removeEventListener) {
            window.removeEventListener('wheel', qodefWheel, {passive: false});
        }
        window.onmousewheel = document.onmousewheel = document.onkeydown = null;

        if(qodef.body.hasClass('qodef-smooth-scroll')){
            window.addEventListener('mousewheel', smoothScrollListener, {passive: false});
            window.addEventListener('wheel', smoothScrollListener, {passive: false});
        }
    }

    function qodefWheel(e) {
        qodefPreventDefaultValue(e);
    }

    function qodefKeydown(e) {
        var keys = [37, 38, 39, 40];

        for (var i = keys.length; i--;) {
            if (e.keyCode === keys[i]) {
                qodefPreventDefaultValue(e);
                return;
            }
        }
    }

    function qodefPreventDefaultValue(e) {
        e = e || window.event;
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.returnValue = false;
    }

    function qodefInitSelfHostedVideoPlayer() {

        var players = $('.qodef-self-hosted-video');
            players.mediaelementplayer({
                audioWidth: '100%'
            });
    }

	function qodefSelfHostedVideoSize(){

		$('.qodef-self-hosted-video-holder .qodef-video-wrap').each(function(){
			var thisVideo = $(this);

			var videoWidth = thisVideo.closest('.qodef-self-hosted-video-holder').outerWidth();
			var videoHeight = videoWidth / qodef.videoRatio;

			if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
				thisVideo.parent().width(videoWidth);
				thisVideo.parent().height(videoHeight);
			}

			thisVideo.width(videoWidth);
			thisVideo.height(videoHeight);

			thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
			thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
		});
	}

    function qodefToTopButton(a) {

        var b = $("#qodef-back-to-top");
        b.removeClass('off on');
        if (a === 'on') { b.addClass('on'); } else { b.addClass('off'); }
    }

    function qodefBackButtonShowHide(){
        qodef.window.scroll(function () {
            var b = $(this).scrollTop();
            var c = $(this).height();
            var d;
            if (b > 0) { d = b + c / 2; } else { d = 1; }
            if (d < 1e3) { qodefToTopButton('off'); }
            else { qodefToTopButton('on'); }
        });
    }

    function qodefInitBackToTop(){
        var backToTopButton = $('#qodef-back-to-top');
        backToTopButton.on('click',function(e){
            e.preventDefault();
            qodef.html.animate({scrollTop: 0}, qodef.window.scrollTop()/4, 'easeInOutQuint');
        });
    }

    function qodefSmoothTransition() {
        var loader = $('body > .qodef-smooth-transition-loader.qodef-mimic-ajax');
        if (loader.length) {
            loader.find('.qodef-st-loader').fadeOut(200, 'easeInOutQuint', function(){
                loader.fadeOut(600, 'easeInOutQuint');
            });
            $(window).on("pageshow", function(event) {
                if (event.originalEvent.persisted) {
                    loader.find('.qodef-st-loader').fadeOut(200, 'easeInOutQuint', function(){
                        loader.fadeOut(600, 'easeInOutQuint');
                    });
                }
            });

            $('a').on('click',function(e) {
                var a = $(this);
                if (
                    e.which === 1 && // check if the left mouse button has been pressed
                    a.attr('href') !== undefined && a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
					(typeof a.data('rel') === 'undefined') && //Not pretty photo link
                    (typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
                    !a.hasClass('qodef-like') && //Not like link
                    !a.parent().hasClass('qodef-blog-load-more-button') &&
                    (typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
                    (a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
                ) {
                    e.preventDefault();
                    loader.addClass('qodef-hide-spinner');
                    loader.fadeIn(500, function() {
                        window.location = a.attr('href');
                    });
                }
            });
        }
    }

	/*
	 *	Animations for overlapping content
	 */
	function qodefInitOverlapingAnimation(){

		var touchClass = $('.qodef-no-animations-on-touch'),
			noAnimationsOnTouch = true,
			elements = $('.qodef-overlapping-content-holder');

		if (touchClass.length) {
			noAnimationsOnTouch = false;
		}

		if(elements.length){
			elements.each(function(){
				var element = $(this);
				if(noAnimationsOnTouch) {
					element.appear(function() {
						setTimeout(function(){
							element.addClass('qodef-animated');
						},100);
					},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
				} else {
					element.addClass('qodef-appeared');
				}
			});
		}

	}



})(jQuery);



(function ($) {
    "use strict";

    var header = {};
    qodef.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour;
    header.qodefSideArea = qodefSideArea;
    header.qodefSideAreaScroll = qodefSideAreaScroll;
    header.qodefFullscreenMenu = qodefFullscreenMenu;
    header.qodefInitMobileNavigation = qodefInitMobileNavigation;
    header.qodefMobileHeaderBehavior = qodefMobileHeaderBehavior;
    header.qodefSetDropDownMenuPosition = qodefSetDropDownMenuPosition;
    header.qodefDropDownMenu = qodefDropDownMenu;
    header.qodefSearch = qodefSearch;
    header.qodefVerticalMenuScroll = qodefVerticalMenuScroll;
    header.qodefMenuLine = qodefMenuLine;

    header.qodefOnDocumentReady = qodefOnDocumentReady;
    header.qodefOnWindowLoad = qodefOnWindowLoad;
    header.qodefOnWindowResize = qodefOnWindowResize;
    header.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefHeaderBehaviour();
        qodefSideArea();
        qodefSideAreaScroll();
        qodefFullscreenMenu();
        qodefInitMobileNavigation();
        qodefMobileHeaderBehavior();
        qodefSetDropDownMenuPosition();
        qodefDropDownMenu();
        qodefSearch();
        //qodefVerticalMenuScroll();
        qodefVerticalMenu().init();
        qodefInitDividedHeaderMenu();
        qodefMenuLine();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
        qodefDropDownMenu();
        qodefSetDropDownMenuPosition();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefInitDividedHeaderMenu();
        qodefDropDownMenu();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {

    }


    /*
     **	Show/Hide sticky header on window scroll
     */
    function qodefHeaderBehaviour() {

        var header = $('.qodef-page-header');
        var stickyHeader = $('.qodef-sticky-header');
        var fixedHeaderWrapper = $('.qodef-fixed-wrapper');

        var headerMenuAreaOffset = $('.qodef-page-header').find('.qodef-fixed-wrapper').length ? $('.qodef-page-header').find('.qodef-fixed-wrapper').offset().top : null;

        var stickyAppearAmount;


        switch (true) {
            // sticky header that will be shown when user scrolls up
            case qodef.body.hasClass('qodef-sticky-header-on-scroll-up'):
                qodef.modules.header.behaviour = 'qodef-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = qodefGlobalVars.vars.qodefTopBarHeight + qodefGlobalVars.vars.qodefLogoAreaHeight + qodefGlobalVars.vars.qodefMenuAreaHeight + qodefGlobalVars.vars.qodefStickyHeaderHeight;

                var headerAppear = function () {
                    var docYScroll2 = $(document).scrollTop();

                    if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        qodef.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.qodef-main-menu .qodef-menu-second').removeClass('qodef-drop-down-start');
                    } else {
                        qodef.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function () {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case qodef.body.hasClass('qodef-sticky-header-on-scroll-down-up'):
                qodef.modules.header.behaviour = 'qodef-sticky-header-on-scroll-down-up';

                if (qodefPerPageVars.vars.qodefStickyScrollAmount !== 0) {
                    qodef.modules.header.stickyAppearAmount = qodefPerPageVars.vars.qodefStickyScrollAmount;
                } else {
                    qodef.modules.header.stickyAppearAmount = qodefGlobalVars.vars.qodefStickyScrollAmount !== 0 ? qodefGlobalVars.vars.qodefStickyScrollAmount : qodefGlobalVars.vars.qodefTopBarHeight + qodefGlobalVars.vars.qodefLogoAreaHeight + qodefGlobalVars.vars.qodefMenuAreaHeight;
                }

                var headerAppear = function () {
                    if (qodef.scroll < qodef.modules.header.stickyAppearAmount) {
                        qodef.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.qodef-main-menu .qodef-menu-second').removeClass('qodef-drop-down-start');
                    } else {
                        qodef.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function () {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case qodef.body.hasClass('qodef-fixed-on-scroll'):
                qodef.modules.header.behaviour = 'qodef-fixed-on-scroll';
                var headerFixed = function () {
                    if (qodef.scroll < headerMenuAreaOffset) {
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom', 0);
                    } else {
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom', fixedHeaderWrapper.height());
                    }
                };

                headerFixed();

                $(window).scroll(function () {
                    headerFixed();
                });

                break;
        }
    }

    /**
     * Show/hide side area
     */
    function qodefSideArea() {

        var wrapper = $('.qodef-wrapper'),
            sideMenu = $('.qodef-side-menu'),
            sideMenuButtonOpen = $('a.qodef-side-menu-button-opener'),
            cssClass,
            //Flags
            slideFromRight = false,
            slideWithContent = false,
            slideUncovered = false;

        if (qodef.body.hasClass('qodef-side-menu-slide-from-right')) {
            $('.qodef-cover').remove();
            cssClass = 'qodef-right-side-menu-opened';
            wrapper.prepend('<div class="qodef-cover"/>');
            slideFromRight = true;

        } else if (qodef.body.hasClass('qodef-side-menu-slide-with-content')) {

            cssClass = 'qodef-side-menu-open';
            slideWithContent = true;

        } else if (qodef.body.hasClass('qodef-side-area-uncovered-from-content')) {

            cssClass = 'qodef-right-side-menu-opened';
            slideUncovered = true;

        }

        $('a.qodef-side-menu-button-opener, a.qodef-close-side-menu').on('click', function (e) {
            e.preventDefault();

            if (!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                qodef.body.addClass(cssClass);

                if (slideFromRight) {
                    $('.qodef-wrapper .qodef-cover').on('click', function () {
                        qodef.body.removeClass('qodef-right-side-menu-opened');
                        sideMenuButtonOpen.removeClass('opened');
                    });
                }

                if (slideUncovered) {
                    sideMenu.css({
                        'visibility': 'visible'
                    });
                }

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function () {
                    if (Math.abs(qodef.scroll - currentScroll) > 400) {
                        qodef.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                        if (slideUncovered) {
                            var hideSideMenu = setTimeout(function () {
                                sideMenu.css({'visibility': 'hidden'});
                                clearTimeout(hideSideMenu);
                            }, 400);
                        }
                    }
                });

            } else {

                sideMenuButtonOpen.removeClass('opened');
                qodef.body.removeClass(cssClass);
                if (slideUncovered) {
                    var hideSideMenu = setTimeout(function () {
                        sideMenu.css({'visibility': 'hidden'});
                        clearTimeout(hideSideMenu);
                    }, 400);
                }

            }

            if (slideWithContent) {

                e.stopPropagation();
                wrapper.on('click', function () {
                    e.preventDefault();
                    sideMenuButtonOpen.removeClass('opened');
                    qodef.body.removeClass('qodef-side-menu-open');
                });

            }

        });

    }

    /*
    **  Smooth scroll functionality for Side Area
    */
    function qodefSideAreaScroll() {

        var sideMenu = $('.qodef-side-menu');

        if (sideMenu.length) {
            sideMenu.niceScroll({
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            });
        }
    }

    /**
     * Init Fullscreen Menu
     */
    function qodefFullscreenMenu() {

        if ($('a.qodef-fullscreen-menu-opener').length) {

            var popupMenuOpener = $('a.qodef-fullscreen-menu-opener'),
                popupMenuHolderOuter = $(".qodef-fullscreen-menu-holder-outer"),
                cssClass,
                //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
                //Widgets
                widgetAboveNav = $('.qodef-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.qodef-fullscreen-below-menu-widget-holder'),
                //Menu
                menuItems = $('.qodef-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild = $('.qodef-fullscreen-menu > ul li.qodef-has-sub > a'),
                menuItemWithoutChild = $('.qodef-fullscreen-menu ul li:not(.qodef-has-sub) a');


            //set height of popup holder and initialize nicescroll
            popupMenuHolderOuter.height(qodef.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of popup holder on resize
            $(window).resize(function () {
                popupMenuHolderOuter.height(qodef.windowHeight);
            });

            if (qodef.body.hasClass('qodef-fade-push-text-right')) {
                cssClass = 'qodef-push-nav-right';
                fadeRight = true;
            } else if (qodef.body.hasClass('qodef-fade-push-text-top')) {
                cssClass = 'qodef-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay': 0 + 'ms',
                        '-moz-animation-delay': 0 + 'ms',
                        'animation-delay': 0 + 'ms'
                    });
                }
                menuItems.each(function (i) {
                    $(this).css({
                        '-webkit-animation-delay': (i + 1) * 70 + 'ms',
                        '-moz-animation-delay': (i + 1) * 70 + 'ms',
                        'animation-delay': (i + 1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay': (menuItems.length + 1) * 70 + 'ms',
                        '-moz-animation-delay': (menuItems.length + 1) * 70 + 'ms',
                        'animation-delay': (menuItems.length + 1) * 70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click', function (e) {
                e.preventDefault();

                if (!popupMenuOpener.hasClass('opened')) {
                    popupMenuOpener.addClass('opened');
                    qodef.body.addClass('qodef-fullscreen-menu-opened');
                    qodef.body.removeClass('qodef-fullscreen-fade-out').addClass('qodef-fullscreen-fade-in');
                    qodef.body.removeClass(cssClass);
                    if (!qodef.body.hasClass('page-template-full_screen-php')) {
                        qodef.modules.common.qodefDisableScroll();
                    }
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) {
                            popupMenuOpener.removeClass('opened');
                            qodef.body.removeClass('qodef-fullscreen-menu-opened');
                            qodef.body.removeClass('qodef-fullscreen-fade-in').addClass('qodef-fullscreen-fade-out');
                            qodef.body.addClass(cssClass);
                            if (!qodef.body.hasClass('page-template-full_screen-php')) {
                                qodef.modules.common.qodefEnableScroll();
                            }
                            $("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200, function () {
                                $('nav.popup_menu').getNiceScroll().resize();
                            });
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('opened');
                    qodef.body.removeClass('qodef-fullscreen-menu-opened');
                    qodef.body.removeClass('qodef-fullscreen-fade-in').addClass('qodef-fullscreen-fade-out');
                    qodef.body.addClass(cssClass);
                    if (!qodef.body.hasClass('page-template-full_screen-php')) {
                        qodef.modules.common.qodefEnableScroll();
                    }
                    $("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200, function () {
                        $('nav.popup_menu').getNiceScroll().resize();
                    });
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function (e) {
                e.preventDefault();

                if ($(this).parent().hasClass('qodef-has-sub')) {
                    var submenu = $(this).parent().find('> ul.sub_menu');
                    if (submenu.is(':visible')) {
                        submenu.slideUp(200, function () {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                        $(this).parent().removeClass('open_sub');
                    } else {
                        if ($(this).parent().siblings().hasClass('open_sub')) {
                            $(this).parent().siblings().each(function () {
                                var sibling = $(this);
                                if (sibling.hasClass('open_sub')) {
                                    var openedUl = sibling.find('> ul.sub_menu');
                                    openedUl.slideUp(200, function () {
                                        popupMenuHolderOuter.getNiceScroll().resize();
                                    });
                                    sibling.removeClass('open_sub');
                                }
                                if (sibling.find('.open_sub')) {
                                    var openedUlUl = sibling.find('.open_sub').find('> ul.sub_menu');
                                    openedUlUl.slideUp(200, function () {
                                        popupMenuHolderOuter.getNiceScroll().resize();
                                    });
                                    sibling.find('.open_sub').removeClass('open_sub');
                                }
                            });
                        }

                        $(this).parent().addClass('open_sub');
                        submenu.slideDown(200, function () {
                            popupMenuHolderOuter.getNiceScroll().resize();
                        });
                    }
                }
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.on('click', function (e) {

                if (($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")) {

                    if (e.which === 1) {
                        popupMenuOpener.removeClass('opened');
                        qodef.body.removeClass('qodef-fullscreen-menu-opened');
                        qodef.body.removeClass('qodef-fullscreen-fade-in').addClass('qodef-fullscreen-fade-out');
                        qodef.body.addClass(cssClass);
                        $("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200, function () {
                            $('nav.popup_menu').getNiceScroll().resize();
                        });
                        qodef.modules.common.qodefEnableScroll();
                    }
                } else {
                    return false;
                }

            });

        }


    }

    /**
     * Init Divided Header Menu
     */
    function qodefInitDividedHeaderMenu() {
        if (qodef.body.hasClass('qodef-header-divided')) {
            //get left side menu width
            var menuArea = $('.qodef-menu-area'),
                stickyArea = $('.qodef-sticky-holder'),
                menuAreaWidth = menuArea.width(),
                stickyAreaWidth = stickyArea.width(),
                menuAreaItem = $('.qodef-main-menu > ul > li > a'),
                menuItemPadding = 0,
                logoArea = menuArea.find('.qodef-logo-wrapper .qodef-normal-logo'),
                logoAreaWidth = 0;

            if (menuArea.children('.qodef-grid').length) {
                menuAreaWidth = menuArea.children('.qodef-grid').outerWidth();
            }

            if (stickyArea.children('.qodef-grid').length) {
                stickyAreaWidth = stickyArea.children('.qodef-grid').outerWidth();
            }

            if (menuAreaItem.length) {
                menuItemPadding = parseInt(menuAreaItem.css('padding-left'));
            }

            if (logoArea.length) {
                logoAreaWidth = logoArea.width() / 2;
            }

            var menuAreaLeftRightSideWidth = Math.round(menuAreaWidth / 2 - menuItemPadding - logoAreaWidth);
            var stickyAreaLeftRightSideWidth = Math.round(stickyAreaWidth / 2 - menuItemPadding - logoAreaWidth);

            $('.qodef-menu-area .qodef-position-left').width(menuAreaLeftRightSideWidth);
            $('.qodef-menu-area .qodef-position-right').width(menuAreaLeftRightSideWidth);

            $('.qodef-sticky-header .qodef-position-left').width(stickyAreaLeftRightSideWidth);
            $('.qodef-sticky-header .qodef-position-right').width(stickyAreaLeftRightSideWidth);

            menuArea.find('nav').css('opacity', 1);
        }
    }

    function qodefInitMobileNavigation() {
        var navigationOpener = $('.qodef-mobile-header .qodef-mobile-menu-opener');
        var navigationHolder = $('.qodef-mobile-header .qodef-mobile-nav');
        var dropdownOpener = $('.qodef-mobile-nav .mobile_arrow, .qodef-mobile-nav h4, .qodef-mobile-nav a[href*="#"]');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if (navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function (e) {
                e.stopPropagation();
                e.preventDefault();

                if (navigationHolder.is(':visible')) {
                    navigationHolder.slideUp(animationSpeed);
                } else {
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if (dropdownOpener.length) {
            dropdownOpener.each(function () {
                $(this).on('tap click', function (e) {
                    var dropdownToOpen = $(this).nextAll('ul').first();

                    if (dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = $(this).parent('li');
                        if (dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('qodef-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('qodef-opened');
                        }
                    }

                });
            });
        }

        $('.qodef-mobile-nav a, .qodef-mobile-logo-wrapper a').on('click tap', function (e) {
            if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function qodefMobileHeaderBehavior() {
        if (qodef.body.hasClass('qodef-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var topBar = $('.qodef-top-bar');
            var mobileHeader = $('.qodef-mobile-header');
            var adminBar = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var topBarHeight = topBar.is(':visible') ? topBar.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = topBarHeight + mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function () {
                var docYScroll2 = $(document).scrollTop();

                if (docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('qodef-animate-mobile-header');
                    mobileHeader.css('margin-bottom', mobileHeaderHeight);
                } else {
                    mobileHeader.removeClass('qodef-animate-mobile-header');
                    mobileHeader.css('margin-bottom', 0);
                }

                if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    if (adminBar.length) {
                        mobileHeader.find('.qodef-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');

                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

    /**
     * Set dropdown position
     */
    function qodefSetDropDownMenuPosition() {

        var menuItems = $(".qodef-drop-down > ul > li.qodef-menu-narrow");
        menuItems.each(function (i) {

            var browserWidth = qodef.windowWidth - 16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.qodef-menu-second .qodef-menu-inner ul').width();

            var menuItemFromLeft = 0;
            if (qodef.body.hasClass('boxed')) {
                menuItemFromLeft = qodef.boxedLayoutWidth - (menuItemPosition - (browserWidth - qodef.boxedLayoutWidth) / 2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if ($(this).find('li.qodef-sub').length > 0) {
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
                $(this).find('.qodef-menu-second').addClass('right');
                $(this).find('.qodef-menu-second .qodef-menu-inner ul').addClass('right');
            }
        });

    }


    function qodefDropDownMenu() {

        var menu_items = $('.qodef-drop-down > ul > li');

        menu_items.each(function (i) {
            if ($(menu_items[i]).find('.qodef-menu-second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.qodef-menu-second');

                if ($(menu_items[i]).hasClass('qodef-menu-wide')) {

                    var dropdown = $(this).find('.qodef-menu-inner > ul');
                    var dropdownPadding = parseInt(dropdown.css('padding-left').slice(0, -2)) + parseInt(dropdown.css('padding-right').slice(0, -2));
                    var dropdownWidth = dropdown.outerWidth();

                    if (!$(this).hasClass('qodef-menu-left-position') && !$(this).hasClass('qodef-menu-right-position')) {
                        dropDownSecondDiv.css('left', 0);
                    }

                    //set columns to be same height - start
                    var tallest = 0;
                    $(this).find('.qodef-menu-second > .qodef-menu-inner > ul > li').each(function () {
                        var thisHeight = $(this).height();
                        if (thisHeight > tallest) {
                            tallest = thisHeight;
                        }
                    });
                    $(this).find('.qodef-menu-second > .qodef-menu-inner > ul > li').css("height", ""); // delete old inline css - via resize
                    $(this).find('.qodef-menu-second > .qodef-menu-inner > ul > li').height(tallest);
                    //set columns to be same height - end

                    if (!$(this).hasClass('qodef-wide-background')) {
                        if (!$(this).hasClass('qodef-menu-left-position') && !$(this).hasClass('qodef-menu-right-position')) {
                            var left_position = (qodef.windowWidth - 2 * (qodef.windowWidth - dropdown.offset().left)) / 2 + (dropdownWidth + dropdownPadding) / 2;
                            dropDownSecondDiv.css('left', -left_position);
                        }
                    } else {
                        if (!$(this).hasClass('qodef-menu-left-position') && !$(this).hasClass('qodef-menu-right-position')) {
                            var left_position = $(this).offset().left;

                            dropDownSecondDiv.css('left', -left_position);
                            dropDownSecondDiv.css('width', qodef.windowWidth);

                        }
                    }
                }

                if (!qodef.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function () {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function () {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    if (qodef.body.hasClass('qodef-dropdown-animate-height')) {
                        $(menu_items[i]).mouseenter(function () {
                            dropDownSecondDiv.css({
                                'visibility': 'visible',
                                'height': '0px',
                                'opacity': '0'
                            });
                            dropDownSecondDiv.stop().animate({
                                'height': $(menu_items[i]).data('original_height'),
                                opacity: 1
                            }, 200, function () {
                                dropDownSecondDiv.css('overflow', 'visible');
                            });
                        }).mouseleave(function () {
                            dropDownSecondDiv.stop().animate({
                                'height': '0px'
                            }, 0, function () {
                                dropDownSecondDiv.css({
                                    'overflow': 'hidden',
                                    'visibility': 'hidden'
                                });
                            });
                        });
                    } else {
                        var config = {
                            interval: 0,
                            over: function () {
                                setTimeout(function () {
                                    dropDownSecondDiv.addClass('qodef-drop-down-start');
                                    dropDownSecondDiv.stop().css({'height': $(menu_items[i]).data('original_height')});
                                }, 150);
                            },
                            timeout: 150,
                            out: function () {
                                dropDownSecondDiv.stop().css({'height': '0px'});
                                dropDownSecondDiv.removeClass('qodef-drop-down-start');
                            }
                        };
                        $(menu_items[i]).hoverIntent(config);
                    }
                }
            }
        });
        $('.qodef-drop-down ul li.qodef-menu-wide ul li a').on('click', function (e) {
            if (e.which === 1) {
                var $this = $(this);
                setTimeout(function () {
                    $this.mouseleave();
                }, 500);
            }
        });

        qodef.menuDropdownHeightSet = true;
    }

    /**
     * Init Search Types
     */
    function qodefSearch() {

        var searchOpener = $('a.qodef-search-opener'),
            searchClose,
            searchForm,
            touch = false;

        if ($('html').hasClass('touch')) {
            touch = true;
        }

        if (searchOpener.length > 0) {
            //Check for type of search
            if (qodef.body.hasClass('qodef-fullscreen-search')) {

                searchClose = $('.qodef-fullscreen-search-close');

                qodefFullscreenSearch();

            }

            //Check for hover color of search
            searchOpener.each(function () {
                var thisSearchOpener = $(this);
                if (typeof thisSearchOpener.data('hover-color') !== 'undefined') {
                    var originalColor;

                    var changeSearchColor = function (event) {
                        event.data.thisSearchOpener.css('color', event.data.color);
                    };

                    if (typeof thisSearchOpener.data('color') !== 'undefined') {
                        originalColor = thisSearchOpener.data('color');
                    } else {
                        originalColor = thisSearchOpener.css('color');
                    }

                    var hoverColor = thisSearchOpener.data('hover-color');

                    thisSearchOpener.on('mouseenter', {
                        thisSearchOpener: thisSearchOpener,
                        color: hoverColor
                    }, changeSearchColor);
                    thisSearchOpener.on('mouseleave', {
                        thisSearchOpener: thisSearchOpener,
                        color: originalColor
                    }, changeSearchColor);
                }
            });

        }

        /**
         * Fullscreen search (two types: fade and from circle)
         */
        function qodefFullscreenSearch() {

            var searchHolder = $('.qodef-fullscreen-search-holder'),
                searchOverlay = $('.qodef-fullscreen-search-overlay'),
                searchField = searchHolder.find('.qodef-search-field');

            searchOpener.on('click', function (e) {
                e.preventDefault();
                var samePosition = false;
                if ($(this).data('icon-close-same-position') === 'yes') {
                    var closeTop = $(this).offset().top;
                    var closeLeft = $(this).offset().left;
                    samePosition = true;
                }
                //Fullscreen search fade
                if (searchHolder.hasClass('qodef-animate')) {
                    closeFullScreenSearch();
                } else {
                    openFullScreenSearch();
                }
                searchClose.on('click', function (e) {
                    closeFullScreenSearch();
                });
                //Close on escape
                $(document).keyup(function (e) {
                    if (e.keyCode === 27) { //KeyCode for ESC button is 27
                        closeFullScreenSearch();
                    }
                });
                //Close on click away
                $(document).mouseup(function (e) {
                    var container = $(".qodef-fullscreen-search-inner");
                    if (!container.is(e.target) && container.has(e.target).length === 0) {
                        closeFullScreenSearch();
                    }
                });

                function closeFullScreenSearch() {
                    qodef.body.removeClass('qodef-fullscreen-search-opened');
                    qodef.body.addClass('qodef-search-fade-out');
                    qodef.body.removeClass('qodef-search-fade-in');
                    searchHolder.removeClass('qodef-animate');
                    if (!qodef.body.hasClass('page-template-full_screen-php')) {
                        qodef.modules.common.qodefEnableScroll();
                    }
                    searchField.blur().val('');
                }

                function openFullScreenSearch() {
                    qodef.body.addClass('qodef-fullscreen-search-opened');
                    qodef.body.removeClass('qodef-search-fade-out');
                    qodef.body.addClass('qodef-search-fade-in');
                    searchHolder.addClass('qodef-animate');
                    if (samePosition) {
                        searchClose.css({
                            'top': closeTop - qodef.scroll, // Distance from top of viewport ( distance from top of window - scroll distance )
                            'left': closeLeft
                        });
                    }
                    if (!qodef.body.hasClass('page-template-full_screen-php')) {
                        qodef.modules.common.qodefDisableScroll();
                    }
                    setTimeout(function () {
                        searchField.focus();
                    }, 600);
                }
            });

            //Text input focus change
            $('.qodef-fullscreen-search-holder .qodef-search-field').focus(function () {
                $('.qodef-fullscreen-search-holder .qodef-field-holder .qodef-line').css("width", "100%");
            });

            $('.qodef-fullscreen-search-holder .qodef-search-field').blur(function () {
                setTimeout(function () {
                    $('.qodef-fullscreen-search-holder .qodef-field-holder .qodef-line').css("width", "0");
                }, 120);
            });

        }

    }


    /*
     **  Smooth scroll functionality for Vertical Menu
     */
    function qodefVerticalMenuScroll() {

        function verticalSideareascroll(event) {
            var delta = 0;
            if (!event) event = window.event;
            if (event.wheelDelta) {
                delta = event.wheelDelta / 120;
            } else if (event.detail) {
                delta = -event.detail / 3;
            }
            if (delta)
                handle(delta);
            if (event.preventDefault)
                event.preventDefault();
            event.returnValue = false;
        }

        function handle(delta) {
            if (delta < 0) {
                if (Math.abs(margin) <= maxMargin) {
                    margin += delta * 20;
                    $(verticalMenuInner).css('margin-top', margin);
                }
            } else {
                if (margin <= -20) {
                    margin += delta * 20;
                    $(verticalMenuInner).css('margin-top', margin);
                }
            }
        }

        if ($('.qodef-vertical-menu-area').length && qodef.windowWidth < 1500) {

            var browserHeight = qodef.windowHeight;
            var verticalMenuArea = $('.qodef-vertical-menu-area');
            var verticalMenuInner = $('.qodef-vertical-menu-area .qodef-vertical-menu-area-inner');
            var verticalMenu = verticalMenuInner.find('.qodef-vertical-menu');
            var verticalMenuHeight = verticalMenu.outerHeight() + parseInt(verticalMenuArea.css('padding-top')) + parseInt(verticalMenuArea.css('padding-bottom'));
            var margin = 0;
            var maxMargin = (browserHeight - verticalMenuHeight) / 2;

            $(verticalMenuArea).hover(
                function () {
                    qodef.modules.common.qodefDisableScroll();
                    if (window.addEventListener) {
                        window.addEventListener('mousewheel', verticalSideareascroll, false);
                        window.addEventListener('DOMMouseScroll', verticalSideareascroll, false);
                    }
                    window.onmousewheel = document.onmousewheel = verticalSideareascroll;
                },
                function () {
                    qodef.modules.common.qodefEnableScroll();
                    window.removeEventListener('mousewheel', verticalSideareascroll, false);
                    window.removeEventListener('DOMMouseScroll', verticalSideareascroll, false);
                }
            );
        }
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var qodefVerticalMenu = function () {
        /**
         * Main vertical area object that used through out function
         * @type {jQuery object}
         */
        var verticalMenuObject = $('.qodef-vertical-menu-area');


        var initNavigation = function () {
            var varticalMenuOpener = verticalMenuObject.find('.qodef-vertical-menu-opener a'),
                verticalMenuNavHolder = verticalMenuObject.find('.qodef-vertical-menu-nav-holder-outer'),
                menuItemWithChild = verticalMenuObject.find('.qodef-fullscreen-menu > ul li.qodef-has-sub > a'),
                menuItemWithoutChild = verticalMenuObject.find('.qodef-fullscreen-menu ul li:not(.qodef-has-sub) a');

            //set height of vertical menu holder and initialize nicescroll
            verticalMenuNavHolder.height(qodef.windowHeight).niceScroll({
                scrollspeed: 30,
                mousescrollstep: 20,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            }); //200 is top and bottom padding of holder

            //set height of vertical menu holder on resize
            $(window).resize(function () {
                verticalMenuNavHolder.height(qodef.windowHeight);
            });

            varticalMenuOpener.on('click', function (e) {
                e.preventDefault();

                if (!verticalMenuNavHolder.hasClass('active')) {
                    verticalMenuNavHolder.addClass('active');
                    verticalMenuObject.addClass('opened');
                    if (!qodef.body.hasClass('page-template-full_screen-php')) {
                        qodef.modules.common.qodefDisableScroll();
                    }
                } else {
                    verticalMenuNavHolder.removeClass('active');
                    verticalMenuObject.removeClass('opened');
                    if (!qodef.body.hasClass('page-template-full_screen-php')) {
                        qodef.modules.common.qodefEnableScroll();
                    }
                }
            });

            $('.qodef-content').on('click', function () {
                if (verticalMenuNavHolder.hasClass('active')) {
                    verticalMenuNavHolder.removeClass('active');
                    verticalMenuObject.removeClass('opened');
                    if (!qodef.body.hasClass('page-template-full_screen-php')) {
                        qodef.modules.common.qodefEnableScroll();
                    }
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function (e) {
                e.preventDefault();

                if ($(this).parent().hasClass('qodef-has-sub')) {
                    var submenu = $(this).parent().find('> ul.sub_menu');
                    if (submenu.is(':visible')) {
                        submenu.slideUp(200, function () {
                            verticalMenuNavHolder.getNiceScroll().resize();
                        });
                        $(this).parent().removeClass('open_sub');
                    } else {
                        if ($(this).parent().siblings().hasClass('open_sub')) {
                            $(this).parent().siblings().each(function () {
                                var sibling = $(this);
                                if (sibling.hasClass('open_sub')) {
                                    var openedUl = sibling.find('> ul.sub_menu');
                                    openedUl.slideUp(200, function () {
                                        verticalMenuNavHolder.getNiceScroll().resize();
                                    });
                                    sibling.removeClass('open_sub');
                                }
                                if (sibling.find('.open_sub')) {
                                    var openedUlUl = sibling.find('.open_sub').find('> ul.sub_menu');
                                    openedUlUl.slideUp(200, function () {
                                        verticalMenuNavHolder.getNiceScroll().resize();
                                    });
                                    sibling.find('.open_sub').removeClass('open_sub');
                                }
                            });
                        }

                        $(this).parent().addClass('open_sub');
                        submenu.slideDown(200, function () {
                            verticalMenuNavHolder.getNiceScroll().resize();
                        });
                    }
                }
                return false;
            });

        };

        return {
            /**
             * Calls all necessary functionality for vertical menu area if vertical area object is valid
             */
            init: function () {
                if (verticalMenuObject.length) {
                    initNavigation();

                }
            }
        };
    };


    function qodefMenuLine() {
        var firstLevelMenus = $('.qodef-main-menu > ul');

        if (firstLevelMenus.length) {
            firstLevelMenus.each(function () {
                var mainMenu = $(this);

                mainMenu.append('<li class="qodef-main-menu-line"></li>');

                var menuLine = mainMenu.find('.qodef-main-menu-line'),
                    menuItems = mainMenu.find('> li.menu-item'),
                    initialOffset;

                menuLine.css('border-color', menuItems.find('a').css('color'));

                if (menuItems.filter('.qodef-active-item').length) {
                    initialOffset = menuItems.filter('.qodef-active-item').offset().left;
                    menuLine.css('width', menuItems.filter('.qodef-active-item').outerWidth());
                } else {
                    initialOffset = menuItems.first().offset().left;
                    menuLine.css('width', menuItems.first().outerWidth());
                }

                //initial positioning
                menuLine.css('left', initialOffset - mainMenu.offset().left);

                //fx on
                menuItems.mouseenter(function () {
                    var menuItem = $(this),
                        menuItemWidth = menuItem.outerWidth(),
                        mainMenuOffset = mainMenu.offset().left,
                        menuItemOffset = menuItem.offset().left - mainMenuOffset;

                    menuLine.css('width', menuItemWidth);
                    menuLine.css('left', menuItemOffset);
                });

                //fx off
                mainMenu.mouseleave(function () {
                    if (menuItems.filter('.qodef-active-item').length) {
                        menuLine.css('width', menuItems.filter('.qodef-active-item').outerWidth());
                        initialOffset = menuItems.filter('.qodef-active-item').offset().left;
                    } else {
                        menuLine.css('width', menuItems.first().outerWidth());
                    }

                    menuLine.css('left', initialOffset - mainMenu.offset().left);
                });
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var title = {};
    qodef.modules.title = title;

    title.qodefParallaxTitle = qodefParallaxTitle;

    title.qodefOnDocumentReady = qodefOnDocumentReady;
    title.qodefOnWindowLoad = qodefOnWindowLoad;
    title.qodefOnWindowResize = qodefOnWindowResize;
    title.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefParallaxTitle();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {

    }
    

    /*
     **	Title image with parallax effect
     */
    function qodefParallaxTitle(){
        if($('.qodef-title.qodef-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.qodef-title.qodef-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.qodef-title.qodef-has-parallax-background.qodef-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(qodef.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+qodefGlobalVars.vars.qodefAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-qodef.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(qodef.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+qodefGlobalVars.vars.qodefAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-qodef.scroll + 'px auto'});
            });

        }
    }

})(jQuery);

(function ($) {
    'use strict';

    var shortcodes = {};

    qodef.modules.shortcodes = shortcodes;

    shortcodes.qodefInitCounter = qodefInitCounter;
    shortcodes.qodefInitProgressBars = qodefInitProgressBars;
    shortcodes.qodefInitCountdown = qodefInitCountdown;
    shortcodes.qodefInitMessages = qodefInitMessages;
    shortcodes.qodefInitMessageHeight = qodefInitMessageHeight;
    shortcodes.qodefInitTestimonials = qodefInitTestimonials;
    shortcodes.qodefInitCarousels = qodefInitCarousels;
    shortcodes.qodefInitPieChart = qodefInitPieChart;
    shortcodes.qodefInitPieChartDoughnut = qodefInitPieChartDoughnut;
    shortcodes.qodefInitTabs = qodefInitTabs;
    shortcodes.qodefInitTabIcons = qodefInitTabIcons;
    shortcodes.qodefInitBlogListMasonry = qodefInitBlogListMasonry;
    shortcodes.qodefCustomFontResize = qodefCustomFontResize;
    shortcodes.qodefInitImageGallery = qodefInitImageGallery;
    shortcodes.qodefInitAccordions = qodefInitAccordions;
    shortcodes.qodefShowGoogleMap = qodefShowGoogleMap;
    shortcodes.qodefCheckSliderForHeaderStyle = qodefCheckSliderForHeaderStyle;
    shortcodes.qodefInitShopListMasonry = qodefInitShopListMasonry;
    shortcodes.qodefCustomFontTypeOut = qodefCustomFontTypeOut;
    shortcodes.qodefItemShowcase = qodefItemShowcase;
    shortcodes.qodefAlbumPlayButton = qodefAlbumPlayButton;
    shortcodes.qodefInitImageGalleryMasonry = qodefInitImageGalleryMasonry;
    shortcodes.qodefInitElementsHolderResponsiveStyle = qodefInitElementsHolderResponsiveStyle;
    shortcodes.qodefAlbumDisc = qodefAlbumDisc;
    shortcodes.qodefBoxedIcon = qodefBoxedIcon;
    shortcodes.qodefDeviceShowcase = qodefDeviceShowcase;
    shortcodes.qodefInitFrameCarousel = qodefInitFrameCarousel;
    shortcodes.qodefImageWithTextAnimation = qodefImageWithTextAnimation;
    shortcodes.qodefParallaxHolder = qodefParallaxHolder;

    shortcodes.qodefOnDocumentReady = qodefOnDocumentReady;
    shortcodes.qodefOnWindowLoad = qodefOnWindowLoad;
    shortcodes.qodefOnWindowResize = qodefOnWindowResize;
    shortcodes.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitCounter();
        qodefInitProgressBars();
        qodefInitCountdown();
        qodefIcon().init();
        qodefInitMessages();
        qodefInitMessageHeight();
        qodefInitTestimonials();
        qodefInitCarousels();
        qodefInitPieChart();
        qodefInitPieChartDoughnut();
        qodefInitTabs();
        qodefInitTabIcons();
        qodefButton().init();
        qodefInitBlogListMasonry();
        qodefInitBlogSlider();
        qodefCustomFontResize();
        qodefInitImageGallery();
        qodefInitAccordions();
        qodefShowGoogleMap();
        qodefInitAlbumsLoadMore();
        qodefInitEventsLoadMore();
        qodefInitBlogListLoadMore();
        qodefSlider().init();
        qodefSocialIconWidget().init();
        qodefInitIconList().init();
        qodefInitShopListMasonry();
        qodefInitVerticalSplitSlider();
        qodefCustomFontTypeOut();
        qodefItemShowcase();
        qodefAudioPlayer().init();
        qodefAlbumPlayButton();
        qodefInitImageGalleryMasonry();
        qodefBoxedIcon();
        qodefDeviceShowcase();
        qodefInitFrameCarousel();
        qodefImageWithTextAnimation();
        qodefParallaxHolder();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
        qodefInitElementsHolderResponsiveStyle();
        qodefAlbumDisc();
        qodefAnchorMenu();
        qodefInitAnchor().init();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {
        qodefInitBlogListMasonry();
        qodefCustomFontResize();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {

    }

    /*
     **	Anchor functionality
     */
    var qodefInitAnchor = qodef.modules.common.qodefInitAnchor = function () {

        /**
         * Set active state on clicked anchor
         * @param anchor, clicked anchor
         */
        var setActiveState = function (anchor) {

            $('.qodef-main-menu .qodef-active-item, .qodef-mobile-nav .qodef-active-item, .qodef-vertical-menu .qodef-active-item, .qodef-fullscreen-menu .qodef-active-item').removeClass('qodef-active-item');
            anchor.parent().addClass('qodef-active-item');

            $('.qodef-main-menu a, .qodef-mobile-nav a, .qodef-vertical-menu a, .qodef-fullscreen-menu a, .qodef-anchor-menu a').removeClass('current');
            anchor.addClass('current');
        };

        /**
         * Check anchor active state on scroll
         */
        var checkActiveStateOnScroll = function () {
            var location = window.location.href.split('#')[0];
            if (location.substring(location.length - 1) === "/") {
                location = location.substring(0, location.length - 1);
            }


            $('[data-qodef-anchor]').waypoint(function (direction) {
                if (direction === 'down') {
                    setActiveState($("a[href='" + location + "#" + $(this.element).data("qodef-anchor") + "']"));
                }
            }, {offset: '50%'});

            $('[data-qodef-anchor]').waypoint(function (direction) {
                if (direction === 'up') {
                    setActiveState($("a[href='" + location + "#" + $(this.element).data("qodef-anchor") + "']"));
                }
            }, {
                offset: function () {
                    return -($(this.element).outerHeight() - qodef.windowHeight / 2);
                }
            });

        };

        /**
         * Check anchor active state on load
         */
        var checkActiveStateOnLoad = function () {
            var hash = window.location.hash.split('#')[1];

            if (hash !== "" && $('[data-qodef-anchor="' + hash + '"]').length > 0) {
                //triggers click which is handled in 'anchorClick' function
                var linkURL = window.location.href.split('#')[0] + "#" + hash;
                if ($("a[href='" + linkURL + "']").length) { //if there is a link on page with such href
                    $("a[href='" + linkURL + "']").trigger("click");
                } else { //than create a fake link and click it
                    var link = $('<a/>').attr({'href': linkURL, 'class': 'qodef-anchor'}).appendTo('body');
                    link.trigger('click');
                }
            }
        };

        /**
         * Calculate header height to be substract from scroll amount
         * @param anchoredElementOffset, anchorded element offest
         */
        var headerHeihtToSubtract = function (anchoredElementOffset) {

            if (qodef.modules.header.behaviour === 'qodef-sticky-header-on-scroll-down-up') {
                (anchoredElementOffset > qodef.modules.header.stickyAppearAmount) ? qodef.modules.header.isStickyVisible = true : qodef.modules.header.isStickyVisible = false;
            }

            if (qodef.modules.header.behaviour === 'qodef-sticky-header-on-scroll-up') {
                (anchoredElementOffset > qodef.scroll) ? qodef.modules.header.isStickyVisible = false : '';
            }

            var headerHeight = qodef.modules.header.isStickyVisible ? qodefGlobalVars.vars.qodefStickyHeaderTransparencyHeight : qodefPerPageVars.vars.qodefHeaderTransparencyHeight;

            return headerHeight;
        };

        /**
         * Handle anchor click
         */
        var anchorClick = function () {
            qodef.document.on("click", ".qodef-main-menu a, .qodef-vertical-menu a, .qodef-fullscreen-menu a, .qodef-btn, .qodef-anchor, .qodef-mobile-nav a", function () {
                var scrollAmount;
                var anchor = $(this);
                var hash = anchor.prop("hash").split('#')[1];

                if (hash !== "" && $('[data-qodef-anchor="' + hash + '"]').length > 0 /*&& anchor.attr('href').split('#')[0] === window.location.href.split('#')[0]*/) {

                    var anchoredElementOffset = $('[data-qodef-anchor="' + hash + '"]').offset().top;
                    scrollAmount = $('[data-qodef-anchor="' + hash + '"]').offset().top - headerHeihtToSubtract(anchoredElementOffset);

                    setActiveState(anchor);

                    qodef.html.stop().animate({
                        scrollTop: Math.round(scrollAmount)
                    }, 600, 'easeInOutQuint', function () {
                        //change hash tag in url
                        if (history.pushState) {
                            history.pushState(null, null, '#' + hash);
                        }
                    });
                    return false;
                }
            });
        };

        return {
            init: function () {
                if ($('[data-qodef-anchor]').length) {
                    anchorClick();
                    checkActiveStateOnScroll();
                    $(window).load(function () {
                        checkActiveStateOnLoad();
                    });
                }
            }
        };

    };

    /*
     *  Anchor Menu relocation
     */
    function qodefAnchorMenu() {

        var anchorMenu = $('.qodef-anchor-menu-outer');

        if (anchorMenu.length) {
            anchorMenu.remove();
            $('.qodef-content-inner').append(anchorMenu.css('opacity', 1));
        }
    }

    /**
     * Counter Shortcode
     */
    function qodefInitCounter() {

        var counters = $('.qodef-counter');


        if (counters.length) {
            counters.each(function () {
                var counter = $(this);
                counter.appear(function () {
                    counter.parent().addClass('qodef-counter-holder-show');

                    //Counter zero type
                    if (counter.hasClass('zero')) {
                        var max = parseFloat(counter.text());
                        counter.countTo({
                            from: 0,
                            to: max,
                            speed: 1500,
                            refreshInterval: 100
                        });
                    } else {
                        counter.absoluteCounter({
                            speed: 2000,
                            fadeInDelay: 1000
                        });
                    }

                }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            });
        }

    }

    /*
    **	Horizontal progress bars shortcode
    */
    function qodefInitProgressBars() {

        var progressBar = $('.qodef-progress-bar');

        if (progressBar.length) {

            progressBar.each(function () {

                var thisBar = $(this);

                thisBar.appear(function () {
                    qodefInitToCounterProgressBar(thisBar);
                    if (thisBar.find('.qodef-floating.qodef-floating-inside') !== 0) {
                        var floatingInsideMargin = thisBar.find('.qodef-progress-content').height();
                        floatingInsideMargin += parseFloat(thisBar.find('.qodef-progress-title-holder').css('padding-bottom'));
                        floatingInsideMargin += parseFloat(thisBar.find('.qodef-progress-title-holder').css('margin-bottom'));
                        thisBar.find('.qodef-floating-inside').css('margin-bottom', -(floatingInsideMargin) + 'px');
                    }
                    var percentage = thisBar.find('.qodef-progress-content').data('percentage'),
                        progressContent = thisBar.find('.qodef-progress-content'),
                        progressNumber = thisBar.find('.qodef-progress-number');

                    progressContent.css('width', '0%');
                    progressContent.animate({'width': percentage + '%'}, 1500);
                    progressNumber.css('left', '0%');
                    progressNumber.animate({'left': percentage + '%'}, 1500);

                });
            });
        }
    }

    /*
    **	Counter for horizontal progress bars percent from zero to defined percent
    */
    function qodefInitToCounterProgressBar(progressBar) {
        var percentage = parseFloat(progressBar.find('.qodef-progress-content').data('percentage'));
        var percent = progressBar.find('.qodef-progress-number .qodef-percent');
        if (percent.length) {
            percent.each(function () {
                var thisPercent = $(this);
                thisPercent.parents('.qodef-progress-number-wrapper').css('opacity', '1');
                thisPercent.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        }
    }

    /*
    **	Function to close message shortcode
    */
    function qodefInitMessages() {
        var message = $('.qodef-message');
        if (message.length) {
            message.each(function () {
                var thisMessage = $(this);
                thisMessage.find('.qodef-close').on('click', function (e) {
                    e.preventDefault();
                    $(this).parent().parent().fadeOut(500);
                });
            });
        }
    }

    /*
    **	Init message height
    */
    function qodefInitMessageHeight() {
        var message = $('.qodef-message.qodef-with-icon');
        if (message.length) {
            message.each(function () {
                var thisMessage = $(this);
                var textHolderHeight = thisMessage.find('.qodef-message-text-holder').height();
                var iconHolderHeight = thisMessage.find('.qodef-message-icon-holder').height();

                if (textHolderHeight > iconHolderHeight) {
                    thisMessage.find('.qodef-message-icon-holder').height(textHolderHeight);
                } else {
                    thisMessage.find('.qodef-message-text-holder').height(iconHolderHeight);
                }
            });
        }
    }

    /**
     * Countdown Shortcode
     */
    function qodefInitCountdown() {

        var countdowns = $('.qodef-countdown'),
            year,
            month,
            day,
            hour,
            minute,
            timezone,
            monthLabel,
            dayLabel,
            hourLabel,
            minuteLabel,
            secondLabel;

        if (countdowns.length) {

            countdowns.each(function () {

                //Find countdown elements by id-s
                var countdownId = $(this).attr('id'),
                    countdown = $('#' + countdownId),
                    digitFontSize,
                    labelFontSize,
                    digitColor,
                    labelColor;

                //Get data for countdown
                year = countdown.data('year');
                month = countdown.data('month');
                day = countdown.data('day');
                hour = countdown.data('hour');
                minute = countdown.data('minute');
                timezone = countdown.data('timezone');
                monthLabel = countdown.data('month-label');
                dayLabel = countdown.data('day-label');
                hourLabel = countdown.data('hour-label');
                minuteLabel = countdown.data('minute-label');
                secondLabel = countdown.data('second-label');
                digitFontSize = countdown.data('digit-size');
                labelFontSize = countdown.data('label-size');
                digitColor = countdown.data('digit-color');
                labelColor = countdown.data('label-color');


                //Initialize countdown
                countdown.countdown({
                    until: new Date(year, month - 1, day, hour, minute, 44),
                    labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
                    format: 'DHMS',
                    timezone: timezone,
                    padZeroes: true,
                    onTick: setCountdownStyle
                });

                function setCountdownStyle() {
                    countdown.find('.countdown-amount').css({
                        'font-size': digitFontSize + 'px',
                        'color': digitColor,
                        'line-height': digitFontSize + 'px'
                    });
                    countdown.find('.countdown-period').css({
                        'font-size': labelFontSize + 'px',
                        'color': labelColor,

                    });

                    qodef.modules.common.qodefInitVideoBackgroundSize();
                }

            });

        }

    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var qodefIcon = qodef.modules.shortcodes.qodefIcon = function () {
        //get all icons on page
        var icons = $('.qodef-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function (icon) {
            if (icon.hasClass('qodef-icon-animation')) {
                icon.appear(function () {
                    icon.parent('.qodef-icon-animation-holder').addClass('qodef-icon-animation-show');
                }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function (icon) {
            if (typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function (event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.qodef-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if (hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function (icon) {
            if (typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function (event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if (hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function (icon) {
            if (typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function (event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if (hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function () {
                if (icons.length) {
                    icons.each(function () {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Object that represents social icon widget
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var qodefSocialIconWidget = qodef.modules.shortcodes.qodefSocialIconWidget = function () {
        //get all social icons on page
        var icons = $('.qodef-social-icon-widget-holder');

        /**
         * Function that triggers icon hover color functionality
         */
        var socialIconHoverColor = function (icon) {
            if (typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function (event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon;
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if (hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function () {
                if (icons.length) {
                    icons.each(function () {
                        socialIconHoverColor($(this));
                    });

                }
            }
        };
    };

    /**
     * Init testimonials shortcode
     */
    function qodefInitTestimonials() {

        var testimonial = $('.qodef-testimonials');
        if (testimonial.length) {
            testimonial.each(function () {

                var thisTestimonial = $(this);

                thisTestimonial.appear(function () {
                    thisTestimonial.css('visibility', 'visible');
                }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});

                var controlNav = true;
                var directionNav = true;
                var animationSpeed = 600;
                var responsive;
                var slidesToShow = 1;

                if (typeof thisTestimonial.data('animation-speed') !== 'undefined' && thisTestimonial.data('animation-speed') !== false) {
                    animationSpeed = thisTestimonial.data('animation-speed');
                }

                if (typeof thisTestimonial.data('dots-navigation') !== 'undefined') {
                    controlNav = thisTestimonial.data('dots-navigation');
                }
                if (typeof thisTestimonial.data('arrows-navigation') !== 'undefined') {
                    directionNav = thisTestimonial.data('arrows-navigation');
                }

                if (thisTestimonial.hasClass('qodef-testimonials-type-carousel')) {
                    slidesToShow = 3;

                    responsive = [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                infinite: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ];
                }

                thisTestimonial.slick({
                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 2800,
                    slidesToShow: slidesToShow,
                    arrows: directionNav,
                    dots: controlNav,
                    dotsClass: 'qodef-slick-dots',
                    adaptiveHeight: true,
                    easing: 'easeInOutQuart',
                    prevArrow: '<span class="qodef-slick-prev qodef-prev-icon"><span class="arrow_carrot-left"></span></span>',
                    nextArrow: '<span class="qodef-slick-next qodef-next-icon"><span class="arrow_carrot-right"></span></span>',
                    customPaging: function (slider, i) {
                        return '<span class="qodef-slick-dot-inner"></span>';
                    },
                    responsive: responsive
                });

            });

        }

    }

    /**
     * Init Carousel shortcode
     */
    function qodefInitCarousels() {

        var carouselHolders = $('.qodef-carousel-holder'),
            carousel,
            numberOfItems,
            arrowsNavigation,
            dotsNavigation;

        if (carouselHolders.length) {
            carouselHolders.each(function () {
                carousel = $(this).children('.qodef-carousel');
                numberOfItems = carousel.data('items');
                arrowsNavigation = (carousel.data('arrows-navigation') === 'yes') ? true : false;
                dotsNavigation = (carousel.data('dots-navigation') === 'yes') ? true : false;

                //Responsive breakpoints

                carousel.slick({
                    infinite: true,
                    autoplay: true,
                    slidesToShow: numberOfItems,
                    arrows: arrowsNavigation,
                    dots: dotsNavigation,
                    dotsClass: 'qodef-slick-dots',
                    adaptiveHeight: true,
                    prevArrow: '<span class="qodef-slick-prev qodef-prev-icon"><span class="arrow_carrot-left"></span></span>',
                    nextArrow: '<span class="qodef-slick-next qodef-next-icon"><span class="arrow_carrot-right"></span></span>',
                    customPaging: function (slider, i) {
                        return '<span class="qodef-slick-dot-inner"></span>';
                    },
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });


            });
        }

        carouselHolders.css('opacity', 1)

    }

    /**
     * Init Pie Chart and Pie Chart With Icon shortcode
     */
    function qodefInitPieChart() {

        var pieCharts = $('.qodef-pie-chart-holder, .qodef-pie-chart-with-icon-holder');

        if (pieCharts.length) {

            pieCharts.each(function () {

                var pieChart = $(this),
                    percentageHolder = pieChart.children('.qodef-percentage, .qodef-percentage-with-icon'),
                    barColor = '#000',
                    trackColor = '#d9d9d9',
                    lineWidth = '4',
                    size = 180;

                if (typeof percentageHolder.data('bar-color') !== 'undefined' && percentageHolder.data('bar-color') !== '') {
                    barColor = percentageHolder.data('bar-color');
                }

                if (typeof percentageHolder.data('track-color') !== 'undefined' && percentageHolder.data('track-color') !== '') {
                    trackColor = percentageHolder.data('track-color');
                }

                percentageHolder.appear(function () {
                    initToCounterPieChart(pieChart);
                    percentageHolder.css('opacity', '1');

                    percentageHolder.easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: lineWidth,
                        animate: 1500,
                        size: size
                    });
                }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});

            });

        }

    }

    /*
     **	Counter for pie chart number from zero to defined number
     */
    function initToCounterPieChart(pieChart) {

        pieChart.css('opacity', '1');
        var counter = pieChart.find('.qodef-to-counter'),
            max = parseFloat(counter.text());
        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });

    }

    /**
     * Init Pie Chart shortcode
     */
    function qodefInitPieChartDoughnut() {

        var pieCharts = $('.qodef-pie-chart-doughnut-holder, .qodef-pie-chart-pie-holder');

        pieCharts.each(function () {

            var pieChart = $(this),
                canvas = pieChart.find('canvas'),
                chartID = canvas.attr('id'),
                chart = document.getElementById(chartID).getContext('2d'),
                data = [],
                jqChart = $(chart.canvas); //Convert canvas to JQuery object and get data parameters

            for (var i = 1; i <= 10; i++) {

                var chartItem,
                    value = jqChart.data('value-' + i),
                    color = jqChart.data('color-' + i);

                if (typeof value !== 'undefined' && typeof color !== 'undefined') {
                    chartItem = {
                        value: value,
                        color: color
                    };
                    data.push(chartItem);
                }

            }

            if (canvas.hasClass('qodef-pie')) {
                new Chart(chart).Pie(data,
                    {segmentStrokeColor: 'transparent'}
                );
            } else {
                new Chart(chart).Doughnut(data,
                    {segmentStrokeColor: 'transparent'}
                );
            }

        });

    }

    /*
    **	Init tabs shortcode
    */
    function qodefInitTabs() {

        var tabs = $('.qodef-tabs');
        if (tabs.length) {
            tabs.each(function () {
                var thisTabs = $(this);

                thisTabs.children('.qodef-tab-container').each(function (index) {
                    index = index + 1;
                    var that = $(this),
                        link = that.attr('id'),
                        navItem = that.parent().find('.qodef-tabs-nav li:nth-child(' + index + ') a'),
                        navLink = navItem.attr('href');

                    link = '#' + link;

                    if (link.indexOf(navLink) > -1) {
                        navItem.attr('href', link);
                    }
                });

                if (thisTabs.hasClass('qodef-horizontal-tab')) {
                    thisTabs.tabs();
                } else if (thisTabs.hasClass('qodef-vertical-tab')) {
                    thisTabs.tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
                    thisTabs.find('.qodef-tabs-nav > ul >li').removeClass('ui-corner-top').addClass('ui-corner-left');
                }
            });
        }
    }

    /*
    **	Generate icons in tabs navigation
    */
    function qodefInitTabIcons() {

        var tabContent = $('.qodef-tab-container');
        if (tabContent.length) {

            tabContent.each(function () {
                var thisTabContent = $(this);

                var id = thisTabContent.attr('id');
                var icon = '';
                if (typeof thisTabContent.data('icon-html') !== 'undefined' || thisTabContent.data('icon-html') !== 'false') {
                    icon = thisTabContent.data('icon-html');
                }

                var tabNav = thisTabContent.parents('.qodef-tabs').find('.qodef-tabs-nav > li > a[href="#' + id + '"]');

                if (typeof (tabNav) !== 'undefined') {
                    tabNav.children('.qodef-icon-frame').append(icon);
                }
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var qodefButton = qodef.modules.shortcodes.qodefButton = function () {
        //all buttons on the page
        var buttons = $('.qodef-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function (button) {
            if (typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function (event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', {button: button, color: hoverColor}, changeButtonColor);
                button.on('mouseleave', {button: button, color: originalColor}, changeButtonColor);
            }
        };


        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function (button) {
            if (typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function (event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', {button: button, color: hoverBgColor}, changeButtonBg);
                button.on('mouseleave', {button: button, color: originalBgColor}, changeButtonBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function (button) {
            if (typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function (event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', {button: button, color: hoverBorderColor}, changeBorderColor);
                button.on('mouseleave', {button: button, color: originalBorderColor}, changeBorderColor);
            }
        };

        return {
            init: function () {
                if (buttons.length) {
                    buttons.each(function () {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                    });
                }
            }
        };
    };

    /*
    **	Init blog list masonry type
    */
    function qodefInitBlogListMasonry() {
        var blogList = $('.qodef-blog-list-holder.qodef-masonry .qodef-blog-list');
        if (blogList.length) {
            blogList.each(function () {
                var thisBlogList = $(this);
                blogList.waitForImages(function () {
                    thisBlogList.isotope({
                        itemSelector: '.qodef-blog-list-masonry-item',
                        masonry: {
                            columnWidth: '.qodef-blog-list-masonry-grid-sizer',
                            gutter: '.qodef-blog-list-masonry-grid-gutter'
                        }
                    });
                    thisBlogList.addClass('qodef-appeared');
                });
            });

        }
    }

    /**
     * Initializes Blog slider
     */

    function qodefInitBlogSlider() {
        var blogSlider = $('.qodef-blog-slider');
        if (blogSlider.length) {
            blogSlider.each(function () {
                var thisBlogSlider = $(this);
                var navigation = true;
                var responsive;
                var slides = 1;

                if (typeof thisBlogSlider.data('type') !== 'undefined' && thisBlogSlider.data('type') !== false && thisBlogSlider.data('type') === 'carousel') {

                    responsive = [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ];
                    slides = 3;
                }

                thisBlogSlider.slick({
                    infinite: true,
                    autoplay: true,
                    slidesToShow: slides,
                    arrows: navigation,
                    dots: true,
                    dotsClass: 'qodef-slick-dots',
                    adaptiveHeight: true,
                    prevArrow: '<span class="qodef-slick-prev qodef-prev-icon"><span class="arrow_carrot-left"></span></span>',
                    nextArrow: '<span class="qodef-slick-next qodef-next-icon"><span class="arrow_carrot-right"></span></span>',
                    customPaging: function (slider, i) {
                        return '<span class="qodef-slick-dot-inner"></span>';
                    },
                    responsive: responsive
                });
            });
        }
    }

    /*
    **	Custom Font resizing
    */
    function qodefCustomFontResize() {
        var customFont = $('.qodef-custom-font-holder');
        if (customFont.length) {
            customFont.each(function () {
                var thisCustomFont = $(this);
                var fontSize;
                var lineHeight;
                var coef1 = 1;
                var coef2 = 1;

                if (qodef.windowWidth < 1200) {
                    coef1 = 0.8;
                }

                if (qodef.windowWidth < 1000) {
                    coef1 = 0.7;
                }

                if (qodef.windowWidth < 768) {
                    coef1 = 0.6;
                    coef2 = 0.7;
                }

                if (qodef.windowWidth < 600) {
                    coef1 = 0.5;
                    coef2 = 0.6;
                }

                if (qodef.windowWidth < 480) {
                    coef1 = 0.4;
                    coef2 = 0.5;
                }

                if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
                    fontSize = parseInt(thisCustomFont.data('font-size'));

                    if (fontSize > 70) {
                        fontSize = Math.round(fontSize * coef1);
                    } else if (fontSize > 35) {
                        fontSize = Math.round(fontSize * coef2);
                    }

                    thisCustomFont.css('font-size', fontSize + 'px');
                }

                if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
                    lineHeight = parseInt(thisCustomFont.data('line-height'));

                    if (lineHeight > 70 && qodef.windowWidth < 1200) {
                        lineHeight = '1.2em';
                    } else if (lineHeight > 35 && qodef.windowWidth < 768) {
                        lineHeight = '1.2em';
                    } else {
                        lineHeight += 'px';
                    }

                    thisCustomFont.css('line-height', lineHeight);
                }
            });
        }
    }

    /*
     **	Show Google Map
     */
    function qodefShowGoogleMap() {

        if ($('.qodef-google-map').length) {
            $('.qodef-google-map').each(function () {

                var element = $(this);

                var customMapStyle;
                if (typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if (typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if (typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if (typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if (typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if (typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if (typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if (typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if (typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if (typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var locationMap;
                if (typeof element.data('location-map') !== 'undefined' && element.data('location-map') !== false && element.data('location-map') === 'yes') {
                    locationMap = true;
                }

                var map = "map_" + uniqueId;
                var geocoder = "geocoder_" + uniqueId;
                var holderId = "qodef-map-" + uniqueId;

                qodefInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin, map, geocoder, addresses, locationMap);
            });
        }

    }

    /*
     **	Init Google Map
     */
    function qodefInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin, map, geocoder, data, locationMap) {

        if( typeof google !== 'object' ){
            return;
        }

        if (locationMap) {
            var mapStyles = [{
                "featureType": "all",
                "elementType": "all",
                "stylers": [{"hue": "#ff0000"}, {"saturation": -100}, {"lightness": -30}]
            }, {
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers": [{"color": "#ffffff"}]
            }, {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [{"color": "#353535"}]
            }, {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [{"color": "#656565"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers": [{"color": "#505050"}]
            }, {
                "featureType": "poi",
                "elementType": "geometry.stroke",
                "stylers": [{"color": "#808080"}]
            }, {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [{"color": "#454545"}]
            }, {
                "featureType": "transit",
                "elementType": "labels",
                "stylers": [{"hue": "#000000"}, {"saturation": 100}, {"lightness": -40}, {"invert_lightness": true}, {"gamma": 1.5}]
            }]
        } else {
            var mapStyles = [
                {
                    stylers: [
                        {hue: color},
                        {saturation: saturation},
                        {lightness: lightness},
                        {gamma: 1}
                    ]
                }
            ];
        }

        var googleMapStyleId;

        if (customMapStyle === 'yes' || locationMap) {
            googleMapStyleId = 'qodef-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Select Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)) {
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'qodef-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('qodef-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            qodefInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }

    /*
     **	Init Google Map Addresses
     */
    function qodefInitializeGoogleAddress(data, pin, map, geocoder) {
        if (data === '')
            return;
        var contentString = '<div id="content">' +
            '<div id="siteNotice">' +
            '</div>' +
            '<div id="bodyContent">' +
            '<p>' + data + '</p>' +
            '</div>' +
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode({'address': data}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });

                google.maps.event.addDomListener(window, 'resize', function () {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    function qodefInitAccordions() {
        var accordion = $('.qodef-accordion-holder');
        if (accordion.length) {
            accordion.each(function () {

                var thisAccordion = $(this);

                if (thisAccordion.hasClass('qodef-accordion')) {

                    thisAccordion.accordion({
                        animate: "swing",
                        collapsible: true,
                        active: 0,
                        icons: "",
                        heightStyle: "content"
                    });
                }

                if (thisAccordion.hasClass('qodef-toggle')) {

                    var toggleAccordion = $(this);
                    var toggleAccordionTitle = toggleAccordion.find('.qodef-title-holder');
                    var toggleAccordionContent = toggleAccordionTitle.next();

                    toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
                    toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
                    toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

                    toggleAccordionTitle.each(function () {
                        var thisTitle = $(this);
                        thisTitle.on('mouseenter mouseleave', function () {
                            thisTitle.toggleClass("ui-state-hover");
                        });

                        thisTitle.on('click', function () {
                            thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
                            thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
                        });
                    });
                }
            });
        }
    }

    function qodefInitImageGallery() {

        var galleries = $('.qodef-image-gallery');

        if (galleries.length) {
            galleries.each(function () {
                var gallery = $(this).children('.qodef-image-gallery-slider'),
                    autoplay = gallery.data('autoplay'),
                    animation = (gallery.data('animation') === 'fade'),
                    arrows = (gallery.data('navigation') === 'yes'),
                    dots = (gallery.data('pagination') === 'yes'),
                    autoplaySpeed;


                if (autoplay === 'disable') {
                    autoplay = false;
                } else {
                    autoplaySpeed = autoplay * 1000;
                    autoplay = true;
                }

                gallery.slick({
                    infinite: true,
                    autoplay: autoplay,
                    autoplaySpeed: autoplaySpeed,
                    speed: 600,
                    slidesToShow: 1,
                    fade: animation,
                    arrows: arrows,
                    dots: dots,
                    easing: 'easeOutQuart',
                    dotsClass: 'qodef-slick-dots',
                    adaptiveHeight: true,
                    prevArrow: '<span class="qodef-slick-prev qodef-prev-icon"><span class="lnr lnr-chevron-left"></span></span>',
                    nextArrow: '<span class="qodef-slick-next qodef-next-icon"><span class="lnr lnr-chevron-right"></span></span>',
                    customPaging: function (slider, i) {
                        return '<span class="qodef-slick-dot-inner"></span>';
                    }
                });
            });
        }

    }

    /**
     * Init Image Masonry Gallery
     */
    function qodefInitImageGalleryMasonry() {
        var masonryGallery = $('.qodef-image-gallery-masonry');

        if (masonryGallery.length) {
            masonryGallery.each(function () {
                var thisGallery = $(this);
                thisGallery.waitForImages(function () {
                    var size = thisGallery.find('.qodef-image-masonry-grid-sizer').width();
                    qodefImageResizeMasonry(size, thisGallery);
                    qodefInitImageMasonry(thisGallery);

                });
                $(window).resize(function () {
                    var size = thisGallery.find('.qodef-image-masonry-grid-sizer').width();
                    qodefImageResizeMasonry(size, thisGallery);
                    qodefInitImageMasonry(thisGallery);
                });
            });
        }
    }

    function qodefInitImageMasonry(container) {
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.qodef-gallery-image',
            masonry: {
                columnWidth: '.qodef-image-masonry-grid-sizer'
            }
        });
    }


    function qodefImageResizeMasonry(size, container) {

        var defaultMasonryItem = container.find('.qodef-size-square');
        var largeWidthMasonryItem = container.find('.qodef-size-landscape');
        var largeHeightMasonryItem = container.find('.qodef-size-portrait');
        var largeWidthHeightMasonryItem = container.find('.qodef-size-big-square');

        defaultMasonryItem.css('height', size);
        largeHeightMasonryItem.css('height', Math.round(2 * size));

        if (qodef.windowWidth > 480) {
            largeWidthHeightMasonryItem.css('height', Math.round(2 * size));
            largeWidthMasonryItem.css('height', size);
        } else {
            largeWidthHeightMasonryItem.css('height', size);
            largeWidthMasonryItem.css('height', Math.round(size / 2));
        }
    }

    function qodefConvertHTML(html) {
        var newHtml = $.trim(html),
            $html = $(newHtml),
            $empty = $();

        $html.each(function (index, value) {
            if (value.nodeType === 1) {
                $empty = $empty.add(this);
            }
        });

        return $empty;
    }


    /**
     * Slider object that initializes whole slider functionality
     * @type {Function}
     */
    var qodefSlider = qodef.modules.shortcodes.qodefSlider = function () {

        //all sliders on the page
        var sliders = $('.qodef-slider .carousel');
        //image regex used to extract img source
        var imageRegex = /url\(["']?([^'")]+)['"]?\)/;

        /*** Functionality for translating image in slide - START ***/

        var matrixArray = {
            zoom_center: '1.2, 0, 0, 1.2, 0, 0',
            zoom_top_left: '1.2, 0, 0, 1.2, -150, -150',
            zoom_top_right: '1.2, 0, 0, 1.2, 150, -150',
            zoom_bottom_left: '1.2, 0, 0, 1.2, -150, 150',
            zoom_bottom_right: '1.2, 0, 0, 1.2, 150, 150'
        };

        // regular expression for parsing out the matrix components from the matrix string
        var matrixRE = /\([0-9epx\.\, \t\-]+/gi;

        // parses a matrix string of the form "matrix(n1,n2,n3,n4,n5,n6)" and
        // returns an array with the matrix components
        var parseMatrix = function (val) {
            return val.match(matrixRE)[0].substr(1).split(",").map(function (s) {
                return parseFloat(s);
            });
        };

        // transform css property names with vendor prefixes;
        // the plugin will check for values in the order the names are listed here and return as soon as there
        // is a value; so listing the W3 std name for the transform results in that being used if its available
        var transformPropNames = [
            "transform",
            "-webkit-transform"
        ];

        var getTransformMatrix = function (el) {
            // iterate through the css3 identifiers till we hit one that yields a value
            var matrix = null;
            transformPropNames.some(function (prop) {
                matrix = el.css(prop);
                return (matrix !== null && matrix !== "");
            });

            // if "none" then we supplant it with an identity matrix so that our parsing code below doesn't break
            matrix = (!matrix || matrix === "none") ?
                "matrix(1,0,0,1,0,0)" : matrix;
            return parseMatrix(matrix);
        };

        // set the given matrix transform on the element; note that we apply the css transforms in reverse order of how its given
        // in "transformPropName" to ensure that the std compliant prop name shows up last
        var setTransformMatrix = function (el, matrix) {
            var m = "matrix(" + matrix.join(",") + ")";
            for (var i = transformPropNames.length - 1; i >= 0; --i) {
                el.css(transformPropNames[i], m + ' rotate(0.01deg)');
            }
        };

        // interpolates a value between a range given a percent
        var interpolate = function (from, to, percent) {
            return from + ((to - from) * (percent / 100));
        };

        $.fn.transformAnimate = function (opt) {
            // extend the options passed in by caller
            var options = {
                transform: "matrix(1,0,0,1,0,0)"
            };
            $.extend(options, opt);

            // initialize our custom property on the element to track animation progress
            this.css("percentAnim", 0);

            // supplant "options.step" if it exists with our own routine
            var sourceTransform = getTransformMatrix(this);
            var targetTransform = parseMatrix(options.transform);
            options.step = function (percentAnim, fx) {
                // compute the interpolated transform matrix for the current animation progress
                var $this = $(this);
                var matrix = sourceTransform.map(function (c, i) {
                    return interpolate(c, targetTransform[i],
                        percentAnim);
                });

                // apply the new matrix
                setTransformMatrix($this, matrix);

                // invoke caller's version of "step" if one was supplied;
                if (opt.step) {
                    opt.step.apply(this, [matrix, fx]);
                }
            };

            // animate!
            return this.stop().animate({percentAnim: 100}, options);
        };

        /*** Functionality for translating image in slide - END ***/


        /**
         * Calculate heights for slider holder and slide item, depending on window width, but only if slider is set to be responsive
         * @param slider, current slider
         * @param defaultHeight, default height of slider, set in shortcode
         * @param responsive_breakpoint_set, breakpoints set for slider responsiveness
         * @param reset, boolean for reseting heights
         */
        var setSliderHeight = function (slider, defaultHeight, responsive_breakpoint_set, reset) {
            var sliderHeight = defaultHeight;
            if (!reset) {
                if (qodef.windowWidth > responsive_breakpoint_set[0]) {
                    sliderHeight = defaultHeight;
                } else if (qodef.windowWidth > responsive_breakpoint_set[1]) {
                    sliderHeight = defaultHeight * 0.75;
                } else if (qodef.windowWidth > responsive_breakpoint_set[2]) {
                    sliderHeight = defaultHeight * 0.6;
                } else if (qodef.windowWidth > responsive_breakpoint_set[3]) {
                    sliderHeight = defaultHeight * 0.55;
                } else if (qodef.windowWidth <= responsive_breakpoint_set[3]) {
                    sliderHeight = defaultHeight * 0.45;
                }
            }

            slider.css({'height': (sliderHeight) + 'px'});
            slider.find('.qodef-slider-preloader').css({'height': (sliderHeight) + 'px'});
            slider.find('.qodef-slider-preloader .qodef-ajax-loader').css({'display': 'block'});
            slider.find('.item').css({'height': (sliderHeight) + 'px'});
            if (qodefPerPageVars.vars.qodefStickyScrollAmount === 0) {
                qodef.modules.header.stickyAppearAmount = sliderHeight; //set sticky header appear amount if slider there is no amount entered on page itself
            }
        };

        /**
         * Calculate heights for slider holder and slide item, depending on window size, but only if slider is set to be full height
         * @param slider, current slider
         */
        var setSliderFullHeight = function (slider) {
            var mobileHeaderHeight = qodef.windowWidth < 1000 ? qodefGlobalVars.vars.qodefMobileHeaderHeight + $('.qodef-top-bar').height() : 0;
            slider.css({'height': (qodef.windowHeight - mobileHeaderHeight) + 'px'});
            slider.find('.qodef-slider-preloader').css({'height': (qodef.windowHeight - mobileHeaderHeight) + 'px'});
            slider.find('.qodef-slider-preloader .qodef-ajax-loader').css({'display': 'block'});
            slider.find('.item').css({'height': (qodef.windowHeight - mobileHeaderHeight) + 'px'});
            if (qodefPerPageVars.vars.qodefStickyScrollAmount === 0) {
                qodef.modules.header.stickyAppearAmount = qodef.windowHeight; //set sticky header appear amount if slider there is no amount entered on page itself
            }
        };

        var setElementsResponsiveness = function (slider) {
            // Basic text styles responsiveness
            slider
                .find('.qodef-slide-element-text-small, .qodef-slide-element-text-normal, .qodef-slide-element-text-large, .qodef-slide-element-text-extra-large')
                .each(function () {
                    var element = $(this);
                    if (typeof element.data('default-font-size') === 'undefined') {
                        element.data('default-font-size', parseInt(element.css('font-size'), 10));
                    }
                    if (typeof element.data('default-line-height') === 'undefined') {
                        element.data('default-line-height', parseInt(element.css('line-height'), 10));
                    }
                    if (typeof element.data('default-letter-spacing') === 'undefined') {
                        element.data('default-letter-spacing', parseInt(element.css('letter-spacing'), 10));
                    }
                });
            // Advanced text styles responsiveness
            slider.find('.qodef-slide-element-responsive-text').each(function () {
                if (typeof $(this).data('default-font-size') === 'undefined') {
                    $(this).data('default-font-size', parseInt($(this).css('font-size'), 10));
                }
                if (typeof $(this).data('default-line-height') === 'undefined') {
                    $(this).data('default-line-height', parseInt($(this).css('line-height'), 10));
                }
                if (typeof $(this).data('default-letter-spacing') === 'undefined') {
                    $(this).data('default-letter-spacing', parseInt($(this).css('letter-spacing'), 10));
                }
            });
            // Button responsiveness
            slider.find('.qodef-slide-element-responsive-button').each(function () {
                if (typeof $(this).data('default-font-size') === 'undefined') {
                    $(this).data('default-font-size', parseInt($(this).find('a').css('font-size'), 10));
                }
                if (typeof $(this).data('default-line-height') === 'undefined') {
                    $(this).data('default-line-height', parseInt($(this).find('a').css('line-height'), 10));
                }
                if (typeof $(this).data('default-letter-spacing') === 'undefined') {
                    $(this).data('default-letter-spacing', parseInt($(this).find('a').css('letter-spacing'), 10));
                }
                if (typeof $(this).data('default-ver-padding') === 'undefined') {
                    $(this).data('default-ver-padding', parseInt($(this).find('a').css('padding-top'), 10));
                }
                if (typeof $(this).data('default-hor-padding') === 'undefined') {
                    $(this).data('default-hor-padding', parseInt($(this).find('a').css('padding-left'), 10));
                }
            });
            // Margins for non-custom layouts
            slider.find('.qodef-slide-element').each(function () {
                var element = $(this);
                if (typeof element.data('default-margin-top') === 'undefined') {
                    element.data('default-margin-top', parseInt(element.css('margin-top'), 10));
                }
                if (typeof element.data('default-margin-bottom') === 'undefined') {
                    element.data('default-margin-bottom', parseInt(element.css('margin-bottom'), 10));
                }
                if (typeof element.data('default-margin-left') === 'undefined') {
                    element.data('default-margin-left', parseInt(element.css('margin-left'), 10));
                }
                if (typeof element.data('default-margin-right') === 'undefined') {
                    element.data('default-margin-right', parseInt(element.css('margin-right'), 10));
                }
            });
            adjustElementsSizes(slider);
        };

        var adjustElementsSizes = function (slider) {
            var boundaries = {
                // These values must match those in map.php (for slider), slider.php and qodef.layout.inc
                mobile: 600,
                tabletp: 800,
                tabletl: 1024,
                laptop: 1440
            };
            slider.find('.qodef-slider-elements-container').each(function () {
                var container = $(this);
                var target = container.filter('.qodef-custom-elements').add(container.not('.qodef-custom-elements').find('.qodef-slider-elements-holder-frame')).not('.qodef-grid');
                if (target.length) {
                    if (boundaries.mobile >= qodef.windowWidth && container.attr('data-width-mobile').length) {
                        target.css('width', container.data('width-mobile') + '%');
                    } else if (boundaries.tabletp >= qodef.windowWidth && container.attr('data-width-tablet-p').length) {
                        target.css('width', container.data('width-tablet-p') + '%');
                    } else if (boundaries.tabletl >= qodef.windowWidth && container.attr('data-width-tablet-l').length) {
                        target.css('width', container.data('width-tablet-l') + '%');
                    } else if (boundaries.laptop >= qodef.windowWidth && container.attr('data-width-laptop').length) {
                        target.css('width', container.data('width-laptop') + '%');
                    } else if (container.attr('data-width-desktop').length) {
                        target.css('width', container.data('width-desktop') + '%');
                    }
                }
            });
            slider.find('.item').each(function () {
                var slide = $(this);
                var def_w = slide.find('.qodef-slider-elements-holder-frame').data('default-width');
                var elements = slide.find('.qodef-slide-element');

                // Adjusting margins for all elements
                elements.each(function () {
                    var element = $(this);
                    var def_m_top = element.data('default-margin-top'),
                        def_m_bot = element.data('default-margin-bottom'),
                        def_m_l = element.data('default-margin-left'),
                        def_m_r = element.data('default-margin-right');
                    var scale_data = (typeof element.data('resp-scale') !== 'undefined') ? element.data('resp-scale') : undefined;
                    var factor;

                    if (boundaries.mobile >= qodef.windowWidth) {
                        factor = (typeof scale_data === 'undefined') ? qodef.windowWidth / def_w : parseFloat(scale_data.mobile);
                    } else if (boundaries.tabletp >= qodef.windowWidth) {
                        factor = (typeof scale_data === 'undefined') ? qodef.windowWidth / def_w : parseFloat(scale_data.tabletp);
                    } else if (boundaries.tabletl >= qodef.windowWidth) {
                        factor = (typeof scale_data === 'undefined') ? qodef.windowWidth / def_w : parseFloat(scale_data.tabletl);
                    } else if (boundaries.laptop >= qodef.windowWidth) {
                        factor = (typeof scale_data === 'undefined') ? qodef.windowWidth / def_w : parseFloat(scale_data.laptop);
                    } else {
                        factor = (typeof scale_data === 'undefined') ? qodef.windowWidth / def_w : parseFloat(scale_data.desktop);
                    }

                    element.css({
                        'margin-top': Math.round(factor * def_m_top) + 'px',
                        'margin-bottom': Math.round(factor * def_m_bot) + 'px',
                        'margin-left': Math.round(factor * def_m_l) + 'px',
                        'margin-right': Math.round(factor * def_m_r) + 'px'
                    });
                });

                // Adjusting responsiveness
                elements
                    .filter('.qodef-slide-element-responsive-text, .qodef-slide-element-responsive-button, .qodef-slide-element-responsive-image')
                    .add(elements.find('a.qodef-slide-element-responsive-text, span.qodef-slide-element-responsive-text'))
                    .each(function () {
                        var element = $(this);
                        var scale_data = (typeof element.data('resp-scale') !== 'undefined') ? element.data('resp-scale') : undefined,
                            left_data = (typeof element.data('resp-left') !== 'undefined') ? element.data('resp-left') : undefined,
                            top_data = (typeof element.data('resp-top') !== 'undefined') ? element.data('resp-top') : undefined;
                        var factor, new_left, new_top;

                        if (boundaries.mobile >= qodef.windowWidth) {
                            factor = (typeof scale_data === 'undefined') ? qodef.windowWidth / def_w : parseFloat(scale_data.mobile);
                            new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left') + '%' : '') : (left_data.mobile !== '' ? left_data.mobile + '%' : element.data('left') + '%');
                            new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top') + '%' : '') : (top_data.mobile !== '' ? top_data.mobile + '%' : element.data('top') + '%');
                        } else if (boundaries.tabletp >= qodef.windowWidth) {
                            factor = (typeof scale_data === 'undefined') ? qodef.windowWidth / def_w : parseFloat(scale_data.tabletp);
                            new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left') + '%' : '') : (left_data.tabletp !== '' ? left_data.tabletp + '%' : element.data('left') + '%');
                            new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top') + '%' : '') : (top_data.tabletp !== '' ? top_data.tabletp + '%' : element.data('top') + '%');
                        } else if (boundaries.tabletl >= qodef.windowWidth) {
                            factor = (typeof scale_data === 'undefined') ? qodef.windowWidth / def_w : parseFloat(scale_data.tabletl);
                            new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left') + '%' : '') : (left_data.tabletl !== '' ? left_data.tabletl + '%' : element.data('left') + '%');
                            new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top') + '%' : '') : (top_data.tabletl !== '' ? top_data.tabletl + '%' : element.data('top') + '%');
                        } else if (boundaries.laptop >= qodef.windowWidth) {
                            factor = (typeof scale_data === 'undefined') ? qodef.windowWidth / def_w : parseFloat(scale_data.laptop);
                            new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left') + '%' : '') : (left_data.laptop !== '' ? left_data.laptop + '%' : element.data('left') + '%');
                            new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top') + '%' : '') : (top_data.laptop !== '' ? top_data.laptop + '%' : element.data('top') + '%');
                        } else {
                            factor = (typeof scale_data === 'undefined') ? qodef.windowWidth / def_w : parseFloat(scale_data.desktop);
                            new_left = (typeof left_data === 'undefined') ? (typeof element.data('left') !== 'undefined' ? element.data('left') + '%' : '') : (left_data.desktop !== '' ? left_data.desktop + '%' : element.data('left') + '%');
                            new_top = (typeof top_data === 'undefined') ? (typeof element.data('top') !== 'undefined' ? element.data('top') + '%' : '') : (top_data.desktop !== '' ? top_data.desktop + '%' : element.data('top') + '%');
                        }

                        if (!factor) {
                            element.hide();
                        } else {
                            element.show();
                            var def_font_size,
                                def_line_h,
                                def_let_spac,
                                def_ver_pad,
                                def_hor_pad;

                            if (element.is('.qodef-slide-element-responsive-button')) {
                                def_font_size = element.data('default-font-size');
                                def_line_h = element.data('default-line-height');
                                def_let_spac = element.data('default-letter-spacing');
                                def_ver_pad = element.data('default-ver-padding');
                                def_hor_pad = element.data('default-hor-padding');

                                element.css({
                                    'left': new_left,
                                    'top': new_top
                                })
                                    .find('.qodef-btn').css({
                                    'font-size': Math.round(factor * def_font_size) + 'px',
                                    'line-height': Math.round(factor * def_line_h) + 'px',
                                    'letter-spacing': Math.round(factor * def_let_spac) + 'px',
                                    'padding-left': Math.round(factor * def_hor_pad) + 'px',
                                    'padding-right': Math.round(factor * def_hor_pad) + 'px',
                                    'padding-top': Math.round(factor * def_ver_pad) + 'px',
                                    'padding-bottom': Math.round(factor * def_ver_pad) + 'px'
                                });
                            } else if (element.is('.qodef-slide-element-responsive-image')) {
                                if (factor !== qodef.windowWidth / def_w) { // if custom factor has been set for this screen width
                                    var up_w = element.data('upload-width'),
                                        up_h = element.data('upload-height');

                                    element.filter('.custom-image').css({
                                        'left': new_left,
                                        'top': new_top
                                    })
                                        .add(element.not('.custom-image').find('img'))
                                        .css({
                                            'width': Math.round(factor * up_w) + 'px',
                                            'height': Math.round(factor * up_h) + 'px'
                                        });
                                } else {
                                    var w = element.data('width');

                                    element.filter('.custom-image').css({
                                        'left': new_left,
                                        'top': new_top
                                    })
                                        .add(element.not('.custom-image').find('img'))
                                        .css({
                                            'width': w + '%',
                                            'height': ''
                                        });
                                }
                            } else {
                                def_font_size = element.data('default-font-size');
                                def_line_h = element.data('default-line-height');
                                def_let_spac = element.data('default-letter-spacing');

                                element.css({
                                    'left': new_left,
                                    'top': new_top,
                                    'font-size': Math.round(factor * def_font_size) + 'px',
                                    'line-height': Math.round(factor * def_line_h) + 'px',
                                    'letter-spacing': Math.round(factor * def_let_spac) + 'px'
                                });
                            }
                        }
                    });
            });
            var nav = slider.find('.carousel-indicators');
            slider.find('.qodef-slide-element-section-link').css('bottom', nav.length ? parseInt(nav.css('bottom'), 10) + nav.outerHeight() + 10 + 'px' : '20px');
        };

        var checkButtonsAlignment = function (slider) {
            slider.find('.item').each(function () {
                var inline_buttons = $(this).find('.qodef-slide-element-button-inline');
                inline_buttons.css('display', 'inline-block').wrapAll('<div class="qodef-slide-elements-buttons-wrapper" style="text-align: ' + inline_buttons.eq(0).css('text-align') + ';"/>');
            });
        };

        /**
         * Set heights for slider and elemnts depending on slider settings (full height, responsive height od set height)
         * @param slider, current slider
         */
        var setHeights = function (slider) {

            var responsiveBreakpointSet = [1600, 1200, 900, 650, 500, 320];

            setElementsResponsiveness(slider);

            if (slider.hasClass('qodef-full-screen')) {

                setSliderFullHeight(slider);

                $(window).resize(function () {
                    setSliderFullHeight(slider);
                    adjustElementsSizes(slider);
                });

            } else if (slider.hasClass('qodef-responsive-height')) {

                var defaultHeight = slider.data('height');
                setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);

                $(window).resize(function () {
                    setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
                    adjustElementsSizes(slider);
                });

            } else {
                var defaultHeight = slider.data('height');

                slider.find('.qodef-slider-preloader').css({'height': (slider.height()) + 'px'});
                slider.find('.qodef-slider-preloader .qodef-ajax-loader').css({'display': 'block'});

                qodef.windowWidth < 1000 ? setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false) : setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);

                $(window).resize(function () {
                    if (qodef.windowWidth < 1000) {
                        setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, false);
                    } else {
                        setSliderHeight(slider, defaultHeight, responsiveBreakpointSet, true);
                    }
                    adjustElementsSizes(slider);
                });
            }
        };

        /**
         * Set prev/next numbers on navigation arrows
         * @param slider, current slider
         * @param currentItem, current slide item index
         * @param totalItemCount, total number of slide items
         */
        var setPrevNextNumbers = function (slider, currentItem, totalItemCount) {
            if (currentItem === 1) {
                slider.find('.left.carousel-control .prev').html(totalItemCount);
                slider.find('.right.carousel-control .next').html(currentItem + 1);
            } else if (currentItem === totalItemCount) {
                slider.find('.left.carousel-control .prev').html(currentItem - 1);
                slider.find('.right.carousel-control .next').html(1);
            } else {
                slider.find('.left.carousel-control .prev').html(currentItem - 1);
                slider.find('.right.carousel-control .next').html(currentItem + 1);
            }
        };

        /**
         * Set video background size
         * @param slider, current slider
         */
        var initVideoBackgroundSize = function (slider) {
            var min_w = 1500; // minimum video width allowed
            var video_width_original = 1920;  // original video dimensions
            var video_height_original = 1080;
            var vid_ratio = 1920 / 1080;

            slider.find('.item .qodef-video .qodef-video-wrap').each(function () {

                var slideWidth = qodef.windowWidth;
                var slideHeight = $(this).closest('.carousel').height();

                $(this).width(slideWidth);

                min_w = vid_ratio * (slideHeight + 20);
                $(this).height(slideHeight);

                var scale_h = slideWidth / video_width_original;
                var scale_v = (slideHeight - qodefGlobalVars.vars.qodefMenuAreaHeight) / video_height_original;
                var scale = scale_v;
                if (scale_h > scale_v)
                    scale = scale_h;
                if (scale * video_width_original < min_w) {
                    scale = min_w / video_width_original;
                }

                $(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original + 2));
                $(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original + 2));
                $(this).scrollLeft(($(this).find('video').width() - slideWidth) / 2);
                $(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find('video').height() - slideHeight) / 2);
                $(this).scrollTop(($(this).find('video').height() - slideHeight) / 2);
            });
        };

        /**
         * Init video background
         * @param slider, current slider
         */
        var initVideoBackground = function (slider) {
            $('.item .qodef-video-wrap .qodef-video-element').mediaelementplayer({
                enableKeyboard: false,
                iPadUseNativeControls: false,
                pauseOtherPlayers: false,
                // force iPhone's native controls
                iPhoneUseNativeControls: false,
                // force Android's native controls
                AndroidUseNativeControls: false
            });

            initVideoBackgroundSize(slider);
            $(window).resize(function () {
                initVideoBackgroundSize(slider);
            });

            //mobile check
            if (navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)) {
                $('.qodef-slider .qodef-mobile-video-image').show();
                $('.qodef-slider .qodef-video-wrap').remove();
            }
        };

        var initPeek = function (slider) {
            if (slider.hasClass('qodef-slide-peek')) {

                var navArrowHover = function (arrow, entered) {
                    var dir = arrow.is('.left') ? 'left' : 'right';
                    var targ_peeker = peekers.filter('.' + dir);
                    if (entered) {
                        arrow.addClass('hovered');
                        var targ_item = (items.index(items.filter('.active')) + (dir === 'left' ? -1 : 1) + items.length) % items.length;
                        targ_peeker.find('.qodef-slider-peeker-inner').css({
                            'background-image': items.eq(targ_item).find('.qodef-image, .qodef-mobile-video-image').css('background-image'),
                            'width': itemWidth + 'px'
                        });
                        targ_peeker.addClass('shown');
                    } else {
                        arrow.removeClass('hovered');
                        peekers.removeClass('shown');
                    }
                };

                var navBulletHover = function (bullet, entered) {
                    if (entered) {
                        bullet.addClass('hovered');

                        var targ_item = bullet.data('slide-to');
                        var cur_item = items.index(items.filter('.active'));
                        if (cur_item !== targ_item) {
                            var dir = (targ_item < cur_item) ? 'left' : 'right';
                            var targ_peeker = peekers.filter('.' + dir);
                            targ_peeker.find('.qodef-slider-peeker-inner').css({
                                'background-image': items.eq(targ_item).find('.qodef-image, .qodef-mobile-video-image').css('background-image'),
                                'width': itemWidth + 'px'
                            });
                            targ_peeker.addClass('shown');
                        }
                    } else {
                        bullet.removeClass('hovered');
                        peekers.removeClass('shown');
                    }
                };

                var handleResize = function () {
                    itemWidth = items.filter('.active').width();
                    itemWidth += (itemWidth % 2) ? 1 : 0; // To make it even
                    items.children('.qodef-image, .qodef-video').css({
                        'position': 'absolute',
                        'width': itemWidth + 'px',
                        'height': '110%',
                        'left': '50%',
                        'transform': 'translateX(-50%)'
                    });
                };

                var items = slider.find('.item');
                var itemWidth;
                handleResize();
                $(window).resize(handleResize);

                slider.find('.carousel-inner').append('<div class="qodef-slider-peeker left"><div class="qodef-slider-peeker-inner"></div></div><div class="qodef-slider-peeker right"><div class="qodef-slider-peeker-inner"></div></div>');
                var peekers = slider.find('.qodef-slider-peeker');
                var nav_arrows = slider.find('.carousel-control');
                var nav_bullets = slider.find('.carousel-indicators > li');

                nav_arrows.on('mouseenter', function () {
                    navArrowHover($(this), true);
                });
                nav_arrows.on('mouseleave', function () {
                    navArrowHover($(this), false);
                });

                nav_bullets.on('mouseenter', function () {
                    navBulletHover($(this), true);
                });
                nav_bullets.on('mouseleave', function () {
                    navBulletHover($(this), false);
                });

                slider.on('slide.bs.carousel', function () {
                    setTimeout(function () {
                        peekers.addClass('qodef-slide-peek-in-progress').removeClass('shown');
                    }, 500);
                });

                slider.on('slid.bs.carousel', function () {
                    nav_arrows.filter('.hovered').each(function () {
                        navArrowHover($(this), true);
                    });
                    setTimeout(function () {
                        nav_bullets.filter('.hovered').each(function () {
                            navBulletHover($(this), true);
                        });
                    }, 200);
                    peekers.removeClass('qodef-slide-peek-in-progress');
                });
            }
        };

        var updateNavigationThumbs = function (slider) {
            if (slider.hasClass('qodef-slider-thumbs')) {
                var src, prev_image, next_image;
                var all_items_count = slider.find('.item').length;
                var curr_item = slider.find('.item').index($('.item.active')[0]) + 1;
                setPrevNextNumbers(slider, curr_item, all_items_count);

                // prev thumb
                if (slider.find('.item.active').prev('.item').length) {
                    if (slider.find('.item.active').prev('div').find('.qodef-image').length) {
                        src = imageRegex.exec(slider.find('.active').prev('div').find('.qodef-image').attr('style'));
                        prev_image = new Image();
                        prev_image.src = src[1];
                        //prev_image = '<div class="thumb-image" style="background-image: url('+src[1]+')"></div>';
                    } else {
                        prev_image = slider.find('.active').prev('div').find('> .qodef-video').clone();
                        prev_image.find('.qodef-video-overlay, .mejs-offscreen').remove();
                        prev_image.find('.qodef-video-wrap').width(150).height(84);
                        prev_image.find('.mejs-container').width(150).height(84);
                        prev_image.find('video').width(150).height(84);
                    }
                    slider.find('.left.carousel-control .img .old').fadeOut(300, function () {
                        $(this).remove();
                    });
                    slider.find('.left.carousel-control .img').append(prev_image).find('div.thumb-image, > img, div.qodef-video').fadeIn(300).addClass('old');

                } else {
                    if (slider.find('.carousel-inner .item:last-child .qodef-image').length) {
                        src = imageRegex.exec(slider.find('.carousel-inner .item:last-child .qodef-image').attr('style'));
                        prev_image = new Image();
                        prev_image.src = src[1];
                        //prev_image = '<div class="thumb-image" style="background-image: url('+src[1]+')"></div>';
                    } else {
                        prev_image = slider.find('.carousel-inner .item:last-child > .qodef-video').clone();
                        prev_image.find('.qodef-video-overlay, .mejs-offscreen').remove();
                        prev_image.find('.qodef-video-wrap').width(150).height(84);
                        prev_image.find('.mejs-container').width(150).height(84);
                        prev_image.find('video').width(150).height(84);
                    }
                    slider.find('.left.carousel-control .img .old').fadeOut(300, function () {
                        $(this).remove();
                    });
                    slider.find('.left.carousel-control .img').append(prev_image).find('div.thumb-image, > img, div.qodef-video').fadeIn(300).addClass('old');
                }

                // next thumb
                if (slider.find('.active').next('div.item').length) {
                    if (slider.find('.active').next('div').find('.qodef-image').length) {
                        src = imageRegex.exec(slider.find('.active').next('div').find('.qodef-image').attr('style'));
                        next_image = new Image();
                        next_image.src = src[1];
                        //next_image = '<div class="thumb-image" style="background-image: url('+src[1]+')"></div>';
                    } else {
                        next_image = slider.find('.active').next('div').find('> .qodef-video').clone();
                        next_image.find('.qodef-video-overlay, .mejs-offscreen').remove();
                        next_image.find('.qodef-video-wrap').width(150).height(84);
                        next_image.find('.mejs-container').width(150).height(84);
                        next_image.find('video').width(150).height(84);
                    }

                    slider.find('.right.carousel-control .img .old').fadeOut(300, function () {
                        $(this).remove();
                    });
                    slider.find('.right.carousel-control .img').append(next_image).find('div.thumb-image, > img, div.qodef-video').fadeIn(300).addClass('old');

                } else {
                    if (slider.find('.carousel-inner .item:first-child .qodef-image').length) {
                        src = imageRegex.exec(slider.find('.carousel-inner .item:first-child .qodef-image').attr('style'));
                        next_image = new Image();
                        next_image.src = src[1];
                        //next_image = '<div class="thumb-image" style="background-image: url('+src[1]+')"></div>';
                    } else {
                        next_image = slider.find('.carousel-inner .item:first-child > .qodef-video').clone();
                        next_image.find('.qodef-video-overlay, .mejs-offscreen').remove();
                        next_image.find('.qodef-video-wrap').width(150).height(84);
                        next_image.find('.mejs-container').width(150).height(84);
                        next_image.find('video').width(150).height(84);
                    }
                    slider.find('.right.carousel-control .img .old').fadeOut(300, function () {
                        $(this).remove();
                    });
                    slider.find('.right.carousel-control .img').append(next_image).find('div.thumb-image, > img, div.qodef-video').fadeIn(300).addClass('old');
                }
            }
        };

        /**
         * initiate slider
         * @param slider, current slider
         * @param currentItem, current slide item index
         * @param totalItemCount, total number of slide items
         * @param slideAnimationTimeout, timeout for slide change
         */
        var initiateSlider = function (slider, totalItemCount, slideAnimationTimeout) {

            //set active class on first item
            slider.find('.carousel-inner .item:first-child').addClass('active');
            //check for header style
            qodefCheckSliderForHeaderStyle($('.carousel .active'), slider.hasClass('qodef-header-effect'));
            // setting numbers on carousel controls
            if (slider.hasClass('qodef-slider-numbers')) {
                setPrevNextNumbers(slider, 1, totalItemCount);
            }
            // set video background if there is video slide
            if (slider.find('.item video').length) {
                //initVideoBackgroundSize(slider);
                initVideoBackground(slider);
            }

            // update thumbs
            updateNavigationThumbs(slider);

            // initiate peek
            initPeek(slider);

            // enable link hover color for slide elements with links
            slider.find('.qodef-slide-element-wrapper-link')
                .mouseenter(function () {
                    $(this).removeClass('inheriting');
                })
                .mouseleave(function () {
                    $(this).addClass('inheriting');
                })
            ;

            //init slider
            if (slider.hasClass('qodef-auto-start')) {
                slider.carousel({
                    interval: slideAnimationTimeout,
                    pause: false
                });

                //pause slider when hover slider button
                slider.find('.slide_buttons_holder .qbutton')
                    .mouseenter(function () {
                        slider.carousel('pause');
                    })
                    .mouseleave(function () {
                        slider.carousel('cycle');
                    });
            } else {
                slider.carousel({
                    interval: 0,
                    pause: false
                });
            }

            $(window).scroll(function () {
                if (slider.hasClass('qodef-full-screen') && qodef.scroll > qodef.windowHeight && qodef.windowWidth > 1000) {
                    slider.carousel('pause');
                } else if (!slider.hasClass('qodef-full-screen') && qodef.scroll > slider.height() && qodef.windowWidth > 1000) {
                    slider.carousel('pause');
                } else {
                    slider.carousel('cycle');
                }
            });


            //initiate image animation
            if ($('.carousel-inner .item:first-child').hasClass('qodef-animate-image') && qodef.windowWidth > 1000) {
                slider.find('.carousel-inner .item.qodef-animate-image:first-child .qodef-image').transformAnimate({
                    transform: "matrix(" + matrixArray[$('.carousel-inner .item:first-child').data('qodef_animate_image')] + ")",
                    duration: 30000
                });
            }
        };

        return {
            init: function () {
                if (sliders.length) {
                    sliders.each(function () {
                        var $this = $(this);
                        var slideAnimationTimeout = $this.data('slide_animation_timeout');
                        var totalItemCount = $this.find('.item').length;

                        checkButtonsAlignment($this);

                        setHeights($this);

                        /*** wait until first video or image is loaded and than initiate slider - start ***/
                        if (qodef.htmlEl.hasClass('touch')) {
                            if ($this.find('.item:first-child .qodef-mobile-video-image').length > 0) {
                                var src = imageRegex.exec($this.find('.item:first-child .qodef-mobile-video-image').attr('style'));
                            } else {
                                var src = imageRegex.exec($this.find('.item:first-child .qodef-image').attr('style'));
                            }
                            if (src) {
                                var backImg = new Image();
                                backImg.src = src[1];
                                $(backImg).load(function () {
                                    $('.qodef-slider-preloader').fadeOut(500);
                                    initiateSlider($this, totalItemCount, slideAnimationTimeout);
                                });
                            }
                        } else {
                            if ($this.find('.item:first-child video').length > 0) {
                                $this.find('.item:first-child video').eq(0).one('loadeddata', function () {
                                    $('.qodef-slider-preloader').fadeOut(500);
                                    initiateSlider($this, totalItemCount, slideAnimationTimeout);
                                });
                            } else {
                                var src = imageRegex.exec($this.find('.item:first-child .qodef-image').attr('style'));
                                if (src) {
                                    var backImg = new Image();
                                    backImg.src = src[1];
                                    $(backImg).load(function () {
                                        $('.qodef-slider-preloader').fadeOut(500);
                                        initiateSlider($this, totalItemCount, slideAnimationTimeout);
                                    });
                                }
                            }
                        }
                        /*** wait until first video or image is loaded and than initiate slider - end ***/

                        /* before slide transition - start */
                        $this.on('slide.bs.carousel', function () {
                            $this.addClass('qodef-in-progress');
                            $this.find('.active .qodef-slider-elements-holder-frame, .active .qodef-slide-element-section-link').fadeTo(250, 0);
                        });
                        /* before slide transition - end */

                        /* after slide transition - start */
                        $this.on('slid.bs.carousel', function () {
                            $this.removeClass('qodef-in-progress');
                            $this.find('.active .qodef-slider-elements-holder-frame, .active .qodef-slide-element-section-link').fadeTo(0, 1);

                            // setting numbers on carousel controls
                            if ($this.hasClass('qodef-slider-numbers')) {
                                var currentItem = $('.item').index($('.item.active')[0]) + 1;
                                setPrevNextNumbers($this, currentItem, totalItemCount);
                            }

                            // initiate image animation on active slide and reset all others
                            $('.item.qodef-animate-image .qodef-image').stop().css({
                                'transform': '',
                                '-webkit-transform': ''
                            });
                            if ($('.item.active').hasClass('qodef-animate-image') && qodef.windowWidth > 1000) {
                                $('.item.qodef-animate-image.active .qodef-image').transformAnimate({
                                    transform: "matrix(" + matrixArray[$('.item.qodef-animate-image.active').data('qodef_animate_image')] + ")",
                                    duration: 30000
                                });
                            }

                            // setting thumbnails on navigation controls
                            if ($this.hasClass('qodef-slider-thumbs')) {
                                updateNavigationThumbs($this);
                            }
                        });
                        /* after slide transition - end */

                        /* swipe functionality - start */
                        $this.swipe({
                            swipeLeft: function () {
                                $this.carousel('next');
                            },
                            swipeRight: function () {
                                $this.carousel('prev');
                            },
                            threshold: 20
                        });
                        /* swipe functionality - end */

                    });

                    //adding parallax functionality on slider
                    if ($('.no-touch .carousel').length) {
                        var skrollr_slider = skrollr.init({
                            smoothScrolling: false,
                            forceHeight: false
                        });
                        skrollr_slider.refresh();
                    }

                    $(window).scroll(function () {
                        //set control class for slider in order to change header style
                        if ($('.qodef-slider .carousel').height() < qodef.scroll) {
                            $('.qodef-slider .carousel').addClass('qodef-disable-slider-header-style-changing');
                        } else {
                            $('.qodef-slider .carousel').removeClass('qodef-disable-slider-header-style-changing');
                            qodefCheckSliderForHeaderStyle($('.qodef-slider .carousel .active'), $('.qodef-slider .carousel').hasClass('qodef-header-effect'));
                        }

                        //hide slider when it is out of viewport
                        if ($('.qodef-slider .carousel').hasClass('qodef-full-screen') && qodef.scroll > qodef.windowHeight && qodef.windowWidth > 1000) {
                            $('.qodef-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
                        } else if (!$('.qodef-slider .carousel').hasClass('qodef-full-screen') && qodef.scroll > $('.qodef-slider .carousel').height() && qodef.windowWidth > 1000) {
                            $('.qodef-slider .carousel').find('.carousel-inner, .carousel-indicators').hide();
                        } else {
                            $('.qodef-slider .carousel').find('.carousel-inner, .carousel-indicators').show();
                        }
                    });
                }
            }
        };
    };

    /**
     * Check if slide effect on header style changing
     * @param slide, current slide
     * @param headerEffect, flag if slide
     */

    function qodefCheckSliderForHeaderStyle(slide, headerEffect) {

        if ($('.qodef-slider .carousel').not('.qodef-disable-slider-header-style-changing').length > 0) {

            var slideHeaderStyle = "";
            if (slide.hasClass('light')) {
                slideHeaderStyle = 'qodef-light-header';
            }
            if (slide.hasClass('dark')) {
                slideHeaderStyle = 'qodef-dark-header';
            }

            if (slideHeaderStyle !== "") {
                if (headerEffect) {
                    qodef.body.removeClass('qodef-dark-header qodef-light-header').addClass(slideHeaderStyle);
                }
            } else {
                if (headerEffect) {
                    qodef.body.removeClass('qodef-dark-header qodef-light-header').addClass(qodef.defaultHeaderStyle);
                }

            }
        }
    }

    /**
     * List object that initializes list with animation
     * @type {Function}
     */
    var qodefInitIconList = qodef.modules.shortcodes.qodefInitIconList = function () {
        var iconList = $('.qodef-animate-list');

        /**
         * Initializes icon list animation
         * @param list current list shortcode
         */
        var iconListInit = function (list) {
            setTimeout(function () {
                list.appear(function () {
                    list.addClass('qodef-appeared');
                }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            }, 30);
        };

        return {
            init: function () {
                if (iconList.length) {
                    iconList.each(function () {
                        iconListInit($(this));
                    });
                }
            }
        };
    };

    /*
     **  Init shop list masonry type
     */
    function qodefInitShopListMasonry() {
        var shopList = $('.qodef-shop-masonry');
        if (shopList.length) {
            shopList.each(function () {
                var thisShopList = $(this).children('.qodef-shop-list-masonry');
                var size = thisShopList.find('.qodef-shop-list-masonry-grid-sizer').width();
                qodefResizeShopMasonry(size, thisShopList);

                qodefInitMasonryLayout(thisShopList);
                $(window).resize(function () {
                    size = thisShopList.find('.qodef-shop-list-masonry-grid-sizer').width();
                    qodefResizeShopMasonry(size, thisShopList);
                    qodefInitMasonryLayout(thisShopList);
                });
            });
        }
    }

    function qodefInitMasonryLayout(container) {
        container.animate({opacity: 1});
        container.isotope({
            itemSelector: '.qodef-shop-product',
            masonry: {
                columnWidth: '.qodef-shop-list-masonry-grid-sizer'
            }
        });
    }

    function qodefResizeShopMasonry(size, container) {

        var defaultMasonryItem = container.find('.qodef-default-masonry-item');
        var largeWidthMasonryItem = container.find('.qodef-large-width-masonry-item');
        var largeHeightMasonryItem = container.find('.qodef-large-height-masonry-item');
        var largeWidthHeightMasonryItem = container.find('.qodef-large-width-height-masonry-item');

        defaultMasonryItem.css('height', size);
        largeHeightMasonryItem.css('height', Math.round(2 * size));

        var breakpoint = qodef.body.hasClass('page-template-full-width') ? 480 : 600;

        if (qodef.windowWidth > breakpoint) {
            largeWidthHeightMasonryItem.css('height', Math.round(2 * size));
            largeWidthMasonryItem.css('height', size);
        } else {
            largeWidthHeightMasonryItem.css('height', size);
            largeWidthMasonryItem.css('height', Math.round(size / 2));

        }
    }

    /**
     * Initializes shop masonry filter
     */
    function qodefInitShopMasonryFilter() {

        var filterHolder = $('.qodef-shop-filter-holder.qodef-masonry-filter');

        if (filterHolder.length) {
            filterHolder.each(function () {

                var thisFilterHolder = $(this);

                var shopIsotopeAnimation = null;

                thisFilterHolder.find('.filter:first').addClass('current');

                thisFilterHolder.find('li').on('click', function () {

                    var currentFilter = $(this);
                    clearTimeout(shopIsotopeAnimation);

                    $('.isotope, .isotope .isotope-item').css('transition-duration', '0.8s');

                    shopIsotopeAnimation = setTimeout(function () {
                        $('.isotope, .isotope .isotope-item').css('transition-duration', '0s');
                    }, 700);

                    var selector = $(this).attr('data-filter');
                    thisFilterHolder.parent().find('.qodef-shop-list-masonry').isotope({filter: selector});

                    thisFilterHolder.find('.filter').removeClass('current');
                    currentFilter.addClass('current');

                    return false;

                });

            });
        }
    }


    /*
     **	Vertical Split Slider
     */

    function qodefInitVerticalSplitSlider() {

        var body = $('body');

        if (body.hasClass('qodef-vertical-split-screen-initialized')) {
            body.removeClass('qodef-vertical-split-screen-initialized');
            $.fn.multiscroll.destroy();
        }

        if ($('.qodef-vertical-split-slider').length) {

            var slider = $('.qodef-vertical-split-slider');

            slider.height(qodef.windowHeight).animate({opacity: 1}, 300);
            slider.multiscroll({
                scrollingSpeed: 500,
                navigation: true,
                useAnchorsOnLoad: false,
                sectionSelector: '.qodef-vss-ms-section',
                leftSelector: '.qodef-vss-ms-left',
                rightSelector: '.qodef-vss-ms-right',
                afterRender: function () {

                    body.addClass('qodef-vertical-split-screen-initialized');

                    //prepare html for smaller screens - start //
                    var verticalSplitSliderResponsive = $("<div class='qodef-vertical-split-slider-responsive' />");
                    slider.after(verticalSplitSliderResponsive);
                    var leftSide = $('.qodef-vertical-split-slider .qodef-vss-ms-left > div');
                    var rightSide = $('.qodef-vertical-split-slider .qodef-vss-ms-right > div');

                    for (var i = 0; i < leftSide.length; i++) {
                        verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
                        verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
                    }

                    //prepare google maps clones
                    if ($('.qodef-vertical-split-slider-responsive .qodef-google-map').length) {
                        $('.qodef-vertical-split-slider-responsive .qodef-google-map').each(function () {
                            var map = $(this);
                            map.empty();
                            var num = Math.floor((Math.random() * 100000) + 1);
                            map.attr('id', 'qodef-map-' + num);
                            map.data('unique-id', num);
                        });
                    }

                    qodefShowGoogleMap();
                },
                onLeave: function (index, nextIndex, direction) {
                    qodefAlbumDisc();
                }
            });


            if (qodef.windowWidth <= 1024) {
                $.fn.multiscroll.destroy();
            } else {
                $.fn.multiscroll.build();
            }

            $(window).resize(function () {
                if (qodef.windowWidth <= 1024) {
                    $.fn.multiscroll.destroy();
                } else {
                    $.fn.multiscroll.build();
                }

            });
        }
    }

    /*
     * Type out functionality for Custom Font
     */
    function qodefCustomFontTypeOut() {

        var qodefTyped = $('.qodef-typed');

        if (qodefTyped.length) {
            qodefTyped.each(function () {

                //vars
                var thisTyped = $(this),
                    typedWrap = thisTyped.parents('.qodef-typed-wrap'),
                    customFontHolder = typedWrap.parents('.qodef-custom-font-holder'),
                    originalText = customFontHolder.find('.qodef-custom-font-original'),
                    str,
                    string_1 = thisTyped.find('.qodef-typed-1').text(),
                    string_2 = thisTyped.find('.qodef-typed-2').text(),
                    string_3 = thisTyped.find('.qodef-typed-3').text();

                //show only the strings that are entered in
                if (!string_2.trim() || !string_3.trim()) {
                    str = [string_1];
                }
                if (!string_3.trim() && string_2.length) {
                    str = [string_1, string_2];
                }
                if (string_1.length && string_2.length && string_3.length) {
                    str = [string_1, string_2, string_3];
                }

                //ampersand
                if (originalText.text().indexOf('&') !== -1) {
                    originalText.html(originalText.text().replace('&', '<span class="qodef-amp">&</span>'));
                }

                //typeout
                setTimeout(function () {
                    customFontHolder.appear(function () {
                        thisTyped.typed({
                            strings: str,
                            typeSpeed: 90,
                            backDelay: 700,
                            loop: true,
                            contentType: 'text',
                            loopCount: false,
                            cursorChar: "_",
                        });
                    }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
                }, 100);

            });
        }
    }


    /**
     * Check if slide effect on header style changing
     */
    function qodefItemShowcase() {
        var itemShowcase = $('.qodef-item-showcase');
        if (itemShowcase.length) {
            itemShowcase.each(function () {
                var thisItemShowcase = $(this),
                    leftItems = thisItemShowcase.find('.qodef-item-left'),
                    rightItems = thisItemShowcase.find('.qodef-item-right'),
                    itemImage = thisItemShowcase.find('.qodef-item-image');

                //logic
                leftItems.wrapAll("<div class='qodef-item-showcase-holder qodef-holder-left' />");
                rightItems.wrapAll("<div class='qodef-item-showcase-holder qodef-holder-right' />");
                thisItemShowcase.animate({opacity: 1}, 200);
                setTimeout(function () {
                    thisItemShowcase.appear(function () {
                        itemImage.addClass('qodef-appeared');
                        thisItemShowcase.on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
                            function (e) {
                                if (qodef.windowWidth > 1200) {
                                    itemAppear('.qodef-holder-left .qodef-item');
                                    itemAppear('.qodef-holder-right .qodef-item');
                                } else {
                                    itemAppear('.qodef-item');
                                }
                            });
                    }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
                }, 100);

                //appear animation trigger
                function itemAppear(itemCSSClass) {
                    thisItemShowcase.find(itemCSSClass).each(function (i) {
                        var thisListItem = $(this);
                        setTimeout(function () {
                            thisListItem.addClass('qodef-appeared');
                        }, i * 150);
                    });
                }
            });

        }
    }

    var qodefAudioPlayer = qodef.modules.shortcodes.qodefAudioPlayer = function () {
        //all players on the page
        var players = $('.qodef-audio-player-wrapper');

        var albumPlaylist = function (player) {
            var ajaxData = {
                action: 'qodef_core_album_playlist',
                album_id: player.find('.qodef-audio-player-holder').data('album-id')
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: qodefCoreAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    if (response.status === 'success') {
                        albumPlayer(response.sdata, player);

                    }

                }
            });
        };

        var albumPlayer = function (data, player) {
            var jPlayerSelector = '#' + player.find('.jp-jplayer').attr('id');
            var jCssSelectorAncestorSelector = '#' + player.find('.qodef-audio-player-holder').attr('id');

            var playlist = new jPlayerPlaylist({
                jPlayer: jPlayerSelector,
                cssSelectorAncestor: jCssSelectorAncestorSelector
            }, data, {
                playlistOptions: {
                    autoPlay: false
                },
                supplied: "mp3",
                wmode: "window",
                useStateClassSkin: true,
                autoBlur: false,
                smoothPlayBar: true,
                keyEnabled: true,
                ready: function () {
                    setTrackTitle(playlist, player);
                    playOnClickOnSingle(playlist)
                },
                play: function () {
                    setTrackTitle(playlist, player);
                    setActiveTrackOnSigle(playlist)
                }
            });

        };
        var setTrackTitle = function (playlist, player) {
            var titleHolder = player.find('.qodef-audio-player-title');
            var artistHolder = player.find('.qodef-audio-player-album');

            titleHolder.html(playlist.original[playlist.current].title);
            artistHolder.html(playlist.original[playlist.current].album_name);
        };
        var setActiveTrackOnSigle = function (playlist) {
            var activeSong = playlist.original[playlist.current].unique_id;
            var tracksSingleHolder = $('.qodef-album-tracks-holder');
            if (tracksSingleHolder.length) {
                tracksSingleHolder.find('.qodef-track-holder').removeClass('qodef-active-track');
                tracksSingleHolder.find('.' + activeSong).addClass('qodef-active-track');
            }
        };
        var playOnClickOnSingle = function (playlist) {
            var tracksSingleHolder = $('.qodef-album-tracks-holder');
            if (tracksSingleHolder.length) {
                tracksSingleHolder.find('.qodef-track-title').on('click', function () {
                    var track = $(this);
                    var trackIndex = track.data('track-index');
                    playlist.play(trackIndex);
                });
            }

        };
        return {
            init: function () {
                if (players.length) {
                    players.each(function () {
                        albumPlaylist($(this));
                    });
                }
            }
        };
    };

    function qodefAlbumPlayButton() {
        var albums = $('.qodef-album-track-list');
        if (albums.length) {
            albums.each(function () {
                var album = $(this);
                var albumID = $(this).attr('id');
                var tracks = album.find('.qodef-album-track');
                var audioTracks = tracks.find('audio');

                tracks.each(function () {
                    var track = $(this);
                    var playButton = track.find('.qodef-at-play-button, .qodef-at-title');

                    var audioTrack = playButton.find('audio').get(0);
                    playButton.on('click', function () {
                        if (track.hasClass('qodef-track-in-progress')) {
                            audioTrack.pause();
                            track.addClass('qodef-track-paused').removeClass('qodef-track-in-progress');
                        } else if (track.hasClass('qodef-track-paused')) {
                            audioTrack.play();
                            track.addClass('qodef-track-playing qodef-track-in-progress').removeClass('qodef-track-paused')
                        } else {
                            audioTracks.each(function () {
                                this.pause();
                                this.currentTime = 0;
                            });
                            tracks.removeClass('qodef-track-playing qodef-track-in-progress qodef-track-paused');
                            audioTrack.play();
                            track.addClass('qodef-track-playing qodef-track-in-progress')
                        }
                    });

                    track.find('audio').on("ended", function () {
                        track.removeClass('qodef-track-playing qodef-track-in-progress');
                    });
                });
            });
        }
    }

    /**
     * Initializes albums load more function
     */
    function qodefInitAlbumsLoadMore() {
        var albumsList = $('.qodef-albums-list-holder-outer.qodef-albums-load-more');

        if (albumsList.length) {
            albumsList.each(function () {

                var thisAlbumList = $(this);
                var thisAlbumListInner = thisAlbumList.find('.qodef-albums-list-holder');
                var nextPage;
                var maxNumPages;
                var loadMoreButton = thisAlbumList.find('.qodef-albums-list-load-more a');

                if (typeof thisAlbumList.data('max-num-pages') !== 'undefined' && thisAlbumList.data('max-num-pages') !== false) {
                    maxNumPages = thisAlbumList.data('max-num-pages');
                }

                loadMoreButton.on('click', function (e) {

                    var loadMoreDatta = qodefGetAlbumsAjaxData(thisAlbumList);
                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    e.stopPropagation();
                    if (nextPage <= maxNumPages) {
                        var ajaxData = qodefSetAlbumsAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: qodefCoreAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisAlbumList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = qodefConvertHTML(response.html);
                                thisAlbumList.waitForImages(function () {
                                    thisAlbumListInner.append(responseHtml);
                                });
                            }
                        });
                    }
                    if (nextPage === maxNumPages) {
                        loadMoreButton.hide();
                    }
                });

            });
        }
    }

    /**
     * Initializes albums load more data params
     * @param albums list container with defined data params
     * return array
     */
    function qodefGetAlbumsAjaxData(container) {
        var returnValue = {};

        returnValue.type = '';
        returnValue.columns = '';
        returnValue.orderBy = '';
        returnValue.order = '';
        returnValue.number = '';
        returnValue.label = '';
        returnValue.genre = '';
        returnValue.artist = '';
        returnValue.selectedAlbums = '';
        returnValue.showLoadMore = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        returnValue.showStores = '';
        returnValue.storesList = '';

        if (typeof container.data('type') !== 'undefined' && container.data('type') !== false) {
            returnValue.type = container.data('type');
        }
        if (typeof container.data('columns') !== 'undefined' && container.data('columns') !== false) {
            returnValue.columns = container.data('columns');
        }
        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {
            returnValue.number = container.data('number');
        }
        if (typeof container.data('label') !== 'undefined' && container.data('label') !== false) {
            returnValue.category = container.data('label');
        }
        if (typeof container.data('genre') !== 'undefined' && container.data('genre') !== false) {
            returnValue.genre = container.data('genre');
        }
        if (typeof container.data('artist') !== 'undefined' && container.data('artist') !== false) {
            returnValue.artist = container.data('artist');
        }
        if (typeof container.data('selected-albums') !== 'undefined' && container.data('selected-albums') !== false) {
            returnValue.selectedAlbums = container.data('selected-albums');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        if (typeof container.data('show-stores') !== 'undefined' && container.data('show-stores') !== false) {
            returnValue.showStores = container.data('show-stores');
        }
        if (typeof container.data('stores-list') !== 'undefined' && container.data('stores-list') !== false) {
            returnValue.storesList = container.data('stores-list');
        }

        return returnValue;
    }


    /**
     * Sets albums load more data params for ajax function
     * @param albums list container with defined data params
     * return array
     */
    function qodefSetAlbumsAjaxData(container) {
        var returnValue = {
            action: 'qodef_core_albums_ajax_load_more',
            type: container.type,
            columns: container.columns,
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            label: container.label,
            genre: container.genre,
            artist: container.artist,
            selectedAlbums: container.selectedAlbums,
            showLoadMore: container.showLoadMore,
            nextPage: container.nextPage,
            showStores: container.showStores,
            storesList: container.storesList
        };

        return returnValue;

    }

    /**
     * Initializes events load more function
     */
    function qodefInitEventsLoadMore() {
        var eventsList = $('.qodef-events-list-holder-outer.qodef-events-load-more');

        if (eventsList.length) {
            eventsList.each(function () {

                var thisEventList = $(this);
                var thisEventListInner = thisEventList.find('.qodef-events-list-holder');
                var nextPage;
                var maxNumPages;
                var loadMoreButton = thisEventList.find('.qodef-events-list-load-more a');
                var loadMoreButtonHolder = thisEventList.find('.qodef-events-list-paging');

                if (typeof thisEventList.data('max-num-pages') !== 'undefined' && thisEventList.data('max-num-pages') !== false) {
                    maxNumPages = thisEventList.data('max-num-pages');
                }

                loadMoreButton.on('click', function (e) {
                    var loadMoreDatta = qodefGetEventsAjaxData(thisEventList);
                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    e.stopPropagation();
                    if (nextPage <= maxNumPages) {
                        loadMoreButtonHolder.find('.qodef-events-list-load-more').stop().animate({opacity: 0}, 200, 'easeInOutQuint',
                            function () {
                                loadMoreButtonHolder.find('.qodef-stripes').stop().animate({opacity: 1}, 200, 'easeInOutQuint');
                            });
                        var ajaxData = qodefSetEventsAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: qodefCoreAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisEventList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = qodefConvertHTML(response.html);
                                thisEventList.waitForImages(function () {
                                    thisEventListInner.append(responseHtml);
                                    loadMoreButtonHolder.find('.qodef-stripes').stop().animate({opacity: 0}, 200, 'easeInOutQuint',
                                        function () {
                                            loadMoreButtonHolder.find('.qodef-events-list-load-more').stop().animate({opacity: 1}, 200, 'easeInOutQuint');
                                            if (nextPage > maxNumPages) {
                                                loadMoreButtonHolder.find('.qodef-stripes').remove();
                                                loadMoreButtonHolder.fadeOut(200, 'easeInOutQuint').remove();
                                            }
                                        });
                                });
                            }
                        });
                    } else {
                        loadMoreButtonHolder.hide();
                    }
                });

            });
        }
    }

    /**
     * Initializes events load more data params
     * @param events list container with defined data params
     * return array
     */
    function qodefGetEventsAjaxData(container) {
        var returnValue = {};

        returnValue.orderBy = '';
        returnValue.order = '';
        returnValue.number = '';
        returnValue.showLoadMore = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        returnValue.titleTag = '';
        returnValue.buttonShape = '';
        returnValue.textColor = '';
        returnValue.buttonSkin = '';
        returnValue.borderColor = '';

        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {
            returnValue.number = container.data('number');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        if (typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {
            returnValue.titleTag = container.data('title-tag');
        }
        if (typeof container.data('button-shape') !== 'undefined' && container.data('button-shape') !== false) {
            returnValue.buttonShape = container.data('button-shape');
        }
        if (typeof container.data('button-skin') !== 'undefined' && container.data('button-skin') !== false) {
            returnValue.buttonSkin = container.data('button-skin');
        }
        if (typeof container.data('text-color') !== 'undefined' && container.data('text-color') !== false) {
            returnValue.textColor = container.data('text-color');
        }
        if (typeof container.data('border-color') !== 'undefined' && container.data('border-color') !== false) {
            returnValue.borderColor = container.data('border-color');
        }

        return returnValue;
    }


    /**
     * Sets events load more data params for ajax function
     * @param events list container with defined data params
     * return array
     */
    function qodefSetEventsAjaxData(container) {
        var returnValue = {
            action: 'qodef_core_events_ajax_load_more',
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            showLoadMore: container.showLoadMore,
            nextPage: container.nextPage,
            titleTag: container.titleTag,
            buttonShape: container.buttonShape,
            buttonSkin: container.buttonSkin,
            textColor: container.textColor,
            borderColor: container.borderColor
        };

        return returnValue;

    }

    /**
     * Initializes events load more function
     */
    function qodefInitBlogListLoadMore() {
        var blogList = $('.qodef-blog-list-holder');

        if (blogList.length) {
            blogList.each(function () {

                var thisBlogList = $(this);
                var thisBlogListInner = thisBlogList.find('.qodef-blog-list');
                var nextPage;
                var maxNumPages;
                var loadMoreButton = thisBlogList.find('.qodef-blog-list-load-more a');
                var loadMoreButtonHolder = thisBlogList.find('.qodef-blog-list-paging');

                if (typeof thisBlogList.data('max-num-pages') !== 'undefined' && thisBlogList.data('max-num-pages') !== false) {
                    maxNumPages = thisBlogList.data('max-num-pages');
                }

                loadMoreButton.on('click', function (e) {

                    var loadMoreDatta = qodefGetBlogListAjaxData(thisBlogList);

                    nextPage = loadMoreDatta.nextPage;
                    e.preventDefault();
                    e.stopPropagation();

                    var nonceHolder = thisBlogList.find('input[name*="qodef_blog_load_more_nonce_"]');

                    loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
                    loadMoreDatta.blog_load_more_nonce = nonceHolder.val();
                    
                    if (nextPage <= maxNumPages) {

                        loadMoreButtonHolder.find('.qodef-blog-list-load-more').stop().animate({opacity: 0}, 200, 'easeInOutQuint',
                            function () {
                                loadMoreButtonHolder.find('.qodef-stripes').stop().animate({opacity: 1}, 200, 'easeInOutQuint');
                            });
                        var ajaxData = qodefSetBlogListAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: QodefAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisBlogList.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml = qodefConvertHTML(response.html);
                                thisBlogList.waitForImages(function () {
                                    thisBlogListInner.append(responseHtml);
                                    qodef.modules.blog.qodefInitAudioPlayer();
                                    qodef.modules.common.qodefSlickSlider();
                                    qodef.modules.common.qodefFluidVideo();
                                    if (blogList.hasClass('qodef-masonry')) {
                                        thisBlogListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
                                        setTimeout(function () {
                                            thisBlogListInner.isotope('layout');
                                        }, 400);
                                    }
                                    loadMoreButtonHolder.find('.qodef-stripes').stop().animate({opacity: 0}, 200, 'easeInOutQuint',
                                        function () {
                                            loadMoreButtonHolder.find('.qodef-blog-list-load-more').stop().animate({opacity: 1}, 200, 'easeInOutQuint');
                                            if (nextPage > maxNumPages) {
                                                loadMoreButtonHolder.find('.qodef-stripes').remove();
                                                loadMoreButtonHolder.fadeOut(200, 'easeInOutQuint').remove();
                                            }
                                        });
                                });
                            }
                        });
                    } else {
                        loadMoreButtonHolder.hide();
                    }
                });

            });
        }
    }

    /**
     * Initializes events load more data params
     * @param events list container with defined data params
     * return array
     */
    function qodefGetBlogListAjaxData(container) {

        var returnValue = {};

        returnValue.orderBy = 'title';
        returnValue.order = 'ASC';
        returnValue.number = '';
        returnValue.showLoadMore = '';
        returnValue.loadMoreSkin = '';
        returnValue.nextPage = '';
        returnValue.maxNumPages = '';
        returnValue.titleTag = 'h4';
        returnValue.textColor = '';
        returnValue.titleColor = '';
        returnValue.postInfoColor = '';
        returnValue.boxShadow = 'no';
        returnValue.bgrColor = '';
        returnValue.textLength = '90';
        returnValue.imageSize = 'original';
        returnValue.category = '';
        returnValue.blType = '';

        if (typeof container.data('order-by') !== 'undefined' && container.data('order-by') !== false) {
            returnValue.orderBy = container.data('order-by');
        }
        if (typeof container.data('order') !== 'undefined' && container.data('order') !== false) {
            returnValue.order = container.data('order');
        }
        if (typeof container.data('number') !== 'undefined' && container.data('number') !== false) {
            returnValue.number = container.data('number');
        }
        if (typeof container.data('show-load-more') !== 'undefined' && container.data('show-load-more') !== false) {
            returnValue.showLoadMore = container.data('show-load-more');
        }
        if (typeof container.data('load-more-skin') !== 'undefined' && container.data('load-more-skin') !== false) {
            returnValue.loadMoreSkin = container.data('load-more-skin');
        }
        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('max-num-pages') !== 'undefined' && container.data('max-num-pages') !== false) {
            returnValue.maxNumPages = container.data('max-num-pages');
        }
        if (typeof container.data('title-tag') !== 'undefined' && container.data('title-tag') !== false) {
            returnValue.titleTag = container.data('title-tag');
        }
        if (typeof container.data('box-shadow') !== 'undefined' && container.data('box-shadow') !== false) {
            returnValue.boxShadow = container.data('box-shadow');
        }
        if (typeof container.data('bg-color') !== 'undefined' && container.data('bg-color') !== false) {
            returnValue.bgrColor = container.data('bg-color');
        }
        if (typeof container.data('text-color') !== 'undefined' && container.data('text-color') !== false) {
            returnValue.textColor = container.data('text-color');
        }
        if (typeof container.data('post-info-color') !== 'undefined' && container.data('post-info-color') !== false) {
            returnValue.postInfoColor = container.data('post-info-color');
        }
        if (typeof container.data('title-color') !== 'undefined' && container.data('title-color') !== false) {
            returnValue.titleColor = container.data('title-color');
        }
        if (typeof container.data('text-length') !== 'undefined' && container.data('text-length') !== false) {
            returnValue.textLength = container.data('text-length');
        }
        if (typeof container.data('image-size') !== 'undefined' && container.data('image-size') !== false) {
            returnValue.imageSize = container.data('image-size');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {
            returnValue.category = container.data('category');
        }
        if (typeof container.data('type') !== 'undefined' && container.data('type') !== false) {
            returnValue.blType = container.data('type');
        }

        return returnValue;
    }


    /**
     * Sets events load more data params for ajax function
     * @param events list container with defined data params
     * return array
     */
    function qodefSetBlogListAjaxData(container) {

        var returnValue = {
            action: 'mixtape_qodef_blog_list_ajax_load_more',
            orderBy: container.orderBy,
            order: container.order,
            number: container.number,
            showLoadMore: container.showLoadMore,
            loadMoreSkin: container.loadMoreSkin,
            nextPage: container.nextPage,
            titleTag: container.titleTag,
            boxShadow: container.boxShadow,
            bgrColor: container.bgrColor,
            textColor: container.textColor,
            postInfoColor: container.postInfoColor,
            titleColor: container.titleColor,
            textLength: container.textLength,
            imageSize: container.imageSize,
            category: container.category,
            blType: container.blType,
            blog_load_more_id: container.blog_load_more_id,
            blog_load_more_nonce: container.blog_load_more_nonce
        };

        return returnValue;

    }


    function qodefAlbumDisc() {
        var albumDiscs = $('.qodef-album-disc.qodef-animate-on-appear');

        if (albumDiscs.length) {
            albumDiscs.each(function () {
                var albumDisc = $(this);

                //vss
                if (albumDisc.closest('.qodef-vss-ms-section').length) {
                    if (albumDisc.closest('.qodef-vss-ms-section').hasClass('active') && !albumDisc.hasClass('qodef-appeared')) {
                        setTimeout(function () {
                            albumDisc.addClass('qodef-appeared');
                        }, 500);
                        //duration of a slide
                    }
                }
                //scroll
                else {
                    albumDisc.appear(function () {
                        albumDisc.addClass('qodef-appeared');
                    }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
                }

            });
        }
    }

    function qodefBoxedIcon() {
        var boxedIcons = $('.qodef-boxed-icon');

        if (boxedIcons.length) {
            boxedIcons.each(function () {
                var boxedIcon = $(this),
                    iconTitle = boxedIcon.find('.qodef-boxed-icon-title');

                if (iconTitle.length) {
                    var iconTitleHeight = parseInt(iconTitle.height()),
                        icon = boxedIcon.find('.qodef-boxed-icon-inner > .qodef-icon-shortcode, .qodef-boxed-icon-inner > .qodef-boxed-icon-custom-icon'),
                        iconElement = icon.find('.qodef-icon-element, img'),
                        heightOffsetCoeff = 2;

                    iconTitle.css('transform', 'translateY(' + iconTitleHeight / heightOffsetCoeff + 'px)');

                    boxedIcon.mouseenter(function () {
                        iconTitleHeight = parseInt(iconTitle.height());
                        iconTitle.css({
                            'top': parseInt(iconElement.offset().top - boxedIcon.offset().top + iconElement.height()),
                            'transform': 'translateY(0px)',
                            'opacity': 1
                        });
                        icon.css('transform', 'translateY(' + -(iconTitleHeight / heightOffsetCoeff) + 'px)');
                    });
                    boxedIcon.mouseleave(function () {
                        iconTitle.css({
                            'transform': 'translateY(' + iconTitleHeight / heightOffsetCoeff + 'px)',
                            'opacity': 0
                        });
                        icon.css('transform', 'translateY(0px)');
                    });
                }
            });
        }
    }


    function qodefDeviceShowcase() {
        var deviceShowcaseShortcodes = $('.qodef-device-showcase.qodef-animate-yes');

        if (deviceShowcaseShortcodes.length && !qodef.htmlEl.hasClass('touch')) {
            deviceShowcaseShortcodes.appear(function () {
                var deviceShowcaseShortcode = $(this),
                    deviceItem = deviceShowcaseShortcode.find('.qodef-device');

                deviceItem.addClass('qodef-appeared');

                deviceItem.each(function (i) {
                    var currentItem = $(this);
                    currentItem.one('webkitTransitionEnd  transitionEnd ', function () {
                        if (currentItem.index() === deviceItem.length - 1) {
                            deviceShowcaseShortcode.css('overflow', 'visible');
                            deviceItem.addClass('qodef-animated')
                        }
                    });
                });
            }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
        }
    }

    function qodefInitFrameCarousel() {

        var frameCarousel = $('.qodef-frame-carousel');

        if (frameCarousel.length) {
            frameCarousel.each(function () {

                if ($(this).children('.qodef-frame-carousel-carousel').length) {

                    var slider = $('.qodef-frame-carousel .qodef-frame-carousel-carousel');

                    var autoplay = slider.data('autoplay'),
                        autoplayTimeout;

                    if (autoplay === 'disable') {
                        autoplay = false;
                    } else {
                        autoplayTimeout = autoplay * 1000;
                        autoplay = true;
                    }


                    slider.waitForImages(function () {
                        slider.owlCarousel({
                            items: 3,
                            slideSpeed: 600,
                            loop: true,
                            margin: 0,
                            autoplay: false,
                            autoplayTimeout: autoplayTimeout,
                            autoplayHoverPause: true,
                            stagePadding: 0,
                            center: true,
                            autoWidth: false,
                            nav: true,
                            navText: [
                                '<span class="qodef-owl-prev qodef-prev-icon"><span class="qodef-top-part"></span><span class="qodef-bottom-part"></span></span>',
                                '<span class="qodef-owl-next qodef-next-icon"><span class="qodef-top-part"></span><span class="qodef-bottom-part"></span></span>'
                            ]
                        });

                        var active_src = $('.qodef-frame-carousel .owl-item.center .qodef-frame-carousel-active-image-holder img').attr('src');
                        $('.qodef-frame-carousel .qodef-frame-carousel-active-image').attr('src', active_src);

                        slider.on('changed.owl.carousel', function (event) {
                            var currentItem = event.item.index;
                            active_src = $('.qodef-frame-carousel .owl-item:eq(' + currentItem + ') .qodef-frame-carousel-active-image-holder img').attr('src');
                            $('.qodef-frame-carousel .qodef-frame-carousel-active-image').attr('src', active_src);

                        });


                        slider.css('opacity', 1);
                    });
                }
            });
        }
    }


    /*
     **	Elements Holder responsive style
     */
    function qodefInitElementsHolderResponsiveStyle() {

        var elementsHolder = $('.qodef-elements-holder');

        if (elementsHolder.length) {
            elementsHolder.each(function () {
                var thisElementsHolder = $(this),
                    elementsHolderItem = thisElementsHolder.children('.qodef-elements-holder-item'),
                    style = '',
                    responsiveStyle = '';

                elementsHolderItem.each(function () {
                    var thisItem = $(this),
                        itemClass = '',
                        largeLaptop = '',
                        smallLaptop = '',
                        ipadLandscape = '',
                        ipadPortrait = '',
                        mobileLandscape = '',
                        mobilePortrait = '';


                    if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
                        itemClass = thisItem.data('item-class');
                    }
                    if (typeof thisItem.data('1280-1440') !== 'undefined' && thisItem.data('1280-1440') !== false) {
                        largeLaptop = thisItem.data('1280-1440');
                    }
                    if (typeof thisItem.data('1024-1280') !== 'undefined' && thisItem.data('1024-1280') !== false) {
                        smallLaptop = thisItem.data('1024-1280');
                    }
                    if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
                        ipadLandscape = thisItem.data('768-1024');
                    }
                    if (typeof thisItem.data('600-768') !== 'undefined' && thisItem.data('600-768') !== false) {
                        ipadPortrait = thisItem.data('600-768');
                    }
                    if (typeof thisItem.data('480-600') !== 'undefined' && thisItem.data('480-600') !== false) {
                        mobileLandscape = thisItem.data('480-600');
                    }
                    if (typeof thisItem.data('480') !== 'undefined' && thisItem.data('480') !== false) {
                        mobilePortrait = thisItem.data('480');
                    }

                    if (largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {

                        if (largeLaptop.length) {
                            responsiveStyle += "@media only screen and (min-width: 1280px) and (max-width: 1440px) {.qodef-elements-holder-item-content." + itemClass + " { padding: " + largeLaptop + " !important; } }";
                        }
                        if (smallLaptop.length) {
                            responsiveStyle += "@media only screen and (min-width: 1024px) and (max-width: 1280px) {.qodef-elements-holder-item-content." + itemClass + " { padding: " + smallLaptop + " !important; } }";
                        }
                        if (ipadLandscape.length) {
                            responsiveStyle += "@media only screen and (min-width: 768px) and (max-width: 1024px) {.qodef-elements-holder-item-content." + itemClass + " { padding: " + ipadLandscape + " !important; } }";
                        }
                        if (ipadPortrait.length) {
                            responsiveStyle += "@media only screen and (min-width: 600px) and (max-width: 768px) {.qodef-elements-holder-item-content." + itemClass + " { padding: " + ipadPortrait + " !important; } }";
                        }
                        if (mobileLandscape.length) {
                            responsiveStyle += "@media only screen and (min-width: 480px) and (max-width: 600px) {.qodef-elements-holder-item-content." + itemClass + " { padding: " + mobileLandscape + " !important; } }";
                        }
                        if (mobilePortrait.length) {
                            responsiveStyle += "@media only screen and (max-width: 480px) {.qodef-elements-holder-item-content." + itemClass + " { padding: " + mobilePortrait + " !important; } }";
                        }
                    }
                });

                if (responsiveStyle.length) {
                    style = '<style type="text/css" data-type="mixtape_qodef_modules_shortcodes_eh_custom_css">' + responsiveStyle + '</style>';
                }

                if (style.length) {
                    $('head').append(style);
                }
            });
        }
    }

    function qodefImageWithTextAnimation() {
        var iwts = $('.qodef-image-with-text.qodef-loading-animation');

        if (iwts.length && !qodef.htmlEl.hasClass('touch')) {
            iwts.each(function () {
                var iwt = $(this),
                    delay = parseInt(iwt.data('loading-animation-delay'));

                iwt.css('pointer-events', 'none');

                iwt.appear(function () {
                    setTimeout(function () {
                        iwt.addClass('qodef-appeared');
                        iwt.one(qodef.transitionEnd, function () {
                            iwt.css('pointer-events', 'auto');
                        });
                    }, delay);
                }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
            });
        }
    }


    function qodefParallaxHolder() {
        var parallaxHolders = $('.qodef-parallax-holder');

        if (parallaxHolders.length && !qodef.htmlEl.hasClass('touch')) {
            ParallaxScroll.init(); //initialzation removed from plugin js file to have it run only on non-touch devices
        }
    }

})(jQuery);
(function ($) {
    'use strict';

    var woocommerce = {};
    qodef.modules.woocommerce = woocommerce;

    woocommerce.qodefInitQuantityButtons = qodefInitQuantityButtons;
    woocommerce.qodefInitSelect2 = qodefInitSelect2;

    woocommerce.qodefOnDocumentReady = qodefOnDocumentReady;
    woocommerce.qodefOnWindowLoad = qodefOnWindowLoad;
    woocommerce.qodefOnWindowResize = qodefOnWindowResize;


    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);

    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitQuantityButtons();
        qodefInitSelect2();
        qodefInitButtonLoadingLabel();
        qodefInitSingleProductLightbox();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {

    }


    function qodefInitQuantityButtons() {

        $(document).on('click', '.qodef-quantity-minus, .qodef-quantity-plus', function (e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.parent().siblings('.qodef-quantity-input'),
                step = parseFloat(inputField.data('step')),
                max = parseFloat(inputField.data('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('qodef-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(0);
                }
            } else {
                newInputValue = inputValue + step;
                if (max === undefined) {
                    inputField.val(newInputValue);
                } else {
                    if (newInputValue >= max) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }
            inputField.trigger('change');

        });

    }

    function qodefInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length || $('#calc_shipping_country').length) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });

            $('#calc_shipping_country, .dropdown_product_cat, .dropdown_layered_nav_color').select2();

        }

    }

    /*
    ** Init Woo loading label
    */
    function qodefInitButtonLoadingLabel() {
        var addToCart = $(".add_to_cart_button");

        addToCart.on('click', function () {
            $(this).children(".qodef-btn-text").text(qodefGlobalVars.vars.qodefAddingToCart);
        });
    }

    /*
     ** Init Product Single Pretty Photo attributes
     */
    function qodefInitSingleProductLightbox() {
        var item = $('.qodef-woocommerce-single-page .qodef-single-product-images .images .woocommerce-product-gallery__image');

        if (item.length) {
            item.each(function () {
                var thisItem = $(this);

                thisItem.attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
                if (typeof qodef.modules.common.qodefPrettyPhoto === "function") {
                    qodef.modules.common.qodefPrettyPhoto();
                }
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var albums = {};
    qodef.modules.albums = albums;

	albums.qodefInitAlbumReviews = qodefInitAlbumReviews;

	albums.qodefOnDocumentReady = qodefOnDocumentReady;
	albums.qodefOnWindowLoad = qodefOnWindowLoad;
	albums.qodefOnWindowResize = qodefOnWindowResize;
	albums.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefInitAlbumReviews();
        qodefInitArtists();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {

    }


	function qodefInitAlbumReviews(){

		var reviews = $('.qodef-single-album-reviews');
		if(reviews.length){
			reviews.each(function(){

				var review = $(this);

				var auto = true;
				var controlNav = false;
				var directionNav = true;
				var slidesToShow = 1;

				review.slick({
					infinite: true,
					autoplay: auto,
					slidesToShow : slidesToShow,
					arrows: directionNav,
					dots: controlNav,
					dotsClass: 'qodef-slick-dots',
                    easing: 'easeInOutQuint',
					adaptiveHeight: true,
					prevArrow: '<span class="qodef-slick-prev qodef-prev-icon"><span class="arrow_carrot-left"></span></span>',
					nextArrow: '<span class="qodef-slick-next qodef-next-icon"><span class="arrow_carrot-right"></span></span>',
					customPaging: function(slider, i) {
						return '<span class="qodef-slick-dot-inner"></span>';
					}
				});

			});
			$('.qodef-single-album-reviews-holder').css('opacity', 1);
		}

	}

    function qodefInitArtists(){
        if($('.qodef-artists-list-holder').length) {

            var container = $('.qodef-artists-list-holder');

            container.waitForImages({
                finished: function(){
                    container.isotope({
                        itemSelector: '.qodef-artist',
                        resizable: false,
                        masonry: {
                            columnWidth: '.qodef-artists-grid-sizer',
                            gutter: '.qodef-artists-grid-gutter'
                        }
                    });
                },
                waitForAll: true
            });
        }
	}



})(jQuery);

(function($) {

    'use strict';

    $(document).ready(function(){
        initSingleArtists();
    });

    // Helper vars and functions.
    function extend( a, b ) {
        for( var key in b ) {
            if( b.hasOwnProperty( key ) ) {
                a[key] = b[key];
            }
        }
        return a;
    }

    /**
     * Record obj.
     */
    function Record(el) {
        this.wrapper = el;
        this.cover = this.wrapper.querySelector('.qodef-atrist-image-holder');
        this.position = this.wrapper.querySelector('.qodef-number');
        this.title = this.wrapper.querySelector('.qodef-name');
        this.stage = this.wrapper.querySelector('.qodef-stage');

        this.info = {
            coverImg : this.cover.querySelector('img').src,
            artist : this.title.innerHTML,
            title : this.stage.innerHTML
        };
    }

    /**
     * Position the record.
     */
    Record.prototype.layout = function(place) {
        switch(place) {
            case 'down' :
                dynamics.css(this.cover, { opacity: 1, translateY : qodef.windowHeight });
                dynamics.css(this.position, { opacity: 1, translateY : qodef.windowHeight - 200 });
                dynamics.css(this.title, { opacity: 1, translateY : qodef.windowHeight - 200 });
                dynamics.css(this.stage, { opacity: 1, translateY : qodef.windowHeight - 180 });
                break;
            case 'right' :
                dynamics.css(this.cover, { opacity: 1, translateX : qodef.windowWidth + 600 });
                dynamics.css(this.position, { opacity: 1, translateX : qodef.windowWidth + 150 });
                dynamics.css(this.title, { opacity: 1, translateX : qodef.windowWidth });
                dynamics.css(this.stage, { opacity: 1, translateX : qodef.windowWidth + 150 });
                break;
            case 'left' :
                dynamics.css(this.cover, { opacity: 1, translateX : -qodef.windowWidth - 600 });
                dynamics.css(this.position, { opacity: 1, translateX : -qodef.windowWidth - 150 });
                dynamics.css(this.title, { opacity: 1, translateX : -qodef.windowWidth });
                dynamics.css(this.stage, { opacity: 1, translateX : -qodef.windowWidth - 150 });
                break;
            case 'hidden' :
                dynamics.css(this.cover, { opacity: 0 });
                dynamics.css(this.position, { opacity: 0 });
                dynamics.css(this.title, { opacity: 0 });
                dynamics.css(this.stage, { opacity: 0 });
                break;
        };
    };

    /**
     * Animate the record.
     */
    Record.prototype.animate = function(direction, callback) {
        var duration = 600,
            type = dynamics.bezier,
            points = [{"x":0,"y":0,"cp":[{"x":0.2,"y":1}]},{"x":1,"y":1,"cp":[{"x":0.3,"y":1}]}],
            transform = {
                'left' : { translateX : -qodef.windowWidth, translateY : 0, opacity : 1 },
                'right' : { translateX : qodef.windowWidth, translateY : 0, opacity : 1 },
                'center' : { translateX : 0, translateY : 0, opacity : 1 }
            };

        dynamics.animate(this.cover, transform[direction], { duration : duration, type : type, points : points, complete : function() {
            if( typeof callback === 'function' ) {
                callback();
            }
        } });
        dynamics.animate(this.position, transform[direction], { duration : duration, type : type, points : points });
        dynamics.animate(this.title, transform[direction], { duration : duration, type : type, points : points });
        dynamics.animate(this.stage, transform[direction], { duration : duration, type : type, points : points });
    };

    /**
     * Slideshow obj.
     */
    function RecordSlideshow(el, options) {
        this.el = el;

        // Options/Settings.
        this.options = extend( {}, this.options );
        extend( this.options, options );

        // Slideshow items.
        this.records = [];
        var self = this;
        [].slice.call(this.el.querySelectorAll('.qodef-atrist-single')).forEach(function(el) {
            var record = new Record(el);
            self.records.push(record);
        });
        // Total items.
        this.recordsTotal = this.records.length;
        // Current record idx.
        this.current = 0;
        // Slideshow controls.
        this.ctrls = {
            next : this.el.querySelector('.qodef-controls-navigate > span.qodef-control-button-next'),
            prev : this.el.querySelector('.qodef-controls-navigate > span.qodef-control-button-prev'),
            back : this.el.querySelector('span.qodef-control-button-back')
        };

        this._initEvents();
    }

    /**
     * RecordSlideshow options/settings.
     */
    RecordSlideshow.prototype.options = {
        // On stop callback.
        onStop : function() { return false; }
    };

    /**
     * Shows the first record.
     */
    RecordSlideshow.prototype.start = function(pos) {
        this.current = pos;
        var currentRecord = this.records[this.current];
        $(currentRecord.wrapper).addClass('qodef-single-current');
        currentRecord.layout('down');
        currentRecord.animate('center');
    };

    /**
     * Init/Bind events.
     */
    RecordSlideshow.prototype._initEvents = function() {
        var self = this;
        this.ctrls.next.addEventListener('click', function() {
            self._navigate('right');
        });
        this.ctrls.prev.addEventListener('click', function() {
            self._navigate('left');
        });
        this.ctrls.back.addEventListener('click', function() {
            self._stop();
        });

    };

    /**
     * Navigate.
     */
    RecordSlideshow.prototype._navigate = function(direction) {

        var currentRecord = this.records[this.current];

        if( direction === 'right' ) {
            this.current = this.current < this.recordsTotal - 1 ? this.current + 1 : 0;
        }
        else {
            this.current = this.current > 0 ? this.current - 1 : this.recordsTotal - 1;
        }

        var nextRecord = this.records[this.current];
        $(nextRecord.wrapper).addClass('qodef-single-current');

        currentRecord.animate(direction === 'right' ? 'left' : 'right', function() {
            $(currentRecord.wrapper).removeClass('qodef-single-current');
        });

        nextRecord.layout(direction);
        nextRecord.animate('center');
    };

    /**
     * Stop the slideshow.
     */
    RecordSlideshow.prototype._stop = function() {
        qodef.modules.common.qodefEnableScroll();
        var currentRecord = this.records[this.current];
        currentRecord.layout('hidden');
        $(currentRecord.wrapper).removeClass('qodef-single-current');

        // Callback.
        this.options.onStop();
    };

    /* UI */

    // Single/Slideshow views.
    if(document.querySelector('.qodef-artists-list-holder-outer ') !== null) {
        var views = {
                list: document.querySelector('.qodef-artists-list-holder'),
                single: document.querySelector('.qodef-artist-view-single')
            },
            // The initial list items.
            lps = [].slice.call(views.list.querySelectorAll('.qodef-artist')),
            expanderEl = document.querySelector('.qodef-artist-single-expander'),
            slideshow;
    }

    /**
     * Initialize events.
     */
    function initSingleArtists() {
        if(document.querySelector('.qodef-artists-list-holder-outer ') !== null) {
            initEvents();
            // Initialize slideshow.
            slideshow = new RecordSlideshow(document.querySelector('.qodef-artist-view-single'), {
                // Stopping/Closing the slideshow: return to the initial list.
                onStop: function () {
                    changeView('single', 'list');
                    hideExpander();
                }
            });
        }
    }

    function changeView(old, current) {
        $(views[old]).removeClass('qodef-view-current');
        $(views[current]).addClass('qodef-view-current');
    }

    function initEvents() {
        lps.forEach(function(lp, pos) {
            $(lp).on('click', function(e) {
                e.preventDefault();
                qodef.modules.common.qodefDisableScroll();

                showExpander({x: e.clientX, y: e.clientY}, function() {
                    changeView('list', 'single');
                });
                // Start the slideshow.
                setTimeout(function() { slideshow.start(pos);}, 80);
            });
        });
    }

    function showExpander(position, callback) {
        $(expanderEl).addClass('active');
        qodef.body.addClass('qodef-records-slideshow-active');

        dynamics.css(expanderEl, { opacity: 1, left : position.x, top : position.y, backgroundColor : '#f4f4f4', scale : 0 });
        dynamics.animate(expanderEl, {
            scale : 1.5,
            backgroundColor : '#f4f4f4'
        }, {
            duration : 500,
            type : dynamics.easeOut,
            complete : function() {
                if( typeof callback === 'function' ) {
                    callback();
                }
            }
        });
    }

    function hideExpander() {
        dynamics.css(expanderEl, { left : window.innerWidth/2, top : window.innerHeight/2 });
        dynamics.animate(expanderEl, {
            opacity : 0
        }, {
            duration : 500,
            type : dynamics.easeOut,
            complete: function(){
                $(expanderEl).removeClass('active');
                qodef.body.removeClass('qodef-records-slideshow-active');
            }
        });
    }


})(jQuery);
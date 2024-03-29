(function ($) {

	$(document).ready(function () {
		$('body').addClass('js');
		var $menu = $('#menu'),
			$menulink = $('.menu-link');

		$menulink.click(function () {
			$menulink.toggleClass('active');
			$menu.toggleClass('active');
			return false;
		});
	});


	$('.owl-carousel').owlCarousel({
		loop: true,
		margin: 30,
		nav: true,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		responsive: {
			0: {
				items: 1
			},
			550: {
				items: 2
			},
			750: {
				items: 3
			},
			1000: {
				items: 4
			},
			1200: {
				items: 5
			}
		}
	})


	$(".Modern-Slider").slick({
		autoplay: true,
		autoplaySpeed: 10000,
		speed: 600,
		slidesToShow: 1,
		slidesToScroll: 1,
		pauseOnHover: false,
		dots: true,
		pauseOnDotsHover: true,
		cssEase: 'fade',
		// fade:true,
		draggable: false,
		prevArrow: '<button class="PrevArrow"></button>',
		nextArrow: '<button class="NextArrow"></button>',
	});


	$("div.features-post").hover(
		function () {
			$(this).find("div.content-hide").slideToggle("medium");
		},
		function () {
			$(this).find("div.content-hide").slideToggle("medium");
		}
	);


	$("#tabs").tabs();



})(jQuery);
//according to loftblog tut
$('.nav li:first').addClass('active');

var showSection = function showSection(section, isAnimate) {
	var
		direction = section.replace(/#/, ''),
		reqSection = $('.section').filter('[data-section="' + direction + '"]'),
		reqSectionPos = reqSection.offset().top - 0;

	if (isAnimate) {
		$('body, html').animate({
			scrollTop: reqSectionPos
		},
			800);
	} else {
		$('body, html').scrollTop(reqSectionPos);
	}

};

var checkSection = function checkSection() {
	$('.section').each(function () {
		var
			$this = $(this),
			topEdge = $this.offset().top - 80,
			bottomEdge = topEdge + $this.height(),
			wScroll = $(window).scrollTop();
		if (topEdge < wScroll && bottomEdge > wScroll) {
			var
				currentId = $this.data('section'),
				reqLink = $('a').filter('[href*=\\#' + currentId + ']');
			reqLink.closest('li').addClass('active').
				siblings().removeClass('active');
		}
	});
};

$('.main-menu, .scroll-to-section').on('click', 'a', function (e) {
	if ($(e.target).hasClass('external')) {
		return;
	}
	e.preventDefault();
	$('#menu').removeClass('active');
	showSection($(this).attr('href'), true);
});

$(window).scroll(function () {
	checkSection();
});
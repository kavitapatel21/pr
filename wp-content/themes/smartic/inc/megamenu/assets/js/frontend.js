(function ($) {
    $(function () {
        $('.main-navigation .has-mega-menu.has-stretchwidth').hover(function (e) {
            let $body = $('body'),
                pleft = $(this).offset().left,
                bodyleft = $body.offset().left;
            $('.mega-stretchwidth', this).css({
                left: -pleft + bodyleft,
                width: $body.width()
            });
        });

        $('.main-navigation .has-mega-menu.has-containerwidth').hover(function (e) {
            let $parent = $(this).closest('.container , .elementor-container, .col-full, .header-container'),
                pleft = $parent.offset().left + parseInt($parent.css('padding-left')),
                cleft = $(this).offset().left;

            $('.mega-containerwidth', this).css({
                left: pleft - cleft,
                width: $parent.width()
            });
        });

		$('.main-navigation .has-mega-menu').has('ul.custom-subwidth').hover(function (e) {
			let pleft = parseFloat($(this).children('a').css('padding-left')),
				$oleft = $(this).offset().left + pleft,
			    $itemwidth = parseInt($(this).children('.custom-subwidth').css('width')),
			    $bodywidth = $('body').width();

			let $offset = $oleft + $itemwidth - $bodywidth;

			if ($offset >= 0){
				$('.mega-menu.custom-subwidth', this).css({
					left: -$offset + pleft
				});
			}
			else{
				$('.mega-menu.custom-subwidth', this).css({
					left: pleft
				});
			}


		});
    });
})(jQuery);

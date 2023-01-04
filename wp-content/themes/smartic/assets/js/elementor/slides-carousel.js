(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/smartic-slides-carousel.default', ($scope) => {
            let $carousel = $('.js-swiper-container', $scope);
            if ($carousel.length > 0) {
                let mySwiper = new Swiper($carousel.get(0), {
                    // Optional parameters
                    direction: 'vertical',
                    loop: false,
                    autoHeight: false,
                    spaceBetween: 0,
                    slidesPerView: 1,
                    // autoplay: {
                    //     delay: 5000,
                    // },
                    effect: "slide", //"slide", "fade", "cube", "coverflow" or "flip"
                    initialSlide: 1,
                    mousewheel: true,

                    // And if we need scrollbar
                    scrollbar: {
                        el: '.swiper-scrollbar',
                        draggable: true,
                        dragSize: 19
                    },
                });
            }
        });
    });
})(jQuery);

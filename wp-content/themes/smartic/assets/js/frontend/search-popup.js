(function ($) {
    'use strict';
    $( document ).ready(function() {

        $('body').on('click', '.site-search-popup-close',function(e){
            e.preventDefault();
            $('html').toggleClass('search-popup-active');
        }).on('click', '.button-search-popup', function (e) {
            e.preventDefault();
            $('html').toggleClass('search-popup-active');
        })
    });
})(jQuery);

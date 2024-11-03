(function ($) {
    "use strict";

    /*====  Document Ready Function =====*/
    jQuery(document).ready(function($){
        //Mobile Menu
        $("#main-menu").slicknav({
            allowParentLinks: true,
            prependTo: '#mobile-menu-wrap',
            label: '',
        });

        $(".mobile-menu-trigger").on("click", function(e) {
            $(".mobile-menu-container").addClass("menu-open");
            e.stopPropagation();
        });

        $(".mobile-menu-close").on("click", function(e) {
            $(".mobile-menu-container").removeClass("menu-open");
            e.stopPropagation();
        });


        $("#display_promotions_text .messages").slick({
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: "2000", //interval
            speed: 1000, // slide speed
            dots: false,
            arrows: false,
            infinite:  true,
            pauseOnHover: false,
            vertical: true,
            verticalSwiping: true,
        });

        $(".product-images").slick({
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: "3000", //interval
            speed: 1500, // slide speed
            dots: false,
            fade: true,
            arrows: false,
            infinite:  true,
            pauseOnHover: false,
            vertical: false,
            verticalSwiping: false,
        });

        $(".product-detail-img-slider").slick({
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: "3000", //interval
            speed: 1500, // slide speed
            dots: false,
            fade: true,
            arrows: false,
            infinite:  true,
            pauseOnHover: false,
            vertical: false,
            verticalSwiping: false,
        });

    });
}(jQuery));


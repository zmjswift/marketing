// 留言提交成功后 倒计时
var t = 60;    
function showTime(item){

    item ? item : item = '#submit_message';

    t -= 1;  
    $(item).text('提交成功（'+t+'）');
    $('#submit_message').css("pointer-events","none").css("background-color","#4CAF50").css("color","#fff")
    var f = setTimeout("showTime('"+item+"')",1000); 

    if(t==0){
        window.location.reload(); //刷新当前页面
        //$(item).text('提交留言');
        //$('#submit_message').css("pointer-events","auto")
        //window.clearTimeout(f);
        t=60;
    } 

} 


(function($) {
    
    "use strict";

    //Loading 动画
    function preloader_load() {
      var preLoader = $('.preloader');
      if(preLoader.length){
        preLoader.delay(400).fadeOut(500);
      }
    }

    //返回顶部
    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 200) {
        $('.scrollup').fadeIn();
      } else {
        $('.scrollup').fadeOut();
      }
    });
    $('.scrollup').on('click', function () {
      $("html, body").animate({
        scrollTop: 0
      }, 1000);
      return false;
    });

    // Navbar
    var nav = $('.header-sticky');
      
    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
        nav.addClass("fixed-header");
      } else {
        nav.removeClass("fixed-header");
      }
    });

    $(document).ready(function(){
      var dropDown = $('.dropdown');
      //Show dropdown on hover only for desktop devices
      if($(window).innerWidth() > 767){
        dropDown.on({
          mouseenter: function () {
            dropDown.clearQueue();
            $(this).find('>.dropdown-menu').addClass('show');
          },
          mouseleave: function () {
            $(this).find('>.dropdown-menu').removeClass('show');
          }
        });
      }

      //Show dropdown on click only for mobile devices
      if($(window).innerWidth() < 768) {
        dropDown.on('click', function(event){

          // Avoid having the menu to close when clicking
          event.stopPropagation();

          // close all the siblings
          $(this).siblings().removeClass('show');
          $(this).siblings().find('>.dropdown-menu').removeClass('show');

          // close all the submenus of siblings
          $(this).siblings().find('>.dropdown-menu').parent().removeClass('show');

          // opening the one you clicked on
          $(this).find('>.dropdown-menu').toggleClass('show');
          $(this).siblings('>.dropdown-menu').toggleClass('show');
        });
      }
    });



    //背景图片视觉差效果
    var dataBackground = $('[data-background]');
    if (dataBackground.length > 0) {
      dataBackground.each(function() {
        var $background, $backgroundmobile, $this;
        $this = $(this);
        $background = $(this).attr('data-background');
        $backgroundmobile = $(this).attr('data-background-mobile');
        if ($this.attr('data-background').substr(0, 1) === '#') {
          return $this.css('background-color', $background);
        } else if ($this.attr('data-background-mobile') && device.mobile()) {
          return $this.css('background-image', 'url(' + $backgroundmobile + ')');
        } else {
          return $this.css('background-image', 'url(' + $background + ')');
        }
      });
    }

    //客户评价
    $("#testimonials_carousel").owlCarousel({
        loop:true,
        autoplay: 2000,
        autoplayHoverPause:true,
        smartSpeed: 700,
        items: 1,
        margin:30,
        dots: true,
        nav:true,
        navText: [
          '<i class="fa fa-angle-left"></i>',
          '<i class="fa fa-angle-right"></i>'
        ]
    });

    //合作伙伴
    $("#client_carousel").owlCarousel({
        loop:true,
        autoplay: 2000,
        autoplayHoverPause:true,
        smartSpeed: 700,
        items: 6,
        margin:30,
        dots: false,
        nav:true,
        navText: [
          '<i class="fa fa-angle-left"></i>',
          '<i class="fa fa-angle-right"></i>'
        ],
        responsive:{
          0:{
            items:2
          },
          480:{
            items:3
          },
          600:{
            items:3
          },
          800:{
            items:4
          },
          1024:{
            items:6
          },
          1200:{
            items:6
          }
        }
    });


    //产品页面，产品图集
    $('#showproduct-slider').owlCarousel({
      items: 1,
      loop:true,
      //autoPlay:3000,
      autoplay: true,
      pagination:true,
      autoHeight: true,
      navigation: false,
    });

    //bootstrap Slider JS Start
    $('#slider-style-one').bsTouchSlider();
    //bootstrap Slider JS End


      //视觉差
      function parallaxIt() {
        // create variables
        var $fwindow = $(window);
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        var $contents = [];
        var $backgrounds = [];

        // for each of content parallax element
        $('[data-type="content"]').each(function(index, e) {
          var $contentObj = $(this);

          $contentObj.__speed = ($contentObj.data('speed') || 1);
          $contentObj.__fgOffset = $contentObj.offset().top;
          $contents.push($contentObj);
        });

        // for each of background parallax element
        $('[data-type="parallax"]').each(function() {
          var $backgroundObj = $(this);

          $backgroundObj.__speed = ($backgroundObj.data('speed') || 1);
          $backgroundObj.__fgOffset = $backgroundObj.offset().top;
          $backgrounds.push($backgroundObj);
        });

        // update positions
        $fwindow.on('scroll resize', function() {
          scrollTop = window.pageYOffset || document.documentElement.scrollTop;

          $contents.forEach(function($contentObj) {
            var yPos = $contentObj.__fgOffset - scrollTop / $contentObj.__speed;

            $contentObj.css('top', yPos);
          })

          $backgrounds.forEach(function($backgroundObj) {
            var yPos = -((scrollTop - $backgroundObj.__fgOffset) / $backgroundObj.__speed);

            $backgroundObj.css({
              backgroundPosition: '50% ' + yPos + 'px'
            });
          });
        });

        // triggers winodw scroll for refresh
        $fwindow.trigger('scroll');
      };
      parallaxIt();
      // Parallax elements JQUARY End



    //留言表单
    $('#ajax-contact').submit(function(event) {
        event.preventDefault();

        $('#submit_message').text('提交中...');

        $.ajax({
            url: dq.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: $('#ajax-contact').serializeArray(),
        })
        .done(function( data ) {
            if( data != 0 ){
                if( data.state == 200 ){
                    $('#form-messages').removeClass('error').addClass('success').text(data.tips);
                    showTime('#submit_message');
                }else if( data.state == 201 ){
                    $('#submit_message').text('提交留言');
                    $('#form-messages').removeClass('success').addClass('error').text(data.tips);
                }
            }else{
                $('#form-messages').removeClass('success').addClass('error').text('请求错误！');
            }
        })
        .fail(function() {
            alert('网络错误！');
        });

    });

    //模块1 手机端滑块
    $("#modular_1_mobile_slider").owlCarousel({
        loop:true,
        autoplay: 2000,
        autoplayHoverPause:true,
        smartSpeed: 700,
        dots: true,
        nav:false,
        items:1
    });

    //模块11 手机端滑块
    $("#modular_11_mobile").owlCarousel({
        loop:true,
        autoplay: 2000,
        autoplayHoverPause:true,
        smartSpeed: 700,
        dots: true,
        nav:false,
        items:1
    });

    //模块12 手机端滑块
    $("#modular_12_mobile_slider").owlCarousel({
        loop:true,
        autoplay: 2000,
        autoplayHoverPause:true,
        smartSpeed: 700,
        dots: true,
        nav:false,
        items:1
    });

    //模块13 手机端滑块
    $("#modular_13_mobile_slider").owlCarousel({
        loop:true,
        autoplay: 2000,
        autoplayHoverPause:true,
        smartSpeed: 700,
        dots: true,
        nav:false,
        items:1
    });

    $('.navbar-toggler').on('click', function () {
      $('body').toggleClass('menu-is-opened');
    });

/////////////////////////////////////////////////////////////



    /*==========================================================================
        WHEN DOCUMENT LOADING
    ==========================================================================*/
    $(window).on('load', function() {

        preloader_load();

     });

    /*==========================================================================
        WHEN WINDOW READY
    ==========================================================================*/
    $(document).on('ready', function() {

    });


    /*==========================================================================
        WHEN WINDOW SCROLL
    ==========================================================================*/
    $(window).on("scroll", function() {
    });

    /*==========================================================================
        WHEN WINDOW RESIZE
    ==========================================================================*/
    $(window).on("resize", function() {

    });

    /*==========================================================================
        链接新窗口打开
    ==========================================================================*/
	$(".entry-tags a,.single-breadcrumbs a,.entry-meta a,.footer-list a").attr("target","_blank");

    /*==========================================================================
       头部搜索按钮
    ==========================================================================*/
    if ($(".header-search-form-wrapper").length) {
        var searchToggleBtn = $(".search-toggle-btn");
        var searchToggleBtnIcon = $(".search-toggle-btn i");
        var searchContent = $(".header-search-form");
        var body = $("body");

        searchToggleBtn.on("click", function (e) {
            searchContent.toggleClass("header-search-content-toggle");
            searchToggleBtnIcon.toggleClass("fa fa-search fa fa-close");
            e.stopPropagation();
        });

        /*单击空白处也会关闭搜索框
        body.on("click", function () {
            searchContent.removeClass("header-search-content-toggle");
        }).find(searchContent).on("click", function (e) {
            e.stopPropagation();
        });
        */
    }

    /*==========================================================================
       产品图集
    ==========================================================================*/
  var $videoWidth = $(".single-product-gallery").width();
  $(".single-product-gallery .product-gallery-zoom .product-video").css({
    width: $videoWidth + "px",
    height: $videoWidth + "px"
  });
  $(".single-product-gallery .flex-control-thumbs li.flex-video").hover(
    function () {
      $(".single-product-gallery .product-gallery-zoom .product-video").show();
      $(".single-product-gallery .product-gallery-zoom .product-image").hide();
      $(this).addClass("flex-active").siblings().removeClass("flex-active");
      return false;
    }
  );
  $(".single-product-gallery .flex-control-thumbs li.flex-thumb").hover(
    function () {
      $(".single-product-gallery .product-gallery-zoom .product-video").hide();
      $(".single-product-gallery .product-gallery-zoom .product-image").show();
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr("src", $(this).find("img").attr("xpreview"));
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr("data-src", $(this).find("img").attr("xpreview"));
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr("data-large_image", $(this).find("img").attr("xpreview"));
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr("xoriginal", $(this).find("img").attr("xpreview"));
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr("srcset", $(this).find("img").attr("xpreview"));
      $(this).addClass("flex-active").siblings().removeClass("flex-active");
      return false;
    }
  );
  var $carouselRTWidth, $carouselLTWidth, $countNext;
  var $thumbsLiWidth4 =
    $(".single-product-gallery .product-thumbs-wrapper").width() / 4;
  var $thumbsLiWidth3 =
    $(".single-product-gallery .product-thumbs-wrapper").width() / 3;
  var $carouselUl = $(".flex-control-thumbs");
  var $imgli = $(".flex-control-thumbs li");
  var $arrowPrev = $(".single-product-gallery .jcarousel-control-prev");
  var $arrowNext = $(".single-product-gallery .jcarousel-control-next");
  var $countPrev = 0;
  $arrowPrev.click(function () {
    $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
      .prev()
      .addClass("flex-active")
      .siblings()
      .removeClass("flex-active");
    $(".single-product-gallery .product-gallery-zoom .product-image img").attr(
      "src",
      $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
        .find("img")
        .attr("xpreview")
    );
    $(".single-product-gallery .product-gallery-zoom .product-image img").attr(
      "data-src",
      $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
        .find("img")
        .attr("xpreview")
    );
    $(".single-product-gallery .product-gallery-zoom .product-image img").attr(
      "data-large_image",
      $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
        .find("img")
        .attr("xpreview")
    );
    $(".single-product-gallery .product-gallery-zoom .product-image img").attr(
      "xoriginal",
      $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
        .find("img")
        .attr("xpreview")
    );
    $(".single-product-gallery .product-gallery-zoom .product-image img").attr(
      "srcset",
      $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
        .find("img")
        .attr("xpreview")
    );
    if (
      $(".product-thumbs-gallery .flex-control-thumbs li.flex-video").hasClass(
        "flex-active"
      )
    ) {
      $(".single-product-gallery .product-gallery-zoom .product-video").show();
      $(".single-product-gallery .product-gallery-zoom .product-image").hide();
    } else {
      $(".single-product-gallery .product-gallery-zoom .product-video").hide();
      $(".single-product-gallery .product-gallery-zoom .product-image").show();
    }
    $arrowNext.removeClass("disable");
    if ($countPrev < 1) {
      $(this).addClass("disable");
      return;
    }
    $countPrev--;
    $countNext++;
    $carouselUl.animate({ left: $carouselRTWidth }, 100);
  });
  if ($(window).width() >= 768) {
    $(".flex-control-thumbs li").css("width", $thumbsLiWidth4);
    $(".single-product-gallery .product-thumbs-gallery").css(
      "height",
      $thumbsLiWidth4 - 10
    );
    $(
      ".product-thumbs-gallery .flex-control-thumbs li.flex-video .btn-play-video"
    ).css({
      width: $thumbsLiWidth4 - 10 + "px",
      "line-height": $thumbsLiWidth4 - 10 + "px"
    });
    $(
      ".product-thumbs-gallery .flex-control-thumbs li.flex-video .btn-play-video .icon-play-video"
    ).css({ height: $thumbsLiWidth4 - 10 + "px" });
    $carouselRTWidth = "+=" + $thumbsLiWidth4 + "px";
    $carouselLTWidth = "-=" + $thumbsLiWidth4 + "px";
    $countNext = $imgli.length;
    $carouselUl.css("width", $imgli.length * $thumbsLiWidth4);
    $arrowNext.click(function () {
      $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
        .next()
        .addClass("flex-active")
        .siblings()
        .removeClass("flex-active");
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr(
        "src",
        $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
          .find("img")
          .attr("xpreview")
      );
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr(
        "data-src",
        $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
          .find("img")
          .attr("xpreview")
      );
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr(
        "data-large_image",
        $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
          .find("img")
          .attr("xpreview")
      );
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr(
        "xoriginal",
        $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
          .find("img")
          .attr("xpreview")
      );
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr(
        "srcset",
        $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
          .find("img")
          .attr("xpreview")
      );
      $arrowPrev.removeClass("disable");
      if ($countNext <= 4) {
        $(this).addClass("disable");
        return;
      }
      $countPrev++;
      $countNext--;
      $carouselUl.animate({ left: $carouselLTWidth }, 100);
      if (
        $(
          ".product-thumbs-gallery .flex-control-thumbs li.flex-video"
        ).hasClass("flex-active")
      ) {
        $(
          ".single-product-gallery .product-gallery-zoom .product-video"
        ).show();
        $(
          ".single-product-gallery .product-gallery-zoom .product-image"
        ).hide();
      } else {
        $(
          ".single-product-gallery .product-gallery-zoom .product-video"
        ).hide();
        $(
          ".single-product-gallery .product-gallery-zoom .product-image"
        ).show();
      }
    });
  } else {
    $(".flex-control-thumbs li").css("width", $thumbsLiWidth3);
    $(".single-product-gallery .product-thumbs-gallery").css(
      "height",
      $thumbsLiWidth3 - 10
    );
    $(
      ".product-thumbs-gallery .flex-control-thumbs li.flex-video .btn-play-video"
    ).css({
      width: $thumbsLiWidth3 - 10 + "px",
      "line-height": $thumbsLiWidth3 - 10 + "px"
    });
    $(
      ".product-thumbs-gallery .flex-control-thumbs li.flex-video .btn-play-video .icon-play-video"
    ).css({ height: $thumbsLiWidth3 - 10 + "px" });
    $carouselRTWidth = "+=" + $thumbsLiWidth3 + "px";
    $carouselLTWidth = "-=" + $thumbsLiWidth3 + "px";
    $countNext = $imgli.length;
    $carouselUl.css("width", $imgli.length * $thumbsLiWidth3);
    $arrowNext.click(function () {
      $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
        .next()
        .addClass("flex-active")
        .siblings()
        .removeClass("flex-active");
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr(
        "src",
        $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
          .find("img")
          .attr("xpreview")
      );
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr(
        "data-src",
        $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
          .find("img")
          .attr("xpreview")
      );
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr(
        "data-large_image",
        $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
          .find("img")
          .attr("xpreview")
      );
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr(
        "xoriginal",
        $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
          .find("img")
          .attr("xpreview")
      );
      $(
        ".single-product-gallery .product-gallery-zoom .product-image img"
      ).attr(
        "srcset",
        $(".product-thumbs-gallery .flex-control-thumbs li.flex-active")
          .find("img")
          .attr("xpreview")
      );
      $arrowPrev.removeClass("disable");
      if ($countNext <= 3) {
        $(this).addClass("disable");
        return;
      }
      $countPrev++;
      $countNext--;
      $carouselUl.animate({ left: $carouselLTWidth }, 100);
      if (
        $(
          ".product-thumbs-gallery .flex-control-thumbs li.flex-video"
        ).hasClass("flex-active")
      ) {
        $(
          ".single-product-gallery .product-gallery-zoom .product-video"
        ).show();
        $(
          ".single-product-gallery .product-gallery-zoom .product-image"
        ).hide();
      } else {
        $(
          ".single-product-gallery .product-gallery-zoom .product-video"
        ).hide();
        $(
          ".single-product-gallery .product-gallery-zoom .product-image"
        ).show();
      }
    });
  }

})(window.jQuery);



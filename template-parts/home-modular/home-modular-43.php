<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';?>
<link rel="stylesheet" href="<?php echo DAHUZI_THEME_URL ?>/static-module/css/swiper-bundle.min.css">
<section class="recent-post-section-swiper" style="background-color: #EEF0F2;">
  <div class="container">
    <?php if( $modular_title || $modular_describe ){?>
    <div class="section-title" style="margin-bottom: 70px!important;">
      <?php if( $modular_title ){ echo '<h2 style="content: none;">'.$modular_title .'</h2>'; }?>
      <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.';text-transform: none;">'.$modular_describe .'</p>'; }?>
    </div>
    <?php }?>
    <div class="recent-post-section">
    <div class="container">
    <div class='swiper-container' style='height: 360px;'>
  <div class='swiper-wrapper'>
    <?php
    if (!empty($id['add_modular_43'])) {
      foreach ($id['add_modular_43'] as $value) :
        $modular_link = isset($value['modular_43_link']) ? $value['modular_43_link'] : '';
        $module_image_title = $value['modular_43_img']['title'];
        $module_image_alt = $value['modular_43_img']['alt'];
        if (empty($module_image_alt)) {
          $module_image_alt = $module_image_title;
        }
    ?>
        <div class="swiper-slide">
          <a href="<?php echo $modular_link; ?>" target="_blank">
            <img src="<?php echo $value['modular_43_img']['url']; ?>" alt="<?php echo $module_image_alt; ?>">
          </a>
          <div class="title">
            <p>
          <?php if($value['modular_43_title']){?>  
          <a href="<?php echo $modular_link; ?>" target="_blank"><?php echo $value['modular_43_title']; ?></a>
          <?php } else { ?>
          <span><?php echo $value['modular_43_title']; ?></span>
          </p></div>
          <?php } ?>

        </div>
    <?php
      endforeach;
    }
    ?>
  </div>
  <div class="swiper-pagination" style="margin-bottom: -15px;"></div>
  <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
</div>
</div>
</section>
<script src="<?php echo DAHUZI_THEME_URL ?>/static-module/js/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 5,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        "@0.00": {
          slidesPerView: 1,
          spaceBetween: 5,
        },
        "@0.75": {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        "@1.00": {
          slidesPerView: 3,
          spaceBetween: 15,
        },
        "@1.50": {
          slidesPerView: 4,
          spaceBetween: 20,
        },
      },
      loop: true,
      speed:600,
            autoplay : {delay:4000},
      loopFillGroupWithBlank: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
<style>
  .swiper-container {
	position: relative;
	overflow: hidden;
	list-style: none;
	padding: 0;
	z-index: 1;
	height: 420px;
	margin-top: -25px;
}

.swiper-slide {
	display: -webkit-box;
	display: -ms-flexbox;
	display: -webkit-flex;
	display: flex;
	-webkit-box-pack: center;
	-ms-flex-pack: center;
	-webkit-justify-content: center;
	justify-content: center;
	-webkit-box-align: center;
	-ms-flex-align: center;
	-webkit-align-items: center;
	align-items: center;
	transition: 300ms;
	transform: scale(0.8);
}


.swiper-slide img {
	display: block;
	border-radius: 10px;
	width: 100%;
}
.swiper-slide {
  position: relative; 
}

.title {
  position: absolute;
  bottom: -20px; 
  left: 0;
  width: 100%;
  text-align: center;
  }
.swiper-slide .title p{
    font-size: 18px;
    font-weight: 600;
    text-decoration: underline;
}
.swiper-slide .title a:hover {
  color: inherit;
}
:root {
  --swiper-navigation-color: <?php $bgcolor = isset($id['modular_43_color']) ? $id['modular_43_color'] : '#007aff';echo $bgcolor;?>;
  --swiper-pagination-color: <?php $bgcolor = isset($id['modular_43_color']) ? $id['modular_43_color'] : '#007aff';echo $bgcolor;?>;
}
  </style>
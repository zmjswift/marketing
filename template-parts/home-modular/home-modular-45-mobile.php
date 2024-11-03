<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';?>
<link rel="stylesheet" href="<?php echo DAHUZI_THEME_URL ?>/static-module/css/swiper-bundle.min.css">
<section class="recent-post-section-swiper">
  <div class="container">
    <?php if( $modular_title || $modular_describe ){?>
      <div class="elementor-divider">
                <span class="elementor-divider-separator" style="background-color: <?php echo $id['modular_45_licolor'] ?>;"></span>
            </div>
    <div class="section-title" style="margin-bottom: 0px!important;">
      <?php if( $modular_title ){ echo '<h2 style="content: none;">'.$modular_title .'</h2>'; }?>
      <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.';text-transform: none;">'.$modular_describe .'</p>'; }?>
    </div>
    <?php }?>
    <div class="recent-post-section">
    <div class="container">
    <div class='swiper-container' style='height: 260px;'>
  <div class='swiper-wrapper'>
    <?php
    if (!empty($id['add_modular_45'])) {
      foreach ($id['add_modular_45'] as $value) :
    ?>
        <div class="swiper-slide">
          <a href="<?php echo $value['modular_45_link']; ?>" target="_blank">
            <img src="<?php echo $value['modular_45_img']['url']; ?>">
          </a>
          <div class="titles" style="bottom: -10px;"><p><a href="<?php echo $value['modular_45_link']; ?>" target="_blank"><?php echo $value['modular_45_title']; ?></a></p></div>
        </div>
    <?php
      endforeach;
    }
    ?>
  </div>
  <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
</div>
</div>

<?php
            if (!empty($id['module_45_button'])) {
                foreach ($id['module_45_button'] as $value):
                    ?>
                    <a class="button-45" href="<?php echo $value['link_45']; ?>" style="display: flex;align-items: center;">
                        <span style="display: flex;align-items: center;margin-left: auto;margin-right: auto;font-weight: 700;">
                            <p style="color: <?php echo $value['color_45']; ?>;font-size: 1rem;"><?php echo $value['title_45']; ?></p>
                            <i class="fa fa-arrow-right" style="color: <?php echo $value['color_45']; ?>;"></i>
                        </span>
                    </a>
                <?php
                endforeach;
            }
            ?>
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

.titles {
  position: absolute;
  bottom: -20px; 
  left: 0;
  width: 100%;
  text-align: center;
  font-size: 18px;
  }
.swiper-slide .titles a:hover {
  color: inherit;
}
:root {
  --swiper-navigation-color: <?php $bgcolor = isset($id['modular_45_licolor']) ? $id['modular_45_licolor'] : '#007aff';echo $bgcolor;?>;
  --swiper-pagination-color: <?php $bgcolor = isset($id['modular_45_licolor']) ? $id['modular_45_licolor'] : '#007aff';echo $bgcolor;?>;
}
.elementor-divider {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
    }

    .elementor-divider-separator {
        width: 100px;
        height: 3px;
        background-color: #F21089;
    }
  </style>
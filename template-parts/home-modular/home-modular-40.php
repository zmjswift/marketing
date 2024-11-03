<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
$modular_img = $id['img_40']['url'] ?: '';
?>
<section class="features" id="feature">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title wow" style="visibility: visible; animation-name: fadeInUp;">
          <p style="color: <?php echo $mmodular_describe_color; ?>;margin-bottom: 1rem;"><?php echo $modular_describe ?></p>
          <h2><?php echo $modular_title ?><span class="custom-after" style="background: <?php echo $id['modular_40_licolor'] ?>!important;"></span></h2>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Feature image start -->
      <?php if( $id['modular_40_img_position'] == 'left' ){ ?>
      <div class="col-lg-5">
        <div class="feature-image wow" style="visibility: visible; animation-name: fadeInLeft;">
          <img src="<?php echo $modular_img ?>" alt="">
        </div>
      </div>
      <?php }?>
      <!-- Feature image end -->

      <!-- Feature Content start -->
      <div class="col-lg-7">
        <div class="features-content">
          <?php if (!empty($id['add_modular_40'])) {
            foreach ($id['add_modular_40'] as $value) {
              $title = $value['modular_40_title'];
              $desc = $value['modular_40_desc'];
              $icons = $value['modular_40_icons'];
              $icon_size = $value['modular_40_icon_size'];
              $icon_color = $value['modular_40_icon_color'];
              $icon_bgcolor = $value['modular_40_icon_bgcolor'];
          ?>
              <div class="features-single wow" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: ;">
                <div class="icon-box" style="border: 1px solid <?php echo $icon_bgcolor; ?>;">
                  <?php if (!empty($icons)) { ?>
                    <i class="<?php echo $icons; ?>" style="font-size: <?php echo $icon_size; ?>rem; color: <?php echo $icon_color; ?>;background: <?php echo $icon_bgcolor; ?>;"></i>
                  <?php } else { ?>
                    <img src="<?php echo $value['modular_40_img']['url']; ?>" alt="<?php echo get_post_meta($value['modular_40_img']['id'], '_wp_attachment_image_alt', true); ?>" loading="lazy">
                  <?php } ?>
                </div>

                <h3><?php echo $title; ?></h3>
                <p><?php echo $desc; ?></p>
              </div>
          <?php
            }
          } ?>

          <?php if (!empty($id['module_40_button'])) {
            foreach ($id['module_40_button'] as $value) {
              $title = $value['title_40'];
              $link = $value['link_40'];
              $icons = $value['icons_40'];
              $icon_size = $value['icon_size_40'];
              $icon_color = $value['icon_color_40'];
              $background = $value['background_40'];
              $color = $value['color_40'];
          ?>
          <?php
            }
          } ?>
        </div>
        <div class="juzhong_m">
              <a href="<?php echo $link; ?>" class="btn-buynow arrow-left" style="background: <?php echo $background; ?>; color:<?php echo $color; ?>;border: 2px solid <?php echo $background; ?>;">
                <?php if (!empty($icons)) { ?>
                  <i class="<?php echo $icons; ?>" style="font-size: <?php echo $icon_size; ?>rem; color: <?php echo $icon_color; ?>;"></i>
                <?php } else { ?>
                  <img src="<?php echo $value['icon_img_40']['url']; ?>" alt="<?php echo get_post_meta($value['icon_img_40']['id'], '_wp_attachment_image_alt', true); ?>" loading="lazy" style="width: <?php echo $icon_size; ?>rem;">
                <?php } ?>
                <?php echo $title; ?>
              </a>
              </div>
      </div>
      <?php if( $id['modular_40_img_position'] == 'right' ){ ?>
      <div class="col-lg-5">
        <div class="feature-image wow" style="visibility: visible; animation-name: fadeInLeft;">
          <img src="<?php echo $modular_img ?>" alt="">
        </div>
      </div>
      <?php }?>
      <!-- Feature Content end -->
    </div>
  </div>
</section>

<style>
  .section-title {
    text-align: center;
    margin-bottom: 80px;
  }

  .section-title p {
    text-transform: uppercase;
    color: #b7c2ca;
    letter-spacing: 0.04em;
  }

  .section-title h2 {
    color: #333c4e;
    font-weight: 600;
    font-size: 36px;
    padding-bottom: 14px;
    position: relative;
  }

  .custom-after {
      content: '';
      display: block;
      width: 40px;
      height: 3px;
      position: absolute;
      bottom: 0;
      left: 50%;
      margin-left: -20px;
      background: #fe60a1;
      background: linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
      background: -webkit-linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
      background: -moz-linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
      background: -o-linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
    }


  .features-single {
    position: relative;
    padding-left: 80px;
    padding-bottom: 30px;
  }

  .features-single:before {
    content: '';
    display: block;
    width: 0;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 30px;
    border-left: 1px dashed <?php echo $id['modular_40_licolor']; ?>;
  }
  .features-single:last-child:before {
    content: none;
}
  .features-single .icon-box {
    width: 60px;
    height: 60px;
    position: absolute;
    top: 0;
    left: 0;
    background: #fff;
    border-radius: 50%;
    color: #fff;
    text-align: center;
    padding: 4px;
    border: 1px solid #fe7088;
  }

  .features-single .icon-box i {
    place-items: center;
    display: grid;
    width: 50px;
    height: 50px;
    font-size: 30px;
    padding-top: 4px;
    border-radius: 50%;
    background: #fe60a1;
    background: linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
    background: -webkit-linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
    background: -moz-linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
    background: -o-linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
  }

  .features-single h3 {
    color: #333c4e;
    font-size: 20px;
    font-weight: 600;
    text-transform: uppercase;
    padding: 14px 0;
  }

  .features-single p {
    font-size: 16px;
    color: #7e8890;
    line-height: 1.5em;
    margin: 0;
  }

  .features-single .btn-buynow {
    margin-top: 20px;
  }

  .btn-buynow {
    display: inline-block;
    background: #fe7088;
    border: 2px solid #fe7088;
    border-radius: 5px;
    color: #fff;
    padding: 10px 30px;
    margin-bottom: 10px;
    letter-spacing: 0.04em;
    font-weight: 600;
    transition: all 0.3s;
    margin-left: 5rem;
  }

  .arrow-left i {
    padding-right: 10px;
  }

  .arrow-right i {
    padding-left: 10px;
  }

  .btn-buynow:hover {
    background: #fff;
    color: #fe7088;
  }

  .buy-button .btn-buynow {
    background: none;
    border-color: #fff;
    color: #fff;
  }

  .buy-button .btn-buynow:hover {
    background: #fff;
    color: #fe7088;
  }

  .slider-image {
    text-align: center;
  }
  @media (max-width: 767px) {
      .juzhong_m {
        float: none;
        margin: 0 auto;
        display: flex;
		justify-content: center;
    margin-left: -5rem !important;
      }
	}
</style>
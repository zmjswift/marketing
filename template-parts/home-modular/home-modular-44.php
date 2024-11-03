<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
$modular_desc = $id['modular_44_desc'] ?: '';
$modular_img = $id['modular_44_img']['url'] ?: '';
$modular_desc_color = $id['modular_44_desc_color'] ?: '';
?>

<section class="features" id="feature">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title wow" style="visibility: visible; animation-name: fadeInUp; margin-bottom: 0px!important;">
          <p style="margin-bottom: 1rem; color: <?php echo $modular_desc_color ?>;"><?php echo $modular_desc ?></p>
          <h2><?php echo $modular_title ?></h2>
          <p style="color: <?php echo $mmodular_describe_color; ?>;margin-bottom: 1rem; text-transform: none!important;"><?php echo $modular_describe ?></p>
        </div>
      </div>
    </div>

    <div class="row" style="background-color: <?php $bgcolor = isset($id['modular_44_bgcolor']) ? $id['modular_44_bgcolor'] : '#FFFAF4C9';echo $bgcolor;?>;">
      <div class="col-lg-6">
        <div class="feature-image wow" style="visibility: visible; animation-name: fadeInLeft;">
          <img src="<?php echo $modular_img ?>" alt="">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="elementor-column">
          <div class="elementor-widget-wrap elementor-element-populated">
            <?php if (!empty($id['add_modular_44'])) {
              foreach ($id['add_modular_44'] as $value) {
                $title = $value['modular_44_title'];
                $desc = $value['modular_44_descs'];
                $icons = $value['modular_44_icons'];
                $icon_size = $value['modular_44_icon_size'];
                $icon_color = $value['modular_44_icon_color'];
            ?>
                <div class="elementor-element">
                  <div class="elementor-widget-container">
                    <div class="elementor-icon-box-wrapper">
                      <div class="elementor-icon-box-icon">
                        <span class="elementor-icon elementor-animation-">
                          <i class="<?php echo $icons; ?>" style="font-size:<?php echo $icon_size; ?>rem; color:<?php echo $icon_color; ?>; margin-left: 10px;"></i>
                        </span>
                      </div>
                      <div class="elementor-icon-box-content">
                        <div class="elementor-icon-box-title">
                          <span><?php echo $title; ?></span>
                        </div>
                        <p class="elementor-icon-box-description"><?php echo $desc; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              }
            } ?>
            <?php
            if (!empty($id['module_44_button'])) {
              foreach ($id['module_44_button'] as $value) {
            ?>
                <div class="elementor-element">
                  <div class="elementor-widget-container" style="background-color: unset;">
                    <div class="elementor-button-wrapper" style="padding-left: 4rem;">
                    <li class="item-btn-44">
                      <a class="elementor-button elementor-button-link elementor-size-sm" href="<?php echo $value['link_44']; ?>">
                        <span class="elementor-button-text" style="color: #fff; font-size: 16px;"><?php echo $value['title_44']; ?></span>
                        <i class="fa fa-arrow-right" style="color:  #fff;"></i>
                      </a></li>
                    </div>
                  </div>
                </div>
            <?php
              }
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .section-title {
    text-align: center;
  }

  .section-title p {
    color: #b7c2ca;
    font-size: 14px;
  }

  .section-title h2 {
    color: #333c4e;
    font-weight: 600;
    font-size: 36px;
    padding-bottom: 14px;
    position: relative;
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
    border-left: 1px dashed #fe7088;
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
    border-radius: 26px;
    color: #fff;
    padding: 10px 30px;
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

  .elementor-element-populated {
    transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
    margin: 0 0 0 0;
    --e-column-margin-right: 0px;
    --e-column-margin-left: 0px;
    padding: 40px 45px 25px 40px;
  }

  .elementor-widget-container {
    margin: 0 0 20px 0;
    padding: 15px 15px 15px 15px;
    background-color: #FFF;
    border-radius: 8px 8px 8px 8px;
  }

  .elementor-icon-box-wrapper {
    display: flex;
  }

  .elementor-icon-box-icon {
    margin-right: var(--icon-box-icon-margin, 15px);
    margin-left: 0;
    margin-bottom: unset;
  }

  .elementor-icon-box-title a {
    font-family: "Open Sans", Sans-serif;
    font-size: 18px;
    font-weight: 600;
    text-transform: none;
    font-style: normal;
    text-decoration: none;
    line-height: 26px;
  }

  .elementor-icon-box-description {
    color: var(--e-global-color-7039399);
    font-family: "Open Sans", Sans-serif;
    font-size: 16px;
    font-weight: 300;
    line-height: 22px;
    margin-top: 0.5rem;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .elementor-icon-box-title span {
    font-family: "Open Sans", Sans-serif;
    font-size: 18px;
    font-weight: 600;
    text-transform: none;
    font-style: normal;
    text-decoration: none;
    line-height: 26px;
  }
  .item-btn-44 {
    align-items: center;
    display: flex;
}
 .item-btn-44 a{
    background-color: <?php echo $value['color_44']; ?>;
    color: <?php echo $value['color_44']; ?> !important;
    height: 40px;
    line-height: 40px;
    padding: 0 15px !important;
    border-radius: 5px;
    font-size: 15px;
    border: 1px solid <?php echo $value['color_44']; ?>;
}
</style>

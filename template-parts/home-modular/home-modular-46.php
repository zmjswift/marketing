<?php
$modular_title = $id['modular_title'] ?: '';
?>

<section class="features" id="feature" style="padding-bottom: 0px !important;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title wow" style="visibility: visible; animation-name: fadeInUp; margin-bottom: 0px!important;">
          <p style="margin-bottom: 1rem; color: <?php echo $modular_desc_color; ?>;"><?php echo $modular_desc; ?></p>
          <h2><?php echo $modular_title; ?></h2>
        </div>
      </div>
    </div>

    <div class="row d-flex align-items-stretch" style="background-color: <?php $bgcolor = isset($id['modular_44_bgcolor']) ? $id['modular_44_bgcolor'] : '#FFFAF4C9'; echo $bgcolor; ?>; margin-top: 50px;">
      <?php
      if (!empty($id['add_modular_46_1'])) {
        foreach ($id['add_modular_46_1'] as $value):
      ?>
          <div class="col-lg-6" style="padding-left: unset; padding-right: unset; background-color: <?php echo $value['modular_46_1_bg_color']; ?>;">
            <div class="span6 widget-span widget-type-cell" style="margin: 0px 10px 0px 0px;">
              <div class="row-fluid-wrapper row-depth-1 row-number-9 dnd-row" style="padding: 40px 40px 40px 60px;">
                <div class="row-fluid">
                  <div class="span12 widget-span widget-type-custom_widget dnd-module">
                    <div class="hs_cos_wrapper">
                      <i class="<?php echo $value['modular_46_1_icons']; ?>" style="color: <?php echo $value['modular_46_1_icon_color']; ?>; font-size: <?php echo $value['modular_46_1_icon_size']; ?>rem; text-align: center; display: block;"></i>
                      <h3 style="text-align: center; margin: 20px 0px;"><span style="color: #ffffff;"><?php echo $value['modular_46_1_title']; ?></span></h3>
                      <ol class="bullets--numbered-1" style="font-size: 16px;color: #ffffff; display: grid; grid-template-columns: repeat(auto-fill, minmax(194px, 1fr)); grid-template-rows: auto; grid-gap: 40px; width: 100%;">
                        <?php
                        if (!empty($value['add_modular_46_1s'])) {
                          foreach ($value['add_modular_46_1s'] as $values):
                        ?>
                            <li style="line-height: 1.75;color:<?php echo $values['modular_46_1_text_color']; ?>;"><?php echo $values['modular_46_1_desc']; ?></li>
                        <?php
                          endforeach;
                        }
                        ?>
                      </ol>
                    </div>
                  </div><!--end widget-span -->
                </div><!--end row-->
              </div><!--end row-wrapper -->
            </div>
          </div>
      <?php
        endforeach;
      }
      ?>
      <?php
      if (!empty($id['add_modular_46_2'])) {
        foreach ($id['add_modular_46_2'] as $value):
      ?>
          <div class="col-lg-6" style="padding-left: unset; padding-right: unset; background-color: <?php echo $value['modular_46_2_bg_color']; ?>;">
            <div class="span6 widget-span widget-type-cell" style="margin: 0px 10px 0px 0px;">
              <div class="row-fluid-wrapper row-depth-1 row-number-9 dnd-row" style="padding: 40px 40px 40px 60px;">
                <div class="row-fluid">
                  <div class="span12 widget-span widget-type-custom_widget dnd-module">
                    <div class="hs_cos_wrapper">
                      <i class="<?php echo $value['modular_46_2_icons']; ?>" style="color: <?php echo $value['modular_46_2_icon_color']; ?>; font-size: <?php echo $value['modular_46_2_icon_size']; ?>rem; text-align: center; display: block;"></i>
                      <h3 style="text-align: center; margin: 20px 0px;"><span style="color: #ffffff;"><?php echo $value['modular_46_2_title']; ?></span></h3>
                      <ol class="bullets--numbered-2" style="font-size: 16px;color: #ffffff; display: grid; grid-template-columns: repeat(auto-fill, minmax(194px, 1fr)); grid-template-rows: auto; grid-gap: 40px; width: 100%;">
                        <?php
                        if (!empty($value['add_modular_46_2s'])) {
                          foreach ($value['add_modular_46_2s'] as $values):
                        ?>
                            <li style="line-height: 1.75;color:<?php echo $values['modular_46_2_text_color']; ?>;"><?php echo $values['modular_46_2_desc']; ?></li>
                        <?php
                          endforeach;
                        }
                        ?>
                      </ol>
                    </div>
                  </div><!--end widget-span -->
                </div><!--end row-->
              </div><!--end row-wrapper -->
            </div>
          </div>
      <?php
        endforeach;
      }
      ?>
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
    text-transform: uppercase;
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

  ol.bullets--numbered-1 {
    list-style-type: none;
    padding-left: 0;
    counter-reset: item;
  }

  ol.bullets--numbered-1 li {
    position: relative;
    padding-left: 24px;
    margin-bottom: 10px;
  }

  ol.bullets--numbered-2 {
    list-style-type: none;
    padding-left: 0;
    counter-reset: item;
  }

  ol.bullets--numbered-2 li {
    position: relative;
    padding-left: 24px;
    margin-bottom: 10px;
  }

  ol.bullets--numbered-1 li::before {
    content: counter(item);
    counter-increment: item;
    position: absolute;
    top: 0;
    left: -20px;
    width: 32px;
    height: 33px;
    border: 1.5px solid <?php
                        if (!empty($id['add_modular_46_1'])) {
                          foreach ($id['add_modular_46_1'] as $value):
                        ?>
                            <?php echo $value['modular_46_1_num_color']; ?>
                        <?php
                          endforeach;
                        }
                        ?>;
    border-radius: 50%;
    margin-right: 6px;
    text-align: center;
    line-height: 32px;
    background-color: transparent;
  }

  ol.bullets--numbered-2 li::before {
    content: counter(item);
    counter-increment: item;
    position: absolute;
    top: 0;
    left: -20px;
    width: 32px;
    height: 33px;
    border: 1.5px solid <?php
                        if (!empty($id['add_modular_46_2'])) {
                          foreach ($id['add_modular_46_2'] as $value):
                        ?>
                            <?php echo $value['modular_46_2_num_color']; ?>
                        <?php
                          endforeach;
                        }
                        ?>;
    border-radius: 50%;
    margin-right: 6px;
    text-align: center;
    line-height: 32px;
    background-color: transparent;
  }
</style>
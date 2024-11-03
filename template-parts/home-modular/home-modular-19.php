<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
?>
<section class="home-modular-19 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
        <div class="container">
          <?php if( $modular_title || $modular_describe ){?>
          <div class="section-title">
            <?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
            <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
          </div>
          <?php }?>
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="owl-testimonial owl-carousel owl-theme text-center ">
                      <?php
                      if( ! empty($id['modular_19']) ){
                      foreach ( $id['modular_19'] as $value ): ?>
                        <div class="item">
                            <div class="slider-info banner-view" style="background:url(<?php echo $value['modular_19_img']['url'];?>) no-repeat center;">
                                <div class="slider-img-info">
                                    <h3><?php echo $value['modular_19_title'];?></h3>
                                    <div class="message"><?php echo $value['modular_19_desc'];?></div>
                                    <?php if( $value['modular_19_btn'] || $value['modular_19_btn_url'] ){?>
                                    <a href="<?php echo $value['modular_19_btn_url'];?>" class="btn btn-style btn-primary mt-4" target="_blank" rel="nofollow"><?php echo $value['modular_19_btn'];?></a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                      <?php
                      endforeach;
                      }?>
                    </div>
                </div>
            </div>
        </div>
</section>
<script>
  $(document).ready(function () {
    $('.owl-testimonial').owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      responsiveClass: true,
      autoplay: false,
      autoplayTimeout: 5000,
      autoplaySpeed: 1000,
      autoplayHoverPause: false,
      navText: [
        '<span aria-label="' + 'Previous' + '"> <span class="fa fa-angle-left"></span> </span>',
        '<span aria-label="' + 'Next' + '"> <span class="fa fa-angle-right"></span> </span>'
      ],
      navElement: 'button type="button" role="presentation"',
      navContainer: false,
      responsive: {
        0: {
          items: 1,
          nav: false
        },
        480: {
          items: 1,
          nav: false
        },
        667: {
          items: 1,
          nav: true
        },
        1000: {
          items: 1,
          nav: true
        }
      }
    })
  })
</script>
<?php
$banner = dqtheme('banner');
if( is_array($banner) ){ ?>
<section class="slider-wrapper p-0">
<div id="slider-style-one" class="carousel slide bs-slider control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000">
  <div class="carousel-inner">
    <?php
    $i = 1;
    foreach ( $banner as $value ):?>
    <div class="carousel-item<?php if($i == 1){?> active<?php }?>">
      <?php if ( wp_is_mobile() && $value['banner_img_mobile']['url'] ){ ?>
            <img loading="lazy" src="<?php echo $value['banner_img_mobile']['url'];?>" alt="<?php echo get_post_meta( $value['banner_img']['id'], '_wp_attachment_image_alt', true );?>" class="slide-image">
      <?php }else { ?>
            <img loading="lazy" src="<?php echo $value['banner_img']['url'];?>" alt="<?php echo get_post_meta( $value['banner_img']['id'], '_wp_attachment_image_alt', true );?>" class="slide-image">
      <?php } ?>
      <div class="bs-slider-overlay">
      </div>
      <div class="container">
        <div class="row">
          <div class="slide-text slide-style-<?php echo $value['banner_title_position'] ?: 'left';?>">
            <?php if( $value['banner_subtitle'] ){?>
            <div class="sub-title">
              <h4><?php echo $value['banner_subtitle'];?></h4>
            </div>
            <?php } ?>
            <?php if( $value['banner_title'] ){?>
            <div class="title-box">
              <h2><?php echo $value['banner_title'];?></h2>
            </div>
            <?php } ?>
            <?php if( $value['btn_txt'] ){?>
            <div class="btn-box">
              <a href="<?php echo $value['banner_url'];?>" <?php if( $value['banner_blank'] ){?>target="_blank"<?php } ?> rel="nofollow" class="btn-theme"><?php echo $value['btn_txt'];?></a>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <?php $i++; endforeach;?>
  </div>
  <a class="left carousel-control" href="#slider-style-one" role="button" data-slide="prev">
    <span class="fa fa-angle-left" aria-hidden="true"></span>
    <span class="sr-only">上一张</span>
  </a>
  <a class="right carousel-control" href="#slider-style-one" role="button" data-slide="next">
    <span class="fa fa-angle-right" aria-hidden="true"></span>
    <span class="sr-only">下一张</span>
  </a>
</div>
</section>
<?php }?>

<?php
$block = dqtheme('banner_block');

if( is_array($block) ){

if( count($block) == '1' ){
  $total_block = '12';
}elseif( count($block) == '2' ){
  $total_block = '6';
}elseif( count($block) == '3' ){
  $total_block = '4';
}elseif( count($block) == '4' ){
  $total_block = '3';
}elseif( count($block) == '5' ){
  $total_block = '2';
}?>
<section class="plumber-feature-sec pt-0">
  <div class="container">
    <div class="row plumber-welcome-feature theme-box-shadow-outer">
      <?php foreach ( $block as $value ):?>
      <div class="col-lg-<?php echo $total_block;?>">
        <div class="feature-item">
          <?php if( $value['block_img']['url'] ){?>
          <div class="icon-box" style="width:<?php echo $value['block_img_px'];?>%;">
            <img loading="lazy" src="<?php echo $value['block_img']['url'];?>" alt="<?php echo get_post_meta( $value['block_img']['id'], '_wp_attachment_image_alt', true );?>">
          </div>
          <?php }?>
          <div class="content" style="width:<?php echo ('100' - $value['block_img_px']);?>%;">
            <h3><?php echo $value['block_title'];?></h3>
            <p><?php echo $value['block_subtitle'];?></p>
          </div>
          <?php if( $value['block_url'] ){?>
          <a style="opacity:0" class="u-permalink" href="<?php echo $value['block_url'];?>" <?php if( $value['block_blank'] ){?>target="_blank" rel="nofollow"<?php } ?>><?php echo $value['block_title'];?></a>
          <?php }?>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</section>
<?php }?>
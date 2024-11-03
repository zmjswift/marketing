<?php $footer_8 = dq('footer_8');
$foots_title = dq('footer_8_modular_title');
$foots_describe = dq('footer_8_modular_describe');
$footer_cf7_shortcode = dq('footer_cf7_shortcode');
?>
<section class="home-modular-8 contact-section pb-70 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
<div class="container">
    <div class="row contact-bg">
    <?php if ( wp_is_mobile() ) : ?>
        <div class="col-md-12 p-0">
        <?php else : ?>
        <div class="col-md-12 col-lg-4 p-0">
        <?php endif; ?>
            <div class="contact-text">
                <h2><?php echo $foots_title; ?></h2>
                <p style="color: <?php echo $mmodular_describe_color; ?>"><?php echo $foots_describe; ?></p>
                <?php
                if( ! empty($footer_8) ){
                foreach ( $footer_8 as $value ): ?>
                <div class="contact-info">
                    <div class="icon-box">
                        <?php
						$features_icon = $value['footer_8_icons'];
						$icon_size = $value['footer_8_icon_size'];
						$icon_color = $value['footer_8_icon_color'];
						$modular_8_icon = $value['footer_8_icon']['url'];
						?>
						<?php if(!empty($features_icon)):?>
						<i class="<?php echo $features_icon;?>" style="font-size: <?php echo $icon_size;?>rem;color: <?php echo $icon_color;?>;"></i>
						<?php endif;?>
                        <?php if(!empty($modular_8_icon)):?>
                        <img loading="lazy" src="<?php echo $modular_8_icon;?>" alt="<?php echo get_post_meta( $value['modular_8_icon']['id'], '_wp_attachment_image_alt', true );?>">
                        <?php endif;?>
                    </div>
                    <h6><?php echo $value['footer_8_title'];?></h6>
                </div>
                <?php
                endforeach;
                }?>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 style-2">

            <?php
            if( ! empty($footer_8) ){
              echo do_shortcode( $footer_cf7_shortcode);
            }?>

        </div>
    </div>
</div>
</section>

<section class="front-page-product-area our-features-area pt-50 pb-50">
        <div class="container">
            <div class="row">
                <?php
                $features = dq('footer_features');
                if( ! empty($features) ){
                foreach ( $features as $value ): ?>
                <div class="col-md-4 single-item">
                    <div class="item">
                        <div class="icon">
						<?php
						$features_icon = $value['features_icon'];
						$icon_size = $value['icon_size'];
						$icon_color = $value['icon_color'];
						$features_img = $value['features_img']['url'];
						?>
						<?php if(!empty($features_icon)):?>
						<i class="<?php echo $features_icon;?>" style="font-size: <?php echo $icon_size;?>rem;color: <?php echo $icon_color;?>;"></i>
						<?php endif;?>
						<?php if(!empty($features_img)):?>
						<img src="<?php echo $features_img;?>" alt="<?php echo $value['features_title'];?>"/>
						<?php endif;?>
                        </div>
                        <div class="info">
                            <p style="text-transform: capitalize; font-weight: 600; margin-bottom: 10px; font-size: 1.5rem;"><?php echo $value['features_title'];?></p>
                            <p><?php echo $value['features_desc'];?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <?php }?>
            </div>
        </div>
    </section>




        <?php if( is_active_sidebar('widget_footer') ){?>
        <footer class="bg-faded pt-70 pb-70 bg-theme-color-2">
          <div class="container">
            <div class="section-content">
              <div class="row">
                <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('widget_footer') ) : endif;?>
              </div>
            </div>
          </div>
        </footer>
        <?php }?>
        <section class="footer-copy-right bg-theme-color-2 text-white p-0">
          <div class="container">
            <div class="row">
              <?php
              if ( is_home() && dqtheme('foot_link') || is_front_page() && dqtheme('foot_link') ) {
                $foot_link_cat = dqtheme('foot_link_cat');
                if(!empty($foot_link_cat)){
                  $foot_link_cat = implode(',', $foot_link_cat);
                }?>
              <ul class="footer-menu col-12 text-center<?php if( dqtheme('foot_link_mobile') ){ echo ' foot_link_mobile'; }?>">
                <li>More：</li><?php wp_list_bookmarks('title_li=&categorize=0&category='.$foot_link_cat.''); ?>
              </ul>
              <?php }?>
              <div class="col-12 text-center">
                <p>
                <?php
                  $footer_icp = dqtheme('footer_icp');
                  $footer_gaba = dqtheme('footer_gaba');
                  $footer_copyright = dqtheme('footer_copyright');
                ?>
                <?php if( $footer_copyright ){?><?php echo $footer_copyright;?><?php }else{?>© <?php echo date('Y'); ?>.&nbsp;All Rights Reserved.<?php } ?><?php if( $footer_icp ) : ?>&nbsp;<a rel="nofollow" target="_blank" href="http://beian.miit.gov.cn/"><?php echo $footer_icp;?></a><?php endif; ?><?php if( $footer_gaba ) : ?>&nbsp;<a rel="nofollow" target="_blank" href="<?php echo dqtheme('footer_gaba_url');?>"><img loading="lazy" class="gaba" alt="公安备案" src="<?php bloginfo('template_directory'); ?>/static/images/gaba.png"><?php echo $footer_gaba;?></a><?php endif; ?><?php if( dqtheme('dqtheme_link') ) : ?>&nbsp;Theme By&nbsp;<a href="http://www.dqtheme.com" target="_blank">DQTheme</a><?php endif; ?>
                </p>
              </div>
            </div>
          </div>
        </section>

    </div>

    <div class="slide-bar">

    <?php
    $add_kefu = dqtheme('add_kefu');
    if ( is_array($add_kefu) ){
    foreach ( $add_kefu as $value ):?>

    <?php if( $value['kefu_type'] == 'link' ){?>
      <a href="<?php echo $value['kefu_url'];?>" target="_blank" rel="nofollow" class="slide-bar__item<?php if(!$value['kefu_title']){ echo ' slide-bar-title_none'; }?>">
        <img loading="lazy" class="slide-bar__item__icon" src="<?php echo $value['kefu_icon']['url'];?>" alt="<?php echo $value['kefu_title'];?>">
        <?php if($value['kefu_title']){?><span class="slide-bar__item__text"><?php echo $value['kefu_title'];?></span><?php }?>
        <?php if($value['kefu_desc']){?><div class="slide-bar__item__tips"><?php echo $value['kefu_desc'];?></div><?php }?>
      </a>
    <?php }elseif( $value['kefu_type'] == 'img' ){?>
        <div class="slide-bar__item<?php if(!$value['kefu_title']){ echo ' slide-bar-title_none'; }?>">
          <img loading="lazy" class="slide-bar__item__icon" src="<?php echo $value['kefu_icon']['url'];?>" alt="<?php echo $value['kefu_title'];?>">
          <span class="slide-bar__item__text"><?php echo $value['kefu_title'];?></span>
          <div class="slide-bar__item__img">
            <img loading="lazy" src="<?php echo $value['kefu_img']['url'];?>" alt="<?php echo $value['kefu_title'];?>">
          </div>
        </div>
    <?php
    }
    endforeach; }?>

      <div class="slide-bar__item scrollup">
        <i class="slide-bar__item__top fa fa-angle-up"></i>
      </div>

    </div>
<?php if( dqtheme('mobile_foot_menu_sw') ){ get_template_part( 'template-parts/mobile-foot-menu' );}?>
<style>
        .privacy-policy {
            position: fixed;
            bottom: -100%; 
            left: 0;
            width: 100%; 
            background-color: rgba(0, 0, 0, 0.8); 
            padding: 20px;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            z-index: 8;
            transition: bottom 0.5s; 
        }
        .privacy-policy-content {
            max-width: 1400px;
            margin: 0 auto; 
        }
        .privacy-policy h2, .privacy-policy p {
            text-align: left;
            color:#fff;
        }
        .privacy-policy button {
    font-size: 14px;
    line-height: 25px;
    padding: 10px 20px;
    border: 1px solid #fff;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    background-color: transparent;
	float: right;
	margin-right: 1rem;
}

.privacy-policy button:hover {
    background-color: rgba(255, 255, 255, 0.2);
}
        @media (max-width: 767px) {
            .privacy-policy {
                padding: 10px;
            }
            .privacy-policy h2 {
                font-size: 1.5em; 
            }
			.privacy-policy-content {
			margin-right: 1rem;
        }
    </style>
    <?php
$is_privacy = dq('is_privacy');
$privacy_title = dq('privacy_title');
$privacy_content = dq('privacy_content');
$privacy_button = dq('privacy_button');
?>
<?php if ($is_privacy): ?>
    <div class="privacy-policy" id="privacyPolicy">
        <div class="privacy-policy-content">
            <h2><?php echo $privacy_title;?></h2>
            <p><?php echo $privacy_content;?></p>
            <button id="agreeButton"><?php echo $privacy_button;?></button>
        </div>
    </div>
<?php endif; ?>

    <script>
        setTimeout(function() {
            document.getElementById('privacyPolicy').style.bottom = '0';
        }, 1800);
        if (localStorage.getItem('privacyAgreed') === 'true') {
            document.getElementById('privacyPolicy').style.display = 'none';
        }

        document.getElementById('agreeButton').addEventListener('click', function() {
            var today = new Date();
            var expirationDate = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 1);
            localStorage.setItem('privacyAgreed', 'true');
            localStorage.setItem('privacyExpiration', expirationDate);
            document.getElementById('privacyPolicy').style.display = 'none';
        });
    </script>
<?php wp_footer(); ?>
</body>
</html>



<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">

<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

<?php

wp_head();

?>

</head>



<style>

.details-content table {

    overflow-x: scroll;

}

.details-content th, .details-content td {

    border: 1px solid #ccc;

    padding: 10px !important;

}

</style>



<body <?php body_class(); ?>>



    <?php if( dqtheme('dq_loading') && dqtheme_img('loading_gif') ){?><div class="preloader" style="background-image: url(<?php echo dqtheme_img('loading_gif');?>);"></div><?php }?>



    <div class="page-wrapper">

        <?php



        //判断是否为产品文章

        $showproduct_head = get_post_meta( get_the_ID(), 'showproduct_head', true );



        if( dqtheme('header_type') == '2' || $showproduct_head && is_single() ){

            $header_type = '2';

        }else{

            $header_type = '1';

        }?>

        <header class="mobile-header header header-style-<?php echo $header_type;?> clearfix" <?php if( !dqtheme('notice_code_switch') ) :?>style="margin:0"<?php endif;?>>



            <?php if( dqtheme('social_sw') ) :?>

            <div class="top-bar">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-9">

                            <?php if( dqtheme('social_sw') ){?>

                            <div class="social-icons">

                                <ul>

                            		<?php if( dqtheme('social_facebook') ){?>

                            		<li>

                            	    <a href="<?php echo dqtheme('social_facebook'); ?>" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a>

                            		</li>

                            		<?php }?>

                            

                            		<?php if( dqtheme('social_twitter') ){?>

                            		<li>

                            	    <a href="<?php echo dqtheme('social_twitter'); ?>" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a>

                            		</li>

                            		<?php }?>

                            

                            		<?php if( dqtheme('social_pinterest') ){?>

                            		<li>

                            	    <a href="<?php echo dqtheme('social_pinterest'); ?>" target="_blank" rel="nofollow"><i class="fa fa-pinterest"></i></a>

                            		</li>

                            		<?php }?>

                            

                            		<?php if( dqtheme('social_youtube') ){?>

                            		<li>

                            	    <a href="<?php echo dqtheme('social_youtube'); ?>" target="_blank" rel="nofollow"><i class="fa fa-youtube"></i></a>

                            		</li>

                            		<?php }?>

                            

                            		<?php if( dqtheme('social_instagram') ){?>

                            		<li>

                            	    <a href="<?php echo dqtheme('social_instagram'); ?>" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i></a>

                            		</li>

                            		<?php }?>

                                </ul>

                            </div>

                            <?php }?>



							<?php echo do_shortcode('[gtranslate]'); ?>

		

                        </div>

                        <?php if( dqtheme('notice_phone') ){?>

                        <div class="col-lg-3">

                            <?php if( dqtheme('search_header') ){?>

                            <div class="header-right">

                                <div class="header-search-form-wrapper">

									<div class="cart-search-contact">

										<button class="search-toggle-btn"><i class="fa fa-search"></i></button>

										<div class="header-search-form">

											<form role="search" action="<?php echo esc_url(home_url('/')); ?>">

												<div>

													<input type="text" name="s" class="form-control" placeholder="<?php if( dqtheme('search_placeholder') ){ echo dqtheme('search_placeholder'); }else{ echo 'Search here...'; }?>">

													<button type="submit"><i class="fa fa-search"></i></button>

												</div>

											</form>

										</div>

									</div>

								</div>

							</div>

                            <?php }?>

                        </div>

                        <?php }?>

                    </div>

                </div>

            </div>

            <?php endif;?>



            <div class="menu-style <?php if( dqtheme('header_type') == '2' || $showproduct_head && is_single() ){ echo 'menu-hover-2';}?> bg-transparent clearfix">



                <div class="main-navigation main-mega-menu animated<?php if( dqtheme('header_sticky') ){ echo ' header-sticky';}?>">

                    <nav class="navbar navbar-expand-lg <?php if( dqtheme('header_type') == '2' ){ echo 'navbar-light';}else{ echo 'navbar-dark'; }?>">

                        <div class="container">



                            <a class="navbar-brand" href="<?php bloginfo('url'); ?>" target="_blank" aria-label="Home page of <?php bloginfo('name');?>">

                                <?php if( wp_is_mobile() && dqtheme_img('mb_logo') ){?>

                                    <img id="logo_img" src="<?php echo dqtheme_img('mb_logo');?>" alt="<?php echo dqtheme_image_alt('logo');?>">

                                <?php }else{?>

                                    <img id="logo_img" src="<?php echo dqtheme_img('logo');?>" alt="<?php echo dqtheme_image_alt('logo');?>">

                                <?php }?>

                            </a> 

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-1" aria-controls="navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>

                            </button>



                            <div class="collapse navbar-collapse<?php if( !dqtheme('search_header') ){ echo ' no-search'; }?>" id="navbar-collapse-1">



                                <ul class="pc-menu navbar-nav ml-xl-auto">

                                    <?php

                                    

                                    wp_nav_menu( array(

										'theme_location'=> 'main',

                                        'container'     => false,

                                        'items_wrap'    =>'%3$s',

                                        'walker'        => new wp_bootstrap_navwalker( true ),

                                        'fallback_cb'   => 'wp_bootstrap_navwalker::fallback'

                                    ) );

                                    

                                    ?>

                                    <?php if( dqtheme('menu_item_btn') ){

                                    echo '<li class="menu-item-btn"><a href="'.dqtheme('menu_item_btn_url').'" target="_blank" rel="nofollow">'.dqtheme('menu_item_btn_text').'</a></li>';

                                    }?>

                                    <form class="search-box" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">

                                    	<div class="form-group">

                                    		<input type="text" placeholder="<?php if( dqtheme('search_placeholder') ){ echo dqtheme('search_placeholder'); }else{ echo 'Search here...'; }?>" name="s" class="form-control" />

                                    		<button type="submit" class="fa fa-search form-control-feedback"></button>

                                    	</div>

                                    </form>

                                </ul>



                            </div>

                        </div>

                    </nav>

                </div>

            </div>



        </header>
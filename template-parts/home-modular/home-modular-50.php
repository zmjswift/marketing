<?php

$modular_50 = $id['modular_50'];

$module_50_img = $modular_50['module_50_img'];

?>

<section style="margin-bottom: -40px;">

  <div class="container">

    <div class="section-title">

	<h2><?php echo $modular_50['modular_50_title'];?></h2>

    <p style="color: #000000;max-width: 1000px;"><?php echo $modular_50['modular_50_desc'];?></p>

    </div>

</div>

</section>

<div class="container" style="background-color: #F5F5F5;">
<?php if( $module_50_img ){

					foreach ($module_50_img as $Img_50) {

						$img_50 = $Img_50['img']['url'];

						$title = $Img_50['title'];

						$desc = $Img_50['desc'];

						echo '<div class="row modular15_wrapper">';
						if ( wp_is_mobile() ){
							echo '<div class="img_log4 modular15_img_box" style="padding: 10px;">';
						}else{
						echo '<div class="col-lg-4 img_log4 modular15_img_box">';}

						echo '<img class="padding" loading="lazy" src="'.$img_50.'" alt="'.$title_50.'" />

						</div>';

						echo '<div class="col-lg-8 modular15_text_box" style="padding-right: 40px;">';

						echo '<h3>'.$title.'</h3>';

						echo wpautop($desc);

						echo '<div class="juzhong_m">';

						echo do_shortcode($Img_50['modular_50_btnduan']);

						if( $Img_50['module_50_button'] ){

							$module_50_button = $Img_50['module_50_button'];

							foreach ($module_50_button as $button) {

								$link_50 = $button['link_50'];

								$title_50 = $button['title_50'];

								$icons_50 = $button['modular_50_icons'];

								$size_50 = $button['modular_50_icon_size'];

								$icon_color_50 = $button['modular_50_icon_color'];

								$color_50 = $button['color_50'];

								$background_50 = $button['background_50'];

								echo '<a class="btn btn-outline-primary btn-outline-style" style="margin-left: 10px;height: 43px;padding: 10px 20px;color: '.$color_50.';background-color: '.$background_50.';" href="'.$link_50.'" target="_blank" rel="nofollow"><i class="'.$icons_50.'" style="margin-right: 10px;font-size: '.$size_50.'rem;color: '.$icon_color_50.';"></i>'.$title_50.'</a>';

							}

						}

						echo '</div>';

						echo '</div>';

						echo '</div>';

						echo '<div class="xian"></div>';

					}

				}?>

				<div class="section-title" style="padding: 60px 0px;">

	<h2><?php echo $modular_50['modular_50_title'];?></h2>

    <p style="color: #000000;max-width: 1000px;"><?php echo $modular_50['modular_50_desc'];?></p>

	<div class="juzhong_f">

		<?php echo do_shortcode($modular_50['modular_50_btnduan_footer']);?>

		<?php if( $modular_50['module_50_button_footer'] ){

							$module_50_button_footer = $modular_50['module_50_button_footer'];

							foreach ($module_50_button_footer as $button) {

								$link_50 = $button['link_50_footer'];

								$title_50 = $button['title_50_footer'];

								$icons_50 = $button['modular_50_icons_footer'];

								$size_50 = $button['modular_50_icon_size_footer'];

								$icon_color_50 = $button['modular_50_icon_color_footer'];

								$color_50 = $button['color_50_footer'];

								$background_50 = $button['background_50_footer'];

								echo '<div class="modular15_wrapper"><a class="btn btn-outline-primary btn-outline-style" style="margin-left: 10px;height: 43px;padding: 10px 20px;color: '.$color_50.';background-color: '.$background_50.';" href="'.$link_50.'" target="_blank" rel="nofollow"><i class="'.$icons_50.'" style="margin-right: 10px;font-size: '.$size_50.'rem;color: '.$icon_color_50.';"></i>'.$title_50.'</a></div>';

							}

						}

						?>

	</div>

    </div>

</div>

<style>

	.std-popup-trigger{border-radius: 5px!important;

    height: 43px!important;

    padding: 5px 15px!important;

	float: left;

	background-color: #fcab03!important;

}

.padding{padding: 40px;

}

	@media (max-width: 767px) {

      .juzhong_m {

        float: none;

        margin: 0 auto;

        display: flex;

		justify-content: center;

      }

	  .std-popup-trigger{

		float: none;

	  }

	  .img_log4{

    position: relative;

    width: 100%;

    min-height: 1px;

    padding-right: 15px;

    padding-left: 15px;

}

.padding{padding: 0px;

}

	}

	.xian {

  border-top: 1px solid #99999978;

}

.juzhong_f {

	margin-top: 40px;

        display: flex;

		justify-content: center;

      }

	</style>
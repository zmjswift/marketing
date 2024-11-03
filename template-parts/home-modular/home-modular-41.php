<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
$modular_bgcolor = $id['modular_41_bgcolor'] ?: '';
?>
<section class="our-process" style="background: <?php echo $modular_bgcolor ?>;">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-sm-12">
					<div class="process-header wow " style="visibility: visible; animation-name: ;">
						<h2><?php echo $modular_title ?></h2>
						<p style="color: <?php echo $mmodular_describe_color; ?>"><?php echo $modular_describe ?></p>
					</div>
				</div>
				
				<div class="col-lg-9 col-sm-12">
					<div class="row">
          <?php if (!empty($id['add_modular_41'])) {
			 $counter = 0;
            foreach ($id['add_modular_41'] as $value) {
              $title = $value['modular_41_title'];
              $icons = $value['modular_41_icons'];
              $icon_size = $value['modular_41_icon_size'];
              $icon_color = $value['modular_41_icon_color'];
          ?>
						<div class="col-md-2 col-sm-2 col-6" style="margin: 20px 0px;">
							<div class="process-single wow " data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: ;">
								<div class="icon-box">
								<?php if (!empty($icons)) { ?>
                  <i class="<?php echo $icons; ?>" style="font-size: <?php echo $icon_size; ?>rem; color: <?php echo $icon_color; ?>;"></i>
                <?php } else { ?>
                  <img src="<?php echo $value['icon_img_41']['url']; ?>" alt="<?php echo get_post_meta($value['icon_img_41']['id'], '_wp_attachment_image_alt', true); ?>" loading="lazy" style="width: <?php echo $icon_size; ?>rem;">
                <?php } ?>
								</div>
								<h3><?php echo ++$counter; ?>. <?php echo $title; ?></h3>
							</div>
						</div>
            <?php
            }
          } ?>

					</div>
				</div>
			</div>
		</div>
	</section>
  <style>
    .our-process{
	padding: 80px 0;
	background: #fe60a1;
    background: linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
    background: -webkit-linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
    background: -moz-linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
    background: -o-linear-gradient(45deg, #fe60a1 0%, #ff8765 100%);
}

.process-header h2{
	color: #fff;
	font-weight: 600;
	padding-top: 12px;
}

.process-header p{
	color: #fff;
	margin: 0;
}

.process-single{
	text-align: center;
}

.process-single .icon-box{
	width: 80px;
	height: 80px;
	margin: 0 auto;
	color: #fff;
	font-size: 40px;
	border-radius: 50%;
	border: 1px dashed rgba(255,255,255,0.5);
}

.process-single h3{
	font-weight: 600;
	color: #fff;
	font-size: 18px;
	margin: 10px 0 0;
	letter-spacing: 0.02em;
}
  </style>
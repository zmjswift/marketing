<?php
$module_title    = $id['module_title'] ?: exit('标题为空');
$module_desc     = $id['module_desc'] ?: '';
$module_img      = $id['module_32_img'] ?: '';
$module_button   = $id['module_button'] ?: '';
$module_32_desc   = $id['module_32_desc'] ?: '';
?>
<?php
            if (!empty($module_img)) {
                foreach ($module_img as $value) {
                    echo '
<div class="design-your-suit text-center">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="top-content">
					<h3 class="title">' . $module_title . '</h3>

					<div class="top-desc">
						' . $module_desc . '
						<b>' . $module_32_desc . '</b>
					</div>
				</div>

				<div class="middle-img">
					<img src="' . $value['img']['url'] . '" alt="device">
				</div>

				<div class="more_info">
					<p>' . $value['img_desc'] . '</p>';
					
					if (!empty($module_button)) {
                foreach ($module_button as $value) {
                    echo '<a class="wrd-button wrd-button-2" href="' . $value['link'] . '" style="background-color: ' . $value['background'] . ';"><span style="color: ' . $value['color'] . ';">' . $value['title'] . '</span></a>';}
            }
				echo '</div>
			</div>
		</div>
	</div>
</div>';
                }
            }
            ?>
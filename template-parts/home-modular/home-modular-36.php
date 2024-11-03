<?php
$module_title    = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
$img = $id['modular_36_img']['url'] ?: '';
$video = $id['modular_36_video']['url'] ?: '';

?>
<style>
    .product {
        display: flex;
        justify-content: center;
        align-items: center;
        /*border: 1px solid #ddd;*/
        margin: 10px auto;
        max-width: 1200px;
        padding: 10px;
    }

    .product img, .product video {
        flex: 0 0 300px; /* flex-grow, flex-shrink, flex-basis */
        height: 200px;
        width: 300px;
        margin: 10px;
    }

    .description {
        flex: 1; /* 占据剩余空间 */
        text-align: center;
        padding: 10px;
    }

    @media (max-width: 768px) {
        .product {
            flex-direction: column; /* 切换为垂直布局 */
        }

        .product img, .product video {
            margin-right: 0; /* 移除图片和视频的左右间隙 */
            margin-left: 0;
            margin-bottom: 10px; /* 为图片和视频底部添加间隙 */
        }

        .product video {
            margin-bottom: 10px; /* 确保视频下方也有间隙 */
        }

        /* 最后一个元素不需要底部间隙 */
        .product video:last-child {
            margin-bottom: 0;
        }
    }
</style>
<?php
      if( ! empty($id['add_modular_36']) ){
      foreach ( $id['add_modular_36'] as $value ): ?>
      <?php
      $title = $value['modular_36_title'];
      $desc = $value['modular_36_desc'];
      $img = $value['modular_36_img']['url'];
      $video = $value['modular_36_video'];
						?>
<div class="product">
	<img src="<?php echo $img; ?>" alt="">
    <video src="<?php echo $video; ?>" controls="controls"></video>
	<div class="description">
		<h3><?php echo $title; ?></h3>
		<p><?php echo $desc; ?></p>
	</div>
</div>
<?php
endforeach;
}?>

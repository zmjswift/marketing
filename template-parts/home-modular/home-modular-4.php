<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
$post_img_height = $id['post_img_height'] ?: '230';
$post_img_width = $id['post_img_width'] ?: '350';
$modular_4_bg = $id['modular_4_bg']['url'] ?: get_stylesheet_directory_uri() . '/static/images/modular_4_bg.jpg';
$modular_category = isset( $id['modular_category'] ) ? $id['modular_category'] : '';
$count_cat = count((array)$modular_category);
$cat_or_post = $id['modular_cat_or_post'] ?: 'cat';
$md5 = md5($id['modular_title']);
?>
<section class="home-modular-4 projects-section over-layer-white parallax-bg modular_display_<?php echo $id['modular_display'];?>" style="background-image:url(<?php echo $modular_4_bg;?>);" data-type="parallax" data-speed="5">
<div class="container">
	<?php if( $modular_title || $modular_describe ){?>
	<div class="section-title<?php if( $count_cat > '1' ){ echo ' tab-modular'; }?>">
		<?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
		<?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
	</div>
	<?php }?>
	<?php
	if( $cat_or_post == 'cat' ){ //判断是否选中「指定分类」

    if( $count_cat > '1' ){ //勾选的分类大于1，则启用tab切换?>
    <script type="text/javascript">
      //js tab功能   
      function g(o) {
        return document.getElementById(o);
      }
      function a<?php echo $md5;?><?php echo $count_cat;?>(t_n, t_n2, n, k, className) {
        for(var i = 1; i <= k; i++) {
          g(t_n2 + i).className = 'row tab-category-posts divhidden';
          g(t_n + i).className = '';
          $("#" + t_n2 + i).find(".anim").removeClass("anim-show");
        }
        g(t_n2 + n).className = 'row tab-category-posts';
        g(t_n + n).className = className;
        setTimeout(function() {
          $("#" + t_n2 + n).find(".anim").addClass("anim-show");
        }, 6)
      }
    </script>
    <div class="row tab-category-menu">
      <div class="col-md-12">
        <?php
        if(is_array( $modular_category )){
        $i = 1;
        foreach ($modular_category as $cat=>$catid ){?>
        <a href="javascript:;" <?php if( $i == '1' ){ echo 'class="two_sel"'; }?> id="b<?php echo $md5;?><?php echo $i;?>" onMouseOver="a<?php echo $md5;?><?php echo $count_cat;?>('b<?php echo $md5;?>', 'c<?php echo $md5;?>', <?php echo $i;?>, <?php echo $count_cat;?>,'two_sel')"><?php echo get_cat_name( $catid );?></a>
        <?php $i++; } }?>
      </div>
    </div>
    <?php }?>

    <?php
    if(is_array( $modular_category )){ //输出单个分类下的文章
    $s = 1;
    foreach ($modular_category as $cat=>$catid ){?>
	<script type="text/javascript">$(document).ready(function() {$(".owl-<?php echo $s+1;?>").owlCarousel({loop:true,autoplay: 5000,autoplayHoverPause:false,smartSpeed: 700,items: 3,margin:15,dots: true,nav:true,navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],responsive:{0:{items:1},480:{items:1},600:{items:1},800:{items:2},1024:{items:3},1200:{items:3}}});});</script>
	<div class="row tab-category-posts<?php if( $s != '1' ){ echo ' divhidden'; }?>" id="c<?php echo $md5;?><?php echo $s;?>">
		<div class="col-md-12">
			<div id="projects_carousel" class="owl-<?php echo $s+1;?> owl-carousel<?php if( $s > '1' ){ echo ' owl-hidden'; }?>">

		      <?php
		      $args = array(
		        'no_found_rows' => true,
		        'ignore_sticky_posts' => 1,
		        'posts_per_page' => 10,
		        'cat' => $catid
		      );
		      $cat_posts = Dq_Query($args);
		      while( $cat_posts->have_posts() ): $cat_posts->the_post();
		      include TEMPLATEPATH.'/template-parts/loop/2.php';
		      endwhile; wp_reset_query();
		      ?>

			</div>
		</div>
	</div>
	<?php $s++; } }

	}elseif( $cat_or_post == 'post' ){?>

	<script type="text/javascript">$(document).ready(function() {$("#projects_carousel").owlCarousel({loop:true,autoplay: 5000,autoplayHoverPause:false,smartSpeed: 700,items: 3,margin:15,dots: true,nav:true,navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],responsive:{0:{items:1},480:{items:1},600:{items:1},800:{items:2},1024:{items:3},1200:{items:3}}});});</script>
	<div class="row">
		<div class="col-md-12">
			<div id="projects_carousel" class="owl-carousel">
			<?php
			$posts = array();
			if( is_array( $id['modular_posts_id'] ) ){
			foreach ( $id['modular_posts_id'] as $value) {
			    $posts = get_posts("post_type=any&include=".$value."");
			    if($posts) : foreach( $posts as $post ) : setup_postdata( $post );
			    include TEMPLATEPATH.'/template-parts/loop/2.php';
				endforeach; endif; wp_reset_query();
			} }?>
			</div>
		</div>
	</div>

	<?php }else{

	echo '<div class="row"><div class="col-md-12"><p style="text-align:center;width:100%;font-size:18px;color:#f44336">此模块暂未设置调用内容，设置后方可显示</p></div></div>';

	}?>

</div>
</section>
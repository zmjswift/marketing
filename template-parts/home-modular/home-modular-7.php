<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
$post_img_height = $id['post_img_height'] ?: '230';
$post_img_width = $id['post_img_width'] ?: '350';
$post_num = $id['modular7_post_num'] ?: '3';
$modular_category = isset( $id['modular_category'] ) ? $id['modular_category'] : '';
$count_cat = count((array)$modular_category);
$cat_or_post = $id['modular_cat_or_post'] ?: 'cat';
$md5 = md5($id['modular_title']);
$modular_col_post_num = isset( $id['modular7_col_post_num'] ) ? $id['modular7_col_post_num'] : '3';?>
<section class="home-modular-7 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
<div class="container">
  <?php if( $modular_title || $modular_describe ){?>
  <div class="section-title">
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
        <a href="javascript:;" <?php if( $i == '1' ){ echo 'class="two_sel"'; }?> id="b<?php echo $md5;?><?php echo $i;?>" onMouseOver="a<?php echo $md5;?><?php echo $count_cat;?>('b<?php echo $md5;?>', 'c<?php echo $md5;?>', <?php echo $i;?>, <?php echo $count_cat;?>,'two_sel')" aria-label="Read more about <?php echo get_cat_name( $catid );?>"><?php echo get_cat_name( $catid );?></a>
        <?php $i++; } }?>
      </div>
    </div>
    <?php }?>

    <?php
    if(is_array( $modular_category )){ //输出单个分类下的文章
    $s = 1;
    foreach ($modular_category as $cat=>$catid ){?>
    <div class="row tab-category-posts<?php if( $s != '1' ){ echo ' divhidden'; }?>" id="c<?php echo $md5;?><?php echo $s;?>">
      <?php
      $args = array(
        'no_found_rows' => true,
        'ignore_sticky_posts' => 1,
        'posts_per_page' => $post_num,
        'cat' => $catid
      );
      $cat_posts = Dq_Query($args);
      while( $cat_posts->have_posts() ): $cat_posts->the_post();
      include TEMPLATEPATH.'/template-parts/loop/3.php';
      endwhile; wp_reset_query();
      ?>
    </div>
    <?php $s++; } }

  }elseif( $cat_or_post == 'post' ){ //判断是否选中「指定文章」?>

    <div class="row">
      <?php
      $posts = array();
      if( is_array( $id['modular_posts_id'] ) ){
        foreach ( $id['modular_posts_id'] as $value) {
          $posts = get_posts("post_type=any&include=".$value."");
          if($posts) : foreach( $posts as $post ) : setup_postdata( $post );
          include TEMPLATEPATH.'/template-parts/loop/3.php';
          endforeach; endif; wp_reset_query();
        }
      }?>
    </div>

  <?php }else{
      echo '<div class="row"><p style="text-align:center;width:100%;font-size:18px;color:#f44336">此模块暂未设置调用内容，设置后方可显示</p></div>';
  }?>
</div>
</section>
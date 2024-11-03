<div class="col-md-4 col-lg-3 <?php if(dqtheme('dqtheme_none_sidebar')){ echo 'none-sidebar'; }?>">
  <div class="theme-sidebar">

    <?php
    if (is_single()){
        $category = get_the_category();
        if($category[0]){
            $cat = $category[0]->term_id;
        }
    }
    $category_data = get_term_meta( $cat, '_dq_taxonomy_options', true );

    if (is_home()){
      if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_home')) : endif;
    }

    else if (is_single()){


      $post_extend = get_post_meta( get_the_ID(), 'extend_info', true );
      $showproduct_head = isset($post_extend['showproduct_head']) ?$post_extend['showproduct_head'] : '';

      if ( !empty($category_data['cat_post_widgets']) && !empty($category_data['cat_widgets']) ) {
        if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget-area-'.$cat.'')) : endif;
      }else{
        if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_post')) : endif;
      }
    }

    else if (is_page()){
      if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_page')) : endif;
    }

    else if (is_home()){
      if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_sidebar')) : endif;
    }

    else if( is_category() ){
      if (!empty($category_data['cat_widgets'])) {
        if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget-area-'.$cat.'')) : endif;
      }else{
        if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_right')) : endif;
      }
    }

    else {
      if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_other')) : endif;
    }?>

  </div>
</div>
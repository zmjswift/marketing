<?php
  $index_modular = dqtheme('index_modular');
  if(is_array($index_modular)){

    foreach($index_modular as $id):

      $modular_type = $id['modular_type'];
      get_template_part( 'template-parts/home-modular/home-modular', $modular_type );

    endforeach;

  }else{
    echo "<div style='text-align:center;line-height:80vh;font-size:22px;font-weight:600'><a href='".wp_customize_url()."'>请到「后台 - 外观 - 自定义 - 首页模块」中添加内容</a></div>";
  }
?>
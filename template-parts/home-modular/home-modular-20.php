<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
$md5 = md5( $id['modular_20_dzmc'] );
?>
<section class="home-modular-20 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
  <div class="container">
    <?php if( $modular_title || $modular_describe ){?>
    <div class="section-title">
      <?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
      <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
    </div>
    <?php }?>

    <div id="map_contact" class="version_2">
      <style type="text/css">
      #a<?php echo $md5;?>{width:100%;height:500px;margin-top: 30px;}
      .modular_20_dzmc{font-size:20px}
      .modular_20_dtxxms{margin-top:10px}
      </style>
      <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=<?php echo $id['modular_20_ak'];?>"></script>
      <div id="a<?php echo $md5;?>"></div>
      <script type="text/javascript">
        // 百度地图API功能
        var sContent =
        "<h4 class='modular_20_dzmc'><?php echo $id['modular_20_dzmc'];?></h4>" + 
        "<p class='modular_20_dtxxms'><?php echo $id['modular_20_dtxxms'];?></p>" + 
        "</div>";
        var map = new BMap.Map("a<?php echo $md5;?>");
        var point = new BMap.Point(<?php echo $id['modular_20_zuobiao'];?>);
        var marker = new BMap.Marker(point);
        var infoWindow = new BMap.InfoWindow(sContent);  // 创建信息窗口对象
        marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
        map.openInfoWindow(infoWindow,point); //开启信息窗口
        map.centerAndZoom(point, 15);
        map.addOverlay(marker);
        marker.addEventListener("click", function(){          
          this.openInfoWindow(infoWindow);
          //图片加载完毕重绘infowindow
          document.getElementById("imgDemo").onload = function (){
            infoWindow.redraw(); //防止在网速较慢，图片未加载时，生成的信息框高度比图片的总高度小，导致图片部分被隐藏
          }
        });
      </script>
    </div>

  </div>
</section>
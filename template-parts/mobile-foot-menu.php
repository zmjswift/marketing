<style>

@media screen and (max-width:767px){

	.footer-copy-right{margin-bottom:53px}

  .footer-copy-right.footer-mobile_btn{margin-bottom:0 !important}

  .footer-copy-right.footer-mobile_btn2{margin-bottom:53px !important}

}

</style>

<?php if( dqtheme('mobile_foot_menu_touch') ){?>

<script type="text/javascript">



  var startY = 0;



  document.addEventListener("touchstart",function(e){

    startY = e.changedTouches[0].pageY;

  },false);



  document.addEventListener("touchmove",function(e){



    var endY = e.changedTouches[0].pageY;

    var changeVal = endY - startY;

    if(endY < startY){

      //console.log("向上滑");

      $('#mobile_btn').hide();

      $('.footer-copy-right').toggleClass('footer-mobile_btn');

    }else if(endY > startY){

      //console.log("向下滑");

      $('#mobile_btn').show();

      $('.footer-copy-right').removeClass('footer-mobile_btn').toggleClass('footer-mobile_btn2');

    }else{

      //console.log("没有偏移");

    }



    var a = document.body.scrollTop || document.documentElement.scrollTop;;

    var b =document.documentElement.clientHeight

    var c = $('body').height();

    if(a+b >= c){

        $('#mobile_btn').show();

    }



  },false);



</script>

<?php }?>

<?php $mobile_foot_background = dqtheme('mobile_foot_background_color') ?: '#081526';?>

<div id="mobile_btn" <?php if( $mobile_foot_background ){ echo 'style="background-color:'.$mobile_foot_background.'"'; }?>>

  <nav>



	<?php

	if ( is_array(dqtheme('add_mobile_foot_menu')) ){

	foreach ( dqtheme('add_mobile_foot_menu') as $value ):

	if( $value['mobile_foot_menu_type'] == 'link' ){ ?>



    <div class="flexbox">

      <a href="<?php echo $value['mobile_foot_menu_url'];?>" rel="nofollow" <?php if( $value['mobile_foot_menu_url_blank'] ){?>target="_blank"<?php }?>>

        <img loading="lazy" src="<?php echo $value['mobile_foot_menu_icon']['url'];?>" alt="<?php echo $value['mobile_foot_menu_title'];?> Icon" />

        <span><?php echo $value['mobile_foot_menu_title'];?></span>

      </a>

    </div>



  <?php }elseif( $value['mobile_foot_menu_type'] == 'qq' ){?>



    <div class="flexbox">

    	<?php if( wp_is_mobile() ){

    		$qq_url = 'mqqwpa://im/chat?chat_type=wpa&uin='.$value['mobile_foot_menu_qq'].'&version=1&src_type=web&web_src=oicqzone.com';

    	}else{

    		$qq_url = 'http://wpa.qq.com/msgrd?v=3&uin='.$value['mobile_foot_menu_qq'].'&site=qq&menu=yes';

    	}?>

      <a href="<?php echo $qq_url;?>" rel="nofollow" target="_blank" aria-label="QQ">

        <img loading="lazy" src="<?php echo $value['mobile_foot_menu_icon']['url'];?>" alt="<?php echo $value['mobile_foot_menu_title'];?> Icon" />

        <span><?php echo $value['mobile_foot_menu_title'];?></span>

      </a>

    </div>



  <?php }elseif( $value['mobile_foot_menu_type'] == 'tel' ){?>



    <div class="flexbox">

      <a href="tel:<?php echo $value['mobile_foot_menu_tel'];?>" rel="nofollow" target="_blank" aria-label="Phone <?php echo $value['mobile_foot_menu_tel'];?>">
        <img loading="lazy" src="<?php echo $value['mobile_foot_menu_icon']['url'];?>" alt="<?php echo $value['mobile_foot_menu_title'];?> Icon" />

        <span><?php echo $value['mobile_foot_menu_title'];?></span>

      </a>

    </div>



  <?php }elseif( $value['mobile_foot_menu_type'] == 'copy' ){

    $md5_copy = md5( $value['mobile_foot_menu_title'] );?>



    <div class="flexbox">

      <a href="javaScript:;" id="<?php echo $md5_copy;?>" data-clipboard-text="<?php echo $value['mobile_foot_menu_copy'];?>">

        <img loading="lazy" src="<?php echo $value['mobile_foot_menu_icon']['url'];?>" alt="<?php echo $value['mobile_foot_menu_title'];?> Icon" />

        <span><?php echo $value['mobile_foot_menu_title'];?></span>

      </a>

    </div>

    <script>    

        $(document).ready(function(){       

            var clipboard = new Clipboard('#<?php echo $md5_copy;?>');    

            clipboard.on('success', function(e) {    

              <?php if( $value['mobile_foot_menu_copy_tips'] ){?>

                alert("<?php echo $value['mobile_foot_menu_copy_tips'];?>",1500);

              <?php }else{?>

                alert("【<?php echo $value['mobile_foot_menu_copy'];?>】复制成功",1500);

              <?php }?>

              <?php if( $value['mobile_foot_menu_copy_weixin'] ){?>

                window.location.href='weixin://';

              <?php }?>

                e.clearSelection();    

                console.log(e.clearSelection);    

            });    

        });    

    </script>



  <?php }elseif( $value['mobile_foot_menu_type'] == 'img' ){

    $md5_title = md5( $value['mobile_foot_menu_title'] );?>



    <div class="flexbox">

      <a data-fancybox href="#<?php echo $md5_title;?>" rel="nofollow" aria-label="Go to <?php echo $value['mobile_foot_menu_title'];?>">

        <img loading="lazy" src="<?php echo $value['mobile_foot_menu_icon']['url'];?>" alt="<?php echo $value['mobile_foot_menu_title'];?> Icon" />

        <span><?php echo $value['mobile_foot_menu_title'];?></span>

      </a>

    </div>

  	<div id="<?php echo $md5_title;?>" style="display:none;">

  		<img loading="lazy" src="<?php echo $value['mobile_foot_menu_img']['url'];?>" alt="">

  	</div>



	<?php }?>

	<?php endforeach; }?>



  </nav>

</div>
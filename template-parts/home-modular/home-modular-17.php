<section class="home-modular-17 py-5 modular_display_<?php echo $id['modular_display'];?>" style="background:url(<?php echo $id['modular_17_img']['url'];?>) no-repeat center;">
    <div class="container">
        <div class="modular17-box text-<?php echo $id['modular_17_center'];?> py-md-5 py-3">
            <h3><?php echo $id['modular_17_title'];?></h3>
            <div class="modular17-desc">
              <?php echo wpautop( $id['modular_17_desc'] );?>
            </div>
            <?php
            $btn = $id['modular_17_btn'];
            if( $btn['modular_17_btn_1'] || $btn['modular_17_btn_1_url'] ){
            echo '<a class="btn btn-style transparent-btn mt-sm-5 mt-4 mr-2" href="'.$btn['modular_17_btn_1_url'].'" target="_blank" rel="nofollow">'.$btn['modular_17_btn_1'].'</a>';
            }
            if( $btn['modular_17_btn_2'] || $btn['modular_17_btn_2_url'] ){
            echo '<a class="btn btn-style btn-primary mt-sm-5 mt-4" href="'.$btn['modular_17_btn_2_url'].'" target="_blank" rel="nofollow">'.$btn['modular_17_btn_2'].'</a>';
            } ?>
        </div>
    </div>
</section>
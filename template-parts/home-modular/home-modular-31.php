<?php
$module_title    = $id['module_title'] ?: '';
$module_subtitle = $id['module_subtitle'] ?: '';
$module_desc     = $id['module_desc'] ?: '';
$module_button   = $id['module_button'] ?: '';

$module_product   = $id['module_product'] ?: '';
$module_products  = $id['module_products'] ?: '';

?>

<div class="suits-for-women">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="section-title-one"><?php echo $module_title ?></h3>
            </div>
        </div>
        <div class="row">


            <?php
            $args = [];
            $args['ignore_sticky_posts'] = 1;
            $args['posts_per_page'] = 4;
            $args['show_posts'] = 4;
            $args['category__in'] = $module_product;
            $data =  new WP_Query($args);
            ?>

            <?php if ($data->have_posts()) : ?>
                <?php while ($data->have_posts()) : $data->the_post();
                    $post_id = get_the_ID();
                    $pic1 = get_post_meta($post_id, "produc_img_1", true);
                    $pic2 = get_post_meta($post_id, "produc_img_2", true);
                ?>

                    <div class="col-lg-3">
                        <div class="single-suits">
                            <a href="<?php the_permalink(); ?>">
                                <div class="suits-images">
                                    <div class="main-container">
                                        <img src="<?php echo $pic1; ?>" alt="<?php the_title(); ?>">
                                    </div>

                                    <div class="fabric-container">
                                        <img class="fabric_hover" src="<?php echo $pic2; ?>" alt="<?php the_title(); ?>">
                                        <div class="info-fabric-text">
                                            <div class="wrd-table">
                                                <div class="wrd-table-cell">
                                                    <p class="info_item category_group"><?php the_category(); ?></p>
                                                    <p class="info_item simple_composition"><?php _e('View'); ?></p>
                                                    <p class="info_item season"><?php the_tags(); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-data">
                                    <h3> <?php the_title(); ?> </h3>
                                    <!--
							<div class="price price_dsc">
								<span class=" final_price ">249€</span>
							</div>
							-->
                                </div>
                            </a>
                        </div>
                    </div>

                <?php endwhile; ?>
                <?php
                wp_reset_postdata();
                ?>
            <?php else : ?>
            <?php endif; ?>





            <!-- More -->
            <div class="col-lg-3">
                <div class="design-own-product">
                    <div class="icon-personalize">
                        <img src="<?php echo DAHUZI_THEME_URL ?>/static-module/images/suits/needle.png" alt="needle">
                    </div>

                    <?php echo $module_desc; ?>


                    <div class="design-own-button">
                        <a style="color: <?php echo $module_button[0]['color']; ?>;background: <?php echo $module_button[0]['background']; ?>;" href="<?php echo $module_button[0]['link']; ?>" class="wrd-button wrd-button-2"><?php echo $module_button[0]['title']; ?></a>
                    </div>
                    <span class="separator_line"></span>
                    <a style="color: <?php echo $module_button[1]['color']; ?>;" href="<?php echo $module_button[1]['link']; ?>" class="wrd-text-button">
                        <?php echo $module_button[1]['title']; ?>
                    </a>
                </div>
            </div>


            <?php
            $args = [];
            $args['ignore_sticky_posts'] = 1;
            $args['posts_per_page'] = 1;
            $args['show_posts'] = 1;
            $args['category__in'] = $module_product;
            $data =  new WP_Query($args);
            ?>

            <?php if ($data->have_posts()) : ?>
                <?php while ($data->have_posts()) : $data->the_post();
                    $post_id = get_the_ID();
                    $pic1 = get_post_meta($post_id, "produc_img_1", true);
                    $pic2 = get_post_meta($post_id, "produc_img_2", true);
                ?>



                     <div class="col-lg-3">
                        <div class="single-suits">
                            <a href="<?php the_permalink(); ?>">
                                <div class="suits-images">
                                    <div class="main-container">
                                        <img src="<?php echo $pic1; ?>" alt="<?php the_title(); ?>">
                                    </div>

                                    <div class="fabric-container">
                                        <img class="fabric_hover" src="<?php echo $pic2; ?>" alt="<?php the_title(); ?>">
                                        <div class="info-fabric-text">
                                            <div class="wrd-table">
                                                <div class="wrd-table-cell">
                                                    <p class="info_item category_group"><?php the_category(); ?></p>
                                                    <p class="info_item simple_composition"><?php _e('View'); ?></p>
                                                    <p class="info_item season"><?php the_tags(); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-data">
                                    <h3> <?php the_title(); ?> </h3>
                                    <!--
							<div class="price price_dsc">
								<span class=" final_price ">249€</span>
							</div>
							-->
                                </div>
                            </a>
                        </div>
                    </div>



                <?php endwhile; ?>
                <?php
                wp_reset_postdata();
                ?>
            <?php else : ?>
            <?php endif; ?>

        </div>
    </div>
</div><!-- Suits For Woman End -->
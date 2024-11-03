<?php



?>



<div class="col-md-4 col-6 mt-2">

    <div class="service-item style-4">

        <div class="thumb">

            <a href="<?php the_permalink(); ?>" target="_blank">

                <img loading="lazy" src="<?php echo post_thumbnail(320, 240); ?>" alt="<?php echo post_thumbnail_alt(); ?>">

            </a>

            <div class="service-link-box" style="top: 50%;left: 50%;transform: translate(-50%, -50%);white-space: nowrap;">

                <a href="<?php echo home_url('contact-us.html'); ?>?product_id=<?php the_ID(); ?>" target="_blank">Inquiry</a>

            </div>

        </div>

    </div>

    <div class="content">

        <h2><a href="<?php the_permalink(); ?>" rel="bookmark" target="_blank"><?php the_title(); ?></a></h2>

        <?php

            $excerpt = get_the_excerpt();

            echo mb_strimwidth($excerpt, 0, 80, '...');

        ?>

    </div>

</div>
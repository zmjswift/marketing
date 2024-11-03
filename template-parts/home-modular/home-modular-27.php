<?php

$modular_title = $id['modular_title'] ?: '';

$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';

$term_id = $_GET['term_id'] ?? '';

$active_all = !$term_id ? 'two_sel' : '';

$all_text = __('All');//isset($_GET['search']) ? __('Search') : __('All');

?>

<section class="home-modular-27 modular_display_<?php echo $id['modular_display']; ?> <?php if ($id['modular_bg_f9']) {

                                                                                            echo 'bg-f9';

                                                                                        } ?>">

    <div class="container">

        <?php if ($modular_title || $modular_describe) { ?>

            <div class="section-title">

                <?php if ($modular_title) {

                    echo '<h2>' . $modular_title . '</h2>';

                } ?>

                <?php if ($modular_describe) {

                    echo '<p style="color: '.$mmodular_describe_color.'">' . $modular_describe . '</p>';

                } ?>

            </div>

        <?php } ?>



        <div class="navbar-nav">

            <form class="form-faq search-box" style="display: block;" action="<?php the_permalink(); ?>">

                <div class="form-group">

                    <input type="text" name="term_id" value="<?php echo $_GET['term_id'] ?? '' ?>" hidden="hidden">

                    <input type="text" placeholder="Search FAQ..." name="search" class="form-control">

                    <button type="submit" class="fa fa-search form-control-feedback"></button>

                </div>

            </form>

        </div>



        <div class="accordion-faq-content">

            <div class="row tab-category-menu mt-5">

                <div class="col-md-12 text-left">

                    <a href="<?php the_permalink(); ?>" class="faq-term <?php echo $active_all; ?>"><?php echo $all_text; ?></a>

                    <?php

                    if (isset($id['add_modular_27'])) {

                        foreach ($id['add_modular_27'] as $key => $value) {

                            $active = $term_id == $value ? 'two_sel' : '';

                            echo '<a href="' . add_query_arg(['term_id' => $value], get_the_permalink()) . '" class="faq-term ' . $active . '">' . get_cat_name($value) . '</a>';

                        }

                    }

                    ?>

                </div>

            </div>



            <div class="accordion-faq accordion" id="accordionExample">



                <?php

                $args = [];

                $args['ignore_sticky_posts'] = 1;

                $args['category__in'] = !empty($_GET['term_id']) ? $_GET['term_id'] : $id['add_modular_27'];

                $args['ignore_sticky_posts'] = 1;

                $args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 0;



                if (isset($_GET['search'])) {

                    $args['s'] = $_GET['search'];

                }

                $wp_query =  new WP_Query($args);

                ?>



                <?php if ($wp_query->have_posts()) :

                    $i = 0;

                    while ($wp_query->have_posts()) : $wp_query->the_post();

                        $i++;

                        $post_id = $i;

                        $show = $i == 1 ? 'show' : '';

                        echo '<div class="card">

                        <div class="card-header" id="heading' . $post_id . '">

    <h2 class="mb-0">

        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse' . $post_id . '" aria-expanded="true" aria-controls="collapse' . $post_id . '">

            ' . get_the_title() . '

        </button>

    </h2>

</div>



<div id="collapse' . $post_id . '" class="collapse ' . $show . '" aria-labelledby="heading' . $post_id . '" data-parent="#accordionExample">

    <div class="card-body">

    ' . get_the_content() . '

    </div>

</div>

</div>';



                    endwhile;

                ?>



                    <section class="paging-section text-center pt-0 pb-70 mt-5">

                        <div class="container">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="page-link-item">

                                        <ul>

                                            <?php par_pagenavi(9); ?>

                                        </ul>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </section>



                    <?php

                    wp_reset_postdata();

                    ?>

                <?php else : ?>

                <?php endif; ?>

            </div>

        </div>

    </div>

</section>



<style>

    .wpkf-loading {

        position: fixed;

        width: 50px;

        height: 50px;

        top: calc(50% - 25px);

        left: calc(50% - 25px);

    }

</style>



<script>

    function wpkf_loading(el) {

        let html = '<img class="wpkf-loading" src="<?php echo DAHUZI_THEME_URL . '/static/xzoom/xloading.gif'; ?>" />';

        $(el).append(html);

    }



    function wpkf_form_get(url) {

        wpkf_loading('.accordion-faq-content');

        window.history.pushState(null, null, url);

        return $.ajax({

            url: url,

            type: "get",

            async: !0,

            success: function(response) {

                let html = $(response).find('.accordion-faq-content').html();

                $('.accordion-faq-content').html(html);

            },

        });

    }



    jQuery(function($) {

        $('body').on('submit', '.form-faq', function(e) {

            e.preventDefault();

            let url = $(this).attr("action") + "?" + $(this).serialize();;

            console.log(url);

            wpkf_form_get(url);

        });

        $('body').on('click', '.faq-term', function(e) {

            e.preventDefault();

            let url = $(this).attr("href");

            console.log(url);

            wpkf_form_get(url);

        });

        $('body').on('click', '.accordion-faq-content .page-link-item li a', function(e) {

            e.preventDefault();

            let url = $(this).attr("href");

            console.log(url);

            wpkf_form_get(url);

        });

    });

</script>
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



        <div class="accordion-faq-content">

<style>

.expand-indicator {

    float: right;

}

.collapse .expand-indicator {

    display: none;

}

.collapse.show .expand-indicator {

    display: inline-block;

}



</style>

            <div class="accordion-faq accordion" id="accordionExample">

			<?php

if (!empty($id['add_modular_37'])) {

    foreach ($id['add_modular_37'] as $value):

        $title = $value['modular_37_title'];

        $desc = $value['modular_37_desc'];

        $color = $value['modular_37_color'];

        $i++;

        $post_id = $i;

        $show = $i == 1 ? 'show' : ''; 

        if (!empty($title)) {

            echo '

            <div class="card ' . $show . '">

                <div class="card-header" id="heading' . $post_id . '">

                    <h2 class="mb-0">

                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse' . $post_id . '" aria-expanded="true" aria-controls="collapse' . $post_id . '" style="font-weight: bold;color: '. $color .';white-space: normal;">

                            ' . $title . '

                            <span class="expand-indicator">+</span>

                        </button>

                    </h2>

                </div>

                <div id="collapse' . $post_id . '" class="collapse ' . $show . '" aria-labelledby="heading' . $post_id . '" data-parent="#accordionExample">

                    <div class="card-body">

                        ' . $desc . '

                    </div>

                </div>

            </div>';

        }

    endforeach;

}

?>





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

<script>

    jQuery(function($) {

        var $defaultExpandedItem = $('.card.show');

        $defaultExpandedItem.find('.expand-indicator').text('-');

        $('body').on('click', '.btn-link', function() {

            var $clickedItem = $(this).closest('.card');

            var $expandedItems = $('.card.show');

            $('.expand-indicator').text('+');



            if ($clickedItem.hasClass('show')) {

                $clickedItem.removeClass('show').find('.expand-indicator').text('+');

            } else {

                $clickedItem.addClass('show').find('.expand-indicator').text('-');

            }

            $expandedItems.not($clickedItem).removeClass('show').find('.expand-indicator').text('+');

        });

    });

    $(document).ready(function() {

        $defaultExpandedItem.find('.btn-link').click();

    });

</script>

<script>

    jQuery(function($) {

        var $defaultExpandedItem = $('.card.show');

        $defaultExpandedItem.find('.expand-indicator').text('-');

    });

</script>












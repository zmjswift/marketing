<?php
$categories = get_categories();

foreach ($categories as $category) {
    $category_id = $category->term_id;
    $category_link = get_category_link($category_id);
    $category_name = $category->name; 
    $is_cat_imgs = get_term_meta($category_id, '_dq_taxonomy_options', true)['is_cat_imgs'];
    $cat_category_img_url = get_term_meta($category_id, '_dq_taxonomy_options', true)['cat_category_img']['url'];
    $is_cat_text = get_term_meta($category_id, '_dq_taxonomy_options', true)['is_cat_text'];
    
    if ($is_cat_imgs) {
        if (!empty($is_cat_text)) {
            $output_text = $is_cat_text;
        } else {
            $output_text = $category_name;
        }

        echo '<div class="col-md-4">
        <div class="service-item style-4">
            <div class="thumb">
                <a href="' . esc_url($category_link) . '" target="_blank">
                    <img loading="lazy" alt="' . $output_text . '" src="' . $cat_category_img_url . '">
                </a><span class="product-badge">';
        display_produc_radio_badge();
        echo '</span><div class="service-link-box" style="top: 50%;left: 50%;transform: translate(-50%, -50%);white-space: nowrap;">
                    <a href="' . esc_url($category_link) . '" target="_blank">' . $output_text . '</a>
                </div>
            </div>
            <div class="content">
                <h2><a href="' . esc_url($category_link) . '" rel="bookmark" target="_blank">' . $output_text . '</a></h2>
            </div>
        </div>
        </div>';
    }
}
?>
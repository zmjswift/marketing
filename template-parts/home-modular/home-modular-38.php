<?php
$modular_38_category    = $id['modular_38_category'] ?: '';
?>
<section>
<div class="container">
<div class="bottom-breadcrumb-menu" style="text-align: center;">
                <div class="breadcrumbs" style="border-bottom: none;">
<?php
$cat_ids = $modular_38_category; 
$categories = array();

foreach ($cat_ids as $cat_id) {
    $category = get_category($cat_id);
    if ($category) {
        $categories[] = '<a href="' . esc_url(get_category_link($cat_id)) . '">' . $category->name . '</a>';
    }
}

echo implode(' / ', $categories);
?>
</div>
</div>
</div>
</section>
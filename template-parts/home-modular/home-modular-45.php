<?php
if (wp_is_mobile()) {
    get_template_part('template-parts/home-modular/home-modular-45', 'mobile');
} else {
    get_template_part('template-parts/home-modular/home-modular-45', 'pc');
}
?>

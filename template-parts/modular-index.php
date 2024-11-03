<?php

/**
 * Template Name: 模块化首页
 *
 * @Author: 大胡子
 * @Email:  dq@dqtheme.com
 * @Link:   www.dq.me
 * @Date:   2020-10-17 22:19:20
 * @Last Modified by:   dq
 * @Last Modified time: 2020-12-26 18:02:47
 */

if(is_paged()){
    include(get_template_directory().'/404.php');
    exit;
}

get_header();

get_template_part( 'template-parts/home-modular/banner');

get_template_part( 'template-parts/home-modular');

get_footer();
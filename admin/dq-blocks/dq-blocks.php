<?php

/**
 * @Author: 大胡子
 * @Email:  dq@dqtheme.com
 * @Link:   www.dq.me
 * @Date:   2020-12-09 21:18:00
 * @Last Modified by:   dq
 * @Last Modified time: 2020-12-10 21:20:32
 */

/** --------------------------------------------------------------------------------- *
 *  加载块功能
 *  --------------------------------------------------------------------------------- */
include TEMPLATEPATH.'/admin/dq-blocks/dist/init.php';

/** --------------------------------------------------------------------------------- *
 *  布局的 Restapi
 *  --------------------------------------------------------------------------------- */
include TEMPLATEPATH.'/admin/dq-blocks/includes/layout/layout-endpoints.php';

/** --------------------------------------------------------------------------------- *
 *  装载容器块PHP
 *  --------------------------------------------------------------------------------- */
include TEMPLATEPATH.'/admin/dq-blocks/src/blocks/block-container/index.php';

/** --------------------------------------------------------------------------------- *
 *  布局组件注册表
 *  --------------------------------------------------------------------------------- */
include TEMPLATEPATH.'/admin/dq-blocks/includes/layout/layout-functions.php';
include TEMPLATEPATH.'/admin/dq-blocks/includes/layout/class-component-registry.php';
include TEMPLATEPATH.'/admin/dq-blocks/includes/layout/register-layout-components.php';


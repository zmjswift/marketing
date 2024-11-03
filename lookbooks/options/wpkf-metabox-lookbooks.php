<?php

$wpkf_meta_lookbooks = 'wpkf_lookbooks';

CSF::createMetabox($wpkf_meta_lookbooks, array(
	'title'     => 'Lookbooks',
	'post_type' =>  array('lookbooks'),
	'data_type' => 'serialize',
	'priority'  => 'high',
));

$fields_array = array(
	array(
		'id'         => 'products',
		'type'       => 'select',
		'title'      => '关联产品',
		'options'    => 'posts',
		'multiple'    => true,
		'chosen'    => true,
		//'ajax'    => true,
		'sortable'    => true,
		'placeholder'    => '请选择',
		'query_args'  => array(
			'posts_per_page' => -1,
		),
	),
    array(
        'id'         => 'gallery',
        'type'       => 'gallery',
        'title'      => '图片组',
        'desc'       => '',
    ),
    /*
    array(
        'id'         => 'video_url',
        'type'       => 'upload',
        'title'      => '视频地址',
        'desc'       => '',
    ),
    */
);

CSF::createSection($wpkf_meta_lookbooks, array(
	'title' => '',
	'fields' => $fields_array
));

<?php

$wpkf_meta_lookbooks = 'extend_info';

/*
CSF::createMetabox($wpkf_meta_lookbooks, array(
	'title'     => 'Lookbooks',
	'post_type' =>  array('post'),
	'data_type' => 'unserialize',
	'priority'  => 'high',
));
*/

$fields_array = array(
    array(
        'id'         => 'wpkf_price',
        'type'       => 'number',
        'title'      => '价格',
        'desc'       => '',
    ),
);

CSF::createSection($wpkf_meta_lookbooks, array(
	'title' => 'Lookbooks',
	'fields' => $fields_array
));

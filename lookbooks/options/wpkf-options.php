<?php

$wpkf_meta_lookbooks = 'dqtheme_optimize';

$fields_array = array(
    array(
        'id'         => 'site_unit',
        'type'       => 'text',
        'title'      => '单位',
        'desc'       => '',
        'attributes' => array('style'    => 'width: 100px;'),
    ),
    array(
        'id'         => 'archive_lookbooks_title',
        'type'       => 'text',
        'title'      => '归档页标题',
        'default'    => 'Outfit Ideas',
    ),
    array(
        'id'         => 'archive_lookbooks_desc',
        'type'       => 'textarea',
        'title'      => '归档页描述',
        'default'    => 'Get inspired by other customers, influencers and celebrities wearing Hockerty. You can filter by occasion and product.',
    ),
);

CSF::createSection($wpkf_meta_lookbooks, array(
	'title' => 'Lookbooks',
	'fields' => $fields_array
));

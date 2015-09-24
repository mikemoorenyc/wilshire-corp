<?php

//PROPERTY
function portfolio_init() {
    $args = array(
      'label' => 'Portfolio',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'page',
        'hierarchical' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'portfolio'),
        'query_var' => true,
        'menu_icon' => get_bloginfo('template_url').'/assets/imgs/post-property.png',
        'supports' => array(
            'title',
            'editor',
            'revisions',
            'thumbnail',
            'page-attributes')
        );
    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'portfolio_init' );


//Team
function team_init() {
    $args = array(
      'label' => 'Team',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'page',
        'hierarchical' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'team'),
        'query_var' => true,
        'menu_icon' => get_bloginfo('template_url').'/assets/imgs/post-team.png',
        'supports' => array(
            'title',
            'editor',
            'revisions',
            'thumbnail',
            'page-attributes')
        );
    register_post_type( 'team', $args );
}
add_action( 'init', 'team_init' );

//STRATEGY
function strategy_init() {
    $args = array(
      'label' => 'Strategies',
        'public' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'capability_type' => 'page',
        'hierarchical' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'strategy'),
        'query_var' => true,
        'menu_icon' => get_bloginfo('template_url').'/assets/imgs/post-strategy.png',
        'supports' => array(
            'title',
            'revisions',
            'thumbnail',
            'page-attributes')
        );
    register_post_type( 'strategy', $args );
}
add_action( 'init', 'strategy_init' );

//Group Files
function group_files_init() {
    $args = array(
      'label' => 'Group Files',
        'public' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'show_in_admin_bar' => false,
        'capability_type' => 'page',
        'hierarchical' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'group-files'),
        'query_var' => true,
        'menu_position' => 2,
        'menu_icon' => 'dashicons-media-default',
        'supports' => array(
            'title',
            'revisions',
            'thumbnail',
            'page-attributes')
        );
    register_post_type( 'group-files', $args );
}
add_action( 'init', 'group_files_init' );


?>

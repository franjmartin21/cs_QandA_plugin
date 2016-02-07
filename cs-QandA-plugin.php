<?php
/*
Plugin Name: Credit Sesame Q&A
Plugin URI: https://github.com/franjmartin21/cs_QandA_plugin
Description: Create a new Q&A section
Version: 1.0
Author: Credit Sesame
Author URI: www.creditsesame.com
License: GPLv2
*/


// Call function when plugin is activated
register_activation_hook( __FILE__, 'halloween_store_install' );

function halloween_store_install() {

    //setup default option values
    $qanda_options_array = array(
        'currency_sign' => '$'
    );

    //save our default option values
    update_option( 'qandaoptions', $qanda_options_array );

}


// Action hook to initialize the plugin
add_action( 'init', 'qanda_init' );

//Initialize the Halloween Store
function qanda_init() {

    //register the products custom post type
    $labels = array(
        'name'               => __( 'Q&A', 'qanda-plugin' ),
        'singular_name'      => __( 'Q&A', 'qanda-plugin' ),
        'add_new'            => __( 'Add New', 'qanda-plugin' ),
        'add_new_item'       => __( 'Add New Q&A', 'halloween-plugin' ),
        'edit_item'          => __( 'Edit Q&A', 'halloween-plugin' ),
        'new_item'           => __( 'New Q&A', 'halloween-plugin' ),
        'all_items'          => __( 'All Q&A', 'halloween-plugin' ),
        'view_item'          => __( 'View Q&A', 'halloween-plugin' ),
        'search_items'       => __( 'Search Q&A', 'halloween-plugin' ),
        'not_found'          =>  __( 'No Q&A found', 'halloween-plugin' ),
        'not_found_in_trash' => __( 'No Q&A found in Trash', 'halloween-plugin' ),
        'menu_name'          => __( 'Q&A', 'halloween-plugin' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
    );

    register_post_type( 'halloween-products', $args );
}

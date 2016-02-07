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
register_activation_hook( __FILE__, 'qanda_install' );

function qanda_install() {

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
        'add_new_item'       => __( 'Add New Q&A', 'qanda-plugin' ),
        'edit_item'          => __( 'Edit Q&A', 'qanda-plugin' ),
        'new_item'           => __( 'New Q&A', 'qanda-plugin' ),
        'all_items'          => __( 'All Q&A', 'qanda-plugin' ),
        'view_item'          => __( 'View Q&A', 'qanda-plugin' ),
        'search_items'       => __( 'Search Q&A', 'qanda-plugin' ),
        'not_found'          =>  __( 'No Q&A found', 'qanda-plugin' ),
        'not_found_in_trash' => __( 'No Q&A found in Trash', 'qanda-plugin' ),
        'menu_name'          => __( 'Q&A', 'qanda-plugin' )
    );

    $content_type_arguments = array(
        'labels'               => $labels,
        'public'               => true,
        'menu_position'        => 6,
        'menu_icon'            => NULL,
        'supports'             => array( 'title', 'editor', 'author', 'thumbnail'),
        'has_archive'          => true,
        'rewrite'              => false,
    );

    register_post_type( 'Q&A', $content_type_arguments );
}


add_action( 'add_meta_boxes', 'add_meta_box_answer');

function add_meta_box_answer() {
    add_meta_box('wp_meta_box_answer', __( 'Answer of Question', 'wp-meta_box_answer' ),'render_answer_meta_box_content', 'Q&A', 'normal', 'high');
}

function render_answer_meta_box_content( $post ) {
    wp_nonce_field( 'answer_qanda', 'wp_answer_qanda' );
    $answer_qanda = get_post_meta( $post->ID, '_answer_qanda', true );
    echo '<p>'.  sprintf( __( 'Answer of the Question', 'wp-meta_box_answer' ), $post->post_type ). '</p> ';
    echo '<textarea id="answer_qanda" name="answer_qanda" style="width:100%; min-height:200px;">' . esc_attr( $answer_qanda ) . '</textarea>';
}


<?php
/**
 *custom post and taxonomic specific 
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

//resource custom post type

// Register Custom Post Type resource
// Post Type Key: resource

function create_resource_cpt() {

  $labels = array(
    'name' => __( 'Resources', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Resource', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Resource', 'textdomain' ),
    'name_admin_bar' => __( 'Resource', 'textdomain' ),
    'archives' => __( 'Resource Archives', 'textdomain' ),
    'attributes' => __( 'Resource Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Resource:', 'textdomain' ),
    'all_items' => __( 'All Resources', 'textdomain' ),
    'add_new_item' => __( 'Add New Resource', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Resource', 'textdomain' ),
    'edit_item' => __( 'Edit Resource', 'textdomain' ),
    'update_item' => __( 'Update Resource', 'textdomain' ),
    'view_item' => __( 'View Resource', 'textdomain' ),
    'view_items' => __( 'View Resources', 'textdomain' ),
    'search_items' => __( 'Search Resources', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into resource', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this resource', 'textdomain' ),
    'items_list' => __( 'Resource list', 'textdomain' ),
    'items_list_navigation' => __( 'Resource list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Resource list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'resource', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'revisions', 'author', 'trackbacks', 'custom-fields', 'thumbnail',),
    'taxonomies' => array('category', 'post_tag'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-welcome-write-blog',
  );
  register_post_type( 'resource', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_resource_cpt', 0 );

add_action( 'init', 'create_type_taxonomies', 0 );
function create_type_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Types', 'taxonomy general name' ),
    'singular_name' => _x( 'Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Types' ),
    'popular_items' => __( 'Popular Types' ),
    'all_items' => __( 'All Types' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Types' ),
    'update_item' => __( 'Update Type' ),
    'add_new_item' => __( 'Add New Type' ),
    'new_item_name' => __( 'New Type' ),
    'add_or_remove_items' => __( 'Add or remove Types' ),
    'choose_from_most_used' => __( 'Choose from the most used Types' ),
    'menu_name' => __( 'Type' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('Types',array('post', 'resource'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
    'show_in_rest'          => true,
    'rest_base'             => 'type',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}

add_action( 'init', 'create_design_element_taxonomies', 0 );
function create_design_element_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Design elements', 'taxonomy general name' ),
    'singular_name' => _x( 'Design element', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Design elements' ),
    'popular_items' => __( 'Popular Design elements' ),
    'all_items' => __( 'All Design elements' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Design elements' ),
    'update_item' => __( 'Update design element' ),
    'add_new_item' => __( 'Add New design element' ),
    'new_item_name' => __( 'New design element' ),
    'add_or_remove_items' => __( 'Add or remove Design_elements' ),
    'choose_from_most_used' => __( 'Choose from the most used Design_elements' ),
    'menu_name' => __( 'Design element' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('Design elements',array('post', 'resource'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'design_element' ),
    'show_in_rest'          => true,
    'rest_base'             => 'design_element',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}

add_action( 'init', 'create_teaching_practice_taxonomies', 0 );
function create_teaching_practice_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Teaching practices', 'taxonomy general name' ),
    'singular_name' => _x( 'Teaching practice', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Teaching practices' ),
    'popular_items' => __( 'Popular Teaching practices' ),
    'all_items' => __( 'All Teaching practices' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Teaching practices' ),
    'update_item' => __( 'Update teaching practice' ),
    'add_new_item' => __( 'Add New teaching practice' ),
    'new_item_name' => __( 'New teaching practice' ),
    'add_or_remove_items' => __( 'Add or remove Teaching practices' ),
    'choose_from_most_used' => __( 'Choose from the most used Teaching practices' ),
    'menu_name' => __( 'Teaching practice' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('Teaching practices',array('post', 'resource'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'teaching_practice' ),
    'show_in_rest'          => true,
    'rest_base'             => 'teaching_practice',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}



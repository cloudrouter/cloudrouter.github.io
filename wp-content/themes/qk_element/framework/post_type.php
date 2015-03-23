<?php

//Portfolio

add_action( 'init', 'codex_portfolio_init' );
/**
 * Register a portfolio post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_portfolio_init() {
	
	
	$labels = array(
		'name'               => __( 'Portfolios', 'post type general name', 'element' ),
		'singular_name'      => __( 'Portfolio', 'post type singular name', 'element' ),
		'menu_name'          => __( 'Portfolios', 'admin menu', 'element' ),
		'name_admin_bar'     => __( 'Portfolio', 'add new on admin bar', 'element' ),
		'add_new'            => __( 'Add New', 'portfolio', 'element' ),
		'add_new_item'       => __( 'Add New Portfolio', 'element' ),
		'new_item'           => __( 'New Portfolio', 'element' ),
		'edit_item'          => __( 'Edit Portfolio', 'element' ),
		'view_item'          => __( 'View Portfolio', 'element' ),
		'all_items'          => __( 'All Portfolios', 'element' ),
		'search_items'       => __( 'Search Portfolios', 'element' ),
		'parent_item_colon'  => __( 'Parent Portfolios:', 'element' ),
		'not_found'          => __( 'No portfolios found.', 'element' ),
		'not_found_in_trash' => __( 'No portfolios found in Trash.', 'element' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'menu_icon' 		 => 'dashicons-portfolio',
		'publicly_queryable' => true,
		'menu_position' 	 => 2,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'comments')
	);

	register_post_type( 'portfolio', $args );
}

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_portfolio_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_portfolio_taxonomies() {
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => __( 'Portfolio Categories', 'element' ),
		'singular_name'     => __( 'Portfolio Category', 'element' ),
		'search_items'      => __( 'Search Portfolio Categories','element' ),
		'all_items'         => __( 'All Portfolio Categories','element' ),
		'parent_item'       => __( 'Parent Portfolio Category','element' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:','element' ),
		'edit_item'         => __( 'Edit Portfolio Category','element' ),
		'update_item'       => __( 'Update Portfolio Category','element' ),
		'add_new_item'      => __( 'Add New Portfolio Category','element' ),
		'new_item_name'     => __( 'New Portfolio Category Name','element' ),
		'menu_name'         => __( 'Portfolio Category' ,'element'),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfolio_category' ),
	);

	register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );


}

add_action( 'init', 'codex_client_init' );
/**
 * Register a Client post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_client_init() {
	
	
	$labels = array(
		'name'               => __( 'Clients', 'post type general name', 'element' ),
		'singular_name'      => __( 'Client', 'post type singular name', 'element' ),
		'menu_name'          => __( 'Clients', 'admin menu', 'element' ),
		'name_admin_bar'     => __( 'Client', 'add new on admin bar', 'element' ),
		'add_new'            => __( 'Add New', 'Client', 'element' ),
		'add_new_item'       => __( 'Add New Client', 'element' ),
		'new_item'           => __( 'New Client', 'element' ),
		'edit_item'          => __( 'Edit Client', 'element' ),
		'view_item'          => __( 'View Client', 'element' ),
		'all_items'          => __( 'All Client', 'element' ),
		'search_items'       => __( 'Search Client', 'element' ),
		'parent_item_colon'  => __( 'Parent Client:', 'element' ),
		'not_found'          => __( 'No Client found.', 'element' ),
		'not_found_in_trash' => __( 'No Client found in Trash.', 'element' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'menu_icon' 		 => 'dashicons-businessman',
		'publicly_queryable' => true,
		'menu_position' 	 => 2,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'client' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title')
	);

	register_post_type( 'client', $args );
}


add_action( 'init', 'codex_testimonial_init' );
/**
 * Register a Testimonial post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_testimonial_init() {
	
	
	$labels = array(
		'name'               => __( 'Testimonials', 'post type general name', 'element' ),
		'singular_name'      => __( 'Testimonial', 'post type singular name', 'element' ),
		'menu_name'          => __( 'Testimonials', 'admin menu', 'element' ),
		'name_admin_bar'     => __( 'Testimonial', 'add new on admin bar', 'element' ),
		'add_new'            => __( 'Add New', 'Testimonial', 'element' ),
		'add_new_item'       => __( 'Add New Testimonial', 'element' ),
		'new_item'           => __( 'New Testimonial', 'element' ),
		'edit_item'          => __( 'Edit Testimonial', 'element' ),
		'view_item'          => __( 'View Testimonial', 'element' ),
		'all_items'          => __( 'All Testimonial', 'element' ),
		'search_items'       => __( 'Search Testimonial', 'element' ),
		'parent_item_colon'  => __( 'Parent Testimonial:', 'element' ),
		'not_found'          => __( 'No Testimonial found.', 'element' ),
		'not_found_in_trash' => __( 'No Testimonial found in Trash.', 'element' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'menu_icon' 		 => 'dashicons-format-status',
		'publicly_queryable' => true,
		'menu_position' 	 => 2,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonial' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor')
	);

	register_post_type( 'testimonial', $args );
}

add_action( 'init', 'codex_team_init' );
/**
 * Register a Team post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_team_init() {
	
	
	$labels = array(
		'name'               => __( 'Teams', 'post type general name', 'element' ),
		'singular_name'      => __( 'Team', 'post type singular name', 'element' ),
		'menu_name'          => __( 'Teams', 'admin menu', 'element' ),
		'name_admin_bar'     => __( 'Team', 'add new on admin bar', 'element' ),
		'add_new'            => __( 'Add New', 'Team', 'element' ),
		'add_new_item'       => __( 'Add New Team', 'element' ),
		'new_item'           => __( 'New Team', 'element' ),
		'edit_item'          => __( 'Edit Team', 'element' ),
		'view_item'          => __( 'View Team', 'element' ),
		'all_items'          => __( 'All Team', 'element' ),
		'search_items'       => __( 'Search Team', 'element' ),
		'parent_item_colon'  => __( 'Parent Team:', 'element' ),
		'not_found'          => __( 'No Team found.', 'element' ),
		'not_found_in_trash' => __( 'No Team found in Trash.', 'element' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'menu_icon' 		 => 'dashicons-id',
		'publicly_queryable' => true,
		'menu_position' 	 => 2,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'team' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title')
	);

	register_post_type( 'team', $args );
}


add_action( 'init', 'codex_service_init' );
/**
 * Register a Service post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_service_init() {
	
	
	$labels = array(
		'name'               => __( 'Servies', 'post type general name', 'element' ),
		'singular_name'      => __( 'Service', 'post type singular name', 'element' ),
		'menu_name'          => __( 'Servies', 'admin menu', 'element' ),
		'name_admin_bar'     => __( 'Service', 'add new on admin bar', 'element' ),
		'add_new'            => __( 'Add New', 'Service', 'element' ),
		'add_new_item'       => __( 'Add New Service', 'element' ),
		'new_item'           => __( 'New Service', 'element' ),
		'edit_item'          => __( 'Edit Service', 'element' ),
		'view_item'          => __( 'View Service', 'element' ),
		'all_items'          => __( 'All Service', 'element' ),
		'search_items'       => __( 'Search Service', 'element' ),
		'parent_item_colon'  => __( 'Parent Service:', 'element' ),
		'not_found'          => __( 'No Service found.', 'element' ),
		'not_found_in_trash' => __( 'No Service found in Trash.', 'element' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'menu_icon' 		 => 'dashicons-sos',
		'publicly_queryable' => true,
		'menu_position' 	 => 2,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'qk_service' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor')
	);

	register_post_type( 'qk_service', $args );
}

add_action( 'init', 'codex_flexslider_init' );
/**
 * Register a portfolio post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_flexslider_init() {
	
	$labels = array(
		'name'               => __( 'QK Slider', 'post type general name', 'element' ),
		'singular_name'      => __( 'QK Slider', 'post type singular name', 'element' ),
		'menu_name'          => __( 'QK Slider', 'admin menu', 'element' ),
		'name_admin_bar'     => __( 'QK Slider', 'add new on admin bar', 'element' ),
		'add_new'            => __( 'Add New', 'Slide', 'element' ),
		'add_new_item'       => __( 'Add New Slide', 'element' ),
		'new_item'           => __( 'New Slide', 'element' ),
		'edit_item'          => __( 'Edit Slide', 'element' ),
		'view_item'          => __( 'View Slide', 'element' ),
		'all_items'          => __( 'All Slide', 'element' ),
		'search_items'       => __( 'Search Slide', 'element' ),
		'parent_item_colon'  => __( 'Parent Slide:', 'element' ),
		'not_found'          => __( 'No Slide found.', 'element' ),
		'not_found_in_trash' => __( 'No Slide found in Trash.', 'element' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'menu_icon' 		 => 'dashicons-images-alt2',
		'publicly_queryable' => true,
		'menu_position' 	 => 2,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'qk_slide' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title','editor')
	);

	register_post_type( 'qk_slide', $args );
}
?>
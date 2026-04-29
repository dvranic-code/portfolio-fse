<?php
/**
 * Portfolio FSE — theme bootstrap.
 *
 * Minimal by design. Only thing here:
 * register a custom block pattern category so our
 * patterns don't pollute core categories.
 *
 * @package portfolio-fse
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_enqueue_scripts', 'portfolio_fse_enqueue_styles' );

/**
 * Enqueue theme styles.
 *
 * @return void
 */
function portfolio_fse_enqueue_styles() {
    wp_enqueue_style(
        'portfolio-fse-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' )
    );
}

add_action( 'init', 'portfolio_fse_register_pattern_categories' );

/**
 * Register custom block pattern category.
 *
 * @return void
 */
function portfolio_fse_register_pattern_categories() {
    register_block_pattern_category(
        'portfolio-fse',
        array(
            'label'       => __( 'Portfolio FSE', 'portfolio-fse' ),
            'description' => __( 'Patterns for the developer portfolio theme.', 'portfolio-fse' ),
        )
    );
}

add_action( 'init', 'portfolio_fse_register_post_types' );

/**
 * Register custom post type for portfolio projects.
 *
 * @return void
 */
function portfolio_fse_register_post_types() {
    register_post_type(
        'portfolio',
        array(
            'labels'              => array(
                'name'               => __( 'Portfolio', 'portfolio-fse' ),
                'singular_name'      => __( 'Project', 'portfolio-fse' ),
                'menu_name'          => __( 'Portfolio', 'portfolio-fse' ),
                'add_new'            => __( 'Add Project', 'portfolio-fse' ),
                'add_new_item'       => __( 'Add New Project', 'portfolio-fse' ),
                'edit_item'          => __( 'Edit Project', 'portfolio-fse' ),
                'view_item'          => __( 'View Project', 'portfolio-fse' ),
                'all_items'          => __( 'All Projects', 'portfolio-fse' ),
                'search_items'       => __( 'Search Projects', 'portfolio-fse' ),
                'not_found'          => __( 'No projects found.', 'portfolio-fse' ),
            ),
            'public'              => true,
            'has_archive'         => true,
            'show_in_rest'        => true,
            'menu_icon'           => 'dashicons-portfolio',
            'menu_position'       => 20,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
            'rewrite'             => array( 'slug' => 'projects' ),
            'taxonomies'          => array( 'technology' ),
        )
    );
}

add_action( 'init', 'portfolio_fse_register_taxonomies' );

/**
 * Register custom taxonomy for portfolio projects.
 *
 * @return void
 */
function portfolio_fse_register_taxonomies() {
    register_taxonomy(
        'technology',
        array( 'portfolio' ),
        array(
            'labels'            => array(
                'name'          => __( 'Technologies', 'portfolio-fse' ),
                'singular_name' => __( 'Technology', 'portfolio-fse' ),
                'menu_name'     => __( 'Technologies', 'portfolio-fse' ),
                'all_items'     => __( 'All Technologies', 'portfolio-fse' ),
                'edit_item'     => __( 'Edit Technology', 'portfolio-fse' ),
                'add_new_item'  => __( 'Add New Technology', 'portfolio-fse' ),
                'search_items'  => __( 'Search Technologies', 'portfolio-fse' ),
            ),
            'public'            => true,
            'hierarchical'      => false,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'rewrite'           => array( 'slug' => 'tech' ),
        )
    );
}

add_action( 'init', 'portfolio_fse_register_button_styles' );

/**
 * Register custom block styles for buttons.
 *
 * @return void
 */
function portfolio_fse_register_button_styles() {
    register_block_style(
        'core/button',
        array(
            'name'         => 'primary',
            'label'        => __( 'Primary', 'portfolio-fse' ),
        )
    );

    register_block_style(
        'core/button',
        array(
            'name'         => 'secondary',
            'label'        => __( 'Secondary', 'portfolio-fse' ),
        )
    );
}
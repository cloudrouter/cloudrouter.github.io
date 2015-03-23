<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {
    global $textdomain;

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';
	
	$meta_boxes[] = array(
		'id'         => 'post_options',
		'title'      => 'Post Options',
		'pages'      => array('post'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
           
			
			
			array(
                'name' => 'oembed URL for post format video',
                'desc' => 'Set Intro video',
                'id'   => $prefix . 'intro_video',
                'type'    => 'oembed',
                
            ),
			
			array(
				'name'         => __( 'Post Slider for post gallery', $textdomain ),
				'desc'         => __( 'Set Intro slider gallery', $textdomain ),
				'id'           => $prefix . 'post_slider',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
			
			array(
				'name'         => __( 'Masonry Thumbnail', 'musichub' ),
				'desc'         => 'Just for Template Blog Masonry 1 or NK Blog Element',
				'id'           => $prefix . 'm_thumb',
				'type'         => 'file',
				'preview_size' => array( 200, 100 ), // Default: array( 50, 50 )
			),
		),
	);
	$meta_boxes[] = array(
		'id'         => 'service_options',
		'title'      => 'Service Options',
		'pages'      => array('qk_service'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
           
			array(
                'name' => 'Icon',
                'desc' => 'Icon',
                'id'   => $prefix . 'ser_icon',
                'type'    => 'text',
				'std' => ''
                
            ),
			
			
		),
	);
	$meta_boxes[] = array(
		'id'         => 'testimonial_options',
		'title'      => 'Testimonial Options',
		'pages'      => array('testimonial'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			
			
			array(
				'name'         => __( 'Testimonial Avatar', $textdomain ),
				'desc'         => __( 'Upload your testimonial\'s  Logo.', $textdomain ),
				'id'           => $prefix . 't_logo',
				'type'         => 'file',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'portfolio_options',
		'title'      => 'Portfolio Options',
		'pages'      => array('portfolio'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
            array(
                'name' => 'Portfolio Type',
                'desc' => 'Set Single View Style',
                'id'   => $prefix . 'portfolio_type',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Type 1', 'value' => 'type1', ),
                    array( 'name' => 'Type 2', 'value' => 'type2', ),
                    array( 'name' => 'Type 3', 'value' => 'type3', ),
                    array( 'name' => 'Type 4', 'value' => 'type4', ),
                    )
            ),
			array(
				'name'         => __( 'Portfolio Slider', $textdomain ),
				'desc'         => __( 'Upload or add multiple images/attachments.', $textdomain ),
				'id'           => $prefix . 'p_slider',
				'type'         => 'file_list',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
			
			array(
                'name' => 'Link',
                'desc' => 'link to Project',
                'id'   => $prefix . 'p_link',
                'type'    => 'text',
                
            ),array(
                'name' => 'Client',
                'desc' => 'Your Client',
                'id'   => $prefix . 'p_slient',
                'type'    => 'text',
                
            ),array(
                'name' => 'Copy Right',
                'desc' => 'Your Client',
                'id'   => $prefix . 'p_copy',
                'type'    => 'text',
                
            ),
			
			
		),
	);
	$meta_boxes[] = array(
		'id'         => 'portfolio_options3',
		'title'      => 'Portfolio Options for Masonry and Masonry w Description Template',
		'pages'      => array('portfolio'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
            array(
                'name' => 'Masonry Width',
                'desc' => 'Set Grid With on Masonry Template',
                'id'   => $prefix . 'portfolio_grid',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Default', 'value' => 'size-default', ),
                    array( 'name' => 'Big Thumb', 'value' => 'size-big', ),
                    )
            ),
			array(
				'name'         => __( 'Masonry Thumbnail ', $textdomain ),
				'desc'         => 'Just for Masonry and Masonry w Description Template',
				'id'           => $prefix . 'v_thumb',
				'type'         => 'file',
				'preview_size' => array( 200, 100 ), // Default: array( 50, 50 )
			),
		),
	);
	$meta_boxes[] = array(
		'id'         => 'portfolio_options2',
		'title'      => 'Portfolio Options for Masonry Fullscreen Template',
		'pages'      => array('portfolio'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
           
			array(
                'name' => 'Masonry Width',
                'desc' => 'Set Grid With on Masonry Template',
                'id'   => $prefix . 'portfolio_grid2',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Default', 'value' => 'size-default', ),
                    array( 'name' => 'Big Thumb', 'value' => 'size-big', ),
                    )
            ),
			array(
				'name'         => __( 'Masonry Thumbnail ', $textdomain ),
				'desc'         => 'Just for Fullscreen Template',
				'id'           => $prefix . 'm_thumb',
				'type'         => 'file',
				'preview_size' => array( 200, 100 ), // Default: array( 50, 50 )
			),
		),
	);
	$meta_boxes[] = array(
        'id'         => 'page_setting',
        'title'      => 'Page Setting',
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
             array(
                'name' => 'Turn Off Breadcrumb Section',
                'desc' => 'Select Sidebar position',
                'id'   => $prefix . 'page_breadcrumb',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'No', 'value' => 'no', ),
                    array( 'name' => 'yes', 'value' => 'yes', ),
                    )
            ),
            array(
                'name' => 'Page Full Width',
                'desc' => 'Set Page Full Width',
                'id'   => $prefix . 'page_fullwidth',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'No', 'value' => 'no', ),
                    array( 'name' => 'Yes', 'value' => 'yes', ),
                    )
            ),
            
            array(
                'name' => 'Sidebar Position',
                'desc' => 'Select Sidebar position',
                'id'   => $prefix . 'sidebar_position',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Right', 'value' => 'right', ),
                    array( 'name' => 'Left', 'value' => 'left', ),
                    )
            ),
			array(
                'name' => 'Select Sidebar',
                'desc' => 'Set Page sidebar',
                'id'   => $prefix . 'page_sidebar',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Default', 'value' => 'sidebar-1', ),
                    array( 'name' => 'Shop sidebar', 'value' => 'sidebar-shop', ),
                    )
            ),
			array(
				'name'         => __( 'Heading Background', 'element-backend' ),
				'desc'         => __( 'Upload or add multiple images/attachments.', 'element-backend' ),
				'id'           => $prefix . 'breadcrumb_bg',
				'type'         => 'file',
				'preview_size' => array( 200, 100 ), // Default: array( 50, 50 )
			),
        )
    );
	
	$meta_boxes[] = array(
		'id'         => 'client_options',
		'title'      => 'Client Options',
		'pages'      => array('client'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
           
			array(
                'name' => 'Client Link',
                'desc' => 'Put your link',
                'id'   => $prefix . 'c_link',
                'type'    => 'text',
				'std' => 'http://themeforest.net'
                
            ),
			
			array(
				'name'         => __( 'Client Logo', $textdomain ),
				'desc'         => __( 'Upload your client\'s  Logo.', $textdomain ),
				'id'           => $prefix . 'c_logo',
				'type'         => 'file',
				'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'seo_fields',
		'title'      => 'SEO Fields',
		'pages'      => array( 'page', 'post','portfolio'), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		//'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
		'fields' => array(
			array(
				'name' => 'SEO title',
				'desc' => 'Title for SEO (optional)',
				'id'   => $prefix . 'seo_title',
				'type' => 'text',
			),
            array(
                'name' => 'SEO Keywords',
                'desc' => 'SEO keywords (optional)',
                'id'   => $prefix . 'seo_keywords',
                'type' => 'text',
            ),
            array(
                'name' => 'SEO Description',
                'desc' => 'SEO description (optional)',
                'id'   => $prefix . 'seo_description',
                'type' => 'text',
            ),
		)
	);
	$meta_boxes[] = array(
		'id'         => 'team_options',
		'title'      => 'Team Options',
		'pages'      => array('team'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
           
			array(
                'name' => 'Job',
                'desc' => 'job',
                'id'   => $prefix . 'job',
                'type'    => 'text',
				'std' => 'Webdesigner'
                
            ),
			
			array(
                'name' => 'Social',
                'desc' => 'social',
                'id'   => $prefix . 'social',
                'type'    => 'textarea',
				'std' => '<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
<li><a class="google" href="#"><i class="fa fa-google-plus"></i></a></li>'
                
            ),
			
			array(
				'name'         => __( 'Avatar', $textdomain ),
				'desc'         => __( 'Upload your avatar.', $textdomain ),
				'id'           => $prefix . 'avatar',
				'type'         => 'file',
				'preview_size' => array( 200, 300 ), // Default: array( 50, 50 )
			),
		),
	);
	// Add other metaboxes as needed
	$meta_boxes['user_edit'] = array(
		'id'         => 'user_edit',
		'title'      => __( 'User Profile Metabox', 'cmb' ),
		'pages'      => array( 'user' ), // Tells CMB to use user_meta vs post_meta
		'show_names' => true,
		'cmb_styles' => false, // Show cmb bundled styles.. not needed on user profile page
		'fields'     => array(
			array(
				'name'    => __( 'Avatar', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'avatar',
				'type'    => 'file',
				'save_id' => true,
			),
			array(
				'name'     => __( 'City', 'cmb' ),
				'desc'     => __( 'Your City (optional)', 'cmb' ),
				'id'       => $prefix . 'user_city',
				'type'     => 'text',
				'on_front' => false,
			),
			array(
				'name'     => __( 'Job', 'cmb' ),
				'desc'     => __( 'Your Job (optional)', 'cmb' ),
				'id'       => $prefix . 'user_Job',
				'type'     => 'text',
				'on_front' => false,
			),
		)
	);
	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}

<?php
/**
 * WPBakery Visual Composer Shortcodes settings
 *
 * @package VPBakeryVisualComposer
 *
 */

$vc_is_wp_version_3_6_more = version_compare( preg_replace( '/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo( 'version' ) ), '3.6' ) >= 0;

// Used in "Button", "Call __( 'Blue', 'js_composer' )to Action", "Pie chart" blocks
$colors_arr = array(
	__( 'Grey', 'js_composer' ) => 'wpb_button',
	__( 'Blue', 'js_composer' ) => 'btn-primary',
	__( 'Turquoise', 'js_composer' ) => 'btn-info',
	__( 'Green', 'js_composer' ) => 'btn-success',
	__( 'Orange', 'js_composer' ) => 'btn-warning',
	__( 'Red', 'js_composer' ) => 'btn-danger',
	__( 'Black', 'js_composer' ) => "btn-inverse"
);

// Used in "Button" and "Call to Action" blocks
$size_arr = array(
	__( 'Regular size', 'js_composer' ) => 'wpb_regularsize',
	__( 'Large', 'js_composer' ) => 'btn-large',
	__( 'Small', 'js_composer' ) => 'btn-small',
	__( 'Mini', 'js_composer' ) => "btn-mini"
);

$target_arr = array(
	__( 'Same window', 'js_composer' ) => '_self',
	__( 'New window', 'js_composer' ) => "_blank"
);

$add_css_animation = array(
	'type' => 'dropdown',
	'heading' => __( 'CSS Animation', 'js_composer' ),
	'param_name' => 'css_animation',
	'admin_label' => true,
	'value' => array(
		__( 'No', 'js_composer' ) => '',
		__( 'Top to bottom', 'js_composer' ) => 'top-to-bottom',
		__( 'Bottom to top', 'js_composer' ) => 'bottom-to-top',
		__( 'Left to right', 'js_composer' ) => 'left-to-right',
		__( 'Right to left', 'js_composer' ) => 'right-to-left',
		__( 'Appear from center', 'js_composer' ) => "appear"
	),
	'description' => __( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'js_composer' )
);

vc_map( array(
	'name' => __( 'Row', 'js_composer' ),
	'base' => 'vc_row',
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Place content elements inside the row', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Font Color', 'js_composer' ),
			'param_name' => 'font_color',
			'description' => __( 'Select font color', 'js_composer' ),
			'edit_field_class' => 'vc_col-md-6 vc_column'
		),
		/*
   array(
        'type' => 'colorpicker',
        'heading' => __( 'Custom Background Color', 'js_composer' ),
        'param_name' => 'bg_color',
        'description' => __( 'Select backgound color for your row', 'js_composer' ),
        'edit_field_class' => 'col-md-6'
  ),
  array(
        'type' => 'textfield',
        'heading' => __( 'Padding', 'js_composer' ),
        'param_name' => 'padding',
        'description' => __( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'js_composer' ),
        'edit_field_class' => 'col-md-6'
  ),
  array(
        'type' => 'textfield',
        'heading' => __( 'Bottom margin', 'js_composer' ),
        'param_name' => 'margin_bottom',
        'description' => __( 'You can use px, em, %, etc. or enter just number and it will use pixels.', 'js_composer' ),
        'edit_field_class' => 'col-md-6'
  ),
  array(
        'type' => 'attach_image',
        'heading' => __( 'Background Image', 'js_composer' ),
        'param_name' => 'bg_image',
        'description' => __( 'Select background image for your row', 'js_composer' )
  ),
  array(
        'type' => 'dropdown',
        'heading' => __( 'Background Repeat', 'js_composer' ),
        'param_name' => 'bg_image_repeat',
        'value' => array(
                          __( 'Default', 'js_composer' ) => '',
                          __( 'Cover', 'js_composer' ) => 'cover',
					  __('Contain', 'js_composer') => 'contain',
					  __('No Repeat', 'js_composer') => 'no-repeat'
					),
        'description' => __( 'Select how a background image will be repeated', 'js_composer' ),
        'dependency' => array( 'element' => 'bg_image', 'not_empty' => true)
  ),
  */
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'js_composer' ),
			'param_name' => 'css',
			// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			'group' => __( 'Design options', 'js_composer' )
		)
	),
	'js_view' => 'VcRowView'
) );
vc_map( array(
	'name' => __( 'Row', 'js_composer' ), //Inner Row
	'base' => 'vc_row_inner',
	'content_element' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'weight' => 1000,
	'show_settings_on_create' => false,
	'description' => __( 'Place content elements inside the row', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Font Color', 'js_composer' ),
			'param_name' => 'font_color',
			'description' => __( 'Select font color', 'js_composer' ),
			'edit_field_class' => 'vc_col-md-6 vc_column'
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'js_composer' ),
			'param_name' => 'css',
			// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			'group' => __( 'Design options', 'js_composer' )
		)
	),
	'js_view' => 'VcRowView'
) );
$column_width_list = array(
	__('1 column - 1/12', 'js_composer') => '1/12',
	__('2 columns - 1/6', 'js_composer') => '1/6',
	__('3 columns - 1/4', 'js_composer') => '1/4',
	__('4 columns - 1/3', 'js_composer') => '1/3',
	__('5 columns - 5/12', 'js_composer') => '5/12',
	__('6 columns - 1/2', 'js_composer') => '1/2',
	__('7 columns - 7/12', 'js_composer') => '7/12',
	__('8 columns - 2/3', 'js_composer') => '2/3',
	__('9 columns - 3/4', 'js_composer') => '3/4',
	__('10 columns - 5/6', 'js_composer') => '5/6',
	__('11 columns - 11/12', 'js_composer') => '11/12',
	__('12 columns - 1/1', 'js_composer') => '1/1'
);
vc_map( array(
	'name' => __( 'Column', 'js_composer' ),
	'base' => 'vc_column',
	'is_container' => true,
	'content_element' => false,
	'params' => array(
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Font Color', 'js_composer' ),
			'param_name' => 'font_color',
			'description' => __( 'Select font color', 'js_composer' ),
			'edit_field_class' => 'vc_col-md-6 vc_column'
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'js_composer' ),
			'param_name' => 'css',
			// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			'group' => __( 'Design options', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Width', 'js_composer' ),
			'param_name' => 'width',
			'value' => $column_width_list,
			'group' => __( 'Width & Responsiveness', 'js_composer' ),
			'description' => __( 'Select column width.', 'js_composer' ),
			'std' => '1/1'
		),
		array(
			'type' => 'column_offset',
			'heading' => __('Responsiveness', 'js_composer'),
			'param_name' => 'offset',
			'group' => __( 'Width & Responsiveness', 'js_composer' ),
			'description' => __('Adjust column for different screen sizes. Control width, offset and visibility settings.', 'js_composer')
		)
	),
	'js_view' => 'VcColumnView'
) );

vc_map( array(
	"name" => __( "Column", "js_composer" ),
	"base" => "vc_column_inner",
	"class" => "",
	"icon" => "",
	"wrapper_class" => "",
	"controls" => "full",
	"allowed_container_element" => false,
	"content_element" => false,
	"is_container" => true,
	"params" => array(
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Font Color', 'js_composer' ),
			'param_name' => 'font_color',
			'description' => __( 'Select font color', 'js_composer' ),
			'edit_field_class' => 'vc_col-md-6 vc_column'
		),
		array(
			"type" => "textfield",
			"heading" => __( "Extra class name", "js_composer" ),
			"param_name" => "el_class",
			"value" => "",
			"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
		),
		array(
			"type" => "css_editor",
			"heading" => __( 'Css', "js_composer" ),
			"param_name" => "css",
			// "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
			"group" => __( 'Design options', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Width', 'js_composer' ),
			'param_name' => 'width',
			'value' => $column_width_list,
			'group' => __( 'Width & Responsiveness', 'js_composer' ),
			'description' => __( 'Select column width.', 'js_composer' ),
			'std' => '1/1'
		)
	),
	"js_view" => 'VcColumnView'
) );
/* Text Block
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Text Block', 'js_composer' ),
	'base' => 'vc_column_text',
	'icon' => 'icon-wpb-layer-shape-text',
	'wrapper_class' => 'clearfix',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'A block of text with WYSIWYG editor', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __( 'Text', 'js_composer' ),
			'param_name' => 'content',
			'value' => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'js_composer' )
		),
		$add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'js_composer' ),
			'param_name' => 'css',
			// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			'group' => __( 'Design options', 'js_composer' )
		)
	)
) );

/* Latest tweets
---------------------------------------------------------- */
/*vc_map( array(
    'name' => __( 'Twitter Widget', 'js_composer' ),
    'base' => 'vc_twitter',
    'icon' => 'icon-wpb-balloon-twitter-left',
    'category' => __( 'Social', 'js_composer' ),
    'params' => array(
  array(
        'type' => 'textfield',
        'heading' => __( 'Widget title', 'js_composer' ),
        'param_name' => 'title',
        'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
  ),
  array(
        'type' => 'textfield',
        'heading' => __( 'Twitter username', 'js_composer' ),
        'param_name' => 'twitter_name',
        'admin_label' => true,
        'description' => __( 'Type in twitter profile name from which load tweets.', 'js_composer' )
  ),
  array(
        'type' => 'dropdown',
        'heading' => __( 'Tweets count', 'js_composer' ),
        'param_name' => 'tweets_count',
        'admin_label' => true,
        'value' => array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15),
        'description' => __( 'How many recent tweets to load.', 'js_composer' )
  ),
  array(
        'type' => 'textfield',
        'heading' => __( 'Extra class name', 'js_composer' ),
        'param_name' => 'el_class',
        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
  )
)
) );*/

/* Separator (Divider)
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Separator', 'js_composer' ),
	'base' => 'vc_separator',
	'icon' => 'icon-wpb-ui-separator',
	'show_settings_on_create' => true,
	'category' => __( 'Content', 'js_composer' ),
//"controls"	=> 'popup_delete',
	'description' => __( 'Horizontal separator line', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Color', 'js_composer' ),
			'param_name' => 'color',
			'value' => array_merge( getVcShared( 'colors' ), array( __( 'Custom color', 'js_composer' ) => 'custom' ) ),
			'std' => 'grey',
			'description' => __( 'Separator color.', 'js_composer' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Custom Border Color', 'js_composer' ),
			'param_name' => 'accent_color',
			'description' => __( 'Select border color for your element.', 'js_composer' ),
			'dependency'  => array(
				'element' => 'color',
				'value'   => array( 'custom' )
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Style', 'js_composer' ),
			'param_name' => 'style',
			'value' => getVcShared( 'separator styles' ),
			'description' => __( 'Separator style.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Element width', 'js_composer' ),
			'param_name' => 'el_width',
			'value' => getVcShared( 'separator widths' ),
			'description' => __( 'Separator element width in percents.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/* Textual block
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Separator with Text', 'js_composer' ),
	'base' => 'vc_text_separator',
	'icon' => 'icon-wpb-ui-separator-label',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Horizontal separator line with heading', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'js_composer' ),
			'param_name' => 'title',
			'holder' => 'div',
			'value' => __( 'Title', 'js_composer' ),
			'description' => __( 'Separator title.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Title position', 'js_composer' ),
			'param_name' => 'title_align',
			'value' => array(
				__( 'Align center', 'js_composer' ) => 'separator_align_center',
				__( 'Align left', 'js_composer' ) => 'separator_align_left',
				__( 'Align right', 'js_composer' ) => "separator_align_right"
			),
			'description' => __( 'Select title location.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Color', 'js_composer' ),
			'param_name' => 'color',
			'value' => array_merge( getVcShared( 'colors' ), array( __( 'Custom color', 'js_composer' ) => 'custom' ) ),
			'std' => 'grey',
			'description' => __( 'Separator color.', 'js_composer' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => __( 'Custom Color', 'js_composer' ),
			'param_name'  => 'accent_color',
			'description' => __( 'Custom separator color for your element.', 'js_composer' ),
			'dependency'  => array(
				'element' => 'color',
				'value'   => array( 'custom' )
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Style', 'js_composer' ),
			'param_name' => 'style',
			'value' => getVcShared( 'separator styles' ),
			'description' => __( 'Separator style.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Element width', 'js_composer' ),
			'param_name' => 'el_width',
			'value' => getVcShared( 'separator widths' ),
			'description' => __( 'Separator element width in percents.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	),
	'js_view' => 'VcTextSeparatorView'
) );

/* Message box
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Message Box', 'js_composer' ),
	'base' => 'vc_message',
	'icon' => 'icon-wpb-information-white',
	'wrapper_class' => 'alert',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Notification box', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Message box type', 'js_composer' ),
			'param_name' => 'color',
			'value' => array(
				__( 'Informational', 'js_composer' ) => 'alert-info',
				__( 'Warning', 'js_composer' ) => 'alert-warning',
				__( 'Success', 'js_composer' ) => 'alert-success',
				__( 'Error', 'js_composer' ) => "alert-danger"
			),
			'description' => __( 'Select message type.', 'js_composer' ),
			'param_holder_class' => 'vc_message-type'
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Style', 'js_composer' ),
			'param_name' => 'style',
			'value' => getVcShared( 'alert styles' ),
			'description' => __( 'Alert style.', 'js_composer' )
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'class' => 'messagebox_text',
			'heading' => __( 'Message text', 'js_composer' ),
			'param_name' => 'content',
			'value' => __( '<p>I am message box. Click edit button to change this text.</p>', 'js_composer' )
		),
		$add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	),
	'js_view' => 'VcMessageView'
) );

/* Facebook like button
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Facebook Like', 'js_composer' ),
	'base' => 'vc_facebook',
	'icon' => 'icon-wpb-balloon-facebook-left',
	'category' => __( 'Social', 'js_composer' ),
	'description' => __( 'Facebook like button', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button type', 'js_composer' ),
			'param_name' => 'type',
			'admin_label' => true,
			'value' => array(
				__( 'Standard', 'js_composer' ) => 'standard',
				__( 'Button count', 'js_composer' ) => 'button_count',
				__( 'Box count', 'js_composer' ) => 'box_count'
			),
			'description' => __( 'Select button type.', 'js_composer' )
		)
	)
) );

/* Tweetmeme button
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Tweetmeme Button', 'js_composer' ),
	'base' => 'vc_tweetmeme',
	'icon' => 'icon-wpb-tweetme',
	'category' => __( 'Social', 'js_composer' ),
	'description' => __( 'Share on twitter button', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button type', 'js_composer' ),
			'param_name' => 'type',
			'admin_label' => true,
			'value' => array(
				__( 'Horizontal', 'js_composer' ) => 'horizontal',
				__( 'Vertical', 'js_composer' ) => 'vertical',
				__( 'None', 'js_composer' ) => 'none'
			),
			'description' => __( 'Select button type.', 'js_composer' )
		)
	)
) );

/* Google+ button
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Google+ Button', 'js_composer' ),
	'base' => 'vc_googleplus',
	'icon' => 'icon-wpb-application-plus',
	'category' => __( 'Social', 'js_composer' ),
	'description' => __( 'Recommend on Google', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button size', 'js_composer' ),
			'param_name' => 'type',
			'admin_label' => true,
			'value' => array(
				__( 'Standard', 'js_composer' ) => '',
				__( 'Small', 'js_composer' ) => 'small',
				__( 'Medium', 'js_composer' ) => 'medium',
				__( 'Tall', 'js_composer' ) => 'tall'
			),
			'description' => __( 'Select button size.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Annotation', 'js_composer' ),
			'param_name' => 'annotation',
			'admin_label' => true,
			'value' => array(
				__( 'Inline', 'js_composer' ) => 'inline',
				__( 'Bubble', 'js_composer' ) => '',
				__( 'None', 'js_composer' ) => 'none'
			),
			'description' => __( 'Select type of annotation', 'js_composer' )
		)
	)
) );

/* Pinterest button
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Pinterest', 'js_composer' ),
	'base' => 'vc_pinterest',
	'icon' => 'icon-wpb-pinterest',
	'category' => __( 'Social', 'js_composer' ),
	'description' => __( 'Pinterest button', 'js_composer' ),
	"params" => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button layout', 'js_composer' ),
			'param_name' => 'type',
			'admin_label' => true,
			'value' => array(
				__( 'Horizontal', 'js_composer' ) => '',
				__( 'Vertical', 'js_composer' ) => 'vertical',
				__( 'No count', 'js_composer' ) => 'none' ),
			'description' => __( 'Select button layout.', 'js_composer' )
		)
	)
) );

/* Toggle (FAQ)
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'FAQ', 'js_composer' ),
	'base' => 'vc_toggle',
	'icon' => 'icon-wpb-toggle-small-expand',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Toggle element for Q&A block', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'h4',
			'class' => 'toggle_title',
			'heading' => __( 'Toggle title', 'js_composer' ),
			'param_name' => 'title',
			'value' => __( 'Toggle title', 'js_composer' ),
			'description' => __( 'Toggle block title.', 'js_composer' )
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'class' => 'toggle_content',
			'heading' => __( 'Toggle content', 'js_composer' ),
			'param_name' => 'content',
			'value' => __( '<p>Toggle content goes here, click edit button to change this text.</p>', 'js_composer' ),
			'description' => __( 'Toggle block content.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Default state', 'js_composer' ),
			'param_name' => 'open',
			'value' => array(
				__( 'Closed', 'js_composer' ) => 'false',
				__( 'Open', 'js_composer' ) => 'true'
			),
			'description' => __( 'Select "Open" if you want toggle to be open by default.', 'js_composer' )
		),
		$add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	),
	'js_view' => 'VcToggleView'
) );

/* Single image */
vc_map( array(
	'name' => __( 'Single Image', 'js_composer' ),
	'base' => 'vc_single_image',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Simple image with CSS animation', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'js_composer' ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'js_composer' )
		),
		$add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'js_composer' ),
			'param_name' => 'img_size',
			'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Image alignment', 'js_composer' ),
			'param_name' => 'alignment',
			'value' => array(
				__( 'Align left', 'js_composer' ) => '',
				__( 'Align right', 'js_composer' ) => 'right',
				__( 'Align center', 'js_composer' ) => 'center'
			),
			'description' => __( 'Select image alignment.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Image style', 'js_composer' ),
			'param_name' => 'style',
			'value' => getVcShared( 'single image styles' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Border color', 'js_composer' ),
			'param_name' => 'border_color',
			'value' => getVcShared( 'colors' ),
			'std' => 'grey',
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'vc_box_border', 'vc_box_border_circle', 'vc_box_outline', 'vc_box_outline_circle' )
			),
			'description' => __( 'Border color.', 'js_composer' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Link to large image?', 'js_composer' ),
			'param_name' => 'img_link_large',
			'description' => __( 'If selected, image will be linked to the larger image.', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'href',
			'heading' => __( 'Image link', 'js_composer' ),
			'param_name' => 'link',
			'description' => __( 'Enter URL if you want this image to have a link.', 'js_composer' ),
			'dependency' => array(
				'element' => 'img_link_large',
				'is_empty' => true,
				'callback' => 'wpb_single_image_img_link_dependency_callback'
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Link Target', 'js_composer' ),
			'param_name' => 'img_link_target',
			'value' => $target_arr,
			'dependency' => array(
				'element' => 'img_link',
				'not_empty' => true
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'js_composer' ),
			'param_name' => 'css',
			// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			'group' => __( 'Design options', 'js_composer' )
		)
	)
) );

/* Gallery/Slideshow
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Image Gallery', 'js_composer' ),
	'base' => 'vc_gallery',
	'icon' => 'icon-wpb-images-stack',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Responsive image gallery', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Gallery type', 'js_composer' ),
			'param_name' => 'type',
			'value' => array(
				__( 'Flex slider fade', 'js_composer' ) => 'flexslider_fade',
				__( 'Flex slider slide', 'js_composer' ) => 'flexslider_slide',
				__( 'Nivo slider', 'js_composer' ) => 'nivo',
				__( 'Image grid', 'js_composer' ) => 'image_grid'
			),
			'description' => __( 'Select gallery type.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Auto rotate slides', 'js_composer' ),
			'param_name' => 'interval',
			'value' => array( 3, 5, 10, 15, __( 'Disable', 'js_composer' ) => 0 ),
			'description' => __( 'Auto rotate slides each X seconds.', 'js_composer' ),
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'flexslider_fade', 'flexslider_slide', 'nivo' )
			)
		),
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'js_composer' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'js_composer' ),
			'param_name' => 'img_size',
			'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'On click', 'js_composer' ),
			'param_name' => 'onclick',
			'value' => array(
				__( 'Open prettyPhoto', 'js_composer' ) => 'link_image',
				__( 'Do nothing', 'js_composer' ) => 'link_no',
				__( 'Open custom link', 'js_composer' ) => 'custom_link'
			),
			'description' => __( 'Define action for onclick event if needed.', 'js_composer' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Custom links', 'js_composer' ),
			'param_name' => 'custom_links',
			'description' => __( 'Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'js_composer' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Custom link target', 'js_composer' ),
			'param_name' => 'custom_links_target',
			'description' => __( 'Select where to open  custom links.', 'js_composer' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			),
			'value' => $target_arr
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/* Image Carousel
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Image Carousel', 'js_composer' ),
	'base' => 'vc_images_carousel',
	'icon' => 'icon-wpb-images-carousel',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Animated carousel with images', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'js_composer' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'js_composer' ),
			'param_name' => 'img_size',
			'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'On click', 'js_composer' ),
			'param_name' => 'onclick',
			'value' => array(
				__( 'Open prettyPhoto', 'js_composer' ) => 'link_image',
				__( 'Do nothing', 'js_composer' ) => 'link_no',
				__( 'Open custom link', 'js_composer' ) => 'custom_link'
			),
			'description' => __( 'What to do when slide is clicked?', 'js_composer' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Custom links', 'js_composer' ),
			'param_name' => 'custom_links',
			'description' => __( 'Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'js_composer' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Custom link target', 'js_composer' ),
			'param_name' => 'custom_links_target',
			'description' => __( 'Select where to open  custom links.', 'js_composer' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			),
			'value' => $target_arr
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Slider mode', 'js_composer' ),
			'param_name' => 'mode',
			'value' => array(
				__( 'Horizontal', 'js_composer' ) => 'horizontal',
				__( 'Vertical', 'js_composer' ) => 'vertical'
			),
			'description' => __( 'Slides will be positioned horizontally (for horizontal swipes) or vertically (for vertical swipes)', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Slider speed', 'js_composer' ),
			'param_name' => 'speed',
			'value' => '5000',
			'description' => __( 'Duration of animation between slides (in ms)', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Slides per view', 'js_composer' ),
			'param_name' => 'slides_per_view',
			'value' => '1',
			'description' => __( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode. Supports also "auto" value, in this case it will fit slides depending on container\'s width. "auto" mode isn\'t compatible with loop mode.', 'js_composer' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Slider autoplay', 'js_composer' ),
			'param_name' => 'autoplay',
			'description' => __( 'Enables autoplay mode.', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Hide pagination control', 'js_composer' ),
			'param_name' => 'hide_pagination_control',
			'description' => __( 'If YES pagination control will be removed.', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Hide prev/next buttons', 'js_composer' ),
			'param_name' => 'hide_prev_next_buttons',
			'description' => __( 'If "YES" prev/next control will be removed.', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Partial view', 'js_composer' ),
			'param_name' => 'partial_view',
			'description' => __( 'If "YES" part of the next slide will be visible on the right side.', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Slider loop', 'js_composer' ),
			'param_name' => 'wrap',
			'description' => __( 'Enables loop mode.', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/* Tabs
---------------------------------------------------------- */
$tab_id_1 = time() . '-1-' . rand( 0, 100 );
$tab_id_2 = time() . '-2-' . rand( 0, 100 );
vc_map( array(
	"name" => __( 'Tabs', 'js_composer' ),
	'base' => 'vc_tabs',
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-ui-tab-content',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Tabbed content', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Auto rotate tabs', 'js_composer' ),
			'param_name' => 'interval',
			'value' => array( __( 'Disable', 'js_composer' ) => 0, 3, 5, 10, 15 ),
			'std' => 0,
			'description' => __( 'Auto rotate tabs each X seconds.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	),
	'custom_markup' => '
<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
<ul class="tabs_controls">
</ul>
%content%
</div>'
,
	'default_content' => '
[vc_tab title="' . __( 'Tab 1', 'js_composer' ) . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
[vc_tab title="' . __( 'Tab 2', 'js_composer' ) . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
',
	'js_view' => $vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35'
) );

/* Tour section
---------------------------------------------------------- */
$tab_id_1 = time() . '-1-' . rand( 0, 100 );
$tab_id_2 = time() . '-2-' . rand( 0, 100 );
WPBMap::map( 'vc_tour', array(
	'name' => __( 'Tour', 'js_composer' ),
	'base' => 'vc_tour',
	'show_settings_on_create' => false,
	'is_container' => true,
	'container_not_allowed' => true,
	'icon' => 'icon-wpb-ui-tab-content-vertical',
	'category' => __( 'Content', 'js_composer' ),
	'wrapper_class' => 'vc_clearfix',
	'description' => __( 'Vertical tabbed content', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Auto rotate slides', 'js_composer' ),
			'param_name' => 'interval',
			'value' => array( __( 'Disable', 'js_composer' ) => 0, 3, 5, 10, 15 ),
			'std' => 0,
			'description' => __( 'Auto rotate slides each X seconds.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	),
	'custom_markup' => '
<div class="wpb_tabs_holder wpb_holder vc_clearfix vc_container_for_children">
<ul class="tabs_controls">
</ul>
%content%
</div>'
,
	'default_content' => '
[vc_tab title="' . __( 'Tab 1', 'js_composer' ) . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
[vc_tab title="' . __( 'Tab 2', 'js_composer' ) . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
',
	'js_view' => $vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35'
) );

vc_map( array(
	'name' => __( 'Tab', 'js_composer' ),
	'base' => 'vc_tab',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'content_element' => false,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Tab title.', 'js_composer' )
		),
		array(
			'type' => 'tab_id',
			'heading' => __( 'Tab ID', 'js_composer' ),
			'param_name' => "tab_id"
		)
	),
	'js_view' => $vc_is_wp_version_3_6_more ? 'VcTabView' : 'VcTabView35'
) );

/* Accordion block
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Accordion', 'js_composer' ),
	'base' => 'vc_accordion',
	'show_settings_on_create' => false,
	'is_container' => true,
	'icon' => 'icon-wpb-ui-accordion',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Collapsible content panels', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Active section', 'js_composer' ),
			'param_name' => 'active_tab',
			'description' => __( 'Enter section number to be active on load or enter false to collapse all sections.', 'js_composer' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Allow collapsible all', 'js_composer' ),
			'param_name' => 'collapsible',
			'description' => __( 'Select checkbox to allow all sections to be collapsible.', 'js_composer' ),
			'value' => array( __( 'Allow', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	),
	'custom_markup' => '
<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
%content%
</div>
<div class="tab_controls">
    <a class="add_tab" title="' . __( 'Add section', 'js_composer' ) . '"><span class="vc_icon"></span> <span class="tab-label">' . __( 'Add section', 'js_composer' ) . '</span></a>
</div>
',
	'default_content' => '
    [vc_accordion_tab title="' . __( 'Section 1', 'js_composer' ) . '"][/vc_accordion_tab]
    [vc_accordion_tab title="' . __( 'Section 2', 'js_composer' ) . '"][/vc_accordion_tab]
',
	'js_view' => 'VcAccordionView'
) );
vc_map( array(
	'name' => __( 'Section', 'js_composer' ),
	'base' => 'vc_accordion_tab',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'content_element' => false,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Accordion section title.', 'js_composer' )
		),
	),
	'js_view' => 'VcAccordionTabView'
) );

/* Teaser grid
* @deprecated please use vc_posts_grid
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Teaser (posts) Grid', 'js_composer' ),
	'base' => 'vc_teaser_grid',
	'content_element' => false,
	'icon' => 'icon-wpb-application-icon-large',
	'category' => __( 'Content', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns count', 'js_composer' ),
			'param_name' => 'grid_columns_count',
			'value' => array( 4, 3, 2, 1 ),
			'admin_label' => true,
			'description' => __( 'Select columns count.', 'js_composer' )
		),
		array(
			'type' => 'posttypes',
			'heading' => __( 'Post types', 'js_composer' ),
			'param_name' => 'grid_posttypes',
			'description' => __( 'Select post types to populate posts from.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Teasers count', 'js_composer' ),
			'param_name' => 'grid_teasers_count',
			'description' => __( 'How many teasers to show? Enter number or word "All".', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content', 'js_composer' ),
			'param_name' => 'grid_content',
			'value' => array(
				__( 'Teaser (Excerpt)', 'js_composer' ) => 'teaser',
				__( 'Full Content', 'js_composer' ) => 'content'
			),
			'description' => __( 'Teaser layout template.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Layout', 'js_composer' ),
			'param_name' => 'grid_layout',
			'value' => array(
				__( 'Title + Thumbnail + Text', 'js_composer' ) => 'title_thumbnail_text',
				__( 'Thumbnail + Title + Text', 'js_composer' ) => 'thumbnail_title_text',
				__( 'Thumbnail + Text', 'js_composer' ) => 'thumbnail_text',
				__( 'Thumbnail + Title', 'js_composer' ) => 'thumbnail_title',
				__( 'Thumbnail only', 'js_composer' ) => 'thumbnail',
				__( 'Title + Text', 'js_composer' ) => 'title_text' ),
			'description' => __( 'Teaser layout.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Link', 'js_composer' ),
			'param_name' => 'grid_link',
			'value' => array(
				__( 'Link to post', 'js_composer' ) => 'link_post',
				__( 'Link to bigger image', 'js_composer' ) => 'link_image',
				__( 'Thumbnail to bigger image, title to post', 'js_composer' ) => 'link_image_post',
				__( 'No link', 'js_composer' ) => 'link_no'
			),
			'description' => __( 'Link type.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Link target', 'js_composer' ),
			'param_name' => 'grid_link_target',
			'value' => $target_arr,
			'dependency' => array(
				'element' => 'grid_link',
				'value' => array( 'link_post', 'link_image_post' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Teaser grid layout', 'js_composer' ),
			'param_name' => 'grid_template',
			'value' => array(
				__( 'Grid', 'js_composer' ) => 'grid',
				__( 'Grid with filter', 'js_composer' ) => 'filtered_grid',
				__( 'Carousel', 'js_composer' ) => 'carousel'
			),
			'description' => __( 'Teaser layout template.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Layout mode', 'js_composer' ),
			'param_name' => 'grid_layout_mode',
			'value' => array(
				__( 'Fit rows', 'js_composer' ) => 'fitRows',
				__( 'Masonry', 'js_composer' ) => 'masonry'
			),
			'dependency' => array(
				'element' => 'grid_template',
				'value' => array( 'filtered_grid', 'grid' )
			),
			'description' => __( 'Teaser layout template.', 'js_composer' )
		),
		array(
			'type' => 'taxonomies',
			'heading' => __( 'Taxonomies', 'js_composer' ),
			'param_name' => 'grid_taxomonies',
			'dependency' => array(
				'element' => 'grid_template',
				// 'not_empty' => true,
				'value' => array( 'filtered_grid' ),
				'callback' => 'wpb_grid_post_types_for_taxonomies_handler'
			),
			'description' => __( 'Select taxonomies.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Thumbnail size', 'js_composer' ),
			'param_name' => 'grid_thumb_size',
			'description' => __( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Post/Page IDs', 'js_composer' ),
			'param_name' => 'posts_in',
			'description' => __( 'Fill this field with page/posts IDs separated by commas (,) to retrieve only them. Use this in conjunction with "Post types" field.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Exclude Post/Page IDs', 'js_composer' ),
			'param_name' => 'posts_not_in',
			'description' => __( 'Fill this field with page/posts IDs separated by commas (,) to exclude them from query.', 'js_composer' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Categories', 'js_composer' ),
			'param_name' => 'grid_categories',
			'description' => __( 'If you want to narrow output, enter category names here. Note: Only listed categories will be included. Divide categories with linebreaks (Enter) . ', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', 'js_composer' ),
			'param_name' => 'orderby',
			'value' => array(
				'',
				__( 'Date', 'js_composer' ) => 'date',
				__( 'ID', 'js_composer' ) => 'ID',
				__( 'Author', 'js_composer' ) => 'author',
				__( 'Title', 'js_composer' ) => 'title',
				__( 'Modified', 'js_composer' ) => 'modified',
				__( 'Random', 'js_composer' ) => 'rand',
				__( 'Comment count', 'js_composer' ) => 'comment_count',
				__( 'Menu order', 'js_composer' ) => 'menu_order'
			),
			'description' => sprintf( __( 'Select how to sort retrieved posts. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order way', 'js_composer' ),
			'param_name' => 'order',
			'value' => array(
				__( 'Descending', 'js_composer' ) => 'DESC',
				__( 'Ascending', 'js_composer' ) => 'ASC'
			),
			'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/* Posts Grid
---------------------------------------------------------- */
$vc_layout_sub_controls = array(
	array( 'link_post', __( 'Link to post', 'js_composer' ) ),
	array( 'no_link', __( 'No link', 'js_composer' ) ),
	array( 'link_image', __( 'Link to bigger image', 'js_composer' ) )
);
vc_map( array(
	'name' => __( 'Posts Grid', 'js_composer' ),
	'base' => 'vc_posts_grid',
	'icon' => 'icon-wpb-application-icon-large',
	'description' => __( 'Posts in grid view', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'loop',
			'heading' => __( 'Grids content', 'js_composer' ),
			'param_name' => 'loop',
			'settings' => array(
				'size' => array( 'hidden' => false, 'value' => 10 ),
				'order_by' => array( 'value' => 'date' ),
			),
			'description' => __( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns count', 'js_composer' ),
			'param_name' => 'grid_columns_count',
			'value' => array( 6, 4, 3, 2, 1 ),
			'std' => 3,
			'admin_label' => true,
			'description' => __( 'Select columns count.', 'js_composer' )
		),
		array(
			'type' => 'sorted_list',
			'heading' => __( 'Teaser layout', 'js_composer' ),
			'param_name' => 'grid_layout',
			'description' => __( 'Control teasers look. Enable blocks and place them in desired order. Note: This setting can be overrriden on post to post basis.', 'js_composer' ),
			'value' => 'title,image,text',
			'options' => array(
				array( 'image', __( 'Thumbnail', 'js_composer' ), $vc_layout_sub_controls ),
				array( 'title', __( 'Title', 'js_composer' ), $vc_layout_sub_controls ),
				array( 'text', __( 'Text', 'js_composer' ), array(
					array( 'excerpt', __( 'Teaser/Excerpt', 'js_composer' ) ),
					array( 'text', __( 'Full content', 'js_composer' ) )
				) ),
				array( 'link', __( 'Read more link', 'js_composer' ) )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Link target', 'js_composer' ),
			'param_name' => 'grid_link_target',
			'value' => $target_arr,
			// 'dependency' => array(
			//     'element' => 'grid_link',
			//     'value' => array( 'link_post', 'link_image_post' )
			// )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Show filter', 'js_composer' ),
			'param_name' => 'filter',
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
			'description' => __( 'Select to add animated category filter to your posts grid.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Layout mode', 'js_composer' ),
			'param_name' => 'grid_layout_mode',
			'value' => array(
				__( 'Fit rows', 'js_composer' ) => 'fitRows',
				__( 'Masonry', 'js_composer' ) => 'masonry'
			),
			'description' => __( 'Teaser layout template.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Thumbnail size', 'js_composer' ),
			'param_name' => 'grid_thumb_size',
			'description' => __( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
// 'html_template' => dirname(__DIR__).'/composer/shortcodes_templates/vc_posts_grid.php'
) );

/* Post Carousel
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Post Carousel', 'vc_extend' ),
	'base' => 'vc_carousel',
	'class' => '',
	'icon' => 'icon-wpb-vc_carousel',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Animated carousel with posts', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'loop',
			'heading' => __( 'Carousel content', 'js_composer' ),
			'param_name' => 'posts_query',
			'settings' => array(
				'size' => array( 'hidden' => false, 'value' => 10 ),
				'order_by' => array( 'value' => 'date' )
			),
			'description' => __( 'Create WordPress loop, to populate content from your site.', 'js_composer' )
		),
		array(
			'type' => 'sorted_list',
			'heading' => __( 'Teaser layout', 'js_composer' ),
			'param_name' => 'layout',
			'description' => __( 'Control teasers look. Enable blocks and place them in desired order. Note: This setting can be overrriden on post to post basis.', 'js_composer' ),
			'value' => 'title,image,text',
			'options' => array(
				array( 'image', __( 'Thumbnail', 'js_composer' ), $vc_layout_sub_controls ),
				array( 'title', __( 'Title', 'js_composer' ), $vc_layout_sub_controls ),
				array( 'text', __( 'Text', 'js_composer' ), array(
					array( 'excerpt', __( 'Teaser/Excerpt', 'js_composer' ) ),
					array( 'text', __( 'Full content', 'js_composer' ) )
				) ),
				array( 'link', __( 'Read more link', 'js_composer' ) )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Link target', 'js_composer' ),
			'param_name' => 'link_target',
			'value' => $target_arr,
			// 'dependency' => array( 'element' => 'link', 'value' => array( 'link_post', 'link_image_post', 'link_image' ) )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Thumbnail size', 'js_composer' ),
			'param_name' => 'thumb_size',
			'description' => __( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Slider speed', 'js_composer' ),
			'param_name' => 'speed',
			'value' => '5000',
			'description' => __( 'Duration of animation between slides (in ms)', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Slider mode', 'js_composer' ),
			'param_name' => 'mode',
			'value' => array( __( 'Horizontal', 'js_composer' ) => 'horizontal', __( 'Vertical', 'js_composer' ) => 'vertical' ),
			'description' => __( 'Slides will be positioned horizontally (for horizontal swipes) or vertically (for vertical swipes)', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Slides per view', 'js_composer' ),
			'param_name' => 'slides_per_view',
			'value' => '1',
			'description' => __( 'Set numbers of slides you want to display at the same time on slider\'s container for carousel mode. Also supports for "auto" value, in this case it will fit slides depending on container\'s width. "auto" mode doesn\'t compatible with loop mode.', 'js_composer' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Slider autoplay', 'js_composer' ),
			'param_name' => 'autoplay',
			'description' => __( 'Enables autoplay mode.', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Hide pagination control', 'js_composer' ),
			'param_name' => 'hide_pagination_control',
			'description' => __( 'If "YES" pagination control will be removed', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Hide prev/next buttons', 'js_composer' ),
			'param_name' => 'hide_prev_next_buttons',
			'description' => __( 'If "YES" prev/next control will be removed', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Partial view', 'js_composer' ),
			'param_name' => 'partial_view',
			'description' => __( 'If "YES" part of the next slide will be visible on the right side', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Slider loop', 'js_composer' ),
			'param_name' => 'wrap',
			'description' => __( 'Enables loop mode.', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );


/* Posts slider
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Posts Slider', 'js_composer' ),
	'base' => 'vc_posts_slider',
	'icon' => 'icon-wpb-slideshow',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Slider with WP Posts', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Slider type', 'js_composer' ),
			'param_name' => 'type',
			'admin_label' => true,
			'value' => array(
				__( 'Flex slider fade', 'js_composer' ) => 'flexslider_fade',
				__( 'Flex slider slide', 'js_composer' ) => 'flexslider_slide',
				__( 'Nivo slider', 'js_composer' ) => 'nivo'
			),
			'description' => __( 'Select slider type.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Slides count', 'js_composer' ),
			'param_name' => 'count',
			'description' => __( 'How many slides to show? Enter number or word "All".', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Auto rotate slides', 'js_composer' ),
			'param_name' => 'interval',
			'value' => array( 3, 5, 10, 15, __( 'Disable', 'js_composer' ) => 0 ),
			'description' => __( 'Auto rotate slides each X seconds.', 'js_composer' )
		),
		array(
			'type' => 'posttypes',
			'heading' => __( 'Post types', 'js_composer' ),
			'param_name' => 'posttypes',
			'description' => __( 'Select post types to populate posts from.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Description', 'js_composer' ),
			'param_name' => 'slides_content',
			'value' => array(
				__( 'No description', 'js_composer' ) => '',
				__( 'Teaser (Excerpt)', 'js_composer' ) => 'teaser'
			),
			'description' => __( 'Some sliders support description text, what content use for it?', 'js_composer' ),
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'flexslider_fade', 'flexslider_slide' )
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Output post title?', 'js_composer' ),
			'param_name' => 'slides_title',
			'description' => __( 'If selected, title will be printed before the teaser text.', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => true ),
			'dependency' => array(
				'element' => 'slides_content',
				'value' => array( 'teaser' )
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Link', 'js_composer' ),
			'param_name' => 'link',
			'value' => array(
				__( 'Link to post', 'js_composer' ) => 'link_post',
				__( 'Link to bigger image', 'js_composer' ) => 'link_image',
				__( 'Open custom link', 'js_composer' ) => 'custom_link',
				__( 'No link', 'js_composer' ) => 'link_no'
			),
			'description' => __( 'Link type.', 'js_composer' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Custom links', 'js_composer' ),
			'param_name' => 'custom_links',
			'dependency' => array( 'element' => 'link', 'value' => 'custom_link' ),
			'description' => __( 'Enter links for each slide here. Divide links with linebreaks (Enter).', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Thumbnail size', 'js_composer' ),
			'param_name' => 'thumb_size',
			'description' => __( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Post/Page IDs', 'js_composer' ),
			'param_name' => 'posts_in',
			'description' => __( 'Fill this field with page/posts IDs separated by commas (,), to retrieve only them. Use this in conjunction with "Post types" field.', 'js_composer' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Categories', 'js_composer' ),
			'param_name' => 'categories',
			'description' => __( 'If you want to narrow output, enter category names here. Note: Only listed categories will be included. Divide categories with linebreaks (Enter) . ', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', 'js_composer' ),
			'param_name' => 'orderby',
			'value' => array(
				'',
				__( 'Date', 'js_composer' ) => 'date',
				__( 'ID', 'js_composer' ) => 'ID',
				__( 'Author', 'js_composer' ) => 'author',
				__( 'Title', 'js_composer' ) => 'title',
				__( 'Modified', 'js_composer' ) => 'modified',
				__( 'Random', 'js_composer' ) => 'rand',
				__( 'Comment count', 'js_composer' ) => 'comment_count',
				__( 'Menu order', 'js_composer' ) => 'menu_order'
			),
			'description' => sprintf( __( 'Select how to sort retrieved posts. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', 'js_composer' ),
			'param_name' => 'order',
			'value' => array(
				__( 'Descending', 'js_composer' ) => 'DESC',
				__( 'Ascending', 'js_composer' ) => 'ASC'
			),
			'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/* Widgetised sidebar
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Widgetised Sidebar', 'js_composer' ),
	'base' => 'vc_widget_sidebar',
	'class' => 'wpb_widget_sidebar_widget',
	'icon' => 'icon-wpb-layout_sidebar',
	'category' => __( 'Structure', 'js_composer' ),
	'description' => __( 'Place widgetised sidebar', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'widgetised_sidebars',
			'heading' => __( 'Sidebar', 'js_composer' ),
			'param_name' => 'sidebar_id',
			'description' => __( 'Select which widget area output.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/* Button
---------------------------------------------------------- */
$icons_arr = array(
	__( 'None', 'js_composer' ) => 'none',
	__( 'Address book icon', 'js_composer' ) => 'wpb_address_book',
	__( 'Alarm clock icon', 'js_composer' ) => 'wpb_alarm_clock',
	__( 'Anchor icon', 'js_composer' ) => 'wpb_anchor',
	__( 'Application Image icon', 'js_composer' ) => 'wpb_application_image',
	__( 'Arrow icon', 'js_composer' ) => 'wpb_arrow',
	__( 'Asterisk icon', 'js_composer' ) => 'wpb_asterisk',
	__( 'Hammer icon', 'js_composer' ) => 'wpb_hammer',
	__( 'Balloon icon', 'js_composer' ) => 'wpb_balloon',
	__( 'Balloon Buzz icon', 'js_composer' ) => 'wpb_balloon_buzz',
	__( 'Balloon Facebook icon', 'js_composer' ) => 'wpb_balloon_facebook',
	__( 'Balloon Twitter icon', 'js_composer' ) => 'wpb_balloon_twitter',
	__( 'Battery icon', 'js_composer' ) => 'wpb_battery',
	__( 'Binocular icon', 'js_composer' ) => 'wpb_binocular',
	__( 'Document Excel icon', 'js_composer' ) => 'wpb_document_excel',
	__( 'Document Image icon', 'js_composer' ) => 'wpb_document_image',
	__( 'Document Music icon', 'js_composer' ) => 'wpb_document_music',
	__( 'Document Office icon', 'js_composer' ) => 'wpb_document_office',
	__( 'Document PDF icon', 'js_composer' ) => 'wpb_document_pdf',
	__( 'Document Powerpoint icon', 'js_composer' ) => 'wpb_document_powerpoint',
	__( 'Document Word icon', 'js_composer' ) => 'wpb_document_word',
	__( 'Bookmark icon', 'js_composer' ) => 'wpb_bookmark',
	__( 'Camcorder icon', 'js_composer' ) => 'wpb_camcorder',
	__( 'Camera icon', 'js_composer' ) => 'wpb_camera',
	__( 'Chart icon', 'js_composer' ) => 'wpb_chart',
	__( 'Chart pie icon', 'js_composer' ) => 'wpb_chart_pie',
	__( 'Clock icon', 'js_composer' ) => 'wpb_clock',
	__( 'Fire icon', 'js_composer' ) => 'wpb_fire',
	__( 'Heart icon', 'js_composer' ) => 'wpb_heart',
	__( 'Mail icon', 'js_composer' ) => 'wpb_mail',
	__( 'Play icon', 'js_composer' ) => 'wpb_play',
	__( 'Shield icon', 'js_composer' ) => 'wpb_shield',
	__( 'Video icon', 'js_composer' ) => "wpb_video"
);

vc_map( array(
	'name' => __( 'Button', 'js_composer' ),
	'base' => 'vc_button',
	'icon' => 'icon-wpb-ui-button',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Eye catching button', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Text on the button', 'js_composer' ),
			'holder' => 'button',
			'class' => 'wpb_button',
			'param_name' => 'title',
			'value' => __( 'Text on the button', 'js_composer' ),
			'description' => __( 'Text on the button.', 'js_composer' )
		),
		array(
			'type' => 'href',
			'heading' => __( 'URL (Link)', 'js_composer' ),
			'param_name' => 'href',
			'description' => __( 'Button link.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Target', 'js_composer' ),
			'param_name' => 'target',
			'value' => $target_arr,
			'dependency' => array( 'element'=>'href', 'not_empty'=>true, 'callback' => 'vc_button_param_target_callback' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Color', 'js_composer' ),
			'param_name' => 'color',
			'value' => $colors_arr,
			'description' => __( 'Button color.', 'js_composer' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Icon', 'js_composer' ),
			'param_name' => 'icon',
			'value' => $icons_arr,
			'description' => __( 'Button icon.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Size', 'js_composer' ),
			'param_name' => 'size',
			'value' => $size_arr,
			'description' => __( 'Button size.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	),
	'js_view' => 'VcButtonView'
) );

vc_map( array(
	'name' => __( 'Button', 'js_composer' ) . " 2",
	'base' => 'vc_button2',
	'icon' => 'icon-wpb-ui-button',
	'category' => array(
		__( 'Content', 'js_composer' )),
	'description' => __( 'Eye catching button', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'vc_link',
			'heading' => __( 'URL (Link)', 'js_composer' ),
			'param_name' => 'link',
			'description' => __( 'Button link.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Text on the button', 'js_composer' ),
			'holder' => 'button',
			'class' => 'vc_btn',
			'param_name' => 'title',
			'value' => __( 'Text on the button', 'js_composer' ),
			'description' => __( 'Text on the button.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Style', 'js_composer' ),
			'param_name' => 'style',
			'value' => getVcShared( 'button styles' ),
			'description' => __( 'Button style.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Color', 'js_composer' ),
			'param_name' => 'color',
			'value' => getVcShared( 'colors' ),
			'description' => __( 'Button color.', 'js_composer' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		/*array(
        'type' => 'dropdown',
        'heading' => __( 'Icon', 'js_composer' ),
        'param_name' => 'icon',
        'value' => getVcShared( 'icons' ),
        'description' => __( 'Button icon.', 'js_composer' )
  ),*/
		array(
			'type' => 'dropdown',
			'heading' => __( 'Size', 'js_composer' ),
			'param_name' => 'size',
			'value' => getVcShared( 'sizes' ),
			'std' => 'md',
			'description' => __( 'Button size.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	),
	'js_view' => 'VcButton2View'
) );

/* Call to Action Button
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Call to Action Button', 'js_composer' ),
	'base' => 'vc_cta_button',
	'icon' => 'icon-wpb-call-to-action',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Catch visitors attention with CTA block', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textarea',
			'admin_label' => true,
			'heading' => __( 'Text', 'js_composer' ),
			'param_name' => 'call_text',
			'value' => __( 'Click edit button to change this text.', 'js_composer' ),
			'description' => __( 'Enter your content.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Text on the button', 'js_composer' ),
			'param_name' => 'title',
			'value' => __( 'Text on the button', 'js_composer' ),
			'description' => __( 'Text on the button.', 'js_composer' )
		),
		array(
			'type' => 'href',
			'heading' => __( 'URL (Link)', 'js_composer' ),
			'param_name' => 'href',
			'description' => __( 'Button link.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Target', 'js_composer' ),
			'param_name' => 'target',
			'value' => $target_arr,
			'dependency' => array( 'element' => 'href', 'not_empty' => true, 'callback' => 'vc_cta_button_param_target_callback' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Color', 'js_composer' ),
			'param_name' => 'color',
			'value' => $colors_arr,
			'description' => __( 'Button color.', 'js_composer' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Icon', 'js_composer' ),
			'param_name' => 'icon',
			'value' => $icons_arr,
			'description' => __( 'Button icon.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Size', 'js_composer' ),
			'param_name' => 'size',
			'value' => $size_arr,
			'description' => __( 'Button size.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button position', 'js_composer' ),
			'param_name' => 'position',
			'value' => array(
				__( 'Align right', 'js_composer' ) => 'cta_align_right',
				__( 'Align left', 'js_composer' ) => 'cta_align_left',
				__( 'Align bottom', 'js_composer' ) => 'cta_align_bottom'
			),
			'description' => __( 'Select button alignment.', 'js_composer' )
		),
		$add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	),
	'js_view' => 'VcCallToActionView'
) );

vc_map( array(
	'name' => __( 'Call to Action Button', 'js_composer' ) . ' 2',
	'base' => 'vc_cta_button2',
	'icon' => 'icon-wpb-call-to-action',
	'category' => array( __( 'Content', 'js_composer' ) ),
	'description' => __( 'Catch visitors attention with CTA block', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Heading first line', 'js_composer' ),
			'admin_label' => true,
			//'holder' => 'h2',
			'param_name' => 'h2',
			'value' => __( 'Hey! I am first heading line feel free to change me', 'js_composer' ),
			'description' => __( 'Text for the first heading line.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Heading second line', 'js_composer' ),
			//'holder' => 'h4',
			//'admin_label' => true,
			'param_name' => 'h4',
			'value' => '',
			'description' => __( 'Optional text for the second heading line.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'CTA style', 'js_composer' ),
			'param_name' => 'style',
			'value' => getVcShared( 'cta styles' ),
			'description' => __( 'Call to action style.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Element width', 'js_composer' ),
			'param_name' => 'el_width',
			'value' => getVcShared( 'cta widths' ),
			'description' => __( 'Call to action element width in percents.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text align', 'js_composer' ),
			'param_name' => 'txt_align',
			'value' => getVcShared( 'text align' ),
			'description' => __( 'Text align in call to action block.', 'js_composer' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Custom Background Color', 'js_composer' ),
			'param_name' => 'accent_color',
			'description' => __( 'Select background color for your element.', 'js_composer' )
		),
		array(
			'type' => 'textarea_html',
			//holder' => 'div',
			//'admin_label' => true,
			'heading' => __( 'Promotional text', 'js_composer' ),
			'param_name' => 'content',
			'value' => __( 'I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'js_composer' )
		),
		array(
			'type' => 'vc_link',
			'heading' => __( 'URL (Link)', 'js_composer' ),
			'param_name' => 'link',
			'description' => __( 'Button link.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Text on the button', 'js_composer' ),
			//'holder' => 'button',
			//'class' => 'wpb_button',
			'param_name' => 'title',
			'value' => __( 'Text on the button', 'js_composer' ),
			'description' => __( 'Text on the button.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button style', 'js_composer' ),
			'param_name' => 'btn_style',
			'value' => getVcShared( 'button styles' ),
			'description' => __( 'Button style.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Color', 'js_composer' ),
			'param_name' => 'color',
			'value' => getVcShared( 'colors' ),
			'description' => __( 'Button color.', 'js_composer' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		/*array(
        'type' => 'dropdown',
        'heading' => __( 'Icon', 'js_composer' ),
        'param_name' => 'icon',
        'value' => getVcShared( 'icons' ),
        'description' => __( 'Button icon.', 'js_composer' )
  ),*/
		array(
			'type' => 'dropdown',
			'heading' => __( 'Size', 'js_composer' ),
			'param_name' => 'size',
			'value' => getVcShared( 'sizes' ),
			'std' => 'md',
			'description' => __( 'Button size.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button position', 'js_composer' ),
			'param_name' => 'position',
			'value' => array(
				__( 'Align right', 'js_composer' ) => 'right',
				__( 'Align left', 'js_composer' ) => 'left',
				__( 'Align bottom', 'js_composer' ) => 'bottom'
			),
			'description' => __( 'Select button alignment.', 'js_composer' )
		),
		$add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/* Video element
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Video Player', 'js_composer' ),
	'base' => 'vc_video',
	'icon' => 'icon-wpb-film-youtube',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Embed YouTube/Vimeo player', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Video link', 'js_composer' ),
			'param_name' => 'link',
			'admin_label' => true,
			'description' => sprintf( __( 'Link to the video. More about supported formats at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'js_composer' ),
			'param_name' => 'css',
			// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			'group' => __( 'Design options', 'js_composer' )
		)
	)
) );

/* Google maps element
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Google Maps', 'js_composer' ),
	'base' => 'vc_gmaps',
	'icon' => 'icon-wpb-map-pin',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Map block', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'textarea_safe',
			'heading' => __( 'Map embed iframe', 'js_composer' ),
			'param_name' => 'link',
			'description' => sprintf( __( 'Visit %s to create your map. 1) Find location 2) Click "Share" and make sure map is public on the web 3) Click folder icon to reveal "Embed on my site" link 4) Copy iframe code and paste it here.', 'js_composer' ), '<a href="https://mapsengine.google.com/" target="_blank">Google maps</a>' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Map height', 'js_composer' ),
			'param_name' => 'size',
			'admin_label' => true,
			'description' => __( 'Enter map height in pixels. Example: 200 or leave it empty to make map responsive.', 'js_composer' )
		),
		/*array(
        'type' => 'dropdown',
        'heading' => __( 'Map type', 'js_composer' ),
        'param_name' => 'type',
        'value' => array( __( 'Map', 'js_composer' ) => 'm', __( 'Satellite', 'js_composer' ) => 'k', __( 'Map + Terrain', 'js_composer' ) => "p" ),
        'description' => __( 'Select map type.', 'js_composer' )
  ),
  array(
        'type' => 'dropdown',
        'heading' => __( 'Map Zoom', 'js_composer' ),
        'param_name' => 'zoom',
        'value' => array( __( '14 - Default', 'js_composer' ) => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
  ),
  array(
        'type' => 'checkbox',
        'heading' => __( 'Remove info bubble', 'js_composer' ),
        'param_name' => 'bubble',
        'description' => __( 'If selected, information bubble will be hidden.', 'js_composer' ),
        'value' => array( __( 'Yes, please', 'js_composer' ) => true),
  ),*/
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/* Raw HTML
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Raw HTML', 'js_composer' ),
	'base' => 'vc_raw_html',
	'icon' => 'icon-wpb-raw-html',
	'category' => __( 'Structure', 'js_composer' ),
	'wrapper_class' => 'clearfix',
	'description' => __( 'Output raw html code on your page', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textarea_raw_html',
			'holder' => 'div',
			'heading' => __( 'Raw HTML', 'js_composer' ),
			'param_name' => 'content',
			'value' => base64_encode( '<p>I am raw html block.<br/>Click edit button to change this html</p>' ),
			'description' => __( 'Enter your HTML content.', 'js_composer' )
		),
	)
) );

/* Raw JS
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Raw JS', 'js_composer' ),
	'base' => 'vc_raw_js',
	'icon' => 'icon-wpb-raw-javascript',
	'category' => __( 'Structure', 'js_composer' ),
	'wrapper_class' => 'clearfix',
	'description' => __( 'Output raw javascript code on your page', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textarea_raw_html',
			'holder' => 'div',
			'heading' => __( 'Raw js', 'js_composer' ),
			'param_name' => 'content',
			'value' => __( base64_encode( '<script type="text/javascript"> alert("Enter your js here!" ); </script>' ), 'js_composer' ),
			'description' => __( 'Enter your JS code.', 'js_composer' )
		),
	)
) );

/* Flickr
---------------------------------------------------------- */
vc_map( array(
	'base' => 'vc_flickr',
	'name' => __( 'Flickr Widget', 'js_composer' ),
	'icon' => 'icon-wpb-flickr',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Image feed from your flickr account', 'js_composer' ),
	"params" => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Flickr ID', 'js_composer' ),
			'param_name' => 'flickr_id',
			'admin_label' => true,
			'description' => sprintf( __( 'To find your flickID visit %s.', 'js_composer' ), '<a href="http://idgettr.com/" target="_blank">idGettr</a>' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Number of photos', 'js_composer' ),
			'param_name' => 'count',
			'value' => array( 9, 8, 7, 6, 5, 4, 3, 2, 1 ),
			'description' => __( 'Number of photos.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Type', 'js_composer' ),
			'param_name' => 'type',
			'value' => array(
				__( 'User', 'js_composer' ) => 'user',
				__( 'Group', 'js_composer' ) => 'group'
			),
			'description' => __( 'Photo stream type.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Display', 'js_composer' ),
			'param_name' => 'display',
			'value' => array(
				__( 'Latest', 'js_composer' ) => 'latest',
				__( 'Random', 'js_composer' ) => 'random'
			),
			'description' => __( 'Photo order.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );


/* Graph
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Progress Bar', 'js_composer' ),
	'base' => 'vc_progress_bar',
	'icon' => 'icon-wpb-graph',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Animated progress bar', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Graphic values', 'js_composer' ),
			'param_name' => 'values',
			'description' => __( 'Input graph values, titles and color here. Divide values with linebreaks (Enter). Example: 90|Development|#e75956', 'js_composer' ),
			'value' => "90|Development,80|Design,70|Marketing"
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Units', 'js_composer' ),
			'param_name' => 'units',
			'description' => __( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Bar color', 'js_composer' ),
			'param_name' => 'bgcolor',
			'value' => array(
				__( 'Grey', 'js_composer' ) => 'bar_grey',
				__( 'Blue', 'js_composer' ) => 'bar_blue',
				__( 'Turquoise', 'js_composer' ) => 'bar_turquoise',
				__( 'Green', 'js_composer' ) => 'bar_green',
				__( 'Orange', 'js_composer' ) => 'bar_orange',
				__( 'Red', 'js_composer' ) => 'bar_red',
				__( 'Black', 'js_composer' ) => 'bar_black',
				__( 'Custom Color', 'js_composer' ) => 'custom'
			),
			'description' => __( 'Select bar background color.', 'js_composer' ),
			'admin_label' => true
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Bar custom color', 'js_composer' ),
			'param_name' => 'custombgcolor',
			'description' => __( 'Select custom background color for bars.', 'js_composer' ),
			'dependency' => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Options', 'js_composer' ),
			'param_name' => 'options',
			'value' => array(
				__( 'Add Stripes?', 'js_composer' ) => 'striped',
				__( 'Add animation? Will be visible with striped bars.', 'js_composer' ) => 'animated'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/**
 * Pie chart
 */
vc_map( array(
	'name' => __( 'Pie chart', 'vc_extend' ),
	'base' => 'vc_pie',
	'class' => '',
	'icon' => 'icon-wpb-vc_pie',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Animated pie chart', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' ),
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Pie value', 'js_composer' ),
			'param_name' => 'value',
			'description' => __( 'Input graph value here. Choose range between 0 and 100.', 'js_composer' ),
			'value' => '50',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Pie label value', 'js_composer' ),
			'param_name' => 'label_value',
			'description' => __( 'Input integer value for label. If empty "Pie value" will be used.', 'js_composer' ),
			'value' => ''
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Units', 'js_composer' ),
			'param_name' => 'units',
			'description' => __( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Bar color', 'js_composer' ),
			'param_name' => 'color',
			'value' => $colors_arr, //$pie_colors,
			'description' => __( 'Select pie chart color.', 'js_composer' ),
			'admin_label' => true,
			'param_holder_class' => 'vc_colored-dropdown'
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		),

	)
) );


/* Support for 3rd Party plugins
---------------------------------------------------------- */
// Contact form 7 plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
	global $wpdb;
	$cf7 = $wpdb->get_results(
		"
  SELECT ID, post_title
  FROM $wpdb->posts
  WHERE post_type = 'wpcf7_contact_form'
  "
	);
	$contact_forms = array();
	if ( $cf7 ) {
		foreach ( $cf7 as $cform ) {
			$contact_forms[$cform->post_title] = $cform->ID;
		}
	} else {
		$contact_forms[__( 'No contact forms found', 'js_composer' )] = 0;
	}
	vc_map( array(
		'base' => 'contact-form-7',
		'name' => __( 'Contact Form 7', 'js_composer' ),
		'icon' => 'icon-wpb-contactform7',
		'category' => __( 'Content', 'js_composer' ),
		'description' => __( 'Place Contact Form7', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Form title', 'js_composer' ),
				'param_name' => 'title',
				'admin_label' => true,
				'description' => __( 'What text use as form title. Leave blank if no title is needed.', 'js_composer' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Select contact form', 'js_composer' ),
				'param_name' => 'id',
				'value' => $contact_forms,
				'description' => __( 'Choose previously created contact form from the drop down list.', 'js_composer' )
			)
		)
	) );
} // if contact form7 plugin active

if ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
	$gravity_forms_array[__( 'No Gravity forms found.', 'js_composer' )] = '';
	if ( class_exists( 'RGFormsModel' ) ) {
		$gravity_forms = RGFormsModel::get_forms( 1, 'title' );
		if ( $gravity_forms ) {
			$gravity_forms_array = array( __( 'Select a form to display.', 'js_composer' ) => '' );
			foreach ( $gravity_forms as $gravity_form ) {
				$gravity_forms_array[$gravity_form->title] = $gravity_form->id;
			}
		}
	}
	vc_map( array(
		'name' => __( 'Gravity Form', 'js_composer' ),
		'base' => 'gravityform',
		'icon' => 'icon-wpb-vc_gravityform',
		'category' => __( 'Content', 'js_composer' ),
		'description' => __( 'Place Gravity form', 'js_composer' ),
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Form', 'js_composer' ),
				'param_name' => 'id',
				'value' => $gravity_forms_array,
				'description' => __( 'Select a form to add it to your post or page.', 'js_composer' ),
				'admin_label' => true
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Display Form Title', 'js_composer' ),
				'param_name' => 'title',
				'value' => array(
					__( 'No', 'js_composer' ) => 'false',
					__( 'Yes', 'js_composer' ) => 'true'
				),
				'description' => __( 'Would you like to display the forms title?', 'js_composer' ),
				'dependency' => array( 'element' => 'id', 'not_empty' => true )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Display Form Description', 'js_composer' ),
				'param_name' => 'description',
				'value' => array(
					__( 'No', 'js_composer' ) => 'false',
					__( 'Yes', 'js_composer' ) => 'true'
				),
				'description' => __( 'Would you like to display the forms description?', 'js_composer' ),
				'dependency' => array( 'element' => 'id', 'not_empty' => true )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Enable AJAX?', 'js_composer' ),
				'param_name' => 'ajax',
				'value' => array(
					__( 'No', 'js_composer' ) => 'false',
					__( 'Yes', 'js_composer' ) => 'true'
				),
				'description' => __( 'Enable AJAX submission?', 'js_composer' ),
				'dependency' => array( 'element' => 'id', 'not_empty' => true )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Tab Index', 'js_composer' ),
				'param_name' => 'tabindex',
				'description' => __( '(Optional) Specify the starting tab index for the fields of this form. Leave blank if you\'re not sure what this is.', 'js_composer' ),
				'dependency' => array( 'element' => 'id', 'not_empty' => true )
			)
		)
	) );
} // if gravityforms active

/* WordPress default Widgets (Appearance->Widgets)
---------------------------------------------------------- */
vc_map( array(
	'name' => 'WP ' . __( "Search" ),
	'base' => 'vc_wp_search',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'A search form for your site', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

vc_map( array(
	'name' => 'WP ' . __( 'Meta' ),
	'base' => 'vc_wp_meta',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Log in/out, admin, feed and WordPress links', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

vc_map( array(
	'name' => 'WP ' . __( 'Recent Comments' ),
	'base' => 'vc_wp_recentcomments',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'The most recent comments', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Number of comments to show', 'js_composer' ),
			'param_name' => 'number',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

vc_map( array(
	'name' => 'WP ' . __( 'Calendar' ),
	'base' => 'vc_wp_calendar',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'A calendar of your sites posts', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

vc_map( array(
	'name' => 'WP ' . __( 'Pages' ),
	'base' => 'vc_wp_pages',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Your sites WordPress Pages', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Sort by', 'js_composer' ),
			'param_name' => 'sortby',
			'value' => array(
				__( 'Page title', 'js_composer' ) => 'post_title',
				__( 'Page order', 'js_composer' ) => 'menu_order',
				__( 'Page ID', 'js_composer' ) => 'ID'
			),
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Exclude', 'js_composer' ),
			'param_name' => 'exclude',
			'description' => __( 'Page IDs, separated by commas.', 'js_composer' ),
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

$tag_taxonomies = array();
foreach ( get_taxonomies() as $taxonomy ) {
	$tax = get_taxonomy( $taxonomy );
	if ( ! $tax->show_tagcloud || empty( $tax->labels->name ) ) {
		continue;
	}
	$tag_taxonomies[$tax->labels->name] = esc_attr( $taxonomy );
}
vc_map( array(
	'name' => 'WP ' . __( 'Tag Cloud' ),
	'base' => 'vc_wp_tagcloud',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Your most used tags in cloud format', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Taxonomy', 'js_composer' ),
			'param_name' => 'taxonomy',
			'value' => $tag_taxonomies,
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

$custom_menus = array();
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
if ( is_array( $menus ) ) {
	foreach ( $menus as $single_menu ) {
		$custom_menus[$single_menu->name] = $single_menu->term_id;
	}
}
vc_map( array(
	'name' => 'WP ' . __( "Custom Menu" ),
	'base' => 'vc_wp_custommenu',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Use this widget to add one of your custom menus as a widget', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Menu', 'js_composer' ),
			'param_name' => 'nav_menu',
			'value' => $custom_menus,
			'description' => empty( $custom_menus ) ? __( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'js_composer' ) : __( 'Select menu', 'js_composer' ),
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

vc_map( array(
	'name' => 'WP ' . __( 'Text' ),
	'base' => 'vc_wp_text',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Arbitrary text or HTML', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'textarea',
			'heading' => __( 'Text', 'js_composer' ),
			'param_name' => 'content',
			// 'admin_label' => true
		),
		/*array(
        'type' => 'checkbox',
        'heading' => __( 'Automatically add paragraphs', 'js_composer' ),
        'param_name' => "filter"
  ),*/
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );


vc_map( array(
	'name' => 'WP ' . __( 'Recent Posts' ),
	'base' => 'vc_wp_posts',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'The most recent posts on your site', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Number of posts to show', 'js_composer' ),
			'param_name' => 'number',
			'admin_label' => true
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Display post date?', 'js_composer' ),
			'param_name' => 'show_date',
			'value' => array( __( 'Yes, please', 'js_composerp' ) => true )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );


$link_category = array( __( 'All Links', 'js_composer' ) => '' );
$link_cats     = get_terms( 'link_category' );
if ( is_array( $link_cats ) ) {
	foreach ( $link_cats as $link_cat ) {
		$link_category[ $link_cat->name ] = $link_cat->term_id;
	}
}
vc_map( array(
	'name'        => 'WP ' . __( 'Links' ),
	'base'        => 'vc_wp_links',
	'icon'        => 'icon-wpb-wp',
	'category'    => __( 'WordPress Widgets', 'js_composer' ),
	'class'       => 'wpb_vc_wp_widget',
	'content_element' => (bool) get_option( 'link_manager_enabled' ),
	'weight'      => - 50,
	'description' => __( 'Your blogroll', 'js_composer' ),
	'params'      => array(
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Link Category', 'js_composer' ),
			'param_name'  => 'category',
			'value'       => $link_category,
			'admin_label' => true
		),
		array(
			'type'       => 'dropdown',
			'heading'    => __( 'Sort by', 'js_composer' ),
			'param_name' => 'orderby',
			'value'      => array(
				__( 'Link title', 'js_composer' )  => 'name',
				__( 'Link rating', 'js_composer' ) => 'rating',
				__( 'Link ID', 'js_composer' )     => 'id',
				__( 'Random', 'js_composer' )      => 'rand'
			)
		),
		array(
			'type'       => 'checkbox',
			'heading'    => __( 'Options', 'js_composer' ),
			'param_name' => 'options',
			'value'      => array(
				__( 'Show Link Image', 'js_composer' )       => 'images',
				__( 'Show Link Name', 'js_composer' )        => 'name',
				__( 'Show Link Description', 'js_composer' ) => 'description',
				__( 'Show Link Rating', 'js_composer' )      => 'rating'
			)
		),
		array(
			'type'       => 'textfield',
			'heading'    => __( 'Number of links to show', 'js_composer' ),
			'param_name' => 'limit'
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Extra class name', 'js_composer' ),
			'param_name'  => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

vc_map( array(
	'name' => 'WP ' . __( 'Categories' ),
	'base' => 'vc_wp_categories',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'A list or dropdown of categories', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Options', 'js_composer' ),
			'param_name' => 'options',
			'value' => array(
				__( 'Display as dropdown', 'js_composer' ) => 'dropdown',
				__( 'Show post counts', 'js_composer' ) => 'count',
				__( 'Show hierarchy', 'js_composer' ) => 'hierarchical'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );


vc_map( array(
	'name' => 'WP ' . __( 'Archives' ),
	'base' => 'vc_wp_archives',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'A monthly archive of your sites posts', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Options', 'js_composer' ),
			'param_name' => 'options',
			'value' => array(
				__( 'Display as dropdown', 'js_composer' ) => 'dropdown',
				__( 'Show post counts', 'js_composer' ) => 'count'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

vc_map( array(
	'name' => 'WP ' . __( 'RSS' ),
	'base' => 'vc_wp_rss',
	'icon' => 'icon-wpb-wp',
	'category' => __( 'WordPress Widgets', 'js_composer' ),
	'class' => 'wpb_vc_wp_widget',
	'weight' => - 50,
	'description' => __( 'Entries from any RSS or Atom feed', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'What text use as a widget title. Leave blank to use default widget title.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'RSS feed URL', 'js_composer' ),
			'param_name' => 'url',
			'description' => __( 'Enter the RSS feed URL.', 'js_composer' ),
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Items', 'js_composer' ),
			'param_name' => 'items',
			'value' => array( __( '10 - Default', 'js_composer' ) => '', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20 ),
			'description' => __( 'How many items would you like to display?', 'js_composer' ),
			'admin_label' => true
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Options', 'js_composer' ),
			'param_name' => 'options',
			'value' => array(
				__( 'Display item content?', 'js_composer' ) => 'show_summary',
				__( 'Display item author if available?', 'js_composer' ) => 'show_author',
				__( 'Display item date?', 'js_composer' ) => 'show_date'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/* Empty Space Element
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Empty Space', 'js_composer' ),
	'base' => 'vc_empty_space',
	'icon' => 'icon-wpb-ui-empty_space',
	'show_settings_on_create' => true,
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Add spacer with custom height', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Height', 'js_composer' ),
			'param_name' => 'height',
			'value' => '32px',
			'admin_label' => true,
			'description' => __( 'Enter empty space height.', 'js_composer' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
		),
	),
) );

/* Custom Heading element
----------------------------------------------------------- */
vc_map( array(
    'name' => __( 'Custom Heading', 'js_composer' ),
    'base' => 'vc_custom_heading',
    'icon' => 'icon-wpb-ui-custom_heading',
    'show_settings_on_create' => true,
    'category' => __( 'Content', 'js_composer' ),
    'description' => __( 'Add custom heading text with google fonts', 'js_composer' ),
    'params' => array(
        array(
            'type' => 'textarea',
            'heading' => __( 'Text', 'js_composer' ),
            'param_name' => 'text',
            'admin_label' => true,
            'value'=> __( 'This is custom heading element with Google Fonts', 'js_composer' ),
            'description' => __( 'Enter your content. If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'js_composer' ),
        ),
        array(
            'type' => 'font_container',
            'param_name' => 'font_container',
            'value'=>'',
            'settings'=>array(
                'fields'=>array(
                    'tag'=>'h2', // default value h2
                    'text_align',
                    'font_size',
                    'line_height',
                    'color',
                    //'font_style_italic'
                    //'font_style_bold'
                    //'font_family'

                    'tag_description' => __('Select element tag.','js_composer'),
                    'text_align_description' => __('Select text alignment.','js_composer'),
                    'font_size_description' => __('Enter font size.','js_composer'),
                    'line_height_description' => __('Enter line height.','js_composer'),
                    'color_description' => __('Select color for your element.','js_composer'),
                    //'font_style_description' => __('Put your description here','js_composer'),
                    //'font_family_description' => __('Put your description here','js_composer'),
                ),
            ),
           // 'description' => __( '', 'js_composer' ),
        ),
        array(
            'type' => 'google_fonts',
            'param_name' => 'google_fonts',
            'value' => '',// Not recommended, this will override 'settings'. 'font_family:'.rawurlencode('Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic').'|font_style:'.rawurlencode('900 bold italic:900:italic'),
            'settings' => array(
                //'no_font_style' // Method 1: To disable font style
                //'no_font_style'=>true // Method 2: To disable font style
                'fields'=>array(
                    'font_family'=>'Abril Fatface:regular', //'Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',// Default font family and all available styles to fetch
                    'font_style'=>'400 regular:400:normal', // Default font style. Name:weight:style, example: "800 bold regular:800:normal"
                    'font_family_description' => __('Select font family.','js_composer'),
                    'font_style_description' => __('Select font styling.','js_composer')
                )
            ),
           // 'description' => __( '', 'js_composer' ),
        ),
        array(
            'type' => 'textfield',
            'heading' => __( 'Extra class name', 'js_composer' ),
            'param_name' => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
        ),
        array(
            'type' => 'css_editor',
            'heading' => __( 'Css', 'js_composer' ),
            'param_name' => 'css',
            // 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
            'group' => __( 'Design options', 'js_composer' )
        )
    ),
) );

/*** Visual Composer Content elements refresh ***/
class VcSharedLibrary {
	// Here we will store plugin wise (shared) settings. Colors, Locations, Sizes, etc...
	private static $colors = array(
		'Blue' => 'blue', // Why __( 'Blue', 'js_composer' ) doesn't work?
		'Turquoise' => 'turquoise',
		'Pink' => 'pink',
		'Violet' => 'violet',
		'Peacoc' => 'peacoc',
		'Chino' => 'chino',
		'Mulled Wine' => 'mulled_wine',
		'Vista Blue' => 'vista_blue',
		'Black' => 'black',
		'Grey' => 'grey',
		'Orange' => 'orange',
		'Sky' => 'sky',
		'Green' => 'green',
		'Juicy pink' => 'juicy_pink',
		'Sandy brown' => 'sandy_brown',
		'Purple' => 'purple',
		'White' => 'white'
	);

	public static $icons = array(
		'Glass' => 'glass',
		'Music' => 'music',
		'Search' => 'search'
	);

	public static $sizes = array(
		'Mini' => 'xs',
		'Small' => 'sm',
		'Normal' => 'md',
		'Large' => 'lg'
	);

	public static $button_styles = array(
		'Rounded' => 'rounded',
		'Square' => 'square',
		'Round' => 'round',
		'Outlined' => 'outlined',
		'3D' => '3d',
		'Square Outlined' => 'square_outlined'
	);

	public static $cta_styles = array(
		'Rounded' => 'rounded',
		'Square' => 'square',
		'Round' => 'round',
		'Outlined' => 'outlined',
		'Square Outlined' => 'square_outlined'
	);

	public static $txt_align = array(
		'Left' => 'left',
		'Right' => 'right',
		'Center' => 'center',
		'Justify' => 'justify'
	);

	public static $el_widths = array(
		'100%' => '',
		'90%' => '90',
		'80%' => '80',
		'70%' => '70',
		'60%' => '60',
		'50%' => '50'
	);

	public static $sep_styles = array(
		'Border' => '',
		'Dashed' => 'dashed',
		'Dotted' => 'dotted',
		'Double' => 'double'
	);

	public static $box_styles = array(
		'Default' => '',
		'Rounded' => 'vc_box_rounded',
		'Border' => 'vc_box_border',
		'Outline' => 'vc_box_outline',
		'Shadow' => 'vc_box_shadow',
		'Bordered shadow' => 'vc_box_shadow_border',
		'3D Shadow' => 'vc_box_shadow_3d',
		'Circle' => 'vc_box_circle', //new
		'Circle Border' => 'vc_box_border_circle', //new
		'Circle Outline' => 'vc_box_outline_circle', //new
		'Circle Shadow' => 'vc_box_shadow_circle', //new
		'Circle Border Shadow' => 'vc_box_shadow_border_circle' //new
	);

	public static function getColors() {
		return self::$colors;
	}

	public static function getIcons() {
		return self::$icons;
	}

	public static function getSizes() {
		return self::$sizes;
	}

	public static function getButtonStyles() {
		return self::$button_styles;
	}

	public static function getCtaStyles() {
		return self::$cta_styles;
	}

	public static function getTextAlign() {
		return self::$txt_align;
	}

	public static function getElementWidths() {
		return self::$el_widths;
	}

	public static function getSeparatorStyles() {
		return self::$sep_styles;
	}

	public static function getBoxStyles() {
		return self::$box_styles;
	}
}

//VcSharedLibrary::getColors();
function getVcShared( $asset = '' ) {
	switch ( $asset ) {
		case 'colors':
			return VcSharedLibrary::getColors();
			break;

		case 'icons':
			return VcSharedLibrary::getIcons();
			break;

		case 'sizes':
			return VcSharedLibrary::getSizes();
			break;

		case 'button styles':
		case 'alert styles':
			return VcSharedLibrary::getButtonStyles();
			break;

		case 'cta styles':
			return VcSharedLibrary::getCtaStyles();
			break;

		case 'text align':
			return VcSharedLibrary::getTextAlign();
			break;

		case 'cta widths':
		case 'separator widths':
			return VcSharedLibrary::getElementWidths();
			break;

		case 'separator styles':
			return VcSharedLibrary::getSeparatorStyles();
			break;

		case 'single image styles':
			return VcSharedLibrary::getBoxStyles();
			break;

		default:
			# code...
			break;
	}
}

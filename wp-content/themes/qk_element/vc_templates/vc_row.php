<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $el_id = $div_wrapper = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'el_id'        => '',
    'div_wrapper'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'fullwidth'         => 'no',
    'margin_bottom'   => '',
    'css' => ''
), $atts));

if($el_id!=''){
	$id = 'id="'.$el_id.'"'; 
}else{
	$id = '';
}

// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' wpb_row '. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
$output .= '<div class="full_'.$fullwidth.' '.$css_class.'"'.$style.'>';
if($el_id!=''){
	$output .= '<div '.$id.'>';
}
if($fullwidth == 'no'){  
	$output .=	'<div class="container"><div class="vc_row ">';
}
$output .= wpb_js_remove_wpautop($content);
if($fullwidth == 'no'){
    $output .= '</div></div>';
}
if($el_id!=''){
	$output .= '</div>';
}
$output .= '</div>'.$this->endBlockComment('row');

echo $output;
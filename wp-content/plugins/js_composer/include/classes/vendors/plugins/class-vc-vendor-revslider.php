<?php
  /**
   * JWPLayer loader.
   *
   */
class Vc_Vendor_Revslider implements Vc_Vendor_Interface {
	protected static $instanceIndex = 1;
    public function load() {
		add_action('vc_after_mapping', array(&$this, 'buildShortcode'));

	}
	public function buildShortcode() {
		if ( is_plugin_active( 'revslider/revslider.php' ) ) {
			global $wpdb;
			$rs = $wpdb->get_results(
				"
  SELECT id, title, alias
  FROM " . $wpdb->prefix . "revslider_sliders
  ORDER BY id ASC LIMIT 999
  "
			);
			$revsliders = array();
			if ( $rs ) {
				foreach ( $rs as $slider ) {
					$revsliders[$slider->title] = $slider->alias;
				}
			} else {
				$revsliders[__( 'No sliders found', 'js_composer' )] = 0;
			}
			vc_map( array(
				'base' => 'rev_slider_vc',
				'name' => __( 'Revolution Slider', 'js_composer' ),
				'icon' => 'icon-wpb-revslider',
				'category' => __( 'Content', 'js_composer' ),
				'description' => __( 'Place Revolution slider', 'js_composer' ),
				"params" => array(
					array(
						'type' => 'textfield',
						'heading' => __( 'Widget title', 'js_composer' ),
						'param_name' => 'title',
						'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'js_composer' )
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Revolution Slider', 'js_composer' ),
						'param_name' => 'alias',
						'admin_label' => true,
						'value' => $revsliders,
						'description' => __( 'Select your Revolution Slider.', 'js_composer' )
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					)
				)
			) );
		} // if revslider plugin active
		if(vc_is_frontend_ajax() || vc_is_frontend_editor()) {
			add_filter('vc_revslider_shortcode', array(&$this, 'setId'));
		}
	}
	public function setId($output) {
		return preg_replace('/rev_slider_(\d+)_(\d+)/', 'rev_slider_$1_$2'.time().'_'.self::$instanceIndex++, $output);
	}

}
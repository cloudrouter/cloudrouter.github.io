<?php

/**
 * Author: Alin Marcu
 * Author URI: https://deconf.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class GADSH_Frontend_Widget extends WP_Widget
{

  final function __construct()
  {
    parent::__construct('gadash_frontend_widget', __('Google Analytics Dashboard', 'ga-dash'), array(
      'description' => __("Will display your google analytics stats in a widget", 'ga-dash')
    ));
    // Frontend Styles
    if (is_active_widget(false, false, $this->id_base, true)) {
      add_action('wp_enqueue_scripts', array(
        $this,
        'ga_dash_front_enqueue_styles'
      ));
    }
  }

  function ga_dash_front_enqueue_styles()
  {
    global $GADASH_Config;
    wp_enqueue_style('ga_dash-front', $GADASH_Config->plugin_url . '/front/css/content_stats.css', NULL, GADWP_CURRENT_VERSION);
    wp_enqueue_script('ga_dash-front', $GADASH_Config->plugin_url . '/front/js/content_stats.js', array(
      'jquery'
    ), GADWP_CURRENT_VERSION);
    wp_enqueue_script('googlejsapi', 'https://www.google.com/jsapi');
  }

  public function widget($args, $instance)
  {
    global $GADASH_Config;
    $widget_title = apply_filters('widget_title', $instance['title']);
    $title = __("Sessions", 'ga-dash') . ($instance['anonim'] ? "' " . __("trend", 'ga-dash') : '');
    echo "\n<!-- BEGIN GADWP v" . GADWP_CURRENT_VERSION . " Widget - https://deconf.com/google-analytics-dashboard-wordpress/ -->\n";
    echo $args['before_widget'];
    if (! empty($widget_title)) {
      echo $args['before_title'] . $widget_title . $args['after_title'];
    }
    /*
     * Include Tools
     */
    include_once ($GADASH_Config->plugin_path . '/tools/tools.php');
    $tools = new GADASH_Tools();
    if (isset($GADASH_Config->options['ga_dash_style'])) {
      $css = "colors:['" . $GADASH_Config->options['ga_dash_style'] . "','" . $tools->colourVariator($GADASH_Config->options['ga_dash_style'], - 20) . "'],";
      $color = $GADASH_Config->options['ga_dash_style'];
    } else {
      $css = "";
      $color = "#3366CC";
    }
    ob_start();
    if ($instance['anonim']) {
      $formater = "var formatter = new google.visualization.NumberFormat({
					  suffix: '%',
					  fractionDigits: 2
					});
        
					formatter.format(data, 1);	";
    } else {
      $formater = '';
    }
    $periodtext = "";
    switch ($instance['period']) {
      case '7daysAgo':
        $periodtext = __('Last 7 Days', 'ga-dash');
        break;
      case '14daysAgo':
        $periodtext = __('Last 14 Days', 'ga-dash');
        break;
      case '30daysAgo':
        $periodtext = __('Last 30 Days', 'ga-dash');
        break;
      default:
        $periodtext = "";
        break;
    }
    switch ($instance['display']) {
      case '1':
        echo '<div id="gadwp-widget"><div id="gadwp-widgetchart"></div><div id="gadwp-widgettotals"></div></div>';
        break;
      case '2':
        echo '<div id="gadwp-widget"><div id="gadwp-widgetchart"></div></div>';
        break;
      case '3':
        echo '<div id="gadwp-widget"><div id="gadwp-widgettotals"></div></div>';
        break;
    }
    echo '<script type="text/javascript">

				jQuery.post("' . admin_url('admin-ajax.php') . '", {action: "gadash_get_frontendwidget_data",gadash_number: "' . $this->number . '",gadash_optionname: "' . $this->option_name . '"}, function(response){
				    if (!jQuery.isNumeric(response) && jQuery.isArray(response)){
				        if (jQuery("#gadwp-widgetchart")[0]){
				           gadash_widgetsessions=response[0]; 
						   google.setOnLoadCallback(ga_dash_drawfwidgetsessions(gadash_widgetsessions));
				        }
				        if (jQuery("#gadwp-widgettotals")[0]){ 
						   ga_dash_drawtotalsstats(response[1]);
				        }  
					}else{
				        jQuery("#gadwp-widgetchart").css({"background-color":"#F7F7F7","height":"auto","padding-top":"50px","padding-bottom":"50px","color":"#000","text-align":"center"});  
				        jQuery("#gadwp-widgetchart").html("' . __("This report is unavailable", 'ga-dash') . ' ("+response+")");
                    }	
				});';
    echo 'google.load("visualization", "1", {packages:["corechart"]});
					function ga_dash_drawfwidgetsessions(response) {
    					var data = google.visualization.arrayToDataTable(response);
    					var options = {
    					  legend: {position: "none"},
    					  pointSize: 3,' . $css . '
    					  title: "' . $title . '",
    					  titlePosition: "in",
    					  chartArea: {width: "95%",height:"75%"},
    					  hAxis: { textPosition: "none"},
    					  vAxis: { textPosition: "none", minValue: 0, gridlines: {color: "transparent"}, baselineColor: "transparent"}
    				 	}
    					var chart = new google.visualization.AreaChart(document.getElementById("gadwp-widgetchart"));
    					' . $formater . '
    					chart.draw(data, options);
				   }
    			   function ga_dash_drawtotalsstats(response) {
    					if (response == null){
    					    response = 0;
                        }    
                        jQuery("#gadwp-widgettotals").html("<div class=\"gadwp-left\">' . __("Period:", 'ga-dash') . '</div> <div class=\"gadwp-right\">' . $periodtext . '</div><div class=\"gadwp-left\">' . __("Sessions:", 'ga-dash') . '</div> <div class=\"gadwp-right\">"+response+"</div>");
                   }';
    echo '</script>';
    if ($instance['give_credits'] == 1)
      echo '<div style="text-align:right;width:100%;font-size:0.8em;clear:both;margin-right:5px;">' . __('generated by', 'ga-dash') . ' <a href="https://deconf.com/google-analytics-dashboard-wordpress/" rel="nofollow" style="text-decoration:none;font-size:1em;">GADWP</a>&nbsp;</div>';
    $widget_content = ob_get_contents();
    ob_end_clean();
    echo apply_filters('widget_html_content', $widget_content);
    echo $args['after_widget'];
    echo "\n<!-- END GADWP Widget -->\n";
  }

  public function form($instance)
  {
    $widget_title = (isset($instance['title']) ? $instance['title'] : __("Google Analytics Stats", 'ga-dash'));
    $period = (isset($instance['period']) ? $instance['period'] : '7daysAgo');
    $display = (isset($instance['display']) ? $instance['display'] : 1);
    $give_credits = (isset($instance['give_credits']) ? $instance['give_credits'] : 1);
    $anonim = (isset($instance['anonim']) ? $instance['anonim'] : 0);
    ?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( "Title:",'ga-dash' ); ?></label>
	<input class="widefat"
		id="<?php echo $this->get_field_id( 'title' ); ?>"
		name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
		value="<?php echo esc_attr( $widget_title ); ?>">
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e( "Display:",'ga-dash' ); ?></label>
	<select id="<?php echo $this->get_field_id('display'); ?>"
		class="widefat"
		name="<?php   echo $this->get_field_name( 'display' ); ?>">
		<option value="1" <?php selected( $display, 1 ); ?>><?php _e('Chart & Totals', 'ga-dash');?></option>
		<option value="2" <?php selected( $display, 2 ); ?>><?php _e('Chart', 'ga-dash');?></option>
		<option value="3" <?php selected( $display, 3 ); ?>><?php _e('Totals', 'ga-dash');?></option>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'anonim' ); ?>"><?php _e( "Anonymize stats:",'ga-dash' ); ?></label>
	<input class="widefat"
		id="<?php echo $this->get_field_id( 'anonim' ); ?>"
		name="<?php echo $this->get_field_name( 'anonim' ); ?>"
		type="checkbox" <?php checked( $anonim, 1 ); ?> value="1">
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'period' ); ?>"><?php _e( "Stats for:",'ga-dash' ); ?></label>
	<select id="<?php echo $this->get_field_id('period'); ?>"
		class="widefat"
		name="<?php   echo $this->get_field_name( 'period' ); ?>">
		<option value="7daysAgo" <?php selected( $period, '7daysAgo' ); ?>><?php _e('Last 7 Days', 'ga-dash');?></option>
		<option value="14daysAgo" <?php selected( $period, '14daysAgo' ); ?>><?php _e('Last 14 Days', 'ga-dash');?></option>
		<option value="30daysAgo" <?php selected( $period, '30daysAgo' ); ?>><?php _e('Last 30 Days', 'ga-dash');?></option>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'give_credits' ); ?>"><?php _e( "Give credits:",'ga-dash' ); ?></label>
	<input class="widefat"
		id="<?php echo $this->get_field_id( 'give_credits' ); ?>"
		name="<?php echo $this->get_field_name( 'give_credits' ); ?>"
		type="checkbox" <?php checked( $give_credits, 1 ); ?> value="1">
</p>


<?php
  }

  public function update($new_instance, $old_instance)
  {
    $instance = array();
    $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : 'Analytics Stats';
    $instance['period'] = (! empty($new_instance['period'])) ? strip_tags($new_instance['period']) : '7daysAgo';
    $instance['display'] = (! empty($new_instance['display'])) ? strip_tags($new_instance['display']) : 1;
    $instance['give_credits'] = (! empty($new_instance['give_credits'])) ? strip_tags($new_instance['give_credits']) : 0;
    $instance['anonim'] = (! empty($new_instance['anonim'])) ? strip_tags($new_instance['anonim']) : 0;
    return $instance;
  }
}

function register_GADSH_Frontend_Widget()
{
  register_widget('GADSH_Frontend_Widget');
}
add_action('widgets_init', 'register_GADSH_Frontend_Widget');

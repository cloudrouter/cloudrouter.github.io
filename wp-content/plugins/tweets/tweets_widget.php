<?php
/**
 * Plugin Name: Twitter Widget
 * Description: A widget that displays Latest Tweets status via user API.
 * Version: 3.1
 * Author: Quannt
 * Author URI: http://qkthemes.com
 */

require_once(dirname(__FILE__) . '/twitteroauth.php');
if(!function_exists('tweets_widget')){
    add_action( 'widgets_init', 'tweets_widget' );
    function tweets_widget() {
        register_widget( 'Tweets_Widget' );
    }
}
function stylos_tweets_style(){
    wp_enqueue_style( 'tweets',plugins_url( 'asset/tweets.css' , __FILE__ ));
}
add_action( 'wp_enqueue_scripts', 'stylos_tweets_style' );
class Tweets_Widget extends WP_Widget {

    function Tweets_Widget() {
        $widget_ops = array( 'classname' => 'latest-tweets', 'description' => __('Latest tweets widget ', 'mint') );
        
        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'tweets-widget' );
        
        $this->WP_Widget( 'tweets-widget', __('Twitter Widget', 'mint'), $widget_ops, $control_ops );
    }
    
    function getAgo($timestamp) {
        $difference = time() - $timestamp;

        if ($difference < 60) {
            return $difference." seconds ago";
        } else {
            $difference = round($difference / 60);
        }

        if ($difference < 60) {
            return $difference." minutes ago";
        } else {
            $difference = round($difference / 60);
        }

        if ($difference < 24) {
            return $difference." hours ago";
        }
        else {
            $difference = round($difference / 24);
        }

        if ($difference < 7) {
            return $difference." days ago";
        } else {
            $difference = round($difference / 7);
            return $difference." weeks ago";
        }
    }
    function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
      $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
      return $connection;
    }
    function widget( $args, $instance ) {
        extract( $args );

        //Our variables from the widget settings.
        $title = apply_filters('widget_title', $instance['title'] );
        $twitteruser = $instance['name'];
        $notweets = $instance['num'];
        $consumerkey = $instance['custommerkey'];
        $consumersecret = $instance['custommersecret'];
        $accesstoken = $instance['accesstoken'];
        $accesstokensecret = $instance['accesstokensecret'];
        $show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;
        //Test
        
        
        echo $before_widget;

        // Display the widget title 
      if ( $title ) {
            echo $before_title . $title . $after_title;
      }
        //Display the name 
       
           $connection = $this->getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
           $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
           $status = json_encode($tweets);
           $fp = fopen('results.json', 'w');
            fwrite($fp, json_encode($tweets));
            fclose($fp);
            $responseJson = file_get_contents(get_home_url().'/results.json');
            if ($responseJson) {
                $response = json_decode($responseJson);
            }
            ?>
			<div class=" tweets-widget">
               <ul>
               <?php 
                    if (!function_exists('processString')) {
                        function processString($s) {
                            return preg_replace('/https?:\/\/[\w\-\.!~?&+\*\'"(),\/]+/','<a href="$0">$0</a>',$s);
                        }
                    }
               ?>
               <?php foreach ((array)$response as $tweet) { ?>
                            <?php 
                            
                            ?>
                            <li>
							
							<p><?php echo processString($tweet->text); ?></p>
							<span><?php echo $this->getAgo(strtotime($tweet->created_at)); ?></span>
                            </li>
                            
                <?php   
                             }   ?>
               </ul>
			</div>
        <?php 
        echo $after_widget;
    }

    //Update the widget 
     
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        //Strip tags from title and name to remove HTML 
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['name'] = strip_tags( $new_instance['name'] );
        $instance['num'] = strip_tags( $new_instance['num'] );
        $instance['custommerkey'] = strip_tags( $new_instance['custommerkey'] );
        $instance['custommersecret'] = strip_tags( $new_instance['custommersecret'] );
        $instance['accesstoken'] = strip_tags( $new_instance['accesstoken'] );
        $instance['accesstokensecret'] = strip_tags( $new_instance['accesstokensecret'] );
        $instance['show_info'] = $new_instance['show_info'];

        return $instance;
    }

    
    function form( $instance ) {

        //Set up some default widget settings.
        $defaults = array( 'title' => __('Latest tweets.', 'mint'), 'name' => 'quanntvn','custommerkey' => 'XcKyCQdCHCVFV8Ila3lcVg','custommersecret' => 'DI6adVbO7ZQ9WuX7rCCumOQvMZTcxEWkBkWGTygI','accesstoken' => '1361529829-0veAbfrZ0zIHPrUnnHI7Xj6Jk8Fm7qgLrJZdAY6','accesstokensecret' => 'ODVbWtpKbJOWhvy2OjuPM6bgeBOwwYIA1lgY2C9Dw','num' => 2);
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'mint'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Twitter Username:', 'mint'); ?></label>
            <input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'custommerkey' ); ?>"><?php _e('API key:', 'mint'); ?></label>
            <input id="<?php echo $this->get_field_id( 'custommerkey' ); ?>" name="<?php echo $this->get_field_name( 'custommerkey' ); ?>" value="<?php echo $instance['custommerkey']; ?>" style="width:100%;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'custommersecret' ); ?>"><?php _e('API secret:', 'mint'); ?></label>
            <input id="<?php echo $this->get_field_id( 'custommersecret' ); ?>" name="<?php echo $this->get_field_name( 'custommersecret' ); ?>" value="<?php echo $instance['custommersecret']; ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'accesstoken' ); ?>"><?php _e('Access token:', 'mint'); ?></label>
            <input id="<?php echo $this->get_field_id( 'accesstoken' ); ?>" name="<?php echo $this->get_field_name( 'accesstoken' ); ?>" value="<?php echo $instance['accesstoken']; ?>" style="width:100%;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'accesstokensecret' ); ?>"><?php _e('Access token secret:', 'mint'); ?></label>
            <input id="<?php echo $this->get_field_id( 'accesstokensecret' ); ?>" name="<?php echo $this->get_field_name( 'accesstokensecret' ); ?>" value="<?php echo $instance['accesstokensecret']; ?>" style="width:100%;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'num' ); ?>"><?php _e('Number Status:', 'mint'); ?></label>
            <input id="<?php echo $this->get_field_id( 'num' ); ?>" name="<?php echo $this->get_field_name( 'num' ); ?>" value="<?php echo $instance['num']; ?>" style="width:100%;" />
        </p>
        
        //Checkbox.
        <!--<p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['show_info'], true ); ?> id="<?php echo $this->get_field_id( 'show_info' ); ?>" name="<?php echo $this->get_field_name( 'show_info' ); ?>" /> 
            <label for="<?php echo $this->get_field_id( 'show_info' ); ?>"><?php _e('Display info publicly?', 'mint'); ?></label>
        </p>-->

    <?php
    }
}

?>
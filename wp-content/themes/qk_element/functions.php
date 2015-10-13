<?php
require_once( dirname( __FILE__ ) . '/framework/theme-config.php' );
require_once dirname( __FILE__ ) . '/framework/Custom-Metaboxes/metabox-functions.php';
require_once dirname( __FILE__ ) . '/framework/post_type.php';
require_once dirname( __FILE__ ) . '/framework/widget/recent.php';
require_once dirname( __FILE__ ) . '/framework/BFI_Thumb.php';
require_once dirname( __FILE__ ) . '/framework/wp_bootstrap_navwalker.php';
require_once dirname( __FILE__ ) . '/framework/wp_bootstrap_navwalker2.php';
require_once dirname( __FILE__ ) . '/vc_shortcodes.php';

$textdomain = 'element';
function element_setup() {
	global $textdomain;
	load_theme_textdomain( 'element', get_template_directory() . '/languages' );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'element' ),
		'one_page'   => __( 'One Page Menu', 'element' ),
		'footer_menu'   => __( 'Footer Menu', 'element' ),
	) );
	add_theme_support( 'woocommerce' );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'video', 'gallery', 'quote',
	) );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background');
	add_filter('widget_text', 'do_shortcode');

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'element_setup' );

if ( ! isset( $content_width ) ) {
	$content_width = 665;
}

function element_widgets_init() {
	global $textdomain;
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'element' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'element' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar Shop', 'element' ),
		'id'            => 'sidebar-shop',
		'description'   => __( 'Main sidebar that appears on Shop Page.', 'element' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar Section', 'element' ),
		'id'            => 'sidebar-section',
		'description'   => __( 'Use in Home builder.', 'element' ),
		'before_widget' => '<aside id="%1$s" class="widget col-md-3 col-sm-6 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(

        'name'          => __( 'Dropdown Cart', 'element' ),
        'id'            => 'top-cart',
        'description'   => __( 'Appears in the Header cart.', 'element' ),
        'before_widget' => '<aside id="%1$s" class=" %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',

    ) );
	register_sidebar( array(
		'name'          => __( 'Languages', 'oliver' ),
		'id'            => 'languages',
		'description'   => __( 'Languages Widget.', 'oliver' ),
		'before_widget' => '<aside id="%1$s" class="top-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area 1', 'element' ),
		'id'            => 'footer-1',
		'description'   => __( 'Appears in the footer section of the site.', 'element' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area 2', 'element' ),
		'id'            => 'footer-2',
		'description'   => __( 'Appears in the footer section of the site.', 'element' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area 3', 'element' ),
		'id'            => 'footer-3',
		'description'   => __( 'Appears in the footer section of the site.', 'element' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area 4', 'element' ),
		'id'            => 'footer-4',
		'description'   => __( 'Appears in the footer section of the site.', 'element' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'element_widgets_init' );

function element_scripts() {

	// Load our main stylesheet.
	global $element_options;
	//Fonts
	$protocol = is_ssl() ? 'https' : 'http';
    if($element_options!=null && $element_options['body-font2']['font-family'] != ''){ 
		wp_enqueue_style( 'google-font', "$protocol://fonts.googleapis.com/css?family=".urlencode($element_options['body-font2']['font-family']).":300italic,400italic,600italic,700italic,400,700,600,300" );
	}
	if($element_options!=null && $element_options['body_style'] == 'one-page'){
		wp_enqueue_style( 'google-font2', "$protocol://fonts.googleapis.com/css?family=Playball" );
	}
	wp_enqueue_style( 'google-font3', "$protocol://fonts.googleapis.com/css?family=Lato:300,400,700" );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css');
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri().'/css/magnific-popup.css');
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.css');
	wp_enqueue_style( 'flexslider-theme', get_template_directory_uri().'/css/flexslider.css');
	wp_enqueue_style( 'animate', get_template_directory_uri().'/css/animate.css');
	wp_enqueue_style( 'owl.carousel', get_template_directory_uri().'/css/owl.carousel.css');
	wp_enqueue_style( 'owl.theme', get_template_directory_uri().'/css/owl.theme.css');
	wp_enqueue_style( 'settings', get_template_directory_uri().'/css/settings.css');
	if($element_options!=null && $element_options['body_style'] == 'boxed'){
		wp_enqueue_style( 'theme-css', get_template_directory_uri().'/css/boxed.css');
	}elseif($element_options!=null && $element_options['body_style'] == 'dark'){
		wp_enqueue_style( 'theme-css', get_template_directory_uri().'/css/dark.css');
	}elseif($element_options!=null && $element_options['body_style'] == 'vertical-light'){
		wp_enqueue_style( 'theme-vertical', get_template_directory_uri().'/css/vertical-light.css');
		wp_enqueue_script( 'queryloader2', get_template_directory_uri().'/js/jquery.queryloader2.js',array(),false,true);
	}elseif($element_options!=null && $element_options['body_style'] == 'vertical-dark'){
		wp_enqueue_style( 'theme-css', get_template_directory_uri().'/css/vertical-dark.css');
		wp_enqueue_script( 'queryloader2', get_template_directory_uri().'/js/jquery.queryloader2.js',array(),false,true);
	}elseif($element_options!=null && $element_options['body_style'] == 'one-page'){
		wp_enqueue_style( 'theme-css', get_template_directory_uri().'/css/one-page.css');
	}else{
		wp_enqueue_style( 'theme-css', get_template_directory_uri().'/css/element_style.css');
	}
	if($element_options['banner_type']=='video'){
		wp_enqueue_style( 'YTPlayer', get_template_directory_uri().'/css/YTPlayer.css');
		wp_enqueue_script( 'YTPlayer', get_template_directory_uri().'/js/jquery.mb.YTPlayer.js',array(),false,true);
	}
	wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array(), '2014-08-20' );
	if($element_options!= null){
	wp_enqueue_style( 'color', get_template_directory_uri().'/css/'.$element_options['body_style'].'_color.php');
	}
		
	
	wp_enqueue_script("jquery");

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script("jflickrfeed", get_template_directory_uri()."/js/jflickrfeed.min.js",array(),false,true);
	wp_enqueue_script("magnific-popup", get_template_directory_uri()."/js/jquery.magnific-popup.min.js",array(),false,true);
	wp_enqueue_script("bootstrap", get_template_directory_uri()."/js/bootstrap.js",array(),false,true);
	wp_enqueue_script("theme- flexslider", get_template_directory_uri()."/js/jquery.flexslider.js",array(),false,true);
	wp_enqueue_script("imagesloaded", get_template_directory_uri()."/js/jquery.imagesloaded.min.js",array(),false,true);
	wp_enqueue_script("isotope", get_template_directory_uri()."/js/jquery.isotope.min.js",array(),false,true);
	wp_enqueue_script("owl.carousel", get_template_directory_uri()."/js/owl.carousel.min.js",array(),false,true);
	wp_enqueue_script("retina", get_template_directory_uri()."/js/retina-1.1.0.min.js",array(),false,true);
	wp_enqueue_script("plugins-scroll", get_template_directory_uri()."/js/plugins-scroll.js",array(),false,true);
	wp_enqueue_script("waypoint", get_template_directory_uri()."/js/waypoint.min.js",array(),false,true);
	if($element_options!=null && $element_options['body_style'] == 'one-page'){
		wp_enqueue_script( 'smooth-scroll', get_template_directory_uri().'/js/smooth-scroll.js',array(),false,true);
	}
	if(is_page_template('template-comming_soon.php')){
	wp_enqueue_script("countdown", get_template_directory_uri()."/js/countdown.js",array(),false,true);
	}
	wp_enqueue_script("custom", get_template_directory_uri()."/js/script.js",array(),false,true);
	wp_enqueue_script("download-analytics", get_template_directory_uri()."/js/download-analytics.js",array(),false,true);
}
add_action( 'wp_enqueue_scripts', 'element_scripts' );


function element_post_nav(){ ?>

	<div class="pagination-box">
	  <span class="prev-link">
	  <?php previous_posts_link(__('Prev','element'),'') ?>
	  </span>
	  <span class="next-link">
	  <?php next_posts_link(__('Next','element'),'') ?>
	  </span>
	</div>
<?php
}
//Custom comment List:
function element_theme_comment($comment, $args, $depth) {
	global $textdomain; 
     $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('clearfix'); ?> id="comment-<?php comment_ID() ?>">
		<div class="comment-box">
			<?php echo get_avatar($comment,$size='75',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=75' ); ?>
			<div class="comment-content">
				<h3><?php printf(__('%s','white'), get_comment_author_link()) ?> <span><?php printf(__('%1$s at %2$s',$textdomain), get_comment_date(), get_comment_time()) ?></span></h3>
				<?php comment_text() ?>
				<?php if ($comment->comment_approved == '0') : ?>
					 <em><?php _e('Your comment is awaiting moderation.','ipressa') ?></em>
					 <br />
				 <?php endif; ?>
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
	

<?php

}
function element_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

function element_breadcrumb() {
       /* === OPTIONS === */
    $text['home']     = 'Home'; // text for the 'Home' link
    $text['category'] = 'Archive by Category "%s"'; // text for a category page
    $text['tax']       = 'Archive for "%s"'; // text for a taxonomy page
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
    $text['author']   = 'Articles Posted by %s'; // text for an author page
    $text['404']      = 'Error 404'; // text for the 404 page
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = ''; // delimiter between crumbs
    $before      = '<li class="active">'; // tag before the current crumb
    $after       = '</li>'; // tag after the current crumb

    /* === END OF OPTIONS === */

    global $post;
    $homeLink = home_url() . '/';
    $linkBefore = '<li>';
    $linkAfter = '</li>';
    $linkAttr = ' rel="v:url" property="v:title"';
    $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';
    } else {
        echo '<ul id="breadcrumbs" class="breadcrumb">' . sprintf($link, $homeLink, $text['home']) . $delimiter;
        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
            }
            echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
        } elseif( is_tax() ){
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
            }

            echo $before . sprintf($text['tax'], single_cat_title('', false)) . $after;
        }elseif ( is_search() ) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;
        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;
        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;
        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
                if ($showCurrent == 1) echo $before . get_the_title() . $after;
            }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, $delimiter);
            $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
            echo $cats;
            printf($link, get_permalink($parent), $parent->post_title);
            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) echo $before . get_the_title() . $after;
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs)-1) echo $delimiter;
            }
            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
        } elseif ( is_tag() ) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
        } elseif ( is_author() ) {
             global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;
        } elseif ( is_404() ) {
            echo $before . $text['404'] . $after;
        }
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page','nevermind') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
        echo '</ul>';
    }
}


// function to display number of posts.
function element_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '0';
    }
    return $count.'';
}
 
// function to count views.
function element_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//Get thumbnail url
    
function element_thumbnail_url($size){
    global $post;
    //$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()),$size );
    if($size==''){
        $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
         return $url;
    }else{
        $url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $size);
         return $url[0];
    }
   
}
//pagination
function element_pagination($prev = 'Prev', $next = 'Next', $pages='') {
    global $wp_query, $wp_rewrite, $textdomain;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }
    $pagination = array(
		'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 		=> '',
		'current' 		=> max( 1, get_query_var('paged') ),
		'total' 		=> $pages,
		'prev_text' => __($prev,$textdomain),
        'next_text' => __($next,$textdomain),
		'type'			=> 'list',
		'end_size'		=> 3,
		'mid_size'		=> 3
);
    $return =  paginate_links( $pagination );
	echo str_replace( "<ul class='page-numbers'>", '<ul class="pagination-list">', $return );
}




//Custom Excerpt Function
function element_excerpt($limit = 30) {
 
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}


if(function_exists('vc_add_param')){

	vc_add_param('vc_row',array(
				  "type" => "textfield",
				  "heading" => __('Section ID', 'wpb'),
				  "param_name" => "el_id",
				  "value" => "",
				  "description" => __("Set ID section", "wpb"),   
    ));
	
	vc_add_param('vc_row',array(
			  "type" => "dropdown",
			  "heading" => __('Fullwidth', 'wpb'),
			  "param_name" => "fullwidth",
			  "value" => array(   
								__('No', 'wpb') => 'no',  
								__('Yes', 'wpb') => 'yes',                                                                                
							  ),
			  "description" => __("Select Fullwidth or not", "wpb"),      
			) 
    );

}
//WooCommerce
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );
// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'element'); ?>"><i class="fa fa-shopping-cart"></i> <span><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'element'), $woocommerce->cart->cart_contents_count);?></span></a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
	
}

/*
 * Return a new number of maximum columns for shop archives
 * @param int Original value
 * @return int New number of columns
 */
function wc_loop_shop_columns( $number_columns ) {
	return 3;
}
add_action( 'init', 'element_remove_wc_breadcrumbs' );
function element_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/framework/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'pioneer_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function pioneer_register_required_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
             // This is an example of how to include a plugin from a private repo in your theme.

		array(            
            'name'               => 'WPBakery Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/js_composer.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
		array(            
            'name'               => 'Revolution Slider', // The plugin name.
            'slug'               => 'revslider', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/revslider.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
		array(            
            'name'               => 'Twitter Widget', // The plugin name.
            'slug'               => 'tweets', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/framework/plugins/tweets.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),
		
		
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'  => true,
        ),
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
        array(
            'name'      => 'WordPress Importer',
            'slug'      => 'wordpress-importer',
            'required'  => false,
        ),
		array(
            'name'      => 'Widget Importer & Exporter',
            'slug'      => 'widget-importer-exporter',
            'required'  => false,
        ),
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
		),
		array(
			'name'      => 'WooCommerce New Product Badge',
			'slug'      => 'woocommerce-new-product-badge',
			'required'  => false,
		),
		
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    tgmpa( $plugins, $config );
}
?>
<?php
global $element_options; 
if($element_options!=null && $element_options['body_style'] == 'one-page'){
add_action( 'get_footer', 'element_footer_script' );
 
function element_footer_script(  ) {
     ?>
        <script>
            (function( $ ) {
                //put all your jQuery goodness in here.
				/*-------------------------------------------------*/
				/* =  slider fullscreen
				/*-------------------------------------------------*/
				$(document).ready(function(){
					var winDow = $(window);
					var sliderFull = $('#slider'),
						fullheight = winDow.height();
					sliderFull.css('height', fullheight);

					winDow.bind('resize', function(){
						fullheight = winDow.height();
						sliderFull.css('height', fullheight);
					});
				});
            })( jQuery );
        </script>
    <?php
    
}
}
// Example Source: http://codex.wordpress.org/Plugin_API/Action_Reference/get_footer
 
?>

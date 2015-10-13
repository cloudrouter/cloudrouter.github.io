<?php
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header("Content-type: text/css; charset=utf-8");
global $element_options;
$main_color = $element_options['main-color'];
?>
.skills-box .skills-progress div.meter p, .steps-box div.step:hover , .pricing-box2 ul.pricing-table:hover li:first-child , .banner-text1-section, .banner-text1-section h1 a, .pricing-box2 ul.pricing-table li a:hover , .services-box3 .services-post:hover span ,.pricing-box1 ul.pricing-table li a, .pricing-box1 ul.pricing-table:hover li:first-child , .services-box2 .services-post span, a.prev-link:hover,ul.pagination-list li a:hover,.filter-widget a:hover,.contact-section ul.social-list li a:hover,
.contact-section2 ul.social-list li a:hover,#contact-form input[type="submit"],
ul.pagination-list li a.active,.blog-section.blog-large .blog-box .blog-post .date-type .date-post,
a.next-link:hover , .portfolio-page ul.filter li a:hover,.banner-text2-section h1 a,.accord-elem.active .accord-title h2 a,
.toogle-elem.active .toogle-title h2 a ,ul.element-social-icons li a:hover,header nav.menu > ul > .active > a, header nav.menu > ul > li:hover > a,header nav.menu > ul > .current-menu-ancestor > a,header nav.menu > ul > .current-menu-parent > a, header nav.menu  .dropdown  > .current-menu-item > a,
.portfolio-page ul.filter li a.active, #slider .tp-caption.large-bold-green ,#slider .tp-caption.middle-green , header nav ul li a:after, header .social-box ul.social-list li a:hover, header .shoping-coupon a:hover,.reply-box form.project-form input[type="submit"],.blog-post.single-post .social-tag-post .single-post-tags ul li a:hover, .blog-post.single-post #comment-form input[type="submit"],.video-widget div a,.need-widget ul li span,.share-widget ul.share-list li a:hover,.noUi-connect , .noUi-origin,.noUi-origin, .shop-section .shop-box .shop-post .shop-gal a:hover,.shop-section .shop-box .shop-post > a:hover {
	background: <?php echo esc_attr($main_color); ?>;
}
header .social-box ul.social-list li a:hover, header .shoping-coupon a:hover,.portfolio-page ul.filter li a:hover,
.portfolio-page ul.filter li a.active, .reply-box form.project-form input[type="text"]:focus,
.reply-box form.project-form textarea:focus,ul.pagination-list li a:hover,.steps-box div.step:hover ,
ul.pagination-list li a.active,.blog-post.single-post #comment-form input[type="text"]:focus,.search-widget input[type="search"]:focus ,
.blog-post.single-post #comment-form textarea:focus,.share-widget ul.share-list li a:hover,#contact-form input[type="text"]:focus,
#contact-form textarea:focus, .testimonial-box1 .bx-wrapper .bx-pager.bx-default-pager a.active{
	border-color: <?php echo esc_attr($main_color); ?>;
}
#elem-title, .recent-widget ul.recent-list li .side-content h2 a:hover{
	color: <?php echo esc_attr($main_color); ?> !important;
}
.tab-box ul.nav-tabs li.active a ,.portfolio-page.description .portfolio-box .work-post .work-content a, .portfolio-page.list-page .portfolio-box .work-post .work-content a, .portfolio-section .work-post .hover-box .inner-hover a:hover i, .page-banner-section ul li a:hover, .blog-section .blog-box .blog-post .blog-gal .blog-hover a:hover, .blog-section .blog-box .blog-post h2 a:hover, .blog-section .blog-box .blog-post ul.post-tags li a:hover, .blog-section .blog-box .blog-post > a,.blog-section.blog-large .blog-box .blog-post .blog-content > a,.blog-post.single-post .social-tag-post .single-post-icons ul li a:hover,.blog-post.single-post .comment-section ul.comment-tree li .comment-box .comment-content h3,.blog-post.single-post .comment-section ul.comment-tree li .comment-box .comment-content a:hover,.category-widget ul li a:hover,
.category-widget ul li a:hover:before,.tweets-widget ul li p a,.products-widget ul li .prod-content span ,.shop-section .shop-box .shop-post span,.product-section .product-section-box .product-details span,.product-section .product-section-box .product-details ul.product-features li:before, .tab-box ul.nav-tabs li.active a,#contact-form .message.success,.services-box1 .services-post span i,.banner-text1-section h1 a:hover,.team-box1 .team-post .team-content span ,
.services-box2 .services-post span i ,.services-box1 .services-post .services-content a:hover,.testimonial-box2 ul li span,.statistic-box .statistic-post h2 ,
.services-box2 .services-post .services-content a:hover,.services-box3 .services-post span i {
	color: <?php echo esc_attr($main_color); ?>;
}
blockquote.style-first p{
	border-left-color: <?php echo esc_attr($main_color); ?>;
}

<?php
     $rgba = element_hex2rgb($element_options['main-color']);
?>
.portfolio-box .work-post .hover-box, .blog-section .blog-box .blog-post .blog-gal .blog-hover{
	background: rgba(<?php echo esc_attr($rgba[0]); ?>, <?php echo esc_attr($rgba[1]); ?>, <?php echo esc_attr($rgba[2]); ?>, 0.85)
}

/**Style Color**/

.form-control:focus, ul.pagination-list li .current,.wpcf7-text:focus, .wpcf7-textarea:focus {
	border-color:<?php echo esc_attr($main_color); ?>;
}
button, input[type="submit"], ul.pagination-list li .current, .header4 .navbar-nav  > li.current-menu-ancestor > a,.header4  .navbar-nav  > li.current-menu-parent > a,.header4  .navbar-nav > li.current-menu-ancestor > a,.header4  .navbar-nav > li.active > a, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button,.woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce #content input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover,.woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider-horizontal .ui-slider-range, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce-page .widget_price_filter .price_slider_amount .button:hover,.woocommerce .cart-collaterals .shipping_calculator .button:hover, .woocommerce-page .cart-collaterals .shipping_calculator .button:hover, .services-post1:hover span,ul.pricing-table li a,.services-post3 span,.skills-progress div.meter p, .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,ul.pricing-table:hover > li:first-child,ul.pricing-table2:hover > li:first-child,ul.pricing-table2 li a:hover {
	background:<?php echo esc_attr($main_color); ?>;
}
.blog-post.single-post .comment-section ul.comment-tree li .comment-box .comment-content h3 a.url, .widget_recent_entries ul li a:hover,.product-categories li a:hover, .product-categories li:hover:before,  .widget_recent_comments ul li a:hover, .widget_archive ul li a:hover, .widget_categories ul li a:hover, .widget_meta ul li a:hover, .widget_pages ul li a:hover, .widget_rss ul li a:hover, .widget_nav_menu ul li a:hover, .widget_recent_entries ul li:hover:before, .widget_recent_comments ul li:hover:before, .widget_archive ul li:hover:before, .widget_categories ul li:hover:before, .widget_meta ul li:hover:before, .widget_pages ul li:hover:before, .widget_rss ul li:hover:before, .widget_nav_menu ul li:hover:before, .product-details span,.woocommerce ul.cart_list li span.amount, .woocommerce ul.product_list_widget li span.amount, .woocommerce-page ul.cart_list li span.amount, .woocommerce-page ul.product_list_widget li span.amount,.cart_totals .order-total .amount,.services-post1 span i,.services-post2 span i, .statistic-post h2,.services-post .services-content a:hover,.team-post2 .team-content span{
	color: <?php echo esc_attr($main_color); ?>;
}

.navbar-nav  li.current-menu-ancestor > a, .navbar-nav  li.current-menu-parent > a, .navbar-nav  li.current-menu-ancestor > a, .navbar-nav  li.active > a{
	color: <?php echo esc_attr($main_color); ?> !important
}

<?php echo esc_attr($element_options['custom-css']); ?>
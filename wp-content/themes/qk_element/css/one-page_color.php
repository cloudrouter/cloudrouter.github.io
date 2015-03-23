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
.navbar-nav > li > a:hover,
.navbar-nav > li > a.active {
  color: <?php echo esc_attr($main_color); ?> !important;
}
.services-post2 span i ,.navbar-nav a.open-search:hover i, .blog-section .blog-box .blog-post .blog-gal .blog-hover a:hover, .blog-section .blog-box .blog-post h2 a:hover, .blog-section .blog-box .blog-post ul.post-tags li a:hover, .blog-section .blog-box .blog-post > a,.blog-post.single-post .social-tag-post .single-post-icons ul li a:hover,.blog-post.single-post .comment-section ul.comment-tree li .comment-box .comment-content h3,.blog-post.single-post .comment-section ul.comment-tree li .comment-box .comment-content a:hover,.portfolio-box .work-post .hover-box .inner-hover a:hover i,#contact-form .message.success,.page-banner-section ul li a:hover ,.services-box1 .services-post span i, .blog-section .blog-box .blog-post .blog-gal .blog-hover a:hover,
.services-box2 .services-post span i, .services-box1 .services-post .services-content a:hover,
.services-box2 .services-post .services-content a:hover,.services-box3 .services-post span i ,.banner-text1-section h1 a:hover, .testimonial-box2 ul li span, .statistic-box .statistic-post h2 , .team-box1 .team-post .team-content span,.cart_totals .order-total .amount, .services-post1 span i,.services-post .services-content a:hove,.team-post2 .team-content span, .statistic-post h2 , .portfolio-box .work-post .hover-box .inner-hover a:hover i {
	color: <?php echo esc_attr($main_color); ?>;
}
.portfolio-box .work-post .hover-box .inner-hover a:hover i, .blog-section .blog-box .blog-post .blog-gal .blog-hover a:hover i, .services-post span i{
	color: <?php echo esc_attr($main_color); ?> ;
}
a.button-one, .page-banner-section2, ul.pagination-list li a:hover,
ul.pagination-list li a.active,.blog-post.single-post .social-tag-post .single-post-tags ul li a:hover,.blog-post.single-post #comment-form input[type="submit"],.portfolio-page ul.filter li a:hover,
.portfolio-page ul.filter li a.active, a.prev-link:hover,
a.next-link:hover, .reply-box form.project-form input[type="submit"] , .contact-section ul.social-list li a:hover,#contact-form input[type="submit"], .information-section .info-box .info-post i, .services-box2 .services-post span,.services-box3 .services-post:hover span, .pricing-box1 ul.pricing-table li a, .pricing-box1 ul.pricing-table:hover li:first-child, .pricing-box2 ul.pricing-table li a:hover, .pricing-box2 ul.pricing-table:hover li:first-child, .banner-text1-section, .banner-text1-section h1 a, .banner-text2-section h1 a, .skills-box .skills-progress div.meter p, .steps-box div.step:hover, .accord-elem.active .accord-title h2 a,
.toogle-elem.active .toogle-title h2 a, ul.element-social-icons li a:hover,.woocommerce .cart-collaterals .shipping_calculator .button:hover, .woocommerce-page .cart-collaterals .shipping_calculator .button:hover,  .services-post1:hover span, ul.pricing-table li a,.services-post3 span, .skills-progress div.meter p,  .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon, ul.pricing-table:hover > li:first-child, ul.pricing-table2:hover > li:first-child , ul.pricing-table2 li a:hover{
	background: <?php echo esc_attr($main_color); ?>;
}
ul.pagination-list li a:hover,
ul.pagination-list li a.active ,.blog-post.single-post #comment-form input[type="text"]:focus, .portfolio-page ul.filter li a:hover,
.portfolio-page ul.filter li a.active, 
.blog-post.single-post #comment-form textarea:focus, .reply-box form.project-form input[type="text"]:focus,
.reply-box form.project-form textarea:focus,#contact-form input[type="text"]:focus,.testimonial-box1 .bx-wrapper .bx-pager.bx-default-pager a.active ,
#contact-form textarea:focus, .steps-box div.step:hover,.wpcf7-text:focus, .wpcf7-textarea:focus {
	border-color: <?php echo esc_attr($main_color); ?>;
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

.form-control:focus, ul.pagination-list li .current{
	border-color: <?php echo esc_attr($main_color); ?>;
}
button, input[type="submit"], ul.pagination-list li .current, .header4 .navbar-nav  > li.current-menu-ancestor > a,.header4  .navbar-nav  > li.current-menu-parent > a,.header4  .navbar-nav > li.current-menu-ancestor > a,.header4  .navbar-nav > li.active > a, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button,.woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce #content input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover,.woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider-horizontal .ui-slider-range,.woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce-page .widget_price_filter .price_slider_amount .button:hover{
	background: <?php echo esc_attr($main_color); ?>;
}
.blog-post.single-post .comment-section ul.comment-tree li .comment-box .comment-content h3 a.url, .widget_recent_entries ul li a:hover,.product-categories li a:hover, .product-categories li:hover:before,  .widget_recent_comments ul li a:hover, .widget_archive ul li a:hover, .widget_categories ul li a:hover, .widget_meta ul li a:hover, .widget_pages ul li a:hover, .widget_rss ul li a:hover, .widget_nav_menu ul li a:hover, .widget_recent_entries ul li:hover:before, .widget_recent_comments ul li:hover:before, .widget_archive ul li:hover:before, .widget_categories ul li:hover:before, .widget_meta ul li:hover:before, .widget_pages ul li:hover:before, .widget_rss ul li:hover:before, .widget_nav_menu ul li:hover:before, .product-details span, .woocommerce ul.cart_list li span.amount, .woocommerce ul.product_list_widget li span.amount, .woocommerce-page ul.cart_list li span.amount, .woocommerce-page ul.product_list_widget li span.amount{
	color: <?php echo esc_attr($main_color); ?>;
}
.navbar-nav  li.current-menu-ancestor > a, .navbar-nav  li.current-menu-parent > a, .navbar-nav  li.current-menu-ancestor > a, .navbar-nav  li.active > a{
	color: <?php echo esc_attr($main_color); ?> !important
}
<?php echo esc_attr($element_options['custom-css']); ?>
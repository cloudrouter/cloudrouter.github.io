<div class="blog-post">
	<div class="row">
		<div class="col-md-4 col-sm-4">
			<div class="blog-gal">
				<?php if(has_post_thumbnail()){
					$img = element_thumbnail_url('');
					$img_url = bfi_thumb($img, array('width'=>370, 'height'=> 280));
				}else{
					$img_url = 'http://placehold.it/370x280';
				}?>
				<img src="<?php echo esc_attr($img_url); ?>" alt="<?php the_title(); ?>">
				<div class="date-post">
					<p><span><?php the_time('d'); ?></span><?php the_time('M'); ?></p>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-sm-8">
			<div class="blog-content">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<ul class="post-tags">
					<li><?php _e('by', 'element'); ?> <?php the_author_posts_link(); ?></li>
					<li><a href="#"><?php the_time('D F Y'); ?></a></li>
					<li><?php the_category(', '); ?></li>
					<li><?php comments_popup_link(__('0 Comment ', 'element'), __('1 Comment', 'element'), __(' % Comments', 'element')); ?></li>
				</ul>
				<p><?php echo do_shortcode(element_excerpt($limit = 40)); ?></p>
				<a href="<?php the_permalink(); ?>"><?php _e('Details', 'element'); ?>  <i class="fa fa-angle-right"></i></a>									
			</div>
		</div>
	</div>
</div>
<div <?php post_class('blog-post'); ?>>
	<div class="blog-content">
		<?php 
		$gallery = get_post_meta(get_the_ID(), '_cmb_post_slider', true);
		?>
		<?php if(count($gallery)>0 and $gallery!=''){ ?>
		<div class="blog-gal">
			<div class="flexslider">
				<ul class="slides">
					<?php foreach($gallery as $img) {?>
					<li>
						<img src="<?php echo esc_attr($img); ?>" alt="<?php the_title(); ?>" />
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php } ?>
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
<div <?php post_class('blog-post'); ?>>
	<div class="date-type">
		<div class="date-post">
			<p><span><?php the_time('d')?></span><?php the_time('M'); ?></p>
		</div>
		<div class="type-post">
			<i class="fa fa-picture-o"></i>
		</div>
	</div>
	<div class="blog-content">
		<?php if(has_post_thumbnail()){ ?>
		<div class="blog-gal">
			<?php the_post_thumbnail(); ?>
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
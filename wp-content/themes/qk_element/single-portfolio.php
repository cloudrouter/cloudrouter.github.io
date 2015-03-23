<?php get_header(); ?>
<?php global $wp_query; ?>
		<!-- content 
			================================================== -->
		<div id="content">

			<!-- page-banner-section
				================================================== -->
			<div class="section-content page-banner-section">
				<div class="container">
					<h1><?php single_post_title(); ?></h1>
					<?php element_breadcrumb(); ?>
				</div>
			</div>
			
			<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_portfolio_type', true)=='type2'){ ?>
			<!-- project-page-section
				================================================== -->
			<div class="section-content project-page-section project-layout2">
				<div class="container">
				<?php while (have_posts()) : the_post(); ?>
					<div class="row">
						<div class="col-md-8">
							<?php 
								$gallery = get_post_meta(get_the_ID(), '_cmb_p_slider', true);
							?>
							<?php if(count($gallery)>0 and $gallery!=''){ ?>
							<div class="project-gallery">
								<div class="flexslider">
									<ul class="slides">
										<?php foreach($gallery as $img) {?>
										<li>
											<img alt="<?php the_title(); ?>" src="<?php echo esc_attr($img); ?>" />
										</li>
										<?php } ?>
									</ul>
								</div>
							</div>
							<?php }else{
								the_post_thumbnail();
							}?>
						</div>
						<div class="col-md-4">
							<div class="project-title">
								<h1><?php the_title(); ?></h1>
								<span><?php the_time('d F Y'); ?></span>
								<div class="project-arrows">
									<?php
									$prev_post = get_adjacent_post(false, '', true);
									?>
									<?php if($prev_post!=null){ ?>
									<a title="<?php echo esc_attr($prev_post->post_title); ?>" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="prev-link"><i class="fa fa-angle-left"></i></a>
									<?php } ?>
									<?php $next_post = get_adjacent_post(false, '', false); ?>
									<?php if($next_post!=null){ ?>
									<a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" title="<?php echo esc_attr($next_post->post_title); ?>" class="next-link"><i class="fa fa-angle-right"></i></a>
									<?php } ?>
								</div>				
							</div>
							<div class="project-content">
								<h2><?php _e('Project Description', 'element'); ?></h2>
								<?php the_content(); ?>
								<h2><?php _e('Project Details','element'); ?></h2>
								<ul class="project-tags">
									<?php if(get_post_meta(get_the_ID(), '_cmb_p_slient', true)!=''){ ?>
									<li><?php _e('Client','element'); ?>: <span><?php echo esc_html(get_post_meta(get_the_ID(), '_cmb_p_slient', true)); ?></span></li>
									<?php } ?>
									
									<li><?php _e('Category','element'); ?>: <?php $skill = get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?> <?php echo do_shortcode($skill); ?></li>
									<?php if(get_post_meta(get_the_ID(), '_cmb_p_copy', true)!=''){ ?>
									<li><?php _e('Copyright','element'); ?>: <span><?php echo esc_html(get_post_meta(get_the_ID(), '_cmb_p_copy', true)); ?></span></li>
									<?php } ?>
									<?php if(get_post_meta(get_the_ID(), '_cmb_p_link', true)!=''){ ?>
									<li><?php _e('Project URL','element'); ?>: <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cmb_p_link', true)); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), '_cmb_p_link', true)); ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				</div>
			</div>

			<!-- portfolio-section
				================================================== -->
			<div class="section-content portfolio-section2">
				<div class="title-section">
					<div class="container triggerAnimation animated" data-animate="bounceIn">
						<h1><?php _e('You May Also Like This','element'); ?></h1>			
					</div>
				</div>

				<div class="portfolio-box triggerAnimation animated" data-animate="fadeIn">
					<div class="container">
						<div id="owl-demo" class="owl-carousel">

							<?php
								$item_cats = get_the_terms( $wp_query->get_queried_object_id(), 'portfolio_category');
								$portfolio_cats = array();
								foreach((array)$item_cats as $item_cat){
									$portfolio_cats[] = $item_cat->slug;
								}
								//print_r($portfolio_cats);
								$id = $wp_query->get_queried_object_id();
								$query = new WP_Query(array('post__not_in' => array( $id ),'post_type'=>'portfolio','posts_per_page'=>9,'tax_query' => array(array('taxonomy' => 'portfolio_category',
						'field' => 'slug','terms' => $portfolio_cats))));
							?>
							<?php while($query->have_posts()) : $query->the_post();?>
							
							<?php
								$img = element_thumbnail_url('');
							?>
							<div class="item work-post">
								<img alt="<?php the_title(); ?>" src="<?php echo esc_attr(bfi_thumb($img, array('width'=>450, 'height'=> 353))); ?>">
								<div class="hover-box">
									<div class="inner-hover">
										<h2><?php the_title(); ?></h2>
										<p><?php the_time('d F Y'); ?></p>
										<a class="link" href="<?php the_permalink(); ?>"><i class="fa fa-search"></i></a>
										<a class="zoom" href="<?php echo esc_url($img); ?>"><i class="fa fa-picture-o"></i></a>
									</div>						
								</div>
							</div>
							<?php endwhile; ?>
						</div>
					</div>

				</div>
			</div>
			<?php }elseif(get_post_meta($wp_query->get_queried_object_id(), '_cmb_portfolio_type', true)=='type3'){ ?>
				<!-- project-page-section
				================================================== -->
			<div class="section-content project-page-section project-layout2">
				<div class="container">
				<?php while(have_posts()) : the_post(); ?>
					<div class="row">
						<div class="col-md-8">
							<div class="project-gallery">
								<?php 
									$gallery = get_post_meta(get_the_ID(), '_cmb_p_slider', true);
								?>
								<?php if(count($gallery)>0 and $gallery!=''){ ?>
								<div class="flexslider" id="slider2">
									<ul class="slides">
										<?php foreach($gallery as $img) {?>
										<li>
											<img src="<?php echo esc_attr($img); ?>" />
										</li>
										<?php } ?>
									</ul>
								</div>
								<div id="carousel" class="flexslider">
									<ul class="slides">
										<?php foreach($gallery as $img) {?>
										<li>
											<img src="<?php echo esc_attr($img); ?>" />
										</li>
										<?php } ?>
									</ul>
								</div>
								<?php }else{
									the_post_thumbnail(); 
								} ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="project-title">
								<h1><?php the_title(); ?></h1>
								<span><?php the_time('d F Y'); ?></span>
								<div class="project-arrows">
									<?php
									$prev_post = get_adjacent_post(false, '', true);
									?>
									<?php if($prev_post!=null){ ?>
									<a title="<?php echo esc_attr($prev_post->post_title); ?>" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="prev-link"><i class="fa fa-angle-left"></i></a>
									<?php } ?>
									<?php $next_post = get_adjacent_post(false, '', false); ?>
									<?php if($next_post!=null){ ?>
									<a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" title="<?php echo esc_attr($next_post->post_title); ?>" class="next-link"><i class="fa fa-angle-right"></i></a>
									<?php } ?>
								</div>				
							</div>
							<div class="project-content">
								<h2><?php _e('Project Description', 'element'); ?></h2>
								<?php the_content(); ?>
								<h2><?php _e('Project Details','element'); ?></h2>
								<ul class="project-tags">
									<?php if(get_post_meta(get_the_ID(), '_cmb_p_slient', true)!=''){ ?>
									<li><?php _e('Client','element'); ?>: <span><?php echo esc_html(get_post_meta(get_the_ID(), '_cmb_p_slient', true)); ?></span></li>
									<?php } ?>
									
									<li><?php _e('Category','element'); ?>: <?php $skill = get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?> <?php echo do_shortcode($skill); ?></li>
									<?php if(get_post_meta(get_the_ID(), '_cmb_p_copy', true)!=''){ ?>
									<li><?php _e('Copyright','element'); ?>: <span><?php echo esc_html(get_post_meta(get_the_ID(), '_cmb_p_copy', true)); ?></span></li>
									<?php } ?>
									<?php if(get_post_meta(get_the_ID(), '_cmb_p_link', true)!=''){ ?>
									<li><?php _e('Project URL','element'); ?>: <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cmb_p_link', true)); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), '_cmb_p_link', true)); ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				</div>
			</div>

			<!-- portfolio-section
				================================================== -->
			<div class="section-content portfolio-section2">
				<div class="title-section">
					<div class="container">
						<h1>You May Also Like This</h1>			
					</div>
				</div>

				<div class="portfolio-box">
					<div class="container">
						<div id="owl-demo" class="owl-carousel">

							<?php
							$item_cats = get_the_terms( $wp_query->get_queried_object_id(), 'portfolio_category');
							$portfolio_cats = array();
							foreach((array)$item_cats as $item_cat){
								$portfolio_cats[] = $item_cat->slug;
							}
							//print_r($portfolio_cats);
							$id = $wp_query->get_queried_object_id();
							$query = new WP_Query(array('post__not_in' => array( $id ),'post_type'=>'portfolio','posts_per_page'=>9,'tax_query' => array(array('taxonomy' => 'portfolio_category',
					'field' => 'slug','terms' => $portfolio_cats))));
						?>
						<?php while($query->have_posts()) : $query->the_post();?>
						
						<?php
							$img = element_thumbnail_url('');
						?>
						<div class="work-post">
							<img alt="<?php the_title(); ?>" src="<?php echo esc_attr(bfi_thumb($img, array('width'=>450, 'height'=> 353))); ?>">
							<div class="hover-box">
								<div class="inner-hover">
									<h2><?php the_title(); ?></h2>
									<p><?php the_time('d F Y'); ?></p>
									<a class="link" href="<?php the_permalink(); ?>"><i class="fa fa-search"></i></a>
									<a class="zoom" href="<?php echo esc_url($img); ?>"><i class="fa fa-picture-o"></i></a>
								</div>						
							</div>
						</div>
						<?php endwhile; ?>

						</div>
					</div>

				</div>
			</div>
			<?php }elseif(get_post_meta($wp_query->get_queried_object_id(), '_cmb_portfolio_type', true)=='type4'){ ?>
				<div class="section-content project-page-section project-layout2">
				<div class="container">
				<?php while(have_posts()) : the_post(); ?>
					<div class="row">
						<div class="col-md-8">
							<div class="project-gallery">
								<?php 
									$gallery = get_post_meta(get_the_ID(), '_cmb_p_slider', true);
								?>
								<?php if(count($gallery)>0 and $gallery!=''){ ?>
								<div class="project-gallery">
									<div class="flexslider">
										<ul class="slides">
											<?php foreach($gallery as $img) {?>
											<li>
												<img alt="<?php the_title(); ?>" src="<?php echo esc_attr($img); ?>" />
											</li>
											<?php } ?>
										</ul>
									</div>
								</div>
								<?php }else{
									the_post_thumbnail();
								}?>
							</div>
							<div class="reply-box">
								<h2>Post Reply</h2>
								<?php comments_template(); ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="project-title">
								<h1><?php the_title(); ?></h1>
								<span><?php the_time('d F Y'); ?></span>
								<div class="project-arrows">
									<?php
									$prev_post = get_adjacent_post(false, '', true);
									?>
									<?php if($prev_post!=null){ ?>
									<a title="<?php echo esc_attr($prev_post->post_title); ?>" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="prev-link"><i class="fa fa-angle-left"></i></a>
									<?php } ?>
									<?php $next_post = get_adjacent_post(false, '', false); ?>
									<?php if($next_post!=null){ ?>
									<a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" title="<?php echo esc_attr($next_post->post_title); ?>" class="next-link"><i class="fa fa-angle-right"></i></a>
									<?php } ?>
								</div>				
							</div>
							<div class="project-content">
								<h2><?php _e('Project Description', 'element'); ?></h2>
								<?php the_content(); ?>
								<h2><?php _e('Project Details','element'); ?></h2>
								<ul class="project-tags">
									<?php if(get_post_meta(get_the_ID(), '_cmb_p_slient', true)!=''){ ?>
									<li><?php _e('Client','element'); ?>: <span><?php echo esc_html(get_post_meta(get_the_ID(), '_cmb_p_slient', true)); ?></span></li>
									<?php } ?>
									
									<li><?php _e('Category','element'); ?>: <?php $skill = get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?> <?php echo do_shortcode($skill); ?></li>
									<?php if(get_post_meta(get_the_ID(), '_cmb_p_copy', true)!=''){ ?>
									<li><?php _e('Copyright','element'); ?>: <span><?php echo esc_html(get_post_meta(get_the_ID(), '_cmb_p_copy', true)); ?></span></li>
									<?php } ?>
									<?php if(get_post_meta(get_the_ID(), '_cmb_p_link', true)!=''){ ?>
									<li><?php _e('Project URL','element'); ?>: <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cmb_p_link', true)); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), '_cmb_p_link', true)); ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				</div>
			</div>

			<!-- portfolio-section
				================================================== -->
			<div class="section-content portfolio-section2">
				<div class="title-section">
					<div class="container triggerAnimation animated" data-animate="bounceIn">
						<h1>You May Also Like This</h1>			
					</div>
				</div>

				<div class="portfolio-box triggerAnimation animated" data-animate="fadeIn">
					<div class="container">
						<div id="owl-demo" class="owl-carousel">

						
							<?php
							$item_cats = get_the_terms( $wp_query->get_queried_object_id(), 'portfolio_category');
							$portfolio_cats = array();
							foreach((array)$item_cats as $item_cat){
								$portfolio_cats[] = $item_cat->slug;
							}
							//print_r($portfolio_cats);
							$id = $wp_query->get_queried_object_id();
							$query = new WP_Query(array('post__not_in' => array( $id ),'post_type'=>'portfolio','posts_per_page'=>9,'tax_query' => array(array('taxonomy' => 'portfolio_category',
					'field' => 'slug','terms' => $portfolio_cats))));
						?>
						<?php while($query->have_posts()) : $query->the_post();?>
						
						<?php
							$img = element_thumbnail_url('');
						?>
						<div class="work-post">
							<img alt="<?php the_title(); ?>" src="<?php echo esc_attr(bfi_thumb($img, array('width'=>450, 'height'=> 353))); ?>">
							<div class="hover-box">
								<div class="inner-hover">
									<h2><?php the_title(); ?></h2>
									<p><?php the_time('d F Y'); ?></p>
									<a class="link" href="<?php the_permalink(); ?>"><i class="fa fa-search"></i></a>
									<a class="zoom" href="<?php echo esc_url($img); ?>"><i class="fa fa-picture-o"></i></a>
								</div>						
							</div>
						</div>
						<?php endwhile; ?>

						</div>
					</div>

				</div>
			</div>
			<?php }else{ ?>
			<!-- project-page-section
				================================================== -->
			<div class="section-content project-page-section">
				<div class="container">
				<?php while(have_posts()) : the_post(); ?>
					<div class="project-title">
						<h1><?php the_title(); ?></h1>
						<span><?php the_time('d F Y'); ?></span>
						<div class="project-arrows">
							<?php
							$prev_post = get_adjacent_post(false, '', true);
							?>
							<?php if($prev_post!=null){ ?>
							<a title="<?php echo esc_attr($prev_post->post_title); ?>" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="prev-link"><i class="fa fa-angle-left"></i></a>
							<?php } ?>
							<?php $next_post = get_adjacent_post(false, '', false); ?>
							<?php if($next_post!=null){ ?>
							<a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" title="<?php echo esc_attr($next_post->post_title); ?>" class="next-link"><i class="fa fa-angle-right"></i></a>
							<?php } ?>
						</div>				
					</div>
					<?php 
						$gallery = get_post_meta(get_the_ID(), '_cmb_p_slider', true);
					?>
					<?php if(count($gallery)>0 and $gallery!=''){ ?>
					<div class="project-gallery">
						<div class="flexslider">
							<ul class="slides">
								<?php foreach($gallery as $img) {?>
								<li>
									<img alt="<?php the_title(); ?>" src="<?php echo esc_attr($img); ?>" />
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<?php } ?>
					<div class="project-content">
						<div class="row">
							<div class="col-md-9 col-sm-8">
								<h2><?php _e('Project Description', 'element'); ?></h2>
								<?php the_content(); ?>
							</div>
							<div class="col-md-3 col-sm-4">
								<h2><?php _e('Project Details','element'); ?></h2>
								<ul class="project-tags">
									<?php if(get_post_meta(get_the_ID(), '_cmb_p_slient', true)!=''){ ?>
									<li><?php _e('Client','element'); ?>: <span><?php echo esc_html(get_post_meta(get_the_ID(), '_cmb_p_slient', true)); ?></span></li>
									<?php } ?>
									
									<li><?php _e('Category','element'); ?>: <?php $skill = get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?> <?php echo do_shortcode($skill); ?></li>
									<?php if(get_post_meta(get_the_ID(), '_cmb_p_copy', true)!=''){ ?>
									<li><?php _e('Copyright','element'); ?>: <span><?php echo esc_html(get_post_meta(get_the_ID(), '_cmb_p_copy', true)); ?></span></li>
									<?php } ?>
									<?php if(get_post_meta(get_the_ID(), '_cmb_p_link', true)!=''){ ?>
									<li><?php _e('Project URL','element'); ?>: <a href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cmb_p_link', true)); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), '_cmb_p_link', true)); ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				</div>
			</div>

			<!-- portfolio-section
				================================================== -->
			<div class="section-content portfolio-section">
				<div class="portfolio-title">
					<div class="container triggerAnimation animated" data-animate="bounceIn">
						<h1>You May Also Like This</h1>						
					</div>
				</div>

				<div class="portfolio-box triggerAnimation animated" data-animate="fadeIn">
					<?php
						$item_cats = get_the_terms( $wp_query->get_queried_object_id(), 'portfolio_category');
						$portfolio_cats = array();
						foreach((array)$item_cats as $item_cat){
							$portfolio_cats[] = $item_cat->slug;
						}
						//print_r($portfolio_cats);
						$id = $wp_query->get_queried_object_id();
						$query = new WP_Query(array('post__not_in' => array( $id ),'post_type'=>'portfolio','posts_per_page'=>5,'tax_query' => array(array('taxonomy' => 'portfolio_category',
				'field' => 'slug','terms' => $portfolio_cats))));
					?>
					<?php while($query->have_posts()) : $query->the_post();?>
					
					<?php
						$img = element_thumbnail_url('');
					?>
					<div class="work-post">
						<img alt="<?php the_title(); ?>" src="<?php echo esc_attr(bfi_thumb($img, array('width'=>450, 'height'=> 353))); ?>">
						<div class="hover-box">
							<div class="inner-hover">
								<h2><?php the_title(); ?></h2>
								<p><?php the_time('d F Y'); ?></p>
								<a class="link" href="<?php the_permalink(); ?>"><i class="fa fa-search"></i></a>
								<a class="zoom" href="<?php echo esc_url($img); ?>"><i class="fa fa-picture-o"></i></a>
							</div>						
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
			<?php } ?>
		</div>
		<!-- End content -->
<?php get_footer(); ?>
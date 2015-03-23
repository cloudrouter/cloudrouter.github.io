<?php get_header(); ?>
<?php global $element_options; ?>
		<!-- content 
			================================================== -->
		<div id="content">

			<!-- page-banner-section
				================================================== -->
			<div class="section-content page-banner-section">
				<?php if($element_options['body_style'] == 'vertical-dark'){ ?>
					<div class="page-banner-box">
				<?php } ?>
						<div class="container">
							<h1><?php single_post_title(); ?></h1>
							<?php element_breadcrumb(); ?>
						</div>
				<?php if($element_options['body_style'] == 'vertical-dark'){ ?>
					</div>
				<?php } ?>
			</div>
			<?php if($element_options['body_style'] == 'vertical-light' or $element_options['body_style'] == 'vertical-dark'){ ?>
			<div class="content-box">
				
					<div class="container-fluid">
			<?php } ?>
			<!-- blog-section
				================================================== -->
			<div class="section-content blog-section blog-standard">
				<div class="container">
					<div class="blog-box">

						<div class="blog-post single-post">
						<?php while(have_posts()) : the_post(); ?>
							<div class="blog-content">
								<?php if(get_post_format()=='video'){ ?>
									<?php if(get_post_meta(get_the_ID(), '_cmb_intro_video', true)!=''){ ?>
										<div class="blog-gal">
											<!-- youtube -->
											<?php echo wp_oembed_get(get_post_meta(get_the_ID(), '_cmb_intro_video', true)); ?>
											<!-- End youtube -->
										</div>
									<?php } ?>
								<?php }elseif(get_post_format()=='gallery'){ ?>
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
								<?php }elseif(has_post_thumbnail()){ ?>
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
								<div class="main-blog">
								<?php the_content(); ?>
								<?php
									$defaults = array(
										'before'           => '<div id="page-links"><strong>Page: </strong>',
										'after'            => '</div>',
										'link_before'      => '<span>',
										'link_after'       => '</span>',
										'next_or_number'   => 'number',
										'separator'        => ' ',
										'nextpagelink'     => __( 'Next page','pioneer' ),
										'previouspagelink' => __( 'Previous page','pioneer' ),
										'pagelink'         => '%',
										'echo'             => 1
									);
								 ?>
								<?php wp_link_pages($defaults); ?>		
								</div>
							</div>
							<div class="social-tag-post">
								<div class="row">
									<div class="col-md-6">
										<div class="single-post-tags">
											<?php if(has_tag()){ ?>
												
												<?php the_tags('<ul class="single-post-tags"><li><span>Tags: </span> </li><li>',' </li><li>','</li></ul>'); ?>
												
												<?php } ?>
											
										</div>
									</div>
									<div class="col-md-6">
										<div class="single-post-icons">
											<ul>
												<li><span><?php _e('Share','element'); ?>:</span></li>
												<li><a onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook-square"></i></a></li>
												<li><a  onclick="window.open('http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>"><i class="fa fa-twitter"></i></a></li>
												<li><a onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','Google plus','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a></li>
												<li><a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"><i class="fa fa-pinterest"></i></a></li>
												<li><a onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>','Linkedin','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>"><i class="fa fa-linkedin"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<?php global $post; ?>
							<?php if('open' == $post->comment_status){ ?>
							<?php comments_template(); ?>
							<?php } ?>
						<?php endwhile; ?>
						</div>

					</div>
				</div>
			</div>
			<?php if($element_options['body_style'] == 'vertical-light' or $element_options['body_style'] == 'vertical-dark'){ ?>
				</div></div>
			<?php } ?>
		</div>
		<!-- End content -->
<?php get_footer(); ?>
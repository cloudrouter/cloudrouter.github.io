<?php global $element_options; ?>
<?php if($element_options['body_style'] != 'vertical-light'){ ?>
<?php if($element_options['body_style'] != 'vertical-dark'){ ?>
<?php if(!is_page_template('template-comming_soon.php')){ ?>
		<!-- footer 
			================================================== -->
		<footer>
			<div class="up-footer">
				<div class="container">
					<div class="row">

						<div class="col-md-3 col-sm-6">
							<?php 
							
							if(is_active_sidebar('footer-1')){
								dynamic_sidebar('footer-1'); 
							}
							
							?>	
							
						</div>

						<div class="col-md-3 col-sm-6">
							<?php 
							
							if(is_active_sidebar('footer-2')){
								dynamic_sidebar('footer-2'); 
							}
							
							?>	
						</div>

						<div class="clearfix visible-sm-block"></div>

						<div class="col-md-3 col-sm-6">
							<?php 
							
							if(is_active_sidebar('footer-3')){
								dynamic_sidebar('footer-3'); 
							}
							
							?>							
						</div>

						<div class="col-md-3 col-sm-6">
							<?php 
							
							if(is_active_sidebar('footer-4')){
								dynamic_sidebar('footer-4'); 
							}
							
							?>							
						</div>

					</div>
				</div>
					
			</div>
	<?php } ?>
			<div class="footer-line">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<?php echo do_shortcode($element_options['footer-text']); ?>
						</div>
						<div class="col-md-6">
							<?php 
								$defaults2= array(
										'theme_location'  => 'footer_menu',
										'menu'            => '',
										'container'       => '',
										'container_class' => '',
										'container_id'    => '',
										'menu_class'      => 'footer-menu',
										'menu_id'         => '',
										'echo'            => true,
										 'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
										'before'          => '',
										'after'           => '',
										'link_before'     => '',
										'link_after'      => '',
										'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="%2$s">%3$s</ul>',
										'depth'           => 0,
									);
									if ( has_nav_menu( 'footer_menu' ) ) {
										wp_nav_menu( $defaults2 );
									} 
								?>
							
						</div>						
					</div>					
				</div>
			</div>

		</footer>
		<!-- End footer -->
	
	<?php } ?>
<?php } ?>
	</div>
	<!-- End Container -->
	
	<!-- Contents of register window -->
	<div id="register-popup" class="mfp-hide white-popup">
		<div class="some-element">
			<h1>Element</h1>
			<h2>Become a Member</h2>
			<form class="become-member">
				<div class="inner-form">
					<label><i class="fa fa-envelope"></i></label>
					<input type="text" placeholder="Email"/> <br>
					<label><i class="fa fa-lock"></i></label>
					<input type="password" placeholder="Password"/>
				</div>
				<a href="#" class="button-one">Continue</a>
			</form>
		</div>
	</div>

    <?php wp_footer(); ?>
</body>
</html>
<?php 
/*
*Template Name: Comming Soon
*/
?>
<?php global $element_options;?>
<?php get_header(); ?>

		<!-- content 
			================================================== -->
		<div id="content">

			<!-- coming-soon section
				================================================== -->
			<div class="section-content coming-soon-section">
				<h1 id="clock">
					<span id="daysLeft">22</span> : 
					<span id="hours"></span> : 
					<span id="minutes"></span> : 
					<span id="seconds"></span>
				</h1>
			</div>

		</div>
		<!-- End content -->

	<script>
		(function($){
			$(document).ready(function(){
				$('#clock').countdown("<?php echo esc_js($element_options['countdown']); ?>", function(event) {
					var $this = $(this);
					switch(event.type) {
						case "seconds":
						case "minutes":
						case "hours":
						case "days":
						case "daysLeft":
							$this.find('span#'+event.type).html(event.value);
							break;
						case "finished":
							$this.hide();
							break;
					}
				});
			});
		})(jQuery);
	</script>
<?php get_footer(); ?>
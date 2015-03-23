<?php
	class WpFastestCacheAdminToolbar{
		public function __construct(){}

		public function add(){
			add_action( 'wp_before_admin_bar_render', array($this, "wpfc_tweaked_admin_bar") );
		}

		public function wpfc_tweaked_admin_bar() {
			global $wp_admin_bar;

			$wp_admin_bar->add_node(array(
				'id'    => 'wpfc-toolbar-parent',
				'title' => ''
			));

			$wp_admin_bar->add_menu( array(
				'id'    => 'wpfc-toolbar-parent-delete-cache',
				'title' => 'Delete Cache',
				'parent'=> 'wpfc-toolbar-parent',
				'meta' => array("class" => "wpfc-toolbar-child")
			));

			$wp_admin_bar->add_menu( array(
				'id'    => 'wpfc-toolbar-parent-delete-cache-and-minified',
				'title' => 'Delete Cache and Minified CSS/JS',
				'parent'=> 'wpfc-toolbar-parent',
				'meta' => array("class" => "wpfc-toolbar-child")
			));
			?>
			<script type="text/javascript">
				jQuery( document ).ready(function() {
					jQuery("body").append('<div id="revert-loader-toolbar"></div>');
 
					jQuery("#wp-admin-bar-wpfc-toolbar-parent-default li").click(function(e){
						var id = (typeof e.target.id != "undefined" && e.target.id) ? e.target.id : jQuery(e.target).parent("li").attr("id");
						var action = "";
						
						if(id == "wp-admin-bar-wpfc-toolbar-parent-delete-cache"){
							action = "wpfc_delete_cache";
						}else if(id == "wp-admin-bar-wpfc-toolbar-parent-delete-cache-and-minified"){
							action = "wpfc_delete_cache_and_minified";
						}
						jQuery("#revert-loader-toolbar").show();
						jQuery.ajax({
							type: 'GET',
							url: "<?php echo admin_url(); ?>admin-ajax.php",
							data : {"action": action},
							dataType : "json",
							cache: false, 
							success: function(data){
								if(typeof WpFcCacheStatics != "undefined"){
									WpFcCacheStatics.update();
								}else{
									jQuery("#revert-loader-toolbar").hide();
								}
							}
						});
					});
				});
			</script>
			<?php

		}
	}
?>
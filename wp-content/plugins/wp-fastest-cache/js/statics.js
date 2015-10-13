var WpFcStatics = {
	ajax_url: "",
	plugin_dir_url: "",
	current_page: 0,
	total_page: 0,
	per_page: 5,
	statics: {},
	init: function(ajax_url, plugin_dir_url){
		this.ajax_url = ajax_url;
		this.plugin_dir_url = plugin_dir_url;
		this.set_click_event_show_hide_button();
		this.set_click_event_optimize_image_button();
		this.set_click_event_search_button();
		this.set_click_event_paging();
		this.set_click_event_clear_search_text();
		this.set_click_event_filter();
		this.set_click_event_per_page();
		this.set_click_event_buy_image_credit();
	},
	set_click_event_buy_image_credit: function(){
		var self = this;

		jQuery("#buy-image-credit").click(function(){

			var shop = jQuery('<div id="wpfc-shop-modal" style="width: 500px;height: 100px;"></div>');
			jQuery("body").append(shop);

			var windowHeight = (jQuery(window).height() - shop.height())/2 + jQuery(window).scrollTop();
			var windowWidth = (jQuery(window).width() - shop.width())/2;
			shop.css({"top": windowHeight, "left": windowWidth});


			jQuery.ajax({
				type: 'GET', 
				url: self.plugin_dir_url + "/wp-fastest-cache-premium/pro/templates/buy_credit.php",
				cache: false,
				error: function(x, t, m) {
					alert(t);
				},
				success: function(data){
					jQuery("#wpfc-shop-modal").css({"background" : "white"});
					jQuery("#wpfc-shop-modal").html(data);

					windowHeight = 35 + jQuery(window).scrollTop();
					windowWidth = (jQuery(window).width() - shop.width())/2;
					shop.css({"top": windowHeight, "left": windowWidth});

					self.event_on_shop();

				}
			});
		});
	},
	event_on_shop: function(){
		jQuery("#wpfc-product-selection-list li").hover(function(e){
			jQuery("#wpfc-product-selection-list li label").removeClass("hover");
			jQuery(e.target).addClass("hover");
		});

		jQuery("#wpfc-product-selection-list li").click(function(e){
			if(jQuery(e.target).prop("tagName") == "LABEL"){
				jQuery("#wpfc-product-selection-list li label").removeClass("checked");
				jQuery(e.target).addClass("checked");
			}

			if(jQuery(e.target).prop("tagName") == "SPAN"){
				jQuery("#wpfc-product-selection-list li label").removeClass("checked");
				jQuery(e.target).closest("LABEL").addClass("checked");
			}

			if(jQuery(e.target).prop("tagName") == "INPUT"){
				jQuery("#wpfc-product-selection-list li input").attr("checked", false);
				jQuery(e.target).attr("checked", true);
			}
		});

		jQuery("#wpfc-cancel-buy-credit").click(function(){
			jQuery("#wpfc-shop-modal").remove();
		});
	},
	set_click_event_per_page: function(){
		var self = this;
		
		jQuery("#wpfc-image-per-page").change(function(e){
			self.update_image_list(0);
		});
	},
	set_click_event_filter: function(){
		var self = this;
		
		jQuery("#wpfc-image-list-filter").change(function(e){
			self.update_image_list(0);
		});
	},
	set_click_event_clear_search_text: function(){
		var self = this;

		jQuery("span.deleteicon span").click(function(e){
			jQuery("#wpfc-image-search-input").val("");
			jQuery(e.target).addClass("cleared");
			self.update_image_list(0);
		});

		jQuery("#wpfc-image-search-input").keyup(function(e){
			if(jQuery(e.target).val().length > 0){
				jQuery("span.deleteicon span").removeClass("cleared");
			}else{
				jQuery("span.deleteicon span").addClass("cleared");

				if(e.keyCode == 8){
					self.update_image_list(0);
				}
			}

			if(e.keyCode == 13){
				self.update_image_list(0);
			}
		});
	},
	set_click_event_paging: function(){
		var self = this;
		jQuery(".wpfc-image-list-next-page, .wpfc-image-list-prev-page, .wpfc-image-list-first-page, .wpfc-image-list-last-page").click(function(e){
			if(jQuery(e.target).hasClass("wpfc-image-list-next-page")){
				self.update_image_list(self.current_page + 1);
			}else if(jQuery(e.target).hasClass("wpfc-image-list-prev-page")){
				self.update_image_list(self.current_page - 1);
			}else if(jQuery(e.target).hasClass("wpfc-image-list-first-page")){
				self.update_image_list(0);
			}else if(jQuery(e.target).hasClass("wpfc-image-list-last-page")){
				self.update_image_list(self.total_page - 1);
			}
		});
	},
	set_click_event_search_button: function(){
		var self = this;
		jQuery("#wpfc-image-search-button").click(function(){
			self.update_image_list(0);
		});
	},
	set_click_event_optimize_image_button: function(){
		var self = this;
		jQuery("#wpfc-optimize-images-button").click(function(){
			jQuery("[id^='wpfc-optimized-statics-']").addClass("wpfc-loading-statics");
			jQuery("[id^='wpfc-optimized-statics-']").html("");
			self.optimize_image(self);
		});
	},
	update_image_list: function(page, search){
		var self = this;
		self.per_page = jQuery("#wpfc-image-per-page").val();

		if(page !== 0 && (page < 0 || (page > self.total_page - 1))){
			return;
		}

		jQuery("#revert-loader").show();

		var search = jQuery("#wpfc-image-search-input").val();
		var filter = jQuery("#wpfc-image-list-filter").val();

		jQuery.ajax({
			type: 'GET',
			url: self.ajax_url,
			data : {"action": "wpfc_update_image_list_ajax_request", "page": page, "search" : search, "filter" : filter, 'per_page' : self.per_page},
			dataType : "json",
			cache: false, 
			success: function(data){
				if(typeof data != "undefined" && data){
					self.total_page = Math.ceil(data.result_count/self.per_page);
					self.total_page = self.total_page > 0 ? self.total_page : 1;

					self.current_page = page;

					jQuery(".wpfc-current-page").text(self.current_page + 1);
					jQuery("#the-list").html(data.content);
					jQuery(".wpfc-total-pages").html(self.total_page);
					jQuery("#revert-loader").hide();

					jQuery(".wpfc-image-list-prev-page").removeClass("disabled");
					jQuery(".wpfc-image-list-next-page").removeClass("disabled");
					jQuery(".wpfc-image-list-first-page").removeClass("disabled");
					jQuery(".wpfc-image-list-last-page").removeClass("disabled");

					if((self.current_page + 1) == self.total_page){
						jQuery(".wpfc-image-list-next-page").addClass("disabled");
						jQuery(".wpfc-image-list-last-page").addClass("disabled");
					}

					if(self.current_page === 0){
						jQuery(".wpfc-image-list-prev-page").addClass("disabled");
						jQuery(".wpfc-image-list-first-page").addClass("disabled");
					}

					self.set_click_event_revert_image();

				}else{
					alert("Error: Image List Problem. Please refresh...");
				}
			}
		});
	},
	set_click_event_show_hide_button: function(){
		var self = this;
		jQuery("#show-image-list, #hide-image-list").click(function(e){
			if(e.target.id == "show-image-list"){
				jQuery(e.target).hide();
				jQuery("#hide-image-list").show();
				jQuery("#wpfc-image-list").show();
				jQuery("#wpfc-image-static-panel").hide();
				self.update_image_list(0);
			}else if(e.target.id == "hide-image-list"){
				jQuery(e.target).hide();
				jQuery("#show-image-list").show();
				jQuery("#wpfc-image-list").hide();
				jQuery("#wpfc-image-static-panel").show();
			}
		});
	},
	optimize_image: function(self){
		jQuery("[id^='wpfc-optimized-statics-']").addClass("wpfc-loading-statics");
		jQuery("[id^='wpfc-optimized-statics-']").html("");

		jQuery.ajax({
			type: 'GET', 
			url: self.ajax_url,
			dataType : "json",
			data : {"action": "wpfc_optimize_image_ajax_request"},
			cache: false,
			timeout: 20000,
			error: function(x, t, m) {
				if(t === "timeout") {
					self.modify_statics_html();
				} else {
					alert(t);
				}
			},
			success: function(data){
				if(data && data.success == "success"){
					if(data.message != "finish"){
						self.update_statics(function(){
							setTimeout(function(){
								self.optimize_image(self);
							}, 1500);
						});
					}else{
						self.update_statics();
					}
				}else{
					self.update_statics();
					if(data && typeof data.message != "undefined" && data.message){
						alert(data.message);
					}else{
						alert("Please try later...");
					}
				}
			}
		});
	},
	update_statics: function(callback){
		var self = this;
		

		jQuery("[id^='wpfc-optimized-statics-']").addClass("wpfc-loading-statics");
		jQuery("[id^='wpfc-optimized-statics-']").html("");

		jQuery.ajax({
			type: 'GET', 
			url: self.ajax_url,
			dataType : "json",
			data : {"action": "wpfc_statics_ajax_request"},
			cache: false, 
			success: function(data){
				if(callback){ callback(); }
				self.statics = data;
				self.modify_statics_html();
			}
		});
	},
	modify_statics_html: function(){
		var self = this;
		jQuery.each(this.statics, function(e, i){
			var el = jQuery("#wpfc-optimized-statics-" + e);
			if(el.length === 1){
				if(e == "percent"){
					var percent = i*3.6;

					if(percent > 180){
						jQuery("#wpfc-pie-chart-big-container-first").show();
						jQuery("#wpfc-pie-chart-big-container-second-right").show();
						jQuery('#wpfc-pie-chart-big-container-second-left').animate({  borderSpacing: (percent - 180) }, {
						    step: function(now,fx) {
						      jQuery(this).css('-webkit-transform','rotate('+now+'deg)'); 
						      jQuery(this).css('-moz-transform','rotate('+now+'deg)');
						      jQuery(this).css('transform','rotate('+now+'deg)');
						    },
						    duration:'slow'
						},'linear');

					}else{
						jQuery("#wpfc-pie-chart-big-container-first").hide();
						jQuery("#wpfc-pie-chart-big-container-second-right").hide();

						jQuery('#wpfc-pie-chart-little').animate({  borderSpacing: percent }, {
						    step: function(now,fx) {
						      jQuery(this).css('-webkit-transform','rotate('+now+'deg)'); 
						      jQuery(this).css('-moz-transform','rotate('+now+'deg)');
						      jQuery(this).css('transform','rotate('+now+'deg)');
						    },
						    duration:'slow'
						},'linear');
					}
				}

				el.removeClass("wpfc-loading-statics");
				el.html(i);
			}
		});
	},
	set_click_event_revert_image: function(){
		var self = this;
		jQuery("div.revert").click(function(e){
			jQuery("#revert-loader").show();

			var id = jQuery(e.target).find("input")[0].value;

			jQuery.ajax({
				type: 'GET', 
				url: self.ajax_url,
				dataType : "json",
				data : {"action": "wpfc_revert_image_ajax_request", "id" : id},
				cache: false, 
				success: function(data){
					try{
						if(data.success == "true"){
							self.update_statics(function(){
								jQuery("tr[post-id='" + id + "']").hide(100, function(){
									if(jQuery("#the-list tr:visible").length === 0){
										self.update_image_list(0);
									}else{
										jQuery("#revert-loader").hide();
									}
								});
							});
						}else if(data.success == "false"){
							jQuery("#revert-loader").hide();
							if(typeof data.message != "undefined" && data.message){
								alert(data.message);
							}else{
								alert("Revert Image: " + 'data.success == "false"');
							}
						}

					}catch(err){
						alert("Revert Image: " + err.message);
					}
				}
			});

		});
	}
};
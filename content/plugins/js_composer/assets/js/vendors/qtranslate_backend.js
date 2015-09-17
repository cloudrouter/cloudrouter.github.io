(function ($) {
	$('#content-html').on('click', function () {
		window.setTimeout(function () {
			window.wpActiveEditor = 'qtrans_textarea_content';
		}, 10);
	});

	$(window).ready(function () {
		var activeLang = qtrans_get_active_language(),
			$langs = $('#vc_vendor_qtranslate_langs');

		$('option', $langs).each(function () {
			var $el = $(this);
			if ($el.val() == activeLang) {
				$el.prop('selected', true);
			}
			$('#qtrans_select_' + $el.val()).on('click', function () {
				$el.prop('selected', true);
			});
		});

		$langs.on('change', function () {
			$('#qtrans_select_' + $(this).val()).trigger('click');
			var link = $(":selected", this).attr('link');
			$('.wpb_switch-to-front-composer').each(function () {
				$(this).attr('href', link);
			});
			$('#wpb-edit-inline').attr('href', link);
			vc.shortcodes.fetch({reset: true});
		});

		$langs.show();

		if (!vc) vc = {};
		vc.QtransResetContent = function () {
			$('#content-html').trigger('click');
			$('#qtrans_textarea_content').css('minHeight', '300px');
			wpActiveEditor = 'qtrans_textarea_content';
		};

		vc.Storage.prototype.getContent = function () {
			vc.QtransResetContent();
			return $('#qtrans_textarea_content').val();
		};

		vc.Storage.prototype.setContent = function (content) {
			$('#content-html').trigger('click');
			$('#qtrans_textarea_content').val(content);
			vc.QtransResetContent();
		};

	});
})(window.jQuery);
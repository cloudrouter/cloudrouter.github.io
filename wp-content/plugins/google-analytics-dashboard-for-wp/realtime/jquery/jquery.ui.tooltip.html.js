jQuery(function () {
      jQuery(document).tooltip({
          content: function () {
              return jQuery(this).prop('title');
          }
      });
  });

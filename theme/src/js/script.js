'use strict';

$(document).ready(function() {
  function checkInputContent(input, reset) {
    var $input = $(input);

    if ($input.val() != '') {
      $input.addClass('has-content');
    } else {
      if (reset && $input.prop('defaultValue')) {
        $input.val($input.prop('defaultValue'));
      } else {
        $input.removeClass('has-content');
      }
    }
  }

  // Init fields on page load.
  $('input[type=text],input[type=password]').each(function() {
    checkInputContent(this, true);
  });

  // Update fields on focus out.
  $('input[type=text],input[type=password]').focusout(function() {
    checkInputContent(this, false);
  })

  // Init select fields.
  $('select').select2({
    minimumResultsForSearch: -1,
    width: 'element'
  });
});

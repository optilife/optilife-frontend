'use strict';

$(document).ready(function() {
  function checkInputContent(input) {
    var $input = $(input);

    if ($input.val() != '') {
      $input.addClass('has-content');
    } else {
      if ($input.prop('defaultValue')) {
        $input.val($input.prop('defaultValue'));
      } else {
        $input.removeClass('has-content');
      }
    }
  }

  // Init fields on page load.
  $('input[type=text],input[type=password]').each(function() {
    checkInputContent(this);
  });

  // Update fields on focus out.
  $('input[type=text],input[type=password]').focusout(function() {
    checkInputContent(this);
  })
});

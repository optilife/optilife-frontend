'use strict';

$(document).ready(function() {


  //----- Configuration.

  var fancyInputs = 'input[type=text],input[type=password],input[type=email]';


  //----- Helper functions.

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
  $(fancyInputs).each(function() {
    checkInputContent(this, true);
  });

  // Update fields on focus out.
  $(fancyInputs).focusout(function() {
    checkInputContent(this, false);
  })

  // Init select fields.
  $('select').select2({
    minimumResultsForSearch: -1,
    width: 'element'
  });
});

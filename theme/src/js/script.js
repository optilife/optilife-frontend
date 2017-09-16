'use strict';

$(document).ready(function() {


  //----- Configuration.

  var fancyInputs = 'input[type=text],input[type=password],input[type=email],input[type=number],input[type=date]';


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
    width: '100%'
  });

  // Init easypiechart.

  var easyPieOptions = {
    scaleColor: false,
    trackColor: '#E7F7F5',
    barColor: 'rgba(51,153,255,0.8)',
    lineWidth: 6,
    lineCap: 'butt',
    size: 95,
    animate: 1000
  };

  $('.statistic').easyPieChart(easyPieOptions);
});

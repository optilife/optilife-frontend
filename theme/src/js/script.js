'use strict';

$(document).ready(function() {
  $('input[type=text],input[type=password]').val('');
  $('input[type=text],input[type=password]').focusout(function() {
    var $this = $(this);

    if ($this.val() != '') {
      $this.addClass('has-content');
    } else {
      $this.removeClass('has-content');
    }
  })
});

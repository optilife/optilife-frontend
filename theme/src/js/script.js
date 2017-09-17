'use strict';

$(document).ready(function() {


  //----- Configuration.

  var fancyInputs = 'input[type=text],input[type=password],input[type=email],input[type=number],input[type=date]';
  var $pageTitle = $('title');
  var $pageContent = $('#page-content');
  var $logo = $('#logo svg');


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

  function randomScalingFactor() {
    var min = -100;
    var max = 100;

    return Math.floor(Math.random()*(max-min+1)+min);
  }

  function ajaxPageCallback(data, ajaxUrl) {
    $pageTitle.html(data.title);
    $pageContent.html(data.html);
    parseHtml($pageContent);
    $pageContent.fadeIn(500, function() {
      $logo.removeClass('spin');
    });

    history.pushState({
      title   : data.title,
      html    : data.html,
      ajaxUrl : ajaxUrl
    }, data.title, data.path);

    // Init ShareThis buttons.
    window.__sharethis__.initialize();
  }


  //----- History Loader.

  if (typeof history.state == 'undefined' || history.state == null) {
    history.replaceState({
      title : $pageTitle.html(),
      html  : $pageContent.html(),
      path  : document.location.href
    }, $pageTitle.html(), document.location.href);
  }

  $(window).bind('popstate', function(e) {
    var state = e.originalEvent.state;

    if (typeof state == 'undefined' || state == null) {
      return;
    }

    $pageTitle.html(state.title);
    $pageContent.html(state.html);
    parseHtml($pageContent);
  });


  //----- Ajax helper.

  function parseHtml(context) {
    var context = $(context);

    // Init fields on page load.
    $(context).find(fancyInputs).each(function() {
      checkInputContent(this, true);
    });

    // Update fields on focus out.
    $(context).find(fancyInputs).focusout(function() {
      checkInputContent(this, false);
    });

    // Init select fields.
    $(context).find('select').select2({
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

    $(context).find('.statistic').easyPieChart(easyPieOptions);

    // Chart.js implementation.
    if (document.getElementById('finances-chart')) {
      var data = window.user_statistics || { "current" : [], "previous" : [] };
      var tickCount = data["current"].length < data["previous"].length ? data["current"].length : data["previous"].length;
      data['current'] = data['current'].slice(tickCount * -1);
      data['previous'] = data['previous'].slice(tickCount * -1);
      var labels = [];
      for (var i = 0; i < tickCount; i++) {
        labels[i] = "";
      }

      if (tickCount >= 3) {
        labels[0] = "Beginning";
        labels[Math.round(tickCount / 2)] = "Middle";
        labels[tickCount - 1] = "End";
      }

      var healthCtx = document.getElementById('health-chart').getContext('2d');
      var financesCtx = document.getElementById('finances-chart').getContext('2d');
      var chartColorRed = 'rgb(255, 99, 132)';
      var chartColorBlue = 'rgb(54, 162, 235)';
      var config = {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Current month',
            backgroundColor: chartColorRed,
            borderColor: chartColorRed,
            data: data["current"].map(function(x) { return x.health_value; }),
            fill: false
          }, {
            label: 'Previous month',
            backgroundColor: chartColorBlue,
            borderColor: chartColorBlue,
            data: data["previous"].map(function(x) { return x.health_value; }),
            fill: false
          }]
        },
        options: {
          responsive: true,
          title: {
            display: false,
            text: 'Spendings comparation'
          },
          tooltips: {
            mode: 'index',
            intersect: false
          },
          hover: {
            mode: 'nearest',
            intersect: true
          },
          scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Month'
              }
            }],
            yAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Spendings'
              }
            }]
          }
        }
      };
      var healthChart = new Chart(healthCtx, config);
      var financesChart = new Chart(financesCtx, config);
    }


    //----- Ajax forms.

    $(context).find('#user-login-form').ajaxForm({
      cache: false,
      url: 'ajax.php?action=login',
      type: 'post',
      beforeSubmit: function(arr, form) {
        $logo.addClass('spin');
        $(form).addClass('readonly');
      },
      success: function(data) {
        if (data.args.hasOwnProperty('uid')) {
          // Login was successful, save our user id.
          Cookies.set('uid', data.args.uid);
        }

        ajaxPageCallback(data, 'ajax.php?action=login');
        $(this).removeClass('readonly');
      }});

    $(context).find('#user-upload-form').ajaxForm({
      cache: false,
      url: 'ajax.php?action=upload',
      type: 'post',
      beforeSubmit: function(arr, form) {
        $logo.addClass('spin');
        $(form).addClass('readonly');
      },
      success: function(data) {
        if (data.args.hasOwnProperty('success')) {
          // Upload was successful.
        }

        ajaxPageCallback(data, 'ajax.php?action=upload');
        $(this).removeClass('readonly');
      }});

    $(context).find('#user-label-food-form').ajaxForm({
      cache: false,
      url: 'ajax.php?action=labelFood2&uid=' + Cookies.get('uid'),
      type: 'post',
      beforeSubmit: function(arr, form) {
        $logo.addClass('spin');
        $(form).addClass('readonly');
      },
      success: function(data) {
        if (data.args.hasOwnProperty('success')) {
          // Upload was successful.
        }

        ajaxPageCallback(data, 'ajax.php?action=dashboard');
        $(this).removeClass('readonly');
      }});


    //----- Ajax behavior.

    $(context).find('a[data-href]').on('click', function(e) {
      var $this = $(this);
      var ajaxUrl = $this.attr('data-href');

      $logo.addClass('spin');
      $pageContent.fadeOut(500);

      $.get(ajaxUrl, function(data) {
        if (data.args.hasOwnProperty('logout')) {
          // The user wants to log out, remove the uid cookie.
          Cookies.remove('uid');
        }

        ajaxPageCallback(data, ajaxUrl);
      });

      e.preventDefault();
      return false;
    });

    // Finally, check if the user is logged in.
    if (typeof Cookies.get('uid') != 'undefined') {
      $('body').addClass('user-logged-in');

      // Temporary Hotfix.
      var logoUrl = $('a.site-logo').attr('href');
      var logoAjaxUrl = $('a.site-logo').attr('data-href');
      logoUrl = logoUrl.replace('login', 'dashboard');
      logoAjaxUrl = logoAjaxUrl.replace('login', 'dashboard');
      $('a.site-logo').attr('href', logoUrl);
      $('a.site-logo').attr('data-href', logoAjaxUrl);
    } else {
      $('body').removeClass('user-logged-in');

      // Temporary Hotfix.
      var logoUrl = $('a.site-logo').attr('href');
      var logoAjaxUrl = $('a.site-logo').attr('data-href');
      logoUrl = logoUrl.replace('dashboard', 'login');
      logoAjaxUrl = logoAjaxUrl.replace('dashboard', 'login');
      $('a.site-logo').attr('href', logoUrl);
      $('a.site-logo').attr('data-href', logoAjaxUrl);
    }
  }

  parseHtml('html');
});

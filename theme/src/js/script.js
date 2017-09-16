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

  function randomScalingFactor() {
    var min = -100;
    var max = 100;

    return Math.floor(Math.random()*(max-min+1)+min);
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

  // Chart.js implementation.
  if (document.getElementById('finances-chart')) {
    var healthCtx = document.getElementById('health-chart').getContext('2d');
    var financesCtx = document.getElementById('finances-chart').getContext('2d');
    var chartColorRed = 'rgb(255, 99, 132)';
    var chartColorBlue = 'rgb(54, 162, 235)';
    var config = {
      type: 'line',
      data: {
        labels: ['Beginning', 'Middle', 'End'],
        datasets: [{
          label: 'Current month',
          backgroundColor: chartColorRed,
          borderColor: chartColorRed,
          data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
          ],
          fill: false,
        }, {
          label: 'Previous month',
          fill: false,
          backgroundColor: chartColorBlue,
          borderColor: chartColorBlue,
          data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
          ],
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
});

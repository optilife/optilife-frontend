<section class="dashboard">
  <div class="content">
    <h1>Dashboard</h1>

    <?php
      // Provide the data to JS.
      if (isset($_SESSION['user_statistics'])) {
        $user_statistics = $_SESSION['user_statistics'];
        $user_statistics = preg_replace('/\s+/', ' ', trim($user_statistics));
        print '<script>';
        print "window.user_statistics = '$user_statistics';";
        print "window.user_statistics = JSON.parse(window.user_statistics);";
        print '</script>';
        unset($_SESSION['user_statistics']);
      }
    ?>

    <?php if (!empty($_SESSION['success_message'])) { ?>
      <div class="message success--message">
        <?php print $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
      </div>
    <?php } ?>

    <div class="form-actions">
      <a class="button button-add" href="<?php print $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=upload'; ?>" data-href="<?php print $protocol . '://' . $_SERVER['SERVER_NAME'] . '/ajax.php?page=upload'; ?>">
        Add data
      </a>
    </div>

    <fieldset>
      <legend>Health</legend>

      <div class="statistic" data-percent="66"><span>1044</span>cals</div>
      <div class="statistic statistic--lines-2" data-percent="80"><span>80%</span>health<br />score</div>
      <div class="statistic statistic--lines-2" data-percent="100"><span>100%</span>challenges<br />won</div>
      <div class="statistic statistic--lines-2" data-percent="33"><span>33%</span>meals<br />tracked</div>
    </fieldset>

    <fieldset class="chartjs">
      <legend>Health comparation</legend>

      <canvas id="health-chart" width="400" height="150"></canvas>
    </fieldset>

    <fieldset>
      <legend>Finances</legend>

      <div class="statistic statistic--lines-2" data-percent="80"><span>80%</span>budget<br />used</div>
      <div class="statistic statistic--lines-2" data-percent="15"><span>15%</span>save<br />potential</div>
    </fieldset>

    <fieldset class="chartjs">
      <legend>Finances comparation</legend>

      <canvas id="finances-chart" width="400" height="200"></canvas>
    </fieldset>

    <div class="active-challenges">
      <h2>Active challenges</h2>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Challenger overall score</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>Axel Uran</td>
              <td>70.1</td>
              <td class="winning">Winning</td>
            </tr>
            <tr>
              <td>Arik Sidney</td>
              <td>85.7</td>
              <td class="winning">Winning</td>
            </tr>
            <tr>
              <td>Luca Christen</td>
              <td>90.9</td>
              <td class="losing">Losing</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="challenge">
      <h2>Challenge friends!</h2>

      <fieldset>
        <legend>Spread the word</legend>
        <div class="sharethis-inline-share-buttons" data-url="http://optilife.pacassi.ch/?page=challenge"></div>
      </fieldset>
    </div>
  </div>
</section>

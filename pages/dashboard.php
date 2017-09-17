<section class="dashboard">
  <div class="content">
    <h1>Dashboard</h1>

    <?php
      // Provide user data to JS.
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

    <?php if (isset($_SESSION['user_health_index'])) { ?>
      <?php $user_health = $_SESSION['user_health_index']; ?>

      <fieldset>
        <legend>Health</legend>

        <div class="statistic statistic--lines-2" data-percent="<?php print $user_health['calories_today_percentage']; ?>"><span><?php print $user_health['calories_today']; ?></span>cals<br />today</div>
        <div class="statistic statistic--lines-2" data-percent="<?php print $user_health['health-index']; ?>"><span><?php print $user_health['health-index']; ?>%</span>health<br />score</div>
        <div class="statistic statistic--lines-2" data-percent="<?php print $user_health['challenges_won']; ?>"><span><?php print $user_health['challenges_won']; ?>%</span>challenges<br />won</div>
        <div class="statistic statistic--lines-2" data-percent="<?php print $user_health['daily_goal']; ?>"><span><?php print $user_health['daily_goal']; ?>%</span>meals<br />tracked</div>
      </fieldset>
      <?php unset($_SESSION['user_health_index']); ?>
    <?php } ?>

    <fieldset class="chartjs">
      <legend>Health comparation</legend>

      <canvas id="health-chart" width="400" height="150"></canvas>
    </fieldset>

    <fieldset>
      <legend>Finances</legend>

      <div class="statistic statistic--lines-2" data-percent="80"><span>80%</span>budget<br />used</div>
      <div class="statistic statistic--lines-2" data-percent="15"><span>15%</span>save<br />potential</div>
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

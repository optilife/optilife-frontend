<section class="dashboard">
  <div class="content">
    <h1>Dashboard</h1>

    <div class="form-actions">
      <a class="button button-add" href="<?php print $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=upload'; ?>">Add data</a>
    </div>

    <fieldset>
      <legend>Health</legend>

      <div class="statistic" data-percent="66"><span>1044</span>cals</div>
      <div class="statistic statistic--lines-2" data-percent="80"><span>80%</span>health<br />score</div>
      <div class="statistic statistic--lines-2" data-percent="100"><span>100%</span>challenges<br />won</div>
      <div class="statistic statistic--lines-2" data-percent="33"><span>33%</span>meals<br />tracked</div>
    </fieldset>

    <fieldset>
      <legend>Finances</legend>

      <div class="statistic statistic--lines-2" data-percent="80"><span>80%</span>budget<br />used</div>
      <div class="statistic statistic--lines-2" data-percent="15"><span>15%</span>save<br />potential</div>
    </fieldset>
  </div>
</section>

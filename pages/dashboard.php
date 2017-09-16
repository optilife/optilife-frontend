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

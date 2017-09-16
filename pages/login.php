<section class="login">
  <div class="content">
    <h1>Log in</h1>

    <form id="user-login-form" class="user-login-form" method="post" accept-charset="UTF-8">
      <fieldset>
        <legend>Optimize your life!</legend>

        <div class="form-item">
          <input id="username" type="text" name="username" value="" />
          <label for="username">Username</label>
          <span class="focus-border"></span>
        </div>

        <div class="form-item">
          <input id="password" type="password" name="password" value="" />
          <label for="password">Password</label>
          <span class="focus-border"></span>
        </div>
      </fieldset>

      <div class="form-actions">
        <input id="submit" type="submit" value="Log in" class="button button-primary" />
        <a class="button button-add" href="<?php print $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=login'; ?>" data-href="<?php print $protocol . '://' . $_SERVER['SERVER_NAME'] . '/ajax.php?page=login'; ?>">Register</a>
      </div>
    </form>
  </div>
</section>

<section class="profile">
  <div class="content">
    <h1>Profile</h1>

    <form id="user-profile-form" class="user-profile-form" method="post" accept-charset="UTF-8">
      <fieldset>
        <legend>Account data</legend>

        <div class="form-item form-item__readonly">
          <input id="username" type="text" name="username" value="dpacassi" readonly="readonly" />
          <label for="username">Username</label>
          <span class="focus-border"></span>
        </div>

        <div class="form-item">
          <input id="firstname" type="text" name="firstname" value="David" />
          <label for="firstname">First name</label>
          <span class="focus-border"></span>
        </div>

        <div class="form-item">
          <input id="lastname" type="text" name="lastname" value="Pacassi Torrico" />
          <label for="lastname">Last name</label>
          <span class="focus-border"></span>
        </div>

        <div class="form-item form-item__standard">
          <label for="gender">Gender</label>
          <select id="gender" name="gender">
            <option value="female">Female</option>
            <option value="male">Male</option>
          </select>
        </div>

        <div class="form-item">
          <input id="email" type="email" name="email" value="dpacassi@gmail.com" />
          <label for="email">E-Mail</label>
          <span class="focus-border"></span>
        </div>

        <div class="form-item">
          <input id="password" type="password" name="password" value="" />
          <label for="password">Change password</label>
          <span class="focus-border"></span>
        </div>

        <div class="form-item">
          <input id="password2" type="password" name="password2" value="" />
          <label for="password2">Change password (repeat)</label>
          <span class="focus-border"></span>
        </div>
      </fieldset>

      <fieldset>
        <legend>Personal data</legend>

        <div class="form-item">
          <input id="birthday" type="date" name="birthday" value="24.11.1987" />
          <label for="birthday">Birthday</label>
          <span class="focus-border"></span>
        </div>

        <div class="form-item">
          <input id="weight" type="number" name="weight" value="70" />
          <label for="weight">Weight (kg)</label>
          <span class="focus-border"></span>
        </div>

        <div class="form-item">
          <input id="height" type="number" name="height" value="167" />
          <label for="height">Height (cm)</label>
          <span class="focus-border"></span>
        </div>
      </fieldset>

      <div class="form-actions">
        <input id="submit" type="submit" value="Update" class="button button-primary" />
      </div>
    </form>
  </div>
</section>

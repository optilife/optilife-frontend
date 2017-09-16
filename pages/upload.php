<section class="upload">
  <div class="content">
    <h1>Add data</h1>

    <?php if (!empty($_SESSION['error_message'])) { ?>
      <div class="message error--message">
        <?php print $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
      </div>
    <?php } ?>

    <form id="user-upload-form" class="user-upload-form" method="post" accept-charset="UTF-8">
      <fieldset>
        <legend>Add food or receipt images</legend>

        <div class="form-item form-item__standard">
          <label for="image">Image</label>
          <input id="image" type="file" name="image" />
        </div>
      </fieldset>

      <div class="form-actions">
        <input id="submit" type="submit" value="Upload" class="button button-primary" />
      </div>
    </form>
  </div>
</section>

<section class="label-food">
  <div class="content">
    <h1>Label food</h1>

    <?php if (!empty($_SESSION['success_message'])) { ?>
      <div class="message success--message">
        <?php print $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
      </div>
    <?php } ?>

    <form id="user-label-food-form" class="user-label-food-form" method="post" accept-charset="UTF-8">
      <fieldset>
        <legend>Select the best category fitting your food</legend>

        <div class="form-item form-item__standard">
          <label for="category">Category</label>
          <select id="category" name="category">
            <?php if (!empty($_SESSION['food_categories'])) { ?>
              <?php foreach ($_SESSION['food_categories'] as $food_category) { ?>
                <option value="<?php print $food_category; ?>"><?php print $food_category; ?></option>
              <?php } ?>
            <?php } else { ?>
              <option value="">Not available</option>
            <?php } ?>
          </select>
        </div>
      </fieldset>

      <div class="form-actions">
        <input id="submit" type="submit" value="Label food" class="button button-primary" />
      </div>
    </form>
  </div>
</section>

<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>optilife.pacassi.ch</title>
    <link rel="stylesheet" href="/theme/vendor/css/html5reset-1.6.1.css" media="all" />
    <link rel="stylesheet" href="/theme/dist/css/style.css" media="all" />
  </head>

  <body>
    <div id="body__inner">
      <header>
        <nav class="nav-primary" role="navigation">
          <ul>
<?php foreach ($nav_links as $nav_name => $nav_link) { ?>
              <li><a href="<?php print $nav_link['link']; ?>"><?php print $nav_link['text']; ?></a></li>
<?php } ?>
          </ul>
        </nav>
      </header>

      <main>
        <div id="main__inner">
          <div id="page-content">
<?php
  if (!empty($page_template) && file_exists($page_template)) {
    include_once $page_template;
  } else {
    echo 'This should not happen!' . "\n";
  }
?>
          </div>
        </div>
      </main>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/theme/dist/js/script.min.js"></script>
  </body>
</html>

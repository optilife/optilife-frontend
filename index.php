<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>OptiLife</title>
    <link rel="stylesheet" href="/theme/vendor/css/html5reset-1.6.1.css" media="all" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato|Montserrat:600,600i">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/theme/dist/css/style.css" media="all" />
  </head>

  <body class="<?php print $page_body_cls; ?>">
    <div id="body__inner">
      <header>
        <div id="header_inner" class="content">
          <div id="logo">
            <a href="/" title="Home" rel="home" class="site-logo">
              <img src="/theme/img/optilife.png" alt="OptiLife" title="OptiLife" />
            </a>
          </div>

          <aside>
            <nav id="nav-primary" role="navigation">
              <ul>
                <?php foreach ($nav_links as $nav_name => $nav_link) { ?>
                  <li class="<?php print $nav_link['nav_cls']; ?>">
                    <a href="<?php print $nav_link['link']; ?>">
                      <div class="icon--wrap">
                        <img src="/theme/img/icons/<?php print $nav_link['icon']; ?>" alt="<?php print $nav_link['text']; ?>" title="<?php print $nav_link['text']; ?>" />
                      </div>
                      <div class="text--wrap">
                        <?php print $nav_link['text']; ?>
                      </div>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </nav>
          </aside>
        </div>
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

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=59bd16864e6a630011ca221c&product=inline-share-buttons"></script>
    <script type="text/javascript" src="/theme/vendor/js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="/theme/dist/js/script.min.js"></script>
  </body>
</html>

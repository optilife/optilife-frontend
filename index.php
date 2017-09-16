<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>OptiLife - <?php print $page_title; ?></title>
    <link rel="stylesheet" href="/theme/vendor/css/html5reset-1.6.1.css" media="all" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato|Montserrat:600,600i">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/theme/dist/css/style.css" media="all" />
    <link rel="shortcut icon" href="/favicon.png" type="image/png" />

    <!-- SEO -->
    <meta property="og:title" content="OptiLife - Optimize your life!" />
    <meta property="og:description" content="Do you want to lose weight? Do you want to save money? Do you want to optimize your life?" />
    <meta property="og:image" content="<?php print $protocol . '://' . $_SERVER['SERVER_NAME'] . '/theme/img/optilife-og.jpg'; ?>" />
  </head>

  <body class="<?php print $page_body_cls; ?>">
    <div id="body__inner">
      <header>
        <div id="header_inner" class="content">
          <h1>OptiLife - Optimize your life!</h1>

          <aside>
            <div id="logo">
              <a href="/" data-href="<?php print $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=upload'; ?>" data-href="<?php print $protocol . '://' . $_SERVER['SERVER_NAME'] . '/ajax.php?page=login'; ?>" title="Home" rel="home" class="site-logo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 435.81 435.81"><defs><style>.cls-1{fill:#fff;}.cls-1,.cls-4{stroke:#15e5ff;}.cls-1,.cls-2,.cls-3,.cls-4{stroke-miterlimit:10;}.cls-2,.cls-3{fill:#199ed9;stroke:#fff;}.cls-3{stroke-width:2px;}.cls-4{fill:#fff;}</style></defs><title>Logo1</title><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><circle class="cls-1" cx="217.9" cy="217.9" r="217.4"/><circle class="cls-2" cx="173.6" cy="155.59" r="88.93"/><rect class="cls-3" x="223.62" y="193.1" width="45.98" height="176.04" rx="12" ry="12"/><rect class="cls-3" x="270.07" y="323.37" width="81.06" height="45.77" rx="12" ry="12"/><circle class="cls-4" cx="173.6" cy="155.59" r="37.51"/></g></g></svg>
              </a>
            </div>

            <nav id="nav-primary" role="navigation">
              <ul>
                <?php foreach ($nav_links as $nav_name => $nav_link) { ?>
                  <li class="<?php print $nav_link['nav_cls']; ?>">
                    <a href="<?php print $nav_link['link']; ?>" data-href="<?php print $nav_link['ajax-link']; ?>">
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/theme/vendor/js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="/theme/vendor/js/js.cookie.js"></script>
    <script type="text/javascript" src="/theme/dist/js/script.min.js"></script>
  </body>
</html>

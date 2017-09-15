<?php
  // Helper variables.
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';

  // Define pages.
  $page_links = [
    'home' => [
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/',
      'text' => 'Log in',
      'template' => 'sections/login.php'
    ],
  ];

  // Define navigation.
  $nav_links = $page_links;

  if (!empty($_GET['section'])) {
    if (array_key_exists($_GET['section'], $page_links)) {
      $page_title = $page_links[$_GET['section']]['text'];
      $page_template = $page_links[$_GET['section']]['template'];
    }
  }

  // By default show the log in page.
  if (empty($page_template)) {
    $page_title = $page_links['home']['text'];
    $page_template = $page_links['home']['template'];
  }

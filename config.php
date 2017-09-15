<?php
  // Helper variables.
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';

  // Define pages.
  $page_links = [
    'home' => [
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/',
      'text' => 'Log in',
      'template' => 'sections/login.php',
      'body_cls' => 'page-login',
    ],
  ];

  // Define navigation.
  $nav_links = $page_links;

  // Define current page.
  if (!empty($_GET['section'])) {
    if (array_key_exists($_GET['section'], $page_links)) {
      $page_title = $page_links[$_GET['section']]['text'];
      $page_template = $page_links[$_GET['section']]['template'];
      $page_body_cls = $page_links[$_GET['section']]['body_cls'];
    }
  }

  // By default, show the log in page.
  if (empty($page_template)) {
    $page_title = $page_links['home']['text'];
    $page_template = $page_links['home']['template'];
    $page_body_cls = $page_links['home']['body_cls'];
  }

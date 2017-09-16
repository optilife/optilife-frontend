<?php
  // Helper variables.
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';

  // Define pages.
  $page_links = [
    'home' => [
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/',
      'text' => 'Log in',
      'template' => 'pages/login.php',
      'body_cls' => 'page-login',
    ],
    'upload' => [
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/',
      'text' => 'Upload',
      'template' => 'pages/upload.php',
      'body_cls' => 'page-upload',
    ],
    'profile' => [
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/',
      'text' => 'Profile',
      'template' => 'pages/profile.php',
      'body_cls' => 'page-profile',
    ],
  ];

  // Define navigation.
  $nav_links = $page_links;

  // Define current page.
  if (!empty($_GET['page'])) {
    if (array_key_exists($_GET['page'], $page_links)) {
      $page_title = $page_links[$_GET['page']]['text'];
      $page_template = $page_links[$_GET['page']]['template'];
      $page_body_cls = $page_links[$_GET['page']]['body_cls'];
    }
  }

  // By default, show the log in page.
  if (empty($page_template)) {
    $page_title = $page_links['home']['text'];
    $page_template = $page_links['home']['template'];
    $page_body_cls = $page_links['home']['body_cls'];
  }

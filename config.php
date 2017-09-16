<?php
  // Start session.
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  // Helper variables.
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
  $base_ajax_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . '/ajax.php';

  // Define pages.
  $page_links = [
    'dashboard' => [
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=dashboard',
      'ajax-link' => $base_ajax_url . '?page=dashboard',
      'text' => 'Dashboard',
      'template' => 'pages/dashboard.php',
      'body_cls' => 'page-dashboard',
      'nav_cls' => 'menu-item menu-item--dashboard',
      'icon' => 'dashboard.svg',
    ],
    'upload' => [
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=upload',
      'ajax-link' => $base_ajax_url . '?page=upload',
      'text' => 'Add data',
      'template' => 'pages/upload.php',
      'body_cls' => 'page-upload',
      'nav_cls' => 'menu-item menu-item--upload',
      'icon' => 'upload.svg',
    ],
    'profile' => [
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=profile',
      'ajax-link' => $base_ajax_url . '?page=profile',
      'text' => 'Profile',
      'template' => 'pages/profile.php',
      'body_cls' => 'page-profile',
      'nav_cls' => 'menu-item menu-item--profile',
      'icon' => 'profile.svg',
    ],
    'logout' => [
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=logout',
      'ajax-link' => $base_ajax_url . '?action=logout',
      'text' => 'Log out',
      'template' => 'pages/profile.php',
      'body_cls' => 'page-profile',
      'nav_cls' => 'menu-item menu-item--logout',
      'icon' => 'logout.svg',
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
    $page_title = 'Login';
    $page_template = 'pages/login.php';
    $page_body_cls = 'page-login';
  }

  // Require composer's autoloader.
  require 'vendor/autoload.php';

  // Python backend configuration.
  $python_base_url = 'http://optilife.pacassi.ch:5000/api/';

  // Set logo url.
  if (isset($_SESSION['uid'])) {
    $logo_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=dashboard';
    $logo_data_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . '/ajax.php?page=dashboard';
  } else {
    $logo_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=login';
    $logo_data_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . '/ajax.php?page=login';
  }

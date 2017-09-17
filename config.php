<?php
  // Require composer's autoloader.
  require 'vendor/autoload.php';

  // Python backend configuration.
  $python_base_url = 'http://optilife.pacassi.ch:5000/api/';

  // Helper variables.
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
  $base_ajax_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . '/ajax.php';

  // Define pages.
  $page_links = [
    'dashboard' => [
      'hidden' => FALSE,
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=dashboard',
      'ajax-link' => $base_ajax_url . '?page=dashboard',
      'text' => 'Dashboard',
      'template' => 'pages/dashboard.php',
      'body_cls' => 'page-dashboard',
      'nav_cls' => 'menu-item menu-item--dashboard',
      'icon' => 'dashboard.svg',
    ],
    'upload' => [
      'hidden' => FALSE,
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=upload',
      'ajax-link' => $base_ajax_url . '?page=upload',
      'text' => 'Add data',
      'template' => 'pages/upload.php',
      'body_cls' => 'page-upload',
      'nav_cls' => 'menu-item menu-item--upload',
      'icon' => 'upload.svg',
    ],
    'profile' => [
      'hidden' => FALSE,
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=profile',
      'ajax-link' => $base_ajax_url . '?page=profile',
      'text' => 'Profile',
      'template' => 'pages/profile.php',
      'body_cls' => 'page-profile',
      'nav_cls' => 'menu-item menu-item--profile',
      'icon' => 'profile.svg',
    ],
    'logout' => [
      'hidden' => FALSE,
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=logout',
      'ajax-link' => $base_ajax_url . '?action=logout',
      'text' => 'Log out',
      'template' => 'pages/profile.php',
      'body_cls' => 'page-profile',
      'nav_cls' => 'menu-item menu-item--logout',
      'icon' => 'logout.svg',
    ],
    // Hiden pages
    'label_food' => [
      'hidden' => TRUE,
      'link' => $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=labelFood',
      'ajax-link' => $base_ajax_url . '?page=labelFood',
      'text' => 'Label food',
      'template' => 'pages/label_food.php',
      'body_cls' => 'page-label-food',
      'nav_cls' => 'menu-item menu-item--label-food',
      'icon' => 'home.svg',
    ],
  ];

  // Define navigation.
  $nav_links = $page_links;

  // Get user statistics.
  if (!empty($_GET['page'])) {
    if ($_GET['page'] == 'dashboard') {
      // Get user statistics.
      $python_url = 'food/log/' . $_SESSION['uid'];
      $python_method = 'GET';
      $python_client = new GuzzleHttp\Client([
        'base_uri' => $python_base_url,
      ]);
      $_SESSION['user_statistics'] = $python_client->get($python_url)->getBody();

      // Get user health index.
      $python_url = 'users/health-index/' . $_SESSION['uid'];
      $python_method = 'GET';
      $python_client = new GuzzleHttp\Client([
        'base_uri' => $python_base_url,
      ]);
      $python_response = $python_client->get($python_url)->getBody();
      $response_object = json_decode($python_response, true);
      $_SESSION['user_health_index'] = $response_object;

      // Get user budget spending.
      $python_url = 'users/' . $_SESSION['uid'];
      $python_method = 'GET';
      $python_client = new GuzzleHttp\Client([
          'base_uri' => $python_base_url,
      ]);
      $python_response = $python_client->get($python_url)->getBody();
      $response_object = json_decode($python_response, true);
      $_SESSION['user_budget'] = 100 - ($response_object.actual_budget / $response_object.monthly_budget) * 100;
    }
  }

  // Define current page.
  if (!empty($_GET['page'])) {
    if (array_key_exists($_GET['page'], $page_links)) {
      $page_title = $page_links[$_GET['page']]['text'];
      $page_template = $page_links[$_GET['page']]['template'];
      $page_body_cls = $page_links[$_GET['page']]['body_cls'];
    }
  }

  // By default, show the log in page or the dashboard.
  if (empty($page_template)) {
    if (isset($_SESSION['uid'])) {
      $page_title = 'Dashboard';
      $page_template = 'pages/dashboard.php';
      $page_body_cls = 'page-dashboard';
    } else {
      $page_title = 'Login';
      $page_template = 'pages/login.php';
      $page_body_cls = 'page-login';
    }
  }

  // Set logo url.
  if (isset($_SESSION['uid'])) {
    $logo_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=dashboard';
    $logo_data_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . '/ajax.php?page=dashboard';
  } else {
    $logo_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=login';
    $logo_data_url = $protocol . '://' . $_SERVER['SERVER_NAME'] . '/ajax.php?page=login';
  }

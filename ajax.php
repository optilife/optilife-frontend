<?php
  function parse_file($filename) {
    if (is_file($filename)) {
      ob_start();
      include 'config.php';
      include $filename;
      return trim(ob_get_clean());
    }

    return false;
  }

  header('Content-Type: application/json');
  include 'config.php';
  $additional_args = [];
  $error_message = '';

  if (!empty($_GET['action'])) {
    if ($_GET['action'] == 'login') {
      if (isset($_POST['username']) && isset($_POST['password'])) {
        // Authenticate the user.
        $python_url = 'users/login';
        $python_method = 'POST';
        $python_client = new GuzzleHttp\Client([
          'base_uri' => $python_base_url,
        ]);
        $python_response = $python_client->post($python_url, [
          'json' => [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
          ],
        ]);
        $response_object = json_decode($python_response->getBody(), true);

        if ($response_object !== false) {
          // Log the user in.
          $page_title = $page_links['dashboard']['text'];
          $page_template = $page_links['dashboard']['template'];
          $page_body_cls = $page_links['dashboard']['body_cls'];
          $additional_args['uid'] = $response_object;
        } else {
          $_SESSION['error_message'] = 'Error logging in: Username and password don\'t match';
        }
      } else {
        $_SESSION['error_message'] = 'Error logging in: Username and password don\'t match';
      }
    }
  }

  $content = '';
  if (!empty($page_template) && file_exists($page_template)) {
    $content = parse_file($page_template);
  } else {
    $page_template = 'pages/login.php';
    $content = parse_file($page_template);
  }

  $file_parts = pathinfo($page_template);
  $page_key = $file_parts['filename'];

  $page = [
    'path' => $page_links[$page_key]['link'],
    'title' => 'OptiLife - ' . $page_links[$page_key]['text'],
    'html' => $content,
    'args' => $additional_args,
  ];

  // For smoothless animations.
  usleep(500000);

  print json_encode($page);

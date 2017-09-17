<?php
  // Start session.
  session_start();

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

          $_SESSION['uid'] = $response_object;
        } else {
          $_SESSION['error_message'] = 'The username and password you entered did not match our records.';
        }
      } else {
        $_SESSION['error_message'] = 'The username and password you entered did not match our records.';
      }
    } else if ($_GET['action'] == 'logout') {
      // Log out - destroy the session.
      session_destroy();
      $additional_args['logout'] = true;
      $page_title = 'Login';
      $page_template = 'pages/login.php';
      $page_body_cls = 'page-login';
    } else if ($_GET['action'] == 'upload') {
      if (isset($_FILES['image'])) {
        $check = getimagesize($_FILES['image']['tmp_name']);

        if ($check !== false) {
          $image_type = pathinfo($_FILES['image']['tmp_name'], PATHINFO_EXTENSION);
          $image_data = file_get_contents($_FILES['image']['tmp_name']);
          $image_base64 = base64_encode($image_data);
          $additional_args['image'] = $image_base64;

          // Send the image to the python backend.
          $python_url = 'food/';
          $python_method = 'POST';
          $python_client = new GuzzleHttp\Client([
            'base_uri' => $python_base_url,
          ]);
          $python_response = $python_client->post($python_url, [
            'json' => [
              'image' => $image_base64,
            ],
          ]);
          $response_object = json_decode($python_response->getBody(), true);
          $additional_args['foodLabels'] = $response_object;

          if (!empty($response_object)) {
            // Set success message.
            $_SESSION['success_message'] = 'Your image was successfully uploaded.';

            // Set possible food categories.
            $_SESSION['food_categories'] = $response_object['foodlabels'];

            // Redirect the user to the dashboard.
            $page_title = $page_links['label_food']['text'];
            $page_template = $page_links['label_food']['template'];
            $page_body_cls = $page_links['label_food']['body_cls'];
          } else {
            // Set error message.
            $_SESSION['error_message'] = 'Please upload an image of a receipt or food.';

            // Redirect the user to the upload page.
            $page_title = $page_links['upload']['text'];
            $page_template = $page_links['upload']['template'];
            $page_body_cls = $page_links['upload']['body_cls'];
          }
        } else {
          $_SESSION['error_message'] = 'Please upload an image.';
        }
      } else {
        $_SESSION['error_message'] = 'Please upload an image.';
      }
    } else if ($_GET['action'] == 'labelFood2') {
      if (isset($_POST['category'])) {
        // Send the food category to the python backend.
        $python_url = 'food/log/' . $_GET['uid'];
        $python_method = 'POST';
        $python_client = new GuzzleHttp\Client([
          'base_uri' => $python_base_url,
        ]);
        $python_response = $python_client->post($python_url, [
          'json' => [
            'label' => $_POST['category'],
          ],
        ]);

        // Set success message.
        $_SESSION['success_message'] = 'Your entry has been successfully logged!';

        // Redirect the user to the dashboard.
        $page_title = $page_links['dashboard']['text'];
        $page_template = $page_links['dashboard']['template'];
        $page_body_cls = $page_links['dashboard']['body_cls'];
      } else {
        $_SESSION['error_message'] = 'Please choose a food category.';

        // Redirect the user to the image upload.
        $page_title = $page_links['upload']['text'];
        $page_template = $page_links['upload']['template'];
        $page_body_cls = $page_links['upload']['body_cls'];
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

  if ($page_key == 'login') {
    $path = $protocol . '://' . $_SERVER['SERVER_NAME'] . '/?page=login';
    $title = 'Login';
  } else {
    $path = $page_links[$page_key]['link'];
    $title = $page_links[$page_key]['text'];
  }

  $page = [
    'path' => $path,
    'title' => 'OptiLife - ' . $title,
    'html' => $content,
    'args' => $additional_args,
  ];

  // For smoothless animations.
  usleep(500000);

  print json_encode($page);

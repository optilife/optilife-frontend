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
    'title' => $page_links[$page_key]['text'],
    'html' => $content,
  ];

  print json_encode($page);

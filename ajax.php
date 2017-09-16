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
    $content = parse_file('pages/login.php');
  }

  $page = [
    'content' => $content,
  ];

  print json_encode($page);

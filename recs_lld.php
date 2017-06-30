#!/usr/bin/php
<?php

$username = "admin";
$password = "admin";
$remote_url = 'http://10.0.0.1/REST/node';

// Create a stream
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header' => "Authorization: Basic " . base64_encode("$username:$password")
  )
);

$context = stream_context_create($opts);

$input = file_get_contents($remote_url, false, $context);

$dom = new DOMDocument;
$dom->loadXML($input);


$nodes = [];


foreach($dom->getElementsByTagName('node') as $node) {
      $result = array();
      $result['{#NODEID}'] = $node->getAttribute('id');
      $results['data'][] = $result;

}

echo json_encode($results);

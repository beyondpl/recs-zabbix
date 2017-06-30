#!/usr/bin/php
<?php

$username = "admin";
$password = "admin";
$node = $argv[1];
$remote_url = "http://10.0.0.1/REST/node/" . "$node";

if ($argc >= 2) {

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
$node = $dom->getElementsByTagName('node');


switch( $argv[2] ) {
                case 'actualNodePowerUsage':
                        print($node[0]->getAttribute('actualNodePowerUsage'));
                        break;
                case 'actualNodePowerUsage':
                        print($node[0]->getAttribute('actualPowerUsage'));
                        break;
                case 'inletTemperature':
                        print($node[0]->getAttribute('inletTemperature'));
                        break;
                case 'outletTemperature':
                        print($node[0]->getAttribute('outletTemperature'));
                        break;
                case 'health':
                        print($node[0]->getAttribute('health'));
                        break;
                default:
                        exit;
}
}
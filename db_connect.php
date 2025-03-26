<?php
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://127.127.126.17:27017");
$db = $client->organizationDB;
$collection = $db->computers;
?>

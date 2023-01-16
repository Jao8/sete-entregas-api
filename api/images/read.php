<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Image.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog image object
$image = new Images($db);

$image->id = isset($_GET['id']) ? $_GET['id'] : die();

$image->read();

$images_arr = array(
    'id' => $image->id,
    'name' => $image->name,
    'path' => $image->path,
    'location' => $image->location,
    'created_at' => $image->created_at,
);

$response = array(
    'status' => 200,
    'message' => 'Image Found',
    'data' => $images_arr
);

print_r(json_encode($response));
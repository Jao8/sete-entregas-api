<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Image.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog image object
$image = new Images($db);

try {
    $data = json_decode(file_get_contents("php://input"));

    $image->name = $data->name;
    $image->path = $data->path;
    $image->location = $data->location;
    $image->created_at = date('Y-m-d H:i:s');

    if ($image->create()) {
        echo json_encode(
            array('message' => 'Image Created', 'status' => 200)
        );
    } else {
        echo json_encode(
            array('message' => 'Image Not Created', 'status' => 400)
        );
    }
} catch (Exception $e) {
    echo json_encode(
        array('message' => 'error: ' . $e->getMessage(), 'status' => 500)
    );
}

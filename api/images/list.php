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

// Blog image query
$result = $image->list();
// Get row count
$num = $result->rowCount();

// Check if any images
if ($num > 0) {
    // Image array
    $images_arr = array();
    // $images_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $id,
            'name' => $name,
            'path' => $path,
        );

        // Push to "data"
        array_push($images_arr, $post_item);
        // array_push($images_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($images_arr);
} else {
    // No Images
    echo json_encode(
        array('message' => 'No Images Found')
    );
}

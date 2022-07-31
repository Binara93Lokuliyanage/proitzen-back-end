<?php 
  // Headers
  if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

  include_once '../../config/Database.php';
  include_once '../../models/Product.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $sku = null;
  $name = null;
  $price = null;
  $type = null;

  // Instantiate blog post object
  $post = new Product($db, $sku, $name, $price, $type);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"), true);

  $countArray = count($data);

  for ($x = 0; $x < $countArray; $x++) {
    $post->sku = $data[$x]['sku'];
    $post->massDelete();
  }
  echo json_encode(
    array(
      'status' => true,
      'message' => 'Successfuly added to database'
        )
  );
?>
  



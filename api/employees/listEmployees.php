<?php 
  // Headers
  if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

  include_once '../../config/Database.php';
  include_once '../../models/Employees.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $emp_no = null;
  $birth_date = null;
  $first_name = null;
  $last_name = null;
  $gender = null;
  $hire_date = null;

  // Instantiate object
  $post = new Employees($db, $emp_no, $birth_date, $first_name, $last_name, $gender, $hire_date);

  $data = json_decode(file_get_contents("php://input"));

  // get query
  $result = $post->listEmployees();
  // Get row count
  $num = $result->rowCount();

  // Check if any member
  if($num > 0) {
    // Post array
    $posts_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'emp_no' => $emp_no,
        'birth_date' => $birth_date,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'gender' => $gender,
        'hire_date' => $hire_date,
      );

      // Push to "data"
      array_push($posts_arr, $post_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($posts_arr);

  } else {
    // No Posts
    echo json_encode(
      array()
    );
  }

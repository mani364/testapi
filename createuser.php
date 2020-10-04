<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/base.php';
  
// instantiate product object
include_once '../objects/pro.php';
  
$database = new Database();
$db = $database->getConnection();
  
$product = new Product($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->stud_name) &&
    !empty($data->stud_regno) &&
    !empty($data->stud_program) &&
    !empty($data->stud_enroll) &&
    !empty($data->stud_compdate)
){
  
    // set product property values
    $product->stud_regno = $data->stud_regno;
    $product->stud_name = $data->stud_name;
    $product->stud_program= $data->stud_program;
    $product->stud_enroll = $data->stud_enroll;
    $product->stud_compdate=$data->stud_compdate;
  
    // create the product
    if($product->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Student Creates."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create student."));
    }
} 
?>


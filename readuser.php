<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/base.php';
include_once '../objects/pro.php';

$database = new Database();
$db = $database->getConnection();

$student = new Product($db);


$stmt = $product->read();
$num = $stmt->rowCount();
  

if($num>0){
  
 
    $products_arr=array();
    $products_arr["records"]=array();
  

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
        extract($row);
  
        $product_item=array(
            "stud_regno" => $stud_regno,
            "stud_name" => $stud_name,
            "stud_program" => $stud_program,
            "stud_enroll" => $stud_enroll,
            "stud_compdate" => $stud_compdate,
        );
  
        array_push($products_arr["records"], $product_item);
    }
  

    http_response_code(200);
  

    echo json_encode($products_arr);
}
?>

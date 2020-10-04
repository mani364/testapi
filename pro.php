<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "studdetails";
  
    // table properties
    public $stud_regno;
    public $stud_name;
    public $stud_program;
    public $stud_enroll;
    public $stud_compdate;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        
    }
    //to read student details 
    function read(){
    // select all query
    $query = "SELECT
                stud_regno, stud_name, stud_program, stud_enroll, stud_compdate,
            FROM
                " . $this->table_name .
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
  
    return $stmt;
    }
    
    // create product
function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                stud_regno=:stud_regno, stud_name=:stud_name, stud_program=:stud_program, stud_enroll=:stud_enroll, stud_compdate=:stud_compdate";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->stud_regno=htmlspecialchars(strip_tags($this->stud_regno));
    $this->stud_name=htmlspecialchars(strip_tags($this->stud_name));
    $this->stud_program=htmlspecialchars(strip_tags($this->stud_program));
    $this->stud_enroll=htmlspecialchars(strip_tags($this->stud_enroll));
    $this->stud_compdate=htmlspecialchars(strip_tags($this->stud_compdate));
  
    // bind values
    $stmt->bindParam(":stud_regno", $this->stud_regno);
    $stmt->bindParam(":stud_name", $this->stud_name);
    $stmt->bindParam(":stud_program", $this->stud_program);
    $stmt->bindParam(":stud_enroll", $this->stud_enroll);
    $stmt->bindParam(":stud_compdate", $this->stud_compdate);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
    return false;
}
}
?>

<?php
    $host = 'localhost';
    $username = 'root';
    $mysqlpassword = '';
    $database = 'mapolon_db';
    
    $connection = mysqli_connect($host, $username, $mysqlpassword, $database);

        if($connection->connect_error){
            die("Connection failed: " . $connection->connect_error);
        }
        
// class Controller{
//     protected $host = 'localhost';
//     protected $user = 'root';
//     protected $password = '';
//     protected $database = 'mapolon_db';

//     public $con = null;

//     public function __construct(){
//         $this->con = myqli_connect($this->host, $this->user, $this->password, $this->database);

//         if($this->con->connect_error){
//             echo 'Fail' . $this->con->connect_error;
//         }else{
//             echo 'Successfully connected to the database';
//         }
//     }

// }

// class InsertData extends Controller{
//     public function insert($param = null, $table = 'user_table'){
//         if($this->con != null){
//             if($params != null){
//                 //get table columns
//                 $columns = implode(',', array_keys($params));
//                 print_r($columns);
//                 $values = implode(',', array_values($params));
//                 print_r($values);

//                 $query = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);   
//             }
//         }
//     }

// }

// class UpdateData extends Controller{
//     public function update($id = null, $data = array(), $table = 'user_table'){
//         if($this->con != null){
//             if($id != null && isset($data)){
//                 $query = sprintf("UPDATE {$table} SET WHERE id=");   
//             }
//         }
//     }

// }

?>
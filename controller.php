<?php
class crud {

    private $servername;
    private $username; 
    private $password; 
    private $dbname;
    private $dbconnect;
    
    function __construct()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "oops_crud";
    }

    public static function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        return $js_code;
    }

    // connection function
    public function connect()
    {
        // Only make a new connection if one not already established. 
        if (empty($this->dbconnect)) {

            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname)
                or die("Connect failed: %s\n" . $conn->error);

            // Check weather connection is established or not
            if ($conn) {
                $this->dbconnect = $conn;
            } else {
                echo "Connection could not be established.<br />";
                die(print_r(mysqli_connect_error(), true));
            }
        }
        // return connection
        return $this->dbconnect;
    }

    // select function for table
    public function user_table_data() {
        // call connection
        $db = $this->connect();
        
        $sql = "SELECT * FROM `users` ORDER BY `id` DESC";
        
        $query = $db->query($sql);
       
        // delare array variable
        $data = array();

        $rows = $query->num_rows;

        if($rows > 0){
            while($row = $query->fetch_assoc()){
                // store all rows into array varable
                $data[] = $row;
            }
        }

        // return array variable
        return $data;
    }


// function to insert data into database
    public function insert_user_data( $username, $password){
        // call connection
        $db = $this->connect();

        // real escape string to remove special charecter's from data and make it usable for sql query
        $username = $db->real_escape_string($username);
        $password = $db->real_escape_string($password);

        // declare array variable
        $msg = array();

        // check if username is not empty
        if(empty($username)){
            $msg[] = ["error"=>"You cannot leave username empty"];
        }

        // chekc if password is not empty
        if(empty($password)){
            $msg[] = ["error"=>"You cannot leave your password empty"];
        }else{
            // if not then check if password is 8 character long
            if(strlen($password) < 8 ){
                $msg[] = ["error"=>"Password Must be 8 letter's long"];
            }
        }

        // if no error found run insert query
        
        if(empty($msg)){
            $sql = "INSERT INTO users (`username`, `password`) VALUES ('$username', '$password')";
            $query = $db->query($sql);
    
            // check if query is working well or not
            if($query){
                $msg[] = ["success"=>"Data Inserted Successfully"];
            }else{
                $msg[] = ["error"=>"Something Went Wrong"];
            }   

        }

        // return response
        return $msg;

    }

    // function to make ready update form for updating data
    public function edit_user($id){
        // call connection
        $db = $this->connect();

        $sql = "SELECT * FROM `users` WHERE `id`='$id'";
        $query = $db->query($sql);

        $rows = $query->num_rows;

        if($rows > 0){
            $row = $query->fetch_assoc();
        }
        // return particular user data for update 
        return $row;
    }

    // function to update data
    public function update_user_data($id,  $username, $password){
        // call connection
        $db = $this->connect();

        // real_escape_string to make sure that vaibales don't contain any special characters
        $username = $db->real_escape_string($username);
        $password = $db->real_escape_string($password);

        // declare array variable to store error or success response
        $msg = array();

        // you can add validation for update function too here i didn't used
        
       
        $sql = "UPDATE `users` SET `username`='$username', `password`='$password' WHERE `id`='$id'";
        $update = $db->query($sql);

        // check if update query working or not
        if($update){
            $msg[] = ["success"=>"Data Updated Successfully"];
        }else{
            $msg[] = ["error"=>"Something Went Wrong"];
        }   

        // return response
        return $msg;

    }

    // function to delete data from table
    public function delete_user($id){
        // call connection
        $db = $this->connect();
        
        $sql = "DELETE FROM `users` WHERE `id`='$id'";
        
        $delete = $db->query($sql);
        
        // declare array variable to store response
        $msg = array();

// check if delete query work well or not
        if($delete){
            $msg[] = ["success"=>"Record Deleted Successfully"]; 
        }else{
            $msg[] = ["error"=>"Something Went Wrong"];
        }

        // return response
        return $msg;
    }


}


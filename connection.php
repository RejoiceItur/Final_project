<?php


    // Database Connection Properties
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = "final_proj";

    // connection property
    $con = null;

    // call constructor
    function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if ($this->con->connect_error){
            echo "Fail " . $this->con->connect_error;
        }
    }

    function __destruct()
    {
        $this->closeConnection();
    }

    // for mysqli closing connection
     function closeConnection(){
        if ($this->con != null ){
            $this->con->close();
            $this->con = null;
        }

}

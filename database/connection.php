<?php
    function connect(){

        $servername = "localhost";
        $database = "cortts_listing";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            return $conn;
        
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();            
        }
    }

?>
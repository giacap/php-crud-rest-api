<?php 

    class Database {

        //DB params
        private $host = MYSQL_DB_HOST_HERE;
        private $db_name = MYSQL_DB_NAME_HERE;
        private $username = MYSQL_DB_USERNAME_HERE;
        private $password = MYSQL_DB_PASSWORD_HERE;
        public $conn;

        //DB connection
        public function connect() {
            $this->conn = null;

            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

            if($this->conn->connect_error){
                die('Error: ' . $this->conn->connect_error);
            }

            return $this->conn;

            
            

        }
    };


    

?>
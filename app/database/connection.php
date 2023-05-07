<?php

#Establecer conexión con la base de datos


if (!class_exists('connection')) {
    class connection
    {

        private $host;
        private $user;
        private $password;
        private $dbname;


        public function __construct()
        {
            $this->host = "localhost";
            $this->user = "root";
            $this->password = "";
            $this->dbname = "cafeteria";
        }



        public function connect()
        {
            return mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
        }
    }
}

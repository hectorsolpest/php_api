<?php

class Database
{
    //db params
    private $host = 'localhost';
    private $db_name = 'php_api';
    private $user = 'root';
    private $password = '';
    private $port = 3308;
    private $connection;

    public function connect()
    {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->db_name, $this->port);
        if (!$this->connection)
        {
            echo 'Error: ' . mysqli_connect_error();
        }
        else
        {
            return $this->connection;
        }
    }

}
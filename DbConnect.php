<?php
class DbConnect
{
    private $server;
    private $port;
    private $dbname;
    private $user;
    private $pass;

    public function __construct()
    {

        $this->server = $_ENV['DB_HOST'];
        $this->port = $_ENV['DB_PORT'];
        $this->dbname = $_ENV['DB_DATABASE'];
        $this->user = "root";
        $this->pass = $_ENV['DB_PASSWORD'];

    }

    public function connect()
    {
        try {
            $conn = new PDO('mysql:host=' . $this->server . ';port=' . $this->port . ';dbname=' . $this->dbname, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\Exception $e) {
            echo "Database Error: " . $e->getMessage();
            return null;
        }
    }
}




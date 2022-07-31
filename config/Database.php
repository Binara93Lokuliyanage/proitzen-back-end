<?php 
  class Database {
    // DB Params
    // private $host = 'rtqaweb.cnaejpnwpryu.ap-southeast-1.rds.amazonaws.com';
    // private $db_name = 'scandy_web';
    // private $username = 'rtadmin';
    // private $password = 'raditechsadmin1qaz2wsx';

    private $host = 'localhost';
    private $db_name = 'proitzen';
    private $username = 'root';
    private $password = '';

    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }
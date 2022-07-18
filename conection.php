<?php
class Conection{ 

    public $host='yourHost';
    public $user='yourMySQLuser';
    public $password='yourMySQLpassword';
    public $dbname='nameOfYourDB';
    public $connection;

    function connect(){
        try {
            $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
        } catch (\Throwable $th) {
            echo("Error al conectar: $th");
        }
        
        return $this->connection;
    }

    function close(){
        try {
            mysqli_close($this->connection);
        } catch (\Throwable $th) {
            echo("Error al cerrar: $th");
        }
    }
 
    // other DBAL methods


    // $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
 
    //     if (!$this->connection) {
    //         die("connection failed: " . mysqli_connect_error());
    //     }
}
?>
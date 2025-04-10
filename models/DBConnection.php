<?php
class DBConnection {
    private $host = "localhost",$user = "root",$password = "mariadbpassword",$database = "proyek_ti";

    protected $connect;

    public function __construct(){
        try {
            if(!$this->connect){
                $this->connect = mysqli_connect($this->host,$this->user,$this->password,$this->database);
            }
        } catch (\Exception $e) {
            echo "error connect".$e->getMessage();
        }
    }
    protected function db_connection(): mysqli{
        return $this->connect;
    }
}
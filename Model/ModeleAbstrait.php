<?php
require_once "Setting.php";
abstract Class ModeleAbstrait {
    protected $connection = null;
    
    public function __construct(){
        $this->connection = mysqli_connect(Db_Host , Db_user , Db_pass, Db_name);
    }
    abstract public function readAll();

    public function count(){
        return count($this->readAll());
    }
}

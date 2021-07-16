<?php

class  CreateDb
{

    public $host;
    public $user;
    public $pass;
    public $dbname;
    public $tablename;
    public $con;

    //class constructor
    public function __construct($dbname='shopping', $tablename='producttb', $host='localhost', $user='root', $pass="atm()sph3r3"){
    $this->dbname=$dbname;
    $this->tablename=$tablename;
    $this->host=$host;
    $this->user=$user;
    $this->pass=$pass;
    

    //create connection
    $this->con = mysqli_connect($host, $user, $pass);

    //check connection
    if(!$this->con){
        die("connection failed:". mysqli_connect_error());
    }

    //query
    $sql ="CREATE DATABASE IF NOT EXISTS $dbname";

    //execute query
    if(mysqli_query($this->con, $sql)){
        $this->con = mysqli_connect($host, $user, $pass, $dbname);
    
        //sql to create table
        $sql ="CREATE TABLE IF NOT EXISTS $tablename
            (Id INT(11)NOT NULL AUTO_INCREMENT PRIMARY KEY,
            category VARCHAR (200) NOT NULL,
            productName VARCHAR(50)NOT NULL,
            productSummary VARCHAR(200) NOT NULL,
            productDiscountPrice INT(11),
            productPrice INT(11) NOT NULL,
            productImage VARCHAR(200)NOT NULL);";

        if (!mysqli_query($this->con, $sql)){
            echo "Error creating table:".mysqli_error($this->con);
        
        }
        }else{
            return false;
        
        }

    }public function getData(){

        $sql= "SELECT * FROM $this->tablename";
        $result = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($result)>0){
            return $result;
        }

    }




}



?>
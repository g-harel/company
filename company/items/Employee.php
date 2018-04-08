<?php

class Employee{

    private $iid;
    private $did;
    private $supervisor;
    private $address;
    private $phone;
    private $hourly;

    public function Employee($var){

        $con = include('./fancy/connection.php');

        $sql = "SELECT * FROM employees WHERE idd = " .$var;

        $result = $con->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $this.$iid = $row['iid'];
            $this.$did = $row['did'];
            $this.$supervisor = $row['supervisor'];
            $this.$address = $row['address'];
            $this.$phone = $row['phone'];
            $this.$hourly = $row['hourly'];
        }
    }

    public function getiid(){
        return $this.$iid;
    }

    public function getdid(){
        return $this.$did;
    }

    public function getSupervisor(){
        return $this.$supervisor;
    }

    public function getAddress(){
        return $this.$address;
    }

    public function getPhone(){
        return $this.$iid;
    }

    public function getHourly(){
        return $this.$hourly;
    }
}


?>
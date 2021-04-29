<?php

class User{
    public $firstName;
    public $lastName;
    public $email;
    public $dateOfBirth;
    public $items;

 public function __construct($f,$l,$e,$d)
 {
     $this->firstName=$f;
     $this->lastName=$l;
     $this->email=$e;
     $this->dateOfBirth=$d;
 }   
} 

?>
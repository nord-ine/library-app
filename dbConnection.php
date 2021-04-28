<?php
 $servername = 'localhost';
 $username= 'library';
 $password= 'root';
 try{
     $dbco= new PDO("mysql:host=$servername;dbname=library",$username,$password);
  }
     catch(PDOException$e){
         echo"Erreur : " . $e->getMessage();

  }
?>
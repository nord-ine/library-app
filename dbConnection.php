<?php
    $servername = 'localhost';
    $username= 'library';
    $password= 'root';
    try{
        $dbco= new PDO("mysql:host=$servername", $username,$password);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //    $sql= "CREATE DATABASE pdodb";$dbco->exec($sql);
        echo'Base de données conncté!';
        }
        catch(PDOException$e){echo"Erreur : " . $e->getMessage();
     }
?>
<?php
require 'dbConnection.php';

echo "ready \n";
$add_user_req=$dbco->prepare("INSERT INTO client(firstName,lastName,email,dateOfBirth) VALUES(:firstName,:lastName,:email,:dateOfBirth)");

$add_user_req->bindValue(':firstName',$firstName);
$add_user_req->bindValue(':lastName',$firstName);
$add_user_req->bindValue(':email',$email);
$add_user_req->bindValue(':dateOfBirth',$dateOfBirth);
$results =   $add_user_req->execute();

echo $results;

?>
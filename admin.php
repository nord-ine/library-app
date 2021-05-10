
<?php 
require 'dbConnection.php';

$error="";

if($_POST['submit']){

    // echo 'in db';
    $email = $_POST['email'];
    $password = $_POST['password'];

     $check_password_req = $dbco->prepare("SELECT ID FROM `admins` WHERE `email`='$email' AND `password`='$password';");
     $check_password_req->execute();
     $req_results= $check_password_req->fetchAll();


    if(count($req_results)>0){
        $error="";
        session_start();
        $_SESSION['admin_ID'] = $req_results[0]['ID'];
        header("Location: update.php");
    }
    else{
        $error="ce compte d'admin n'existe pas";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en" style="margin-top:50px"> 
<head>
    <title>accueil</title>

    <style>
        html,
        body {
        background-color:rgb(165, 214, 175);
        margin:0;
        padding:0;
        height:100%;
        }
        #container{
            position: relative;
            min-height: 100%;
        }
        #main{
            padding-bottom: 250px;
        }
        #footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 200px;
        } 
        #submit_button{
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input{
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
        }
        .input_errors{
            color:red;
            margin:2px;
            font-weight:bold;
        }
    </style>
</head>
<body>
        <div id="container">
            <div> <?php require 'header.php';?> </div>
            
            <div id="main" >
                <h1 style="text-align: center; color:firebrick">connection à votre compte Admin</h1>
                <div 
                    style="display:flex;
                        flex-direction:row;
                        justify-content:space-evenly;
                        align-items:center;  
                    ">
                    <form action="admin.php" method="POST" >

                        <div class="input_errors"><?php echo $error?></div>
                        <label for="email">email:</label><br>
                        <input type="email" id="email" name="email" required><br>
                        <label for="lastName">mot de passe :</label><br>
                        <input type="password" id="password" name="password"  required><br>
                        <input type="submit" id="submit_button" name="submit" value="se connecter">
                    </form> 
                    </div>
            </div>
            <div id="footer"><?php require 'footer.php';?></div>
        </div>   
</body>
</html>


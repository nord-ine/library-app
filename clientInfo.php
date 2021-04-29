<?php
require 'user.php';
$errors = ['email'=>"",'firstName'=>"",'lastName'=>"",'date'=>""];
$inputvalues=['email'=>"",'firstName'=>"me",'lastName'=>"",'date'=>""];

if(isset($_POST['submit'])){	

    // check email
        $inputvalues['email'] = $_POST['email'];
        if(!filter_var($inputvalues['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'entrez un email valide';
        }
    
    // check firstName
        $inputvalues['firstName'] = $_POST['firstName'];
        if(!preg_match("/^([a-zA-Z' ]+)$/", $inputvalues['firstName'])){
            $errors['firstName'] = 'le prenom doit contenir que des lettres';
        }
    // check LastName
        $inputvalues['lastName'] = $_POST['lastName'];
        if(!preg_match("/^([a-zA-Z' ]+)$/", $inputvalues['lastName'])){
            $errors['lastName'] = 'le nom doit contenir que des lettres';
        }
    

    // check date
        $inputvalues['date'] = $_POST['dateOfBirth'];
        $age = date_diff(date_create($inputvalues['date']), date_create('now'))->y;
        if($age>90 || $age<10){
            $errors['date'] = 'vous n etes pas elligible pour passer une commande ';
        }

    if(array_filter($errors)){
        //echo 'errors in form';
        //echo $errors;
    } else {
        //echo 'form is valid';
        session_start();
        $_SESSION['userData'] = new User($inputvalues['firstName'],$inputvalues['lastName'],$inputvalues['email'],$inputvalues['date']);

        //print_r($inputvalues);
        header('Location: search.php');
    }
  
   // print_r($errors);

} // end POST check

?>


<!DOCTYPE html>
<html lang="en" style="margin-top:50px"> 
<head>
    <title>Achat</title>

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
        #info_form{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        #firstName,#lastName,#email,#dateOfBirth{
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
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
                <h1 style="text-align: center; color:firebrick">information client</h1>
                <div id=info_form>
                <form action="clientInfo.php" method="POST" >
                        <label for="firstName">prenom:</label><br>
                        <input type="text" id="firstName" name="firstName" value="<?php echo $inputvalues['firstName'] ?>" required ><br>
                        <div class="input_errors"><?php echo $errors['firstName']  ?></div>
                        <label for="lastName">nom:</label><br>
                        <input type="text" id="lastName" name="lastName" value="<?php echo $inputvalues['lastName'] ?>" required><br>
                        <div class="input_errors"><?php echo $errors['lastName']  ?></div>
                        <label for="email">email:</label><br>
                        <input type="email" id="email" name="email" value="<?php echo $inputvalues['email'] ?>" required><br>
                        <div class="input_errors"><?php echo $errors['email']  ?></div>
                        <label for="dateOfBirth">date de naissance:</label><br>
                        <input type="date" id="dateOfBirth" name="dateOfBirth" value="<?php echo $inputvalues['date'] ?>" required><br>
                        <div class="input_errors"><?php echo $errors['date']  ?></div>
                        <input type="submit" id="submit_button" name="submit" value="valider">
                </form> 
                </div>
            </div>
            <div id="footer"><?php require 'footer.php';?></div>
        </div>   
</body>
</html>


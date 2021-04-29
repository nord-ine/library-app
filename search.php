<?php
require 'dbConnection.php';

require 'user.php';

if(isset($_POST['submit'])){
    session_start();
    $user_choices = json_decode($_POST['user_choices'],true);

    $_SESSION['userData']->items=$user_choices;

    //print_r($_SESSION['userData']);
    $user_email = $_SESSION['userData']->email;
    //echo $user_email;
    $user_req= $dbco->prepare("SELECT ID FROM admins WHERE email='$user_email' ");
    $user_req->execute();
    $returned_data  = $user_req->fetchAll();

     if(count($returned_data)>=1){
        $_SESSION['userData']->items['discount']=15;
     } 
     else{
        $user_req= $dbco->prepare("SELECT ID FROM client WHERE email='$user_email' ");
        $user_req->execute();
        $returned_data  = $user_req->fetchAll();
        if(count($returned_data)>=1){
            $_SESSION['userData']->items['discount']=10;
         }
         else{
            $firstName = $_SESSION['userData']->firstName;
            $lastName = $_SESSION['userData']->lastName;
            $email = $_SESSION['userData']->email;
            $dateOfBirth = $_SESSION['userData']->dateOfBirth;

                $add_user_req=$dbco->prepare("INSERT INTO `client` (`ID`, `fistName`, `lastName`, `email`, `dateOfBirth`) VALUES (NULL, '$firstName', '$lastName', '$email', '$dateOfBirth');");
                $add_user_req->execute();
                //$add_user_req->debugDumpParams();
                //echo "ajouter a latble \n";
                $_SESSION['userData']->items['discount']=0;
            }

              
         }
         //print_r($_SESSION['userData']);
         header("Location: summary.php");
}
 
    session_start();
    
    $books_req= $dbco->prepare("SELECT * FROM books where quantity>0");
    $books_req->execute();
    $book_list= $books_req->fetchAll(PDO::FETCH_ASSOC);

    $product_req= $dbco->prepare("SELECT * FROM products where quantity>0");
    $product_req->execute();
    $product_list= $product_req->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['book_list']=$book_list;
    $_SESSION['product_list']=$product_list;
   
?>
<!DOCTYPE html>
<html lang="en" style="margin-top:50px"> 
<head>
    <title>recherche</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        #content{
            display:flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
        }
        #user_data_div{
            height: 160px;
            width: 400px;
            border-radius: 3px;
            border:3px solid;
            border-color: tomato;
            box-shadow: 0 20px 40px -14px ;
            padding:10px;
        }
        #product_selection_div{
            margin-top: 30px;
            display:flex;
            flex-direction:column;
            align-items: center;
            justify-content:center;
            
        }
    </style>

   
</head>
<body>
        <div id="container">
            <div> <?php require 'header.php';?> </div>
            
            <div id="main" >
                <h1 style="text-align: center; color:firebrick">Recherche</h1>
                <div id ="content">
                    <div id="user_data_div">
                        <p> <b>prename : </b><?php echo $_SESSION['userData']->firstName ?></p>
                        <p><b>nom : </b><?php echo $_SESSION['userData']->lastName ?></p>
                        <p><b>email : </b><?php echo $_SESSION['userData']->email?></p>
                        <p><b>date de naissance : </b><?php echo $_SESSION['userData']->dateOfBirth?></p>
                    </div>
                    <div id="product_selection_div">
                        <h3>selectionner les livres et produits que vous voulez réserver</h3>
                        <div class="menu">
                            <select name="book_choice" id="book_choice">
                                <?php
                                foreach ($book_list as &$book) {
                                    ?> 
                                    <option class="book_option" value="<?php echo $book['ID']; ?>"><?php echo $book['title']; ?></option>
                                    <?php
                                    }       
                                    ?>                                
                            </select>
                            <button id="add_book_button"> ajouter livre</button>
                            <select name="product_choice" id="product_choice">
                                <?php
                                foreach ($product_list as &$product) {
                                    ?> 
                                    <option class=product_option value="<?php echo $product['ID']; ?>"><?php echo $product['name']; ?></option>
                                    <?php
                                    }       
                                    ?>                                
                            </select>
                            <button id="add_product_button"> ajouter produit</button>
                         
                            <form method="post" action="search.php">
                            <input type="hidden" name="user_choices" id="user_choices"></input>
                            <input type="submit" id="submit_button" name="submit" value="valider vos choix">
                            </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div id="footer"><?php require 'footer.php';?></div>
            </div>
           
        </div>   

        <script >

var clientItems={
    books:[],
    products:[]
}

    var form = document.getElementById('submit_choices_form');
    var input = document.getElementById('user_choices');
    let add_book_button = document.getElementById('add_book_button');

    add_book_button.addEventListener('click', function(event){
        let book = document.getElementById('book_choice').value;
        clientItems.books.push(parseInt(book));
        input.value= JSON.stringify(clientItems);

        console.log(input.value);
    });

   let add_product_button = document.getElementById('add_product_button');
    add_product_button.addEventListener('click', function(event){
        let product = document.getElementById('product_choice').value;
        clientItems.products.push(parseInt(product));
        input.value= JSON.stringify(clientItems);

        console.log(input.value);
    });


    let search_items_button = document.getElementById("search_items_button");

    search_items_button.addEventListener('click',function(){

        let book_options = document.querySelectorAll('.book_option');
        let product_options = document.querySelectorAll('.product_option');

        book_options.forEach(element => {
            console.log(element.innerHTML)
        });
        //console.log(book_options);
        //console.log(product_options);
    });
    // let validate_items_button = document.getElementById('validate_items_button');
    // validate_items_button.addEventListener('click',  function(event){
    //     console.log("in ajax");
    //        $.ajax({
    //             url: 'search.php',
    //             type: 'post',
    //             data: {items:JSON.stringify(clientItems)},
    //             dataType: 'JSON',
    //             success: function(response){
    //                 console.log("success");
    //             }
    //         });
    // });
   // console.log(ele.value);

</script>
</body>
</html>


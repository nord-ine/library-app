<?php
require 'user.php';
require 'dbConnection.php';

session_start();



if($_POST['add_book']){
    $imageData = file_get_contents($_FILES["book_image"]["tmp_name"]);
    $book_title = $_POST['book_title'];
    $book_description = $_POST['book_description'];
    $book_author = $_POST['book_author'];
    $book_year = $_POST['book_year'];
    $book_price = $_POST['book_price'];
    $book_quantity = $_POST['book_quantity'];

    $add_book_req=$dbco->prepare("INSERT INTO `books` (`ID`, `title`, `description`, `author`, `year`, `price`, `image`, `quantity`) VALUES (NULL, '$book_title', '$book_description', '$book_author', '$book_year', '$book_price', ". $dbco->quote($imageData) .", '$book_quantity');");

    $add_book_req->execute();
    //$add_book_req->debugDumpParams();

}
if($_POST['add_product']){

    $imageData = file_get_contents($_FILES["product_image"]["tmp_name"]);
    $product_name = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];

    $add_product_req=$dbco->prepare("INSERT INTO `products` (`ID`, `name`, `description`, `price`, `image`, `quantity`) VALUES (NULL, '$product_name', '$product_description', '$product_price', ". $dbco->quote($imageData) .", '$product_quantity');");

    $add_product_req->execute();
    $add_product_req->debugDumpParams();

}

if($_POST['delete_book_submit']){
    //var_dump($_POST['delete_book_choice']);

    $book_id = $_POST['delete_book_choice'];
    $delete_book_req = $dbco->prepare("DELETE FROM `books` WHERE ID=$book_id;");
    $delete_book_req->execute();
    //$delete_book_req->debugDumpParams();
}
if($_POST['delete_product_submit']){
    //var_dump($_POST['delete_book_choice']);

    $book_id = $_POST['delete_product_choice'];
    $delete_product_req = $dbco->prepare("DELETE FROM `products` WHERE ID=$book_id;");
    $delete_product_req->execute();
    //$delete_product_req->debugDumpParams();
}

$books_req= $dbco->prepare("SELECT * FROM books");
$books_req->execute();
$book_list= $books_req->fetchAll(PDO::FETCH_ASSOC);

$product_req= $dbco->prepare("SELECT * FROM products");
$product_req->execute();
$product_list= $product_req->fetchAll(PDO::FETCH_ASSOC);



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
            /* display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center; */
        }
        #footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 200px;
        } 
        #add_forms,#delete_forms{
            display:flex;
            flex-direction:row;
            justify-content:space-around;
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
        input[type=submit]{
            width: 100%;
            background-color: blueviolet;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
        <div id="container">
            <div> <?php require 'header.php';?> </div>
            
            <div id="main" >
                <h1 style="text-align: center; color:firebrick">Update</h1>
                
                <h3>ajouter livre ou produit : </h3>
                <div id="add_forms">
                    <div>
                    <h4>ajouter livre</h4>
                    <form method="post" action="update.php" enctype="multipart/form-data">
                        <label for="book_title">titre du livre</label><br>
                        <input type="text" id="book_title" name="book_title" value="<?php echo $inputvalues['firstName'] ?>" required ><br>
                        <label for="book_author">auteur</label><br>
                        <input type="text" id="book_author" name="book_author" value="<?php echo $inputvalues['lastName'] ?>" required><br>
                        <label for="book_description">description</label><br>
                        <input type="text" id="book_description" name="book_description" value="<?php echo $inputvalues['email'] ?>" required><br>
                        <label for="book_year">année : </label><br>
                        <input type="number" min="1000" max="2021" id="book_year" name="book_year" value="<?php echo $inputvalues['date'] ?>" required><br>
                        <label for="book_price">prix : </label><br>
                        <input type="number" min="1" id="book_price" name="book_price" value="<?php echo $inputvalues['date'] ?>" required><br>
                        <label for="book_quantity">quantité </label><br>
                        <input type="number" min="1" id="book_quantity" name="book_quantity" value="<?php echo $inputvalues['date'] ?>" required><br>
                        <input type="file" name="book_image" id="book_image"></br>
                        <input type="submit" id="submit_button" name="add_book" value="valider livre"> 
                    </form>
                    </div>
                   <div>
                   <h4>ajouter produit</h4>
                   <form method="post" action="update.php" enctype="multipart/form-data">
                        <label for="product_name">nom du produit</label><br>
                        <input type="text" id="product_name" name="product_name" value="<?php echo $inputvalues['firstName'] ?>" required ><br>
                        <label for="product_description">description</label><br>
                        <input type="text" id="product_description" name="product_description" value="<?php echo $inputvalues['email'] ?>" required><br>
                        <label for="product_price">prix : </label><br>
                        <input type="number" min="1" id="product_price" name="product_price" value="<?php echo $inputvalues['date'] ?>" required><br>
                        <label for="product_quantity">quantité </label><br>
                        <input type="number" min="1" id="product_quantity" name="product_quantity" value="<?php echo $inputvalues['date'] ?>" required><br>
                        <input type="file" name="product_image" id="product_image"></br>
                        <input type="submit" id="submit_button" name="add_product" value="valider produits"> 
                    </form>
                   </div>
                </div>
                <h3>supprimer des livres ou des produits</h3>
                <div id="delete_forms">      
                            <form method="post" action="update.php">
                                <select name="delete_book_choice" id="book_choice">
                                    <?php
                                    foreach ($book_list as &$book) {
                                        ?> 
                                        <option class="book_option" value="<?php echo $book['ID']; ?>"><?php echo $book['title']; ?></option>
                                        <?php
                                        }       
                                        ?>                                
                                </select>
                                <input type="submit" id="submit_button" name="delete_book_submit" value="supprimer livre">
                            </form>
                            <form method="post" action="update.php">
                                <select name="delete_product_choice" id="product_choice">
                                    <?php
                                    foreach ($product_list as &$product) {
                                        ?> 
                                        <option class=product_option value="<?php echo $product['ID']; ?>"><?php echo $product['name']; ?></option>
                                        <?php
                                        }       
                                        ?>                                
                                </select>
                                <input type="submit" id="submit_button" name="delete_product_submit" value="supprimer produit">
                            </form>
                </div>
            </div>
            <div id="footer"><?php require 'footer.php';?></div>
        </div>   
</body>
</html>


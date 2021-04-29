<?php
require 'user.php';
require 'dbConnection.php';

session_start();

$book_list_summary=[];
$product_list_summary=[];
$total=0;
$total_after_discount=0;

function get_book_by_ID($id){
    foreach($_SESSION['book_list'] as &$b){
        if($b['ID']==$id) return ['title'=>$b['title'],'price'=>$b['price']];
    }
}
function get_product_by_ID($id){
    foreach($_SESSION['product_list'] as&$p){
        if($p['ID']==$id){
            return ['name'=>$p['name'],'price'=>$p['price']];
        }
    }
}

foreach ($_SESSION['userData']->items['books'] as &$id){
        array_push($book_list_summary,get_book_by_ID($id));
    }
foreach ($_SESSION['userData']->items['products'] as &$id){
        array_push($product_list_summary,get_product_by_ID($id));
    }

function compute_total($book_list_summary,$product_list_summary){
    $sum = 0;
    foreach ($book_list_summary as &$bls){
        $sum+=$bls['price'];
    }
    foreach ($product_list_summary as &$pls){
        $sum+=$pls['price'];
    }
    return $sum;
}

$total = compute_total($book_list_summary,$product_list_summary);
$total_after_discount = $total -($_SESSION['userData']->items['discount'])/100*$total;



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
        #add_forms{
            display:flex;
            flex-direction:row;
            justify-content:space-around;
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
                    <form method="post" action="update.php">
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
                        <input type="submit" id="submit_button" name="submit" value="valider livre"> 
                    </form>
                    </div>
                   <div>
                   <h4>ajouter produit</h4>
                   <form method="post" action="update.php">
                        <label for="product_name">nom du produit</label><br>
                        <input type="text" id="product_name" name="product_name" value="<?php echo $inputvalues['firstName'] ?>" required ><br>
                        <label for="product_description">description</label><br>
                        <input type="text" id="product_description" name="product_description" value="<?php echo $inputvalues['email'] ?>" required><br>
                        <label for="product_price">prix : </label><br>
                        <input type="number" min="1" id="product_price" name="product_price" value="<?php echo $inputvalues['date'] ?>" required><br>
                        <label for="product_quantity">quantité </label><br>
                        <input type="number" min="1" id="product_quantity" name="product_quantity" value="<?php echo $inputvalues['date'] ?>" required><br>
                        <input type="file" name="product_image" id="product_image"></br>
                        <input type="submit" id="submit_button" name="submit" value="valider produits"> 
                    </form>
                   </div>
                  
                </div>
            </div>
            <div id="footer"><?php require 'footer.php';?></div>
        </div>   
</body>
</html>


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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        #footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 200px;
        } 
        #summary,#adress{
            border: 2px solid tomato;
            border-radius: 4px;
            box-sizing: border-box;
            width: 300px;
            display:flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
    

    </style>
</head>
<body>
        <div id="container">
            <div> <?php require 'header.php';?> </div>
            
            <div id="main" >
                <h1 style="text-align: center; color:firebrick">récapitulatif</h1>
                <div id="summary">
 
                        <?php
                        foreach($book_list_summary as &$bls){
                        ?>
                               <p><?php echo $bls['title'] ?> :  <?php echo $bls['price'] ?> €</p> 
                         <?php   
                        }
                        ?>
                    <?php
                    foreach($product_list_summary as &$pls){
                        ?>
                                <p><?php echo $pls['name'] ?> :  <?php echo $pls['price'] ?> €</p>
                         <?php   
                        }
                        ?>
               
                        <p>réduction :  <?php echo $_SESSION['userData']->items['discount'] ?> %</p>
                        <p>total : <?php echo $total; ?> € </br> </p>
                        <p>total aprés réduction : <?php echo $total_after_discount; ?>  €     </p>              
                </div>

                <div id="adress">
                <p>vous pouvez récupérer les livres et produits résérvé  sur l'adresse suivante:</p>
                <p>5 rue de Stasbourg </br>Paris 16e , 75016</p>
                </div>
                <h3 style="text-align: center;"> horaire d'ouverture : </h3>
                    <div style=" display:flex; justify-content:center; ">
                        <img src="images/horaire.png" alt="openHours" width="400" height="300" >
                    </div>
                
            </div>
            <div id="footer"><?php require 'footer.php';?></div>
        </div>   
</body>
</html>


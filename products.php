<!DOCTYPE html>
<html lang="en" style="margin-top:50px"> 
<head>
    <title>Produits</title>

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
        .product_list{
            display:flex;
            flex-direction: row;
            flex-wrap: wrap;
            margin:20px;
        }
        .product{
            margin:10px;
            height: 350px;
            width:300px;
            border-radius: 4px;
            box-shadow: 0 20px 40px -14px ;
            background-color:white;
        }
        .product_image{
            padding:2px;
        }
        .product_name{
            font-weight:800;
            font-size: 18px;
        }
        .product_text{
            overflow-wrap: break-word;
        }
    </style>
</head>
<body>
        <div id="container">
            <div> <?php require 'header.php';?> </div>
            
            <div id="main" >
                <h1 style="text-align: center; color:firebrick">Nos Produits</h1>
                <div class="product_list">
                <?php
                require 'dbConnection.php';
                $sth= $dbco->prepare("SELECT * FROM products");
                $sth->execute();
                $resultat= $sth->fetchAll(PDO::FETCH_ASSOC);

              
                foreach ($resultat as &$product) {
                    ?> 
                    <div class="product">
                    <img class="product_image" src="data:image/jpeg;base64,<?php echo base64_encode($product['image'])?>" width="297px" height="200px">
                    <p class="product_name"><?php echo $product['title']?></p>
                    <p class="product_text"><b>description:</b><?php echo $product['description']?></p>
                    <p class="product_text"><b> prix:</b><?php echo $product['price']?>$</p>
                     </div>
                     <?php
                     }       
                    ?>
                </div>
            </div>
            <div id="footer"><?php require 'footer.php';?></div>
        </div>   
</body>
</html>


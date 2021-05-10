<!DOCTYPE html>
<html lang="en" style="margin-top:50px"> 
<head>
    <title>livre</title>

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
        .book_list{
            display:flex;
            flex-direction: row;
            flex-wrap: wrap;
            margin:20px;
        }
        .book{
            margin:10px;
            height: 400px;
            width:350px;
            border-radius: 4px;
            box-shadow: 0 20px 40px -14px ;
            background-color:white;
        }
        .book_image{
            padding:2px;
        }
        .book_title{
            font-weight:800;
            font-size: 18px;
        }
        .book_text{
            overflow-wrap: break-word;
        }
    </style>
</head>
<body>
        <div id="container">
            <div> <?php require 'header.php';?> </div>
            
            <div id="main" >
                <h1 style="text-align: center; color:firebrick">Nos Livres dfgfsdf</h1>
                <div class="book_list">
                <?php
                require 'dbConnection.php';
                $sth= $dbco->prepare("SELECT * FROM books");
                $sth->execute();
                $resultat= $sth->fetchAll(PDO::FETCH_ASSOC);

              
                foreach ($resultat as &$book) {
                    ?> 
                    <div class="book">
                    <img class="book_image" src="data:image/jpeg;base64,<?php echo base64_encode($book['image'])?>" width="345px" height="150px">
                    <p class="book_title"><?php echo $book['title']?></p>
                    <p class="book_text"><b>description:</b><?php echo $book['description']?></p>
                    <p class="book_text"><b> auteur : </b><?php echo $book['author']?></p>
                    <p class="book_text"><b> année de publication :</b><?php echo $book['year']?></p>
                    <p class="book_text"><b> prix:</b><?php echo $book['price']?>$</p>
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


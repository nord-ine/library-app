<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>accueil</title>
    <style>
        body,html{
        margin:0;
        height:100%;
        background-color:rgb(165, 214, 175);
        }

        nav{
            height:7%;
            position: fixed;
            top: 0;
            width: 100%;
            margin:0;
            overflow:hidden;
        }
        ul{
            display:flex;
            flex-direction:row;
            justify-content:center;
            align-items:center;
            color:aqua;
            background-color:tomato;
            list-style-type: none;
            margin:0;
            padding:0;
            height:100%;
        }
        a:hover{
            background-color:blueviolet;
        }

        a{
            text-decoration:none;
            color:black;
            font-weight:bold;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            height:100%;
            width: 100%;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
           <a href="index.php"><li>accueil</li></a> 
           <a href="products.php"><li>Produit</li></a> 
           <a href="books.php"><li>Livres</li></a> 
           <a href="accueil.html"><li>Achats</li></a> 
           <a href="accueil.html"><li>Recherche</li></a> 
           <a href="accueil.html"><li>update</li></a> 
        </ul>
    </nav>
</body>
</html>
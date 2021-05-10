<div>
        <style>
        nav{
            height:40px;
            top: 0;
            width: 100%;
            margin:0;
            position:fixed;
            background-color:tomato;
        }
        ul{
            display:flex;
            flex-direction:row;
            justify-content:center;
            align-items:center;
            color:aqua;
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
            <nav>
                <ul>
                    <a href="index.php"><li>accueil</li></a> 
                    <a href="products.php"><li>Produit</li></a> 
                    <a href="books.php"><li>Livres</li></a> 
                    <a href="clientInfo.php"><li>Achats</li></a> 
                    <a href="admin.php"><li>admin</li></a> 
                </ul>
            </nav>
</div>

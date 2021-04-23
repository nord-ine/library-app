<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>accueil</title>
    <link href="accueil.css" rel="stylesheet">
    <style>
        html,body{
            height: 100;
            width: 100%;
            font-size:large;
        }
        footer{
            width: 100%;
            background-color: tomato;
            bottom: 0;
            position: fixed;
            left: 0;
        }
        .container{
            display:flex;
            flex-direction:row;
            justify-content: space-around;
            align-items: center;
        }
        footer{
            display:flex;
            flex-direction:column;
            justify-content: center;
        }
        .socialMedia{
            text-decoration:none;
            display:inline;
        }
    </style>    
</head>
<body>
    <footer>
        <div class="container">
            <div>
                <p>adresse : </p>
                <p>5 rue de Stasbourg</p>
                <p>Paris 16e , 75016</p>
            </div>
            <div>
                <p>Contact : </p>
                <p>email : librairie@gmail.com</p>
                <p>numéro de Tel : 01 53 99 11 22</p>
            </div>
            <div class="socialMedia">
                <a href="#"><img src='images/facebook.png' width="50px" height="50px"></a>
                <a href="#"><img src='images/insta.png'  width="50px" height="50px"></a>
                <a href="#"><img src='images/youtube.png'  width="50px" height="50px"></a>
            </div>
        </div>

    </footer>
</body>
</html>
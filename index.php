
<!DOCTYPE html>
<html lang="en" style="margin-top:50px"> 
<head>
    <title>accueil</title>

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
    </style>
</head>
<body>
        <div id="container">
            <div> <?php require 'header.php';?> </div>
            
            <div id="main" >
                <h1 style="text-align: center; color:firebrick">Bienvenu à la libraire de mars</h1>
                <div 
                    style="display:flex;
                        flex-direction:row;
                        justify-content:space-evenly;
                        align-items:center;  
                    ">
                        <img src="images/librairie1.jpg" alt="libray" width="400" height="300">
                        <img src="images/produits.jpg" alt="libraryProducts" width="400" height="300">
                </div>
                    <p>Ad dolore dignissimos asperiores dicta facere optio quod commodi nam tempore recusandae. Rerum sed nulla eum vero expedita ex delectus voluptates rem at neque quos facere sequi unde optio aliquam!</p>
                    <p>Tenetur quod quidem in voluptatem corporis dolorum dicta sit pariatur porro quaerat autem ipsam odit quam beatae tempora quibusdam illum! Modi velit odio nam nulla unde amet odit pariatur at!</p>
                    <p>Consequatur rerum amet fuga expedita sunt et tempora saepe? Iusto nihil explicabo perferendis quos provident delectus ducimus necessitatibus reiciendis optio tempora unde earum doloremque commodi laudantium ad nulla vel odio?</p>
                   <div>
               
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


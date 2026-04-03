<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonsterEnergy</title>
    <meta name="description" content="Explore the Monster Energy catalog. Discover available Monster Energy drinks, browse products, and find your favorite flavors in our online shop.">

    <meta name="keywords" content="Monster Energy, energy drinks, Monster catalog, Monster flavors, energy drink shop, Monster products, buy energy drinks, Monster collection">

    <link rel="icon" type="image/png" href="resources/images/logo.png">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION["ussername"]) && isset($_SESSION["password"])){
            require_once "header.php";
        }
        else{
            $_SESSION["ussername"]="";
            $_SESSION["password"]="";
            require_once "header.php";  
        }
        // var_dump($_SESSION["ussername"]);
        
    ?>
    <div id="main">
        <h1>Monster Energy</h1>
        <img src="resources/images/logo.png" id="mainLogo" alt="monster logo">
        <h2>Welcome to Monster Energy catalog.</h2>
    </div>

    <div class="hero">
        <h2>Info</h2>
        <p>Monster energy is a energy drink that was founded in USA. The Monster is now the most popupla energy drink in the world. There are milions of people who have passionate love for this drink, not only for it's taste but alsou because the like collecting Monster cans and making collection.</p>
        <div>
            <img src="resources/images/collection.png" alt="monster collection">
            <img src="resources/images/collection2.png" alt="monster collection">
            <img src="resources/images/collection3.png" alt="monster collection">
        </div>
    </div>
    <div class="hero">
        <h2>Where to start</h2>
        <p>On this website you are able to see all product that are currently avelable in store to purches. In the shop page you can search and filter products to find what are you interested in.</p>
        <p>The stocks in shops are constatnly changeing so the products that you are seeing can change depending on the stores.</p>
    </div>
     <div id="fav">
        <h3>Favorutes</h3>
        <div>
            <?php
            $con=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
            $some=$con->query("select product_name, image from products where product_id in (1,30,12,14,24)");
            foreach($some as $red){
                echo "<div class='favItem'>
                <img src='resources/images/".$red["image"]."'/>
                <p>".$red["product_name"]."</p>
                </div>";
            }
            ?>
        </div>
    </div>


    
<?php
        if(isset($_SESSION["ussername"]) && isset($_SESSION["password"])){
            require_once "footer.php";
        }
        else{
            $_SESSION["ussername"]="";
            $_SESSION["password"]="";
            require_once "footer.php";
        }    
    ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
    <script src="resources/js/main.js"></script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author | Monster Energy</title>

<meta name="description" content="Learn more about the author of the Monster Energy website. Meet Filip Savić, an IT student specializing in Internet Technologies and web development.">

<meta name="keywords" content="author page, Filip Savić, IT student, web developer, Monster Energy website author, ICT student, portfolio author">

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
    <div id="authorHero">
        <div id="authorWrap">
            <div>
                <img src="resources/images/profilna.jpg" alt="prfilna slika" id="autorImg">
            </div>
            <div id="authorDesc">
                <h1>Filip Savić 81/24 IT</h1>
                <p>Moje ime je Filip Savić, pohađam visoku ICT školu na smeru Internet Tehnoogije. Završio sam srednju elektrotehničku školu Rade Končar na smeru Informacione Tehnologije.</p>
            </div>
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


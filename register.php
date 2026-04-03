<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Monster Energy</title>

<meta name="description" content="Create a Monster Energy account to explore products, send messages to administrators, and access personalized features.">

<meta name="keywords" content="register Monster Energy, create account, sign up, user registration, Monster Energy account">

<meta name="robots" content="noindex, nofollow">

<link rel="icon" type="image/png" href="resources/images/logo.png">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>

    <?php
        session_start();
        if(isset($_SESSION["ussername"]) && isset($_SESSION["password"]) && $_SESSION["ussername"]!="" && $_SESSION["password"]!=""){
            header("location: index.php");
        }
        if(isset($_SESSION["ussername"]) && isset($_SESSION["password"])){
            require_once "header.php";
        }
        else{
            $_SESSION["ussername"]="";
            $_SESSION["password"]="";
            require_once "header.php";
        }
    ?>
    <div id="registerPopUp">
        <form id="register">
            <div>
                <label for="registerUssername">Ussername:</label>
                <input type="text" name="registerUssername" id="registerUssername">
            </div>
            <div>
                <label for="registerPassword">Password:</label>
                <input type="password" name="registerPassword" id="registerPassword">
            </div>
            <div>
                <label for="registerEmail">Email:</label>
                <input type="email" name="registerEmail" id="registerEmail">
            </div>
            <div id="greskaRegister"></div>
            <div>
                <button id="sendRegister">Send</button>
                <button id="closeRegister" type='button'>Close</button>
            </div>
        </form>
    </div>

    <div class="fWrap">
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
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
    <script src="resources/js/main.js"></script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
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
        var_dump($_SESSION["ussername"]);
    ?>

 <div id="logInPopUp">
        <form id="login">
            <div>
                <label for="ussername">Ussername:</label>
                <input type="text" name="ussername" id="ussername">
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="text" name="password" id="password">
            </div>
            <div id="greskaLogin"></div>
            <div>
                <button id="sendLogin">Send</button>
                <button id="closeLogin">Close</button>
            </div>
        </form>
    </div>

    

    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
    <script src="resources/js/main.js"></script>
</body>
</html>


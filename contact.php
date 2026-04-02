<?php
session_start();
var_dump($_SESSION["ussername"]);
    if(!isset($_SESSION["ussername"]) || $_SESSION["ussername"]==""){
        header("location: index.php");
    }
    $con=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
        if(isset($_POST["contact"])){
            // echo "dbsbdhkHSAVDA";
            $admin_id=0;
            $title=$_POST["title"];
            $message=$_POST["message"];
            $admin_email=$_POST["admin_email"];

            $adminUpit=$con->prepare("select * from ussers where role_id=2 and email = :usser_email");
            $adminUpit->bindParam(":usser_email",$admin_email);
            $adminUpit->execute();
            foreach($adminUpit as $red){
                $admin_id= $red["usser_id"];
            }
            var_dump($admin_id);
            var_dump($_SESSION["ussername"]);
            var_dump($_SESSION["password"]);
            $usserUpit=$con->prepare("select * from ussers where ussername like :ussername and password like :password");
            $usserUpit->bindParam(":ussername",$_SESSION["ussername"]);
            $usserUpit->bindParam(":password",$_SESSION["password"]);
            $usserUpit->execute();
            foreach($usserUpit as $red){
                $usser_id= $red["usser_id"];
            }

            
            
            $upit= $con->prepare("insert into messages (admin_id,usser_id,title,message) values (:admin_id,:usser_id,:title,:message)");
            $upit->bindParam(":admin_id",$admin_id);
            $upit->bindParam(":usser_id",$usser_id);
            $upit->bindParam(":title",$title);
            $upit->bindParam(":message",$message);

            if($admin_id){
                echo "Message sent successful!";
                $upit->execute();
                exit();
            }
            else{
                echo "Wrong admin email!";
                exit();
            }
        }
            
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonsterEnergy</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>
    <?php
        if(isset($_SESSION["ussername"]) && isset($_SESSION["password"])){
            require_once "header.php";
        }
        else{
            $_SESSION["ussername"]="";
            $_SESSION["password"]="";
            require_once "header.php";  
        }    
    ?>
<!-- action="contact.php" method="post" -->
    
    
    <form  id="contactForm">

        <div>
            <label for="admin_email">Admin email:</label>
            <input type="text" name="admin_email" id="admin_email">
    
            <label for="title">Title:</label>
            <input type="text" name="title" id="title">
    
            <label for="message">Message:</label>
            <textarea type="text" name="message" id="message" cols="40" rows="5"></textarea>
            
    
            <button name="contact" value="contact" id="contact">Send</button>
        </div>
    </form>
    <p id="greska"></p>


    
    <?php
        // if(isset($_SESSION["ussername"]) && isset($_SESSION["password"])){
        //     require_once "footer.php";
        // }
        // else{
        //     $_SESSION["ussername"]="";
        //     $_SESSION["password"]="";
        //     require_once "footer.php";
        // }    
    ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
    <script src="resources/js/main.js"></script>
</body>
</html>


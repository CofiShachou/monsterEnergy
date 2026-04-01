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
        session_start();
        if(isset($_SESSION["ussername"]) && isset($_SESSION["password"])){
            require_once "header.php";
        }
        else{
            $_SESSION["ussername"]="";
            $_SESSION["password"]="";
            require_once "header.php";  
        }    
    ?>

    <form action="contact.php" method="post" id="contact">
        <label for="admin_email">Admin email"</label>
        <input type="text" name="admin_email" id="admin_email">

        <label for="title">title</label>
        <input type="text" name="title" id="title">

        <label for="message">Message</label>
        <input type="text" name="message" id="message">

        <button name="contact">Send</button>
    </form>

    <?php
        if(isset($_POST["contact"])){
            $admin_id=0;
            $title=$_POST["title"];
            $message=$_POST["message"];
            $admin_email=$_POST["admin_email"];
            $conAdmin=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
            $adminUpit=$con->prepare("select * from ussers where role_id=2 and email like :usser_email");
            $adminUpit->bindParam(":usser_email",$admin_email);
            $adminUpit->execute();
            foreach($adminUpit as $red){
                $admin_id= $red["usser_id"];
            }

            $usserUpit=$con->prepare("select * from ussers where ussername like :ussername and password like :password");
            $usserUpit->bindParam(":ussername",$_SESSION["ussername"]);
            $usserUpit->bindParam(":password",$_SESSION["password"]);
            $usserUpit->execute();
            foreach($usserUpit as $red){
                $usser_id= $red["usser_id"];
            }

            
            $con=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
            $upit= $con->prepare("insert into messages (admin_id,usser_id,title,message) values (:admin_id,:usser_id,:title,:message)");
            $upit->bindParam(":admin_id",$admin_id);
            $upit->bindParam(":usser_id",$usser_id);
            $upit->bindParam(":title",$title);
            $upit->bindParam(":message",$message);
            
            echo "<p>Dole</p>";
            echo "$admin_id + $usser_id + $title + $message";
            }
            
    ?>
    


    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
    <script src="resources/js/main.js"></script>
</body>
</html>


<?php
        // session_start();
        // $con=new PDO("mysql:host=sql106.infinityfree.com;dbname=if0_41266997_monsterenergy","if0_41266997","IzanaKurokawa9");
        $con=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
        $rezultat=$con->query("select * from header");

        $conUser=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
        $rezUser=$conUser->query("select u.ussername, u.password,u.role_id as role from ussers u join roles r on u.role_id = r.role_id");
        $adminExists=false;
        $usserExists=false;
        foreach($rezUser as $red){
            if($_SESSION["ussername"]==$red["ussername"] && $_SESSION["password"]==$red["password"]){
                $usserExists=true;
            }
            if($_SESSION["ussername"]==$red["ussername"] && $_SESSION["password"]==$red["password"] && $red["role"]==2){
                $adminExists=true;
            }
        }
        
        
        echo " <footer> <ul>";
        foreach($rezultat as $red){
            if($red["name"]!="Admin panel")
                echo "<li><a href=".$red["location"].">".$red["name"]."</a></li>";


            if($adminExists && $red["name"]=="Admin panel"){
                echo "<li><a href=".$red["location"].">".$red["name"]."</a></li>";
                $adminExists=false;
            }
            if($usserExists){
                echo "<li><a href='contact.php'>Contact admin</a></li>";
                echo "<li><a href='upload.php'>Upload</a></li>";
                $usserExists=false;
            }
        }
        echo "</ul> ";
        echo"</footer>";

       
?>

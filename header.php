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
        
        
        echo " <header> <ul>
        <li><a href='index.php'><img src='resources/images/logo.png' id='logo'/></a></li>";
        foreach($rezultat as $red){
            if($red["name"]!="Admin panel")
                echo "<li><a href=".$red["location"].">".$red["name"]."</a></li>";

            if($adminExists && $red["name"]=="Admin panel"){
                echo "<li><a href=".$red["location"].">".$red["name"]."</a></li>";
                $adminExists=false;
            }
        }
        if($usserExists){
            echo "<li><a href='contact.php'>Contact admin</a></li>";
            echo "<li><a href='upload.php'>Upload</a></li>";
            $usserExists=false;
            }
        echo "</ul> <div class='controls'>";
        
        if
        (
            isset($_SESSION["ussername"]) 
            && 
            isset($_SESSION["password"]) 
            && ($_SESSION["ussername"]!="") 
            && ($_SESSION["password"]!="")
            ){

                echo "
                <i class='fa-solid fa-user'></i>
                <p>".$_SESSION["ussername"]."</p>
                <button id='signOut'>Sign out</button>";
                }
        else{
            echo "
                <button id='btnLogin'>Log In</button>
                <button id='btnRegister'>Register</button>
            ";
            }
        echo"<a href='resources/dokumentacija.pdf'>Documentation</a></div>
        </header>";

       
?>

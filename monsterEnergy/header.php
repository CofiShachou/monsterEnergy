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
        // session_start();
        $con=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
        $rezultat=$con->query("select * from header");

        $conUser=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
        $rezUser=$conUser->query("select u.ussername, u.password,u.role_id as role from ussers u join roles r on u.role_id = r.role_id");
        $exists=false;
        foreach($rezUser as $red){
            // echo $red["role"];
            if($_SESSION["ussername"]==$red["ussername"] && $_SESSION["password"]==$red["password"] && $red["role"]==2){
                    $exists=true;
                }
        }
        
        
        echo " <header> <ul>";
        foreach($rezultat as $red){
            if($red["name"]!="Admin panel")
                echo "<li><a href=".$red["location"].">".$red["name"]."</a></li>";


            if($exists && $red["name"]=="Admin panel"){
                echo "<li><a href=".$red["location"].">".$red["name"]."</a></li>";
                $exists=false;
            }
        }
        echo "</ul> ";
        
        if
        (
            isset($_SESSION["ussername"]) 
            && 
            isset($_SESSION["password"]) 
            && ($_SESSION["ussername"]!="") 
            && ($_SESSION["password"]!="")
            ){

                echo "<div class='controls'><p>".$_SESSION["ussername"]."</p><button id='signOut'>Sign out</button><div>";
                }
        else{
            echo "
            <div>
                <button id='btnLogin'>Log In</button>
                <button id='btnRegister'>Register</button>
            </div>
            ";
            }
        echo"</header>";

       
    ?>

    
   
            
        

    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
    <script src="resources/js/main.js"></script>
</body>
</html>


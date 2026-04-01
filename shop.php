<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>

    <?php
        session_start();
        $con=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
        if(isset($_SESSION["ussername"]) && isset($_SESSION["password"])){
            // require_once "header.php";
        }
        else{
            $_SESSION["ussername"]="";
            $_SESSION["password"]="";
            // require_once "header.php";  
        }
        if(isset($_POST["upload"])){
            $slika=$_FILES["uploadImage"];
            echo $slika["name"];
            echo "<br>";
            echo $slika["type"];
            $ext=pathinfo($slika["name"],PATHINFO_EXTENSION);
            $allowedExtentions=["png","jpg","jpeg"];
            if(in_array($ext,$allowedExtentions)){
                move_uploaded_file($slika["tmp_name"],"resources/images/".$slika["name"]);

                $insertImage=$con->prepare("insert into products ");
                // ........
            }
            else{
                echo "Mogu se uploadovati samo png jpg i jpeg slike";
            }
        }  
    ?>
    
    <div id="shop">
        <form id="filterForm" action="shop.php" method="get" >
            <div id="filters">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" 
                    <?php 
                    if(isset($_GET["reset"])){
                        $_GET["name"]="";
                    }
                    if(!isset($_GET["name"])){
                        $_GET["name"]="";
                    }
                    // var_dump($_SESSION["name"]);
                    $x='dsa';
                    if(isset($_SESSION["name"])){
                        echo "value='".$_GET["name"]."'";
                        // echo "value='".$x."'";
                    }
                    ?>
                    >
                    <button name="reset"><i class="fa-solid fa-xmark"></i></button>
                    <button name="search">Search</button>
                 </div>

                 <div>
                     <fieldset id="chategory" name="chategory">
                        <legend>Chategory:</legend>
                        <?php
                            
                            $rezultat=$con->query("select * from chategory");
                            $check="";
                            foreach($rezultat as $red){
                                // var_dump($_GET["chategory"]);
                                if(isset($_GET["chategory"]) && in_array($red["chategory_id"],$_GET["chategory"]))
                                {
                                    $check="checked";
                                }
                                else{
                                    $check="";
                                }
                                echo "
                                <div>
                                    <input 
                                    type='checkbox' 
                                    name='chategory[]' 
                                    id='".$red["chategory_id"]."' 
                                    value='".$red["chategory_id"]."' 
                                    class='checkBox' 
                                    $check>
                                    <label for='".$red["chategory_id"]."'>".$red["chategory_name"]."</label>
                                </div>
                                ";
                            }
                        ?>
                    </fieldset>
                </div>
            </div>
        </form>
        <form action="shop.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="uploadImage">Upload image:</label>
                <input type="file" name="uploadImage" id="uploadImage">
                <button name="upload" value="up">Upload</button>
            </div>
        </form>

         <div id="catalog">
            <div class="page">
                <?php
                    

                    if(isset($_GET["name"])){
                        $_SESSION["name"]=$_GET["name"];
                    }
                    else{
                        if(!isset($_SESSION["name"]))
                        $_SESSION["name"]="";
                    }
                    // var_dump($_SESSION["name"]);
                    if(isset($_SESSION["name"]) && $_SESSION["name"]!="" && isset($_GET["chategory"])){
                        // echo 'oba';
                        $ids = implode(",", $_GET["chategory"]);
                        $rezultat=$con->query("select * from products p join chategory c on p.chategory= c.chategory_id WHERE chategory IN ($ids) and product_name like '%".$_SESSION["name"]."%'");
                        foreach($rezultat as $red){
                            echo "
                                <div class='item'>
                                    <img src='resources/images/".$red["image"]."' alt=''>
                                    <p>".$red["product_name"]."</p>
                                    <p>".$red["chategory_name"]."</p>
                                </div>
                            ";
                        }
                    }
                    else if(isset($_SESSION["name"]) && $_SESSION["name"]!="" && !isset($_GET["chategory"])){
                        // echo "Samo ime";
                        $rezultat=$con->query("select * from products p join chategory c on p.chategory= c.chategory_id WHERE product_name like '%".$_SESSION["name"]."%'");
                        foreach($rezultat as $red){
                            echo "
                                <div class='item'>
                                    <img src='resources/images/".$red["image"]."' alt=''>
                                    <p>".$red["product_name"]."</p>
                                    <p>".$red["chategory_name"]."</p>
                                </div>
                            ";
                        }
                    }
                    else if(isset($_GET["chategory"]) && $_SESSION["name"]==""){
                        // echo "Samo categorija";
                        $ids = implode(",", $_GET["chategory"]);
                        $rezultat=$con->query("select * from products p join chategory c on p.chategory= c.chategory_id WHERE chategory IN ($ids)");
                        foreach($rezultat as $red){
                            echo "
                                <div class='item'>
                                    <img src='resources/images/".$red["image"]."' alt=''>
                                    <p>".$red["product_name"]."</p>
                                    <p>".$red["chategory_name"]."</p>
                                </div>
                            ";
                        }
                    }
                    else{
                        // echo "nista";
                        $rezultat=$con->query("select * from products p join chategory c on p.chategory= c.chategory_id");
                        foreach($rezultat as $red){
                            echo "
                                <div class='item'>
                                    <img src='resources/images/".$red["image"]."' alt=''>
                                    <p>".$red["product_name"]."</p>
                                    <p>".$red["chategory_name"]."</p>
                                </div>
                            ";
                        }
                    }
                ?>
                

            </div>
    </div>
</div>
    

    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
    <script src="resources/js/main.js"></script>
</body>
</html>


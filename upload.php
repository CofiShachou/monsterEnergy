<?php
        session_start();
        if(!isset($_SESSION["ussername"]) || $_SESSION["ussername"]==""){
        header("location: index.php");
        }
        $con=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");

        if(isset($_POST["upload"])){
            $slika=$_FILES["uploadImage"];
            $ext=pathinfo($slika["name"],PATHINFO_EXTENSION);
            $allowedExtentions=["png","jpg","jpeg"];

            if(in_array($ext,$allowedExtentions)){
                move_uploaded_file($slika["tmp_name"],"resources/images/".$slika["name"]);

                $insertImage=$con->prepare("insert into products (product_name,price,chategory,image,description) values (:product_name,:price,:chategory,:image,:description)");
                $product_name="Usser uploaded picture";
                $price=200;
                $chategory=4;
                $description="This product was uploaded by a usser.";

                $insertImage->bindParam(":product_name",$product_name);
                $insertImage->bindParam(":price",$price);
                $insertImage->bindParam(":chategory",$chategory);
                $insertImage->bindParam(":image",$slika["name"]);
                $insertImage->bindParam(":description",$description);

                $insertImage->execute();
                echo "Product uploaded!";
                exit();
            }
            else{
                echo "You can upload only .jpg .png and .jpeg images!";
                exit();
            }
        }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Your Product | Monster Energy</title>

<meta name="description" content="Upload your own Monster Energy product to the website. Share your favorite flavors, custom images, and be part of the Monster Energy community.">

<meta name="keywords" content="Monster Energy upload, add product, user uploaded products, Monster flavors, Monster Energy community">

<meta name="robots" content="index, follow">

<link rel="icon" type="image/png" href="resources/images/logo.png">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>
    <?php
        $con=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
        if(isset($_SESSION["ussername"]) && isset($_SESSION["password"])){
            require_once "header.php";
        }
        else{
            $_SESSION["ussername"]="";
            $_SESSION["password"]="";
            require_once "header.php";  
        }
    ?>
    
    <!-- action="upload.php" method="POST" -->
    <form  enctype="multipart/form-data" id="formUpload">
        <div>
            <label for="uploadImage">Here you can upload your own products to the website:</label>
            <input type="file" name="uploadImage" id="uploadImage">
            <button name="upload" value="up" id="upload">Upload</button>
            <p id="greskaUpload"></p>
        </div>
    </form>
        
    <div id="exampleWrap">
        <h3>Examples</h3>
        <div id="exampleItems">
            <div class="example"><img src="resources/images/sunrise.png" alt="monster energy"></div>
            <div class="example"><img src="resources/images/violet.png" alt="monster energy"></div>
            <div class="example"><img src="resources/images/badApple.png" alt="monster energy"></div>
            <div class="example"><img src="resources/images/mangoLoco.png" alt="monster energy"></div>
            <div class="example"><img src="resources/images/wildPassion.png" alt="monster energy"></div>
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


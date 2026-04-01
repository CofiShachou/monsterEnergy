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
        $con=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
        if(isset($_SESSION["ussername"]) && isset($_SESSION["password"])){
            require_once "header.php";
        }
        else{
            $_SESSION["ussername"]="";
            $_SESSION["password"]="";
            require_once "header.php";  
        }
        echo "dsadasdsa";
        var_dump($_POST["upload"]);
         if(isset($_POST["upload"])){
            $slika=$_FILES["uploadImage"];
            echo $slika["name"];
            echo "<br>";
            echo $slika["type"];
            $ext=pathinfo($slika["name"],PATHINFO_EXTENSION);
            $allowedExtentions=["png","jpg","jpeg"];

            $_SESSION["succes"]=false;
            if(in_array($ext,$allowedExtentions)){
                $_SESSION["message"]="Uspesno uploadovan proizvod";
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
                // $_SESSION["succes"]=true;
            }
            else{
                // $_SESSION["message"]="Mogu se uploadovati samo png jpg i jpeg slike";
            }
            
        }        
    ?>
    <p id="greskaUpload"></p>
    <!-- action="upload.php" method="POST"  -->
    <form enctype="multipart/form-data" id="formUpload">
        <div>
            <label for="uploadImage">Here you can upload your own products to the website:</label>
            <input type="file" name="uploadImage" id="uploadImage">
            <button name="upload" value="up">Upload</button>
        </div>
    </form>


    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
    <script src="resources/js/main.js"></script>
</body>
</html>


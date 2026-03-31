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
        if(isset($_SESSION["ussername"]) && isset($_SESSION["password"])){
            require_once "header.php";
        }
        else{
            $_SESSION["ussername"]="";
            $_SESSION["password"]="";
            require_once "header.php";  
        }
    ?>
    
    <div id="shop">
        <form>
            <div id="filters">
                <div>
                    <label for="">Name:</label>
                     <input type="text" name="" id="">
                 </div>

                 <div>
                     <fieldset id="chategory" name="chategory">
                        <legend>Chategory:</legend>
                        <div>
                        <label for="">Monster 1</label>
                        <input type="checkbox" name="" id="">
                        </div>
                        <div>
                        <label for="">Monster 1</label>
                        <input type="checkbox" name="" id="">
                        </div>
                        <div>
                        <label for="">Monster 1</label>
                        <input type="checkbox" name="" id="">
                        </div>
                    </fieldset>
                    <!-- <select name="" id="">
                        <option value="">Nesto</option>
                        <option value="">Nesto</option>
                        <option value="">Nesto</option>
                    </select> -->
                 </div>
            </div>
          </form>

         <div id="catalog">
            <div class="page">
                <?php
                    $con=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
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


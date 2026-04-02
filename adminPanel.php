<?php
    
?>
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
            $rezultat=$con->query("select * from ussers");
            $exists=false;
            foreach($rezultat as $red){
            // var_dump($red["ussername"]);
                if($_SESSION["ussername"]==$red["ussername"] && $_SESSION["password"]==$red["password"] && $red["role_id"]==2){
                $exists=true;
                }
            }
            if($exists){
                require_once "header.php";
                $exists=false;
            }
            else{
                header("location: index.php");
            }
            
            function deleteItem($table,$idToDel,$id){
                global $con;
                $deleteProduct=$con->prepare("delete from $table where $idToDel = :id");
                $deleteProduct->bindParam(":id",$id);
                $deleteProduct->execute();
                echo "Uspesno obrisan proizvod";
            }
            
            if(isset($_GET["product_id_delete"])){
                deleteItem("products","product_id",$_GET["product_id_delete"]);
            }
            if(isset($_GET["header_id_delete"])){
                deleteItem("header","id",$_GET["header_id_delete"]);
            }
            if(isset($_GET["chategory_id_delete"])){
                deleteItem("chategory","chategory_id",$_GET["chategory_id_delete"]);
            }
            if(isset($_GET["usser_id_delete"])){
                deleteItem("ussers","usser_id",$_GET["usser_id_delete"]);
            }
            if(isset($_GET["message_id_delete"])){
                deleteItem("messages","message_id",$_GET["message_id_delete"]);
            }



            if(isset($_GET["product_id_update"])){
                // var_dump("DSAHDSDAS");
                $getProduct=$con->prepare("select * from products where product_id = :id");
                $getProduct->bindParam(":id",$_GET["product_id_update"]);
                $getProduct->execute();
                echo "<form action='adminPanel.php' method='GET' id='update'>";
                foreach($getProduct as $red){
                    // var_dump($getProduct);
                    echo "
                    <input type='hidden' name='id' value='".$red["product_id"]."'/>
                    <div>
                        <label>Name: </label>
                        <input type='text' name='newProductName' value='".$red["product_name"]."'/>
                    </div>

                    <div>
                        <label>Price: </label>
                        <input type='text' name='newProductPrice' value='".$red["price"]."'/>
                    </div>

                    <div>
                        <label>Chategory: </label>
                        <input type='text' name='newProductChategory' value='".$red["chategory"]."'/>
                    </div>

                    <div>
                        <label>Description: </label>
                        <input type='text' name='newProductDescription' value='".$red["description"]."'/>
                    </div>

                    <div>
                        <button id='updateProduct' name='updateProduct' value='click'>Update</button>
                        <button id='cancle' name='cancle' value='click' >Cancle</button>
                    </div>
                    ";

                }
                echo "</form>";
            }

            if(isset($_GET["updateProduct"])){
                $updateProduct=$con->prepare("update products set product_name=:name,price=:price,chategory=:chategory,description=:description where product_id = :id");
                $updateProduct->bindParam(":name",$_GET["newProductName"]);
                $updateProduct->bindParam(":price",$_GET["newProductPrice"]);
                $updateProduct->bindParam(":chategory",$_GET["newProductChategory"]);
                $updateProduct->bindParam("description",$_GET["newProductDescription"]);
                $updateProduct->bindParam(":id",$_GET["id"]);
                $updateProduct->execute();
                echo "Uspesno updateovan proizvod";
            }

        ?>
            <div id="tables">
            <?php   



            $tableProducts=["Delete","Update","product_id","product_name","price","chategory","image","description"];


            $productsSelect=$con->query("select p.product_id, p.product_name,p.price,p.chategory,p.image,p.description,c.chategory_id,c.chategory_name from products p join chategory c on chategory=chategory_id");
            echo "<div id='adminTableProducts'>";
            foreach($tableProducts as $tableRow){
                echo "<div>".$tableRow."</div>";
            }
            foreach($productsSelect as $red){
                echo "<div><a href='adminPanel.php?product_id_delete=".$red["product_id"]."'><i class='fa-solid fa-xmark'></i></a></div>";
                echo "<div><a href='adminPanel.php?product_id_update=".$red["product_id"]."'><i class='fa-solid fa-pen'></i></a></div>";
                echo "<div><p>".$red["product_id"]."</p></div>";
                echo "<div><p>".$red["product_name"]."</p></div>";
                echo "<div><p>".$red["price"]."</p></div>";
                echo "<div><p>".$red["chategory"]."</p></div>";
                echo "<div><img class='tableImage' src='resources/images/".$red["image"]."'/></div>";
                echo "<div><p>".$red["description"]."</p></div>";
                
                
            }
            echo "</div>";


            $tableHeader=["Delete","Update","id","name","location"];

            $headerSelect=$con->query("select * from header");
            echo "<div id='adminTableHeader'>";
            foreach($tableHeader as $tableRow){
                echo "<div>".$tableRow."</div>";
            }
            foreach($headerSelect as $red){
                echo "<div><a href='adminPanel.php?header_id_delete=".$red["id"]."'><i class='fa-solid fa-xmark'></i></a></div>";
                echo "<div><a href='adminPanel.php?header_id_delete=".$red["id"]."'><i class='fa-solid fa-pen'></i></a></div>";
                echo "<div>".$red["id"]."</div>";
                echo "<div>".$red["name"]."</div>";
                echo "<div>".$red["location"]."</div>"; 
            }
            echo "</div>";


            $tableChategory=["Delete","Update","chategory_id","chategory_name"];

            $chategorySelect=$con->query("select * from chategory");
            echo "<div id='adminTableChategory'>";
            foreach($tableChategory as $tableRow){
                echo "<div>".$tableRow."</div>";
            }
            foreach($chategorySelect as $red){
                echo "<div><a href='adminPanel.php?chategory_id_delete=".$red["chategory_id"]."'><i class='fa-solid fa-xmark'></i></a></div>";
                echo "<div><a href='adminPanel.php?chategory_id_delete=".$red["chategory_id"]."'><i class='fa-solid fa-pen'></i></a></div>";
                echo "<div>".$red["chategory_id"]."</div>";
                echo "<div>".$red["chategory_name"]."</div>";
            }
            echo "</div>";


            $tableUssers=["Delete","Update","usser_id","ussername","password","email","role_id"];


            $usserSelect=$con->query("select * from ussers");
            echo "<div id='adminTableUssers'>";
            foreach($tableUssers as $tableRow){
                echo "<div>".$tableRow."</div>";
            }
            foreach($usserSelect as $red){
                echo "<div><a href='adminPanel.php?usser_id_delete=".$red["usser_id"]."'><i class='fa-solid fa-xmark'></i></a></div>";
                echo "<div><a href='adminPanel.php?usser_id_delete=".$red["usser_id"]."'><i class='fa-solid fa-pen'></i></a></div>";
                echo "<div>".$red["usser_id"]."</div>";
                echo "<div>".$red["ussername"]."</div>";
                echo "<div>".$red["password"]."</div>";
                echo "<div>".$red["email"]."</div>";
                echo "<div>".$red["role_id"]."</div>";
            }
            echo "</div>";



            $tableMessages=["Delete","Update","message_id","admin_id","usser_id","title","message"];


            $messageSelect=$con->query("select * from messages");
            echo "<div id='adminTableUssers'>";
            foreach($tableMessages as $tableRow){
                echo "<div>".$tableRow."</div>";
            }
            foreach($messageSelect as $red){
                echo "<div><a href='adminPanel.php?message_id_delete=".$red["message_id"]."'><i class='fa-solid fa-xmark'></i></a></div>";
                echo "<div><a href='adminPanel.php?message_id_delete=".$red["message_id"]."'><i class='fa-solid fa-pen'></i></a></div>";
                echo "<div>".$red["message_id"]."</div>";
                echo "<div>".$red["admin_id"]."</div>";
                echo "<div>".$red["usser_id"]."</div>";
                echo "<div>".$red["title"]."</div>";
                echo "<div>".$red["message"]."</div>";
            }
            echo "</div>";
            
        ?>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
    crossorigin="anonymous"></script>
    <script src="resources/js/main.js"></script>
</body>
</html>


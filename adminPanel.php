<?php
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <meta name="description" content="Monster Energy admin panel. Manage products, users, categories, messages, and website content through the administration dashboard.">

<meta name="keywords" content="admin panel, Monster Energy admin, manage products, manage users, product management, website administration, CMS dashboard">

<link rel="icon" type="image/png" href="resources/images/logo.png">
    
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

            echo "<form action='adminPanel.php' method='GET' id='tableChose'>
                <h2>Chose the table to modify</h2>
                <div>
                    <button name='showTable' id='usser' value='usser'>Ussers</button>
                    <button name='showTable' id='prduct' value='product'>Products</button>
                    <button name='showTable' id='header' value='header'>Header</button>
                    <button name='showTable' id='chat' value='chat'>Chategoryes</button>
                    <button name='showTable' id='message' value='message'>Messages</button>
                </div>
            </form>";





            
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




            if(isset($_GET["header_id_update"])){
                // var_dump("DSAHDSDAS");
                $getHeader=$con->prepare("select * from header where id = :id");
                $getHeader->bindParam(":id",$_GET["header_id_update"]);
                $getHeader->execute();
                echo "<form action='adminPanel.php' method='GET' id='update'>";
                foreach($getHeader as $red){
                    // var_dump($getProduct);
                    echo "
                    <input type='hidden' name='id' value='".$red["id"]."'/>
                    <div>
                        <label>Name: </label>
                        <input type='text' name='newHeaderName' value='".$red["name"]."'/>
                    </div>

                    <div>
                        <label>Location: </label>
                        <input type='text' name='newHeaderLocation' value='".$red["location"]."'/>
                    </div>
                    <div>
                        <button id='updateProduct' name='updateHeader' value='click'>Update</button>
                        <button id='cancle' name='cancle' value='click' >Cancle</button>
                    </div>
                    ";

                }
                echo "</form>";
            }


            if(isset($_GET["updateHeader"])){
                $updateHeader=$con->prepare("update header set name=:name,location=:location where id= :id");
                $updateHeader->bindParam(":name",$_GET["newHeaderName"]);
                $updateHeader->bindParam(":location",$_GET["newHeaderLocation"]);
                $updateHeader->bindParam(":id",$_GET["id"]);
                $updateHeader->execute();
                echo "Uspesno updateovan header";
            }



            if(isset($_GET["chategory_id_update"])){
                // var_dump("DSAHDSDAS");
                $getChategory=$con->prepare("select * from chategory where chategory_id = :id");
                $getChategory->bindParam(":id",$_GET["chategory_id_update"]);
                $getChategory->execute();
                echo "<form action='adminPanel.php' method='GET' id='update'>";
                foreach($getChategory as $red){
                    // var_dump($getProduct);
                    echo "
                    <input type='hidden' name='id' value='".$red["chategory_id"]."'/>
                    <div>
                        <label>Name: </label>
                        <input type='text' name='newChategoryName' value='".$red["chategory_name"]."'/>
                    </div>
                    <div>
                        <button id='updateProduct' name='updateChategory' value='click'>Update</button>
                        <button id='cancle' name='cancle' value='click' >Cancle</button>
                    </div>
                    ";

                }
                echo "</form>";
            }

            if(isset($_GET["updateChategory"])){
                $updateChategory=$con->prepare("update chategory set chategory_name=:name where chategory_id = :id");
                $updateChategory->bindParam(":name",$_GET["newChategoryName"]);
                $updateChategory->bindParam(":id",$_GET["id"]);
                $updateChategory->execute();
                echo "Uspesno updateovana kategorija";
            }



            if(isset($_GET["usser_id_update"])){
                // var_dump("DSAHDSDAS");
                $getUsser=$con->prepare("select * from ussers where usser_id = :id");
                $getUsser->bindParam(":id",$_GET["usser_id_update"]);
                $getUsser->execute();
                echo "<form action='adminPanel.php' method='GET' id='update'>";
                foreach($getUsser as $red){
                    // var_dump($getProduct);
                    echo "
                    <input type='hidden' name='id' value='".$red["usser_id"]."'/>
                    <div>
                        <label>Name: </label>
                        <input type='text' name='newUsserName' value='".$red["ussername"]."'/>
                    </div>

                    <div>
                        <label>Password: </label>
                        <input type='text' name='newPassword' value='".$red["password"]."'/>
                    </div>

                    <div>
                        <label>Email: </label>
                        <input type='text' name='newEmail' value='".$red["email"]."'/>
                    </div>

                    <div>
                        <label>Role id: </label>
                        <input type='text' name='newRoleId' value='".$red["role_id"]."'/>
                    </div>

                    <div>
                        <button id='updateProduct' name='updateUsser' value='click'>Update</button>
                        <button id='cancle' name='cancle' value='click' >Cancle</button>
                    </div>
                    ";

                }
                echo "</form>";
            }

            if(isset($_GET["updateUsser"])){
                $updateUsser=$con->prepare("update ussers set ussername=:name,password=:password,email=:email,role_id=:role where usser_id = :id");
                $updateUsser->bindParam(":name",$_GET["newUsserName"]);
                $updateUsser->bindParam(":password",$_GET["newPassword"]);
                $updateUsser->bindParam(":email",$_GET["newEmail"]);
                $updateUsser->bindParam("role",$_GET["newRoleId"]);
                $updateUsser->bindParam(":id",$_GET["id"]);
                $updateUsser->execute();
                echo "Uspesno updateovan korisnik";
            }


            if(isset($_GET["message_id_update"])){
                // var_dump("DSAHDSDAS");
                $getMessage=$con->prepare("select * from messages where message_id = :id");
                $getMessage->bindParam(":id",$_GET["message_id_update"]);
                $getMessage->execute();
                echo "<form action='adminPanel.php' method='GET' id='update'>";
                foreach($getMessage as $red){
                    // var_dump($getProduct);
                    echo "
                    <input type='hidden' name='id' value='".$red["message_id"]."'/>
                    <div>
                        <label>Title: </label>
                        <input type='text' name='newTitle' value='".$red["title"]."'/>
                    </div>
                    <div>
                        <label>Message: </label>
                        <input type='text' name='newMessage' value='".$red["message"]."'/>
                    </div>

                    <div>
                        <button id='updateProduct' name='updateMessage' value='click'>Update</button>
                        <button id='cancle' name='cancle' value='click' >Cancle</button>
                    </div>
                    ";

                }
                echo "</form>";
            }

            if(isset($_GET["updateMessage"])){
                $updateMessage=$con->prepare("update message set title=:title,message=:message where message_id = :id");
                $updateMessage->bindParam(":title",$_GET["newTitle"]);
                $updateMessage->bindParam(":message",$_GET["newMessage"]);
                $updateMessage->bindParam(":id",$_GET["id"]);
                $updateMessage->execute();
                echo "Uspesno updateovana poruka";
            }

        ?>
            <div id="tables">



            <?php   

            if(!isset($_GET["showTable"])){
                $_GET["showTable"]="product";
            }


            if($_GET["showTable"]=="product"){
                $tableProducts=["Delete","Update","product_id","product_name","price","chategory","image","description"];


                $productsSelect=$con->query("select p.product_id, p.product_name,p.price,p.chategory,p.image,p.description,c.chategory_id,c.chategory_name from products p join chategory c on chategory=chategory_id");
                echo "<h2>Products</h2>";
                echo "<div id='adminTableProducts'>";
                foreach($tableProducts as $tableRow){
                    echo "<div><h3>".$tableRow."</h3></div>";
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
            }


            if($_GET["showTable"]=="header"){
                $tableHeader=["Delete","Update","id","name","location"];

                $headerSelect=$con->query("select * from header");
                echo "<h2>Header</h2>";
                echo "<div id='adminTableHeader'>";
                foreach($tableHeader as $tableRow){
                    echo "<div><h3>".$tableRow."</h3></div>";
                }
                foreach($headerSelect as $red){
                    echo "<div><a href='adminPanel.php?header_id_delete=".$red["id"]."'><i class='fa-solid fa-xmark'></i></a></div>";
                    echo "<div><a href='adminPanel.php?header_id_update=".$red["id"]."'><i class='fa-solid fa-pen'></i></a></div>";
                    echo "<div><p>".$red["id"]."</p></div>";
                    echo "<div><p>".$red["name"]."</p></div>";
                    echo "<div><p>".$red["location"]."</p></div>"; 
                }
                echo "</div>";
            }

            if($_GET["showTable"]=="chat"){
                $tableChategory=["Delete","Update","chategory_id","chategory_name"];

                $chategorySelect=$con->query("select * from chategory");
                echo "<h2>Chategory</h2>";
                echo "<div id='adminTableChategory'>";
                foreach($tableChategory as $tableRow){
                    echo "<div><h3>".$tableRow."</h3></div>";
                }
                foreach($chategorySelect as $red){
                    echo "<div><a href='adminPanel.php?chategory_id_delete=".$red["chategory_id"]."'><i class='fa-solid fa-xmark'></i></a></div>";
                    echo "<div><a href='adminPanel.php?chategory_id_update=".$red["chategory_id"]."'><i class='fa-solid fa-pen'></i></a></div>";
                    echo "<div><p>".$red["chategory_id"]."</p></div>";
                    echo "<div><p>".$red["chategory_name"]."</p></div>";
                }
                echo "</div>";
            }


            if($_GET["showTable"]=="usser"){
                $tableUssers=["Delete","Update","usser_id","ussername","password","email","role_id"];

                $usserSelect=$con->query("select * from ussers");
                echo "<h2>Ussers</h2>";
                echo "<div id='adminTableUssers'>";
                foreach($tableUssers as $tableRow){
                    echo "<div><h3>".$tableRow."</h3></div>";
                }
                foreach($usserSelect as $red){
                    echo "<div><a href='adminPanel.php?usser_id_delete=".$red["usser_id"]."'><i class='fa-solid fa-xmark'></i></a></div>";
                    echo "<div><a href='adminPanel.php?usser_id_update=".$red["usser_id"]."'><i class='fa-solid fa-pen'></i></a></div>";
                    echo "<div><p>".$red["usser_id"]."</p></div>";
                    echo "<div><p>".$red["ussername"]."</p></div>";
                    echo "<div><p>".$red["password"]."</p></div>";
                    echo "<div><p>".$red["email"]."</p></div>";
                    echo "<div><p>".$red["role_id"]."</p></div>";
                }
                echo "</div>";
            }



            if($_GET["showTable"]=="message"){
                $tableMessages=["Delete","Update","message_id","admin_id","usser_id","title","message"];

                $messageSelect=$con->query("select * from messages");
                echo "<h2>Messages</h2>";
                echo "<div id='adminTableUssers'>";
                foreach($tableMessages as $tableRow){
                    echo "<div><h3>".$tableRow."</h3></div>";
                }
                foreach($messageSelect as $red){
                    echo "<div><a href='adminPanel.php?message_id_delete=".$red["message_id"]."'><i class='fa-solid fa-xmark'></i></a></div>";
                    echo "<div><a href='adminPanel.php?message_id_update=".$red["message_id"]."'><i class='fa-solid fa-pen'></i></a></div>";
                    echo "<div><p>".$red["message_id"]."</p></div>";
                    echo "<div><p>".$red["admin_id"]."</p></div>";
                    echo "<div><p>".$red["usser_id"]."</p></div>";
                    echo "<div><p>".$red["title"]."</p></div>";
                    echo "<div><p>".$red["message"]."</p></div>";
                }
                echo "</div>";
            }
        ?>
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


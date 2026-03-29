<?php
session_start();


$con=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");
// $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if(isset($_GET["ussername"]) && isset($_GET["password"])){
    $ussername=$_GET["ussername"];
    $password=$_GET["password"];
}else{
    $ussername=$_SESSION["ussername"];
    $password=$_SESSION["password"];
}

$rezultat=$con->query("select * from ussers");
foreach($rezultat as $red){
    echo $ussername;
    echo $password;
    if($red["ussername"]==$ussername && $red["password"]==$password){
        $_SESSION["ussername"]=$ussername;
        $_SESSION["password"]=$password;
    }
}
if(isset($_GET["reset"])){
    $_SESSION["ussername"]="";
    $_SESSION["password"]="";
    
    var_dump($_SESSION["ussername"]);
}

?>
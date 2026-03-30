<?php
session_start();


$con=new PDO("mysql:host=localhost;dbname=monsterenergy","root","");

$ussernameRegEx="/^[A-z0-9]{3,20}$/";
$passwordRegEx="/^.{3,10}$/";


if(isset($_POST["ussername"]) && isset($_POST["password"])){
    $ussername=$_POST["ussername"];
    $password=$_POST["password"];
    if(preg_match($ussername,$_POST["ussername"]) && preg_match($ussername,$_POST["password"])){
    }
}else{
    $ussername=$_SESSION["ussername"];
    $password=$_SESSION["password"];
}
if($_POST["type"]=="login"){
    $rezultat=$con->query("select * from ussers");
    foreach($rezultat as $red){
        echo $ussername;
        echo $password;
        if($red["ussername"]==$ussername && $red["password"]==$password){
            $_SESSION["ussername"]=$ussername;
            $_SESSION["password"]=$password;
        }
    }
}
else if($_POST["type"]=="register"){
    $email=$_POST["email"];
    $roleId=1;

    $select=$con->query("select * from ussers");
    $exists=false;
    foreach($select as $red){
        if($red["ussername"]==$ussername && $red["password"]==$password){
            $exists=true;
        }
    }
    if(!$exists){
        $upit=$con->prepare("insert into ussers (ussername,password,email,role_id) values (:ussername,:password,:email,:roleId)");
        $upit->bindParam(":ussername",$ussername);
        $upit->bindParam(":password",$password);
        $upit->bindParam(":email",$email);
        $upit->bindParam(":roleId",$roleId);
        $upit->execute();
        $_SESSION["ussername"]=$ussername;
        $_SESSION["password"]=$password;
        echo "registrovano";
    }
    else{
        echo "nije registrovano";
    }
    $exists= false;
}


if(isset($_GET["reset"])){
    $_SESSION["ussername"]="";
    $_SESSION["password"]="";
    
    var_dump($_SESSION["ussername"]);
}

?>
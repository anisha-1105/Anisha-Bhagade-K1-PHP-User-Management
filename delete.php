<?php
include "db.php";
if(isset($_GET["p_id"])){
    $p_id=$_GET["p_id"];
    $sql=$conn->prepare("delete from products where p_id=? ");
     $sql->bind_param( "i", $p_id );
    if($sql->execute()){
        header("Location:home.php");
    }
}
?>




<?php
include "connection.php";
session_start();
  $query="INSERT INTO commande(id_client,date_commande) VALUES({$_SESSION['client']},now());";
    $result=mysqli_query($connection,$query);

 
        $id_com=mysqli_insert_id($connection);
    
    




foreach($_SESSION['shop'] as $cle => $val)
{
   
     $query="INSERT INTO concerner(poduit_id,id_commande,quantite_produit) VALUES({$val['item_id']},{$id_com},{$val['item_quantite']});";
    $result=mysqli_query($connection,$query);

    }
unset($_SESSION['util']);

header("location:acceil.php");



?>

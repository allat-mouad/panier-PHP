<?php

$connection=mysqli_connect("localhost","root","","shop");
if(!$connection)
{
    die("erreur ".mysqli_connect_error());
}

?>
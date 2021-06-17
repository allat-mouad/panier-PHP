<?php
include "connection.php";
if(!$connection)
{
    die("erreur ".mysqli_connect_error());
}
if(isset($_POST["submit"])){
    copy($_FILES['jsonfile']['tmp_name'],'jsonFiles/'.$_FILES['jsonfile']['name']);
    $data =file_get_contents('jsonFiles/'.$_FILES['jsonfile']['name']);
    $products=json_decode($data);
    
 /*   foreach($products as $product)
    {
        $query="INSERT INTO products VALUES('$product->sku','$product->name','$product->description','$product->price','$product->image')";
        
        $result=mysqli_query($connection,$query);

    
}*/
    
        foreach($products as $product)
    {
        
                foreach($product->category as $cat)
                {
                    
                    $categ=$cat->id
                }
    
             $query="INSERT INTO categories VALUES('$cat->id','$cat->name') SELECT cat_id FROM  categories 
 WHERE NOT EXISTS (SELECT cat_id FROM categories WHERE categories.cat_id =$cat->id)";
        
        $result=mysqli_query($connection,$query);

       

    
}
}
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <title>Document</title>
</head>
<body>
  
    
<form method="post" enctype="multipart/form-data">

Json file <input type="file" name="jsonfile"><br>
<input type="submit" value="import" name="submit">
</form>
    
</body>
</html>
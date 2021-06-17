<?php 
$connection=mysqli_connect("localhost","root","","shop");
session_start();  


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   

<?php
if(isset($_POST['submit']))
{
   if(isset($_SESSION['shop']))
{       
       
    $tab_item_id=array_column($_SESSION['shop'],'item_id');
       if(!in_array($_GET['id'],$tab_item_id))
       {
//           $count=count($_SESSION['shop']);
            $tab_item=array(
        'item_id'=>$_GET['id'],
            'item_name'=>$_POST['hidden_name'],
            'item_price'=>$_POST['hidden_price'],
            'item_quantite'=>$_POST['quantite']
            );
            $_SESSION['shop'][]=$tab_item;
           
       }
       else
       {
           echo "<script>atert('item already added'); window.location='acceil.php';</script>";
       }
}
 
    else
    {
        $tab_item=array(
        'item_id'=>$_GET['id'],
            'item_name'=>$_POST['hidden_name'],
            'item_price'=>$_POST['hidden_price'],
            'item_quantite'=>$_POST['quantite']
            );
        $_SESSION['shop'][0]=$tab_item;
        
    }
    
}

if(isset($_GET['action']))
{
    if($_GET['action']=='delete')
    {
        foreach($_SESSION['shop'] as $key =>$value)
        {
            if($value['item_id'] == $_GET['id'])
            {
                unset($_SESSION['shop'][$key]);
                echo "<script>alert('item removed'); window.location='acceil.php';</script>";
            }
            
            
            
        }
    }
}
?>





<?php

// define how many results you want per page
$results_per_page = 9;

// find out the number of results stored in database
$sql='SELECT * FROM products';
$result = mysqli_query($connection, $sql);
$number_of_results = mysqli_num_rows($result);

// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);

// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;

// retrieve selected results from database and display them on page
?>


<div class="container">
			<h3 align="center">WELCOME </h3>
              <?php
            $query="SELECT * FROM products LIMIT "  . $this_page_first_result . ',' .  $results_per_page;
            $result=mysqli_query($connection,$query);
            $count=mysqli_num_rows($result);
            if($count==0)
            {
                echo "<h3>no result</h3>";
            }
            else {
                while($row=mysqli_fetch_assoc($result))
                {
                    
          
            ?>
    
               <div class="col-md-4">
                   <form action="acceil.php?action=add&id=<?php echo $row['sku']; ?>" method="post">
                     <div style="border: 1px solid #333; background-color:#f1f1f1; border-radius:5px;padding:16px; " align="center">
                        
                       <img src="<?php echo $row["image"]; ?>" width="300" height="300px" /><br />
                      <h4 class="text-info"><?php echo $row['name']; ?></h4>
                      <h4 class="text-danger">$<?php echo $row['price']; ?></h4>
                      <input type="text" name="quantite" value="1" class="form-control">
                      <input type="hidden" name="hidden_name" value="<?php echo $row['name']; ?>">
                      <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>">
                      <input type="submit" style="margin-top:5px;" name="submit" class="btn  btn-info" value="add to card">
                      
                       </div>
                   </form>
               </div>
               <?php
                      
                  }
            }
            ?>
            <div style="clear:both">  </div>
            <br>
            <h3>order details</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="40%">item name</th>
                        <th width="10%">quantite</th>
                        <th width="20%">price</th>
                        <th width="15%">total</th>
                        <th width="5%">action</th>
                    </tr>
                    <?php
                    if(!empty($_SESSION['shop']))
                    {
                        $total=0;
                        foreach($_SESSION['shop'] as $key =>$value)
                        {
                            ?>
            
                            <tr>
                                <td><?php echo $value['item_name']; ?></td>
                                <td><?php echo $value['item_quantite']; ?></td>
                                <td>$<?php echo $value['item_price']; ?></td>
                                <td><?php echo number_format($value['item_price']*$value['item_quantite'],2); ?></td>
                                <td><a href="acceil.php?action=delete&id=<?php echo $value['item_id']; ?>">delete</a></td>
                            </tr>
                            <?php
                            $total=$total+($value['item_price']*$value['item_quantite']);
                    
                            
                            
                    ?>
                           
                            <?php
                        }
                        ?>
                         <tr>
                                <td colspan="3" align="right">Total</td>
                                 <td align="right">$<?php echo number_format($total,2); ?></td>
                           
                                                      
                            
                            </tr>
                       <tr>
                                
                                 <td colspan="3"  align="center">click here to Order now <a href="enregistrer.php">Order</a></td>
                           
                                                      
                            
                            </tr>
                       <?php 
                    }
                    
                    ?>
                    
                </table>
            </div>
            
            
            
             </div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <?php


// display the links to the pages
for ($page=1;$page<=3;$page++) {
    
  echo '<li class="page-item"><a class="page-link" href="acceil.php?page=' . $page . '">' . $page . '</a></li> ';
}

?>
    
    <li class="page-item">
      <a class="page-link" href="acceil.php?page=<?php echo $page+1 ?>">Next</a>
    </li>
  </ul>
</nav>














   





<?php 
include "connection.php";
session_start();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


   <?php
if(isset($_POST['submit']))
{
function testinput($t)
{
    $t=trim($t);
    $t=htmlspecialchars($t);
    $t=stripslashes($t);
    return $t;
    
}    
    
    
    if(!empty($_POST['username']) &&  !empty($_POST['password']) && !empty($_POST['firstname']) )
    {

        $query0="SELECT * FROM clients WHERE client_username='{$_POST['username']}' AND client_password='{$_POST['password']}'";
         $result0=mysqli_query($connection,$query0);
        $count=mysqli_num_rows($result0);
        if($count==0)
        {
        $username=mysqli_real_escape_string($connection,$_POST['username']);
        $firstname=mysqli_real_escape_string($connection,$_POST['firstname']);
        $password=mysqli_real_escape_string($connection,$_POST['password']);
        
                
        $query="INSERT INTO clients(client_username,client_name,client_password) VALUES('{$username}','{$firstname}','{$password}')";
         $result=mysqli_query($connection,$query);
    
             
        if(!$result)
        {
            die("erreur".mysqli_error($connection));
        }
              $last_id = mysqli_insert_id($connection);

                   $_SESSION['client']=$last_id;

                            header('location:acceil.php');

                
                
        
        }
        else
        {
             while($row0=mysqli_fetch_assoc($result0))
    { 
        $id_com=$row0['client_id'];
    }
              $_SESSION['client']=$id_com;

                            header('location:acceil.php');

            
        }
        
        
        
     
        
    }
    
}



?>
   
   
               
   
   

    <!-- Page Content -->
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off" >
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username"  class="form-control" placeholder="Enter Desired Username">
                        </div>
                       
                    
                              <div class="form-group">
                            <label for="firstname" class="sr-only">user  name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Desired firstname">
                        </div>
                         
                          
                           
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->


       
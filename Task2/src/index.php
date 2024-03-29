<?php

require_once 'connection.php';

session_start();

if(isset($_SESSION["user_login"])) //check condition session user login not direct back to index.php page
{
 header("location: home.php");
}

if(isset($_POST['login']))
{
 $username =strip_tags($_POST["username"]); 
 $email  =strip_tags($_POST["username"]); 
 $password =strip_tags($_POST["password"]);   
  
 if(empty($username)){      
  $errorMsg[]="please enter username or email"; //check "username/email" textbox not empty 
 }
 else if(empty($email)){
  $errorMsg[]="please enter username or email"; //check "username/email" textbox not empty 
 }
 else if(empty($password)){
  $errorMsg[]="please enter password"; //check "passowrd" textbox not empty 
 }
 else
 {
  try
  {
   $query=$db->prepare("SELECT * FROM users WHERE username=? OR email=?"); //sql select query
   $query->execute(array($username,$email)); //execute query with bind parameter
   $row=$query->fetch(PDO::FETCH_ASSOC);
   
   if($query->rowCount() > 0) //check condition database record greater zero after continue
   {
    if($username==$row["username"] OR $email==$row["email"]) //check condition user taypable "username or email" are both match from database "username or email" after continue
    {
     if($password== $row["password"]) 
     {
      $_SESSION["user_login"] = $row["user_id"]; //session name is "user_login"
      $loginMsg = "Successfully Login...";  //user login success message
      header("refresh:2; home.php");   
     }
     else
     {
      $errorMsg[]="wrong password";
     }
    }
    else
    {
     $errorMsg[]="wrong username or email";
    }
   }
   else
   {
    $errorMsg[]="wrong username or email";
   }
  }
  catch(PDOException $e)
  {
   $e->getMessage();
  }  
 }
}
?>

<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout.css">
  </head>
  <body> 
    <br>
    <div class="login">
<form method="post" class="form-horizontal">
     
 <div class="form-group">
 <label class="col-sm-3 control-label">Username or Email</label>
 <div class="col-sm-6">
 <input type="text" name="username" class="form-control" placeholder="Enter username or email" />
 </div>
 </div>
 <br>
     
 <div class="form-group">
 <label class="col-sm-3 control-label">Password</label>
 <div class="col-sm-6">
 <input type="password" name="password" class="form-control" placeholder="Enter passowrd" />
 </div>
 </div>
 <br>
    
 <div class="form-group">
 <div class="col-sm-offset-3 col-sm-9 m-t-15">
 <input type="submit" name="login" class="btn btn-success" value="Login">
 </div>
 </div>
 <br>
    
 <div class="form-group">
 <div class="col-sm-offset-3 col-sm-9 m-t-15">
 You don't have a account register here? <a href="register.php"><p class="text-info">Register Account</p></a>  
 </div>
 </div>
     
</form>
<?php
if(isset($errorMsg))
{
 foreach($errorMsg as $error)
 {
 ?>
  <div class="alert alert-danger">
   <strong><?php echo $error; ?></strong>
  </div>
    <?php
 }
}
if(isset($loginMsg))
{
?>
 <div class="alert alert-success">
  <strong><?php echo $loginMsg; ?></strong>
 </div>
<?php
}
?>
</div>
</body>
</html>
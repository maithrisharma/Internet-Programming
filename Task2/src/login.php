<?php
    session_start();
    include "connection.php";
    if(isset($_POST["login"])){
        if($_POST["username"]=="" or $_POST["email"] or $_POST["password"]==""){
            //echo "<h1>Username, Email and Password cannot be empty!!</h1>";
        }
        else{
            $username =strip_tags(trim($_POST["username"]));
            echo $username; //textbox name "txt_username_email"
            $email  =trim($_POST["email"]);
            echo $email; //textbox name "txt_username_email"
            $password =strip_tags(trim($_POST["password"]));
            echo $password;
            $query=$db->prepare("SELECT * FROM users WHERE email=? AND password=?");
            $query->execute(array($email,$password));
            $control=$query->fetch(PDO::FETCH_OBJ);
            if($control>0){
                $_SESSION["username"]=$username;
                header("Location:index.php");
            }
            echo "<h1>Incorrect Password or EMail</h1>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <form method="post">
            <div>
                <label for="">Username</label>
                <input type="text" name="username" placeholder="enter username" />
            </div>
            <div>
                <label for="">Email</label>
                    <input type="email" name="email" placeholder="enter email" />
            </div>
            <div>
                <label for="">Password</label>
                <input type="password" name="password" placeholder="enter password" />
            </div>
            <button type="submit" name="login">Login</button>
            <div class="col-sm-offset-3 col-sm-9 m-t-15">
            You don't have a account register here? <a href="register.php"><p class="text-info">Register Account</p></a>  
            </div>
    
        </form>
    </body>
</html>
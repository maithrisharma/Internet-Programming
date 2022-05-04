<?php
    
 require_once 'connection.php';
    
 session_start();

 if(!isset($_SESSION['user_login'])) //check unauthorize user not access in "welcome.php" page
 {
  header("location: index.php");
 }
    
 $id = $_SESSION['user_login'];
    
 $select_stmt = $db->prepare("SELECT * FROM users WHERE user_id=:uid");
 $select_stmt->execute(array(":uid"=>$id));
 
 $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
    
 if(isset($_SESSION['user_login']))
 {
 ?>
  Welcome,
<?php
   echo $row['username'];
 }
 ?>
 </h2>
 <h3>Sample New Recipe Entery Form</h3>
            <form action="post">
                <div class="sketch">
                    <img src="newRecipe.jpeg" alt="New recipe entry form">
                </div>    
                <div class="addmore">
                    <!-- add more feilds for the remaining recipe info ...-->
                    <p class="note">The sketch above provides an incomplete list of the required information for a new recipe. You need to add the missing feilds to the New Recipe Entry Form you are going to develop.</p>
                    <input type="submit" value="Add Recipe" />
                    <!--input type="reset" value="Cancel" /-->                
                </div>
            </form>
  <a href="logout.php">Logout</a>
  

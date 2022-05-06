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
   <!DOCTYPE html>
   <html>
     <head>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
       <link rel="stylesheet" href="layout.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
     </head>
     <body>
     <header>
               <a href="welcome.php"><h3>CSYM019 - BBC GOOD FOOD RECIPES</h3></a>
               Welcome,
   <?php
      echo $row['username'];
    }
   ?>
   <?php
   if(isset($errorMsg))
   {
    
    ?>
     <div class="alert alert-danger">
      <strong><?php echo $errorMsg; ?></strong>
     </div>
       <?php
   
   }
   
   ?>
   
               <a href="logout.php">Logout</a>
           </header>
       
    <nav>
               <ul>
                   <li><a href="./recipeSelectionForm.php">Recipe Report</a></li>
                   <li><a href="./newRecipe.php">New Recipe</a></li>
               </ul>
           </nav>
           <main>
           <?php

$recipeID = $_GET['recipe'];

?>
   <?php
           try
     { 
      $query=$db->prepare('SELECT * FROM Recipes WHERE id IN (' . implode(",", $recipeID) . ')');// sql select query
      
      $query->execute(); //execute query 
      $results=$query->fetchAll(); 
      
      if(empty($results)){
       $errorMsg="Sorry No recipes Exists"; //check condition username already exists 
      }
      
      else //check no "$errorMsg" show then continue
      {
        ?>
       <script language="JavaScript">
   function toggle(source) {
     checkboxes = document.getElementsByName('recipe[]');
     for(var i=0, n=checkboxes.length;i<n;i++) {
       checkboxes[i].checked = source.checked;
     }
   }
   </script>

       <table>
       <thead class='tbl-header'>
         <tr>
             
           <th>No.</th>
           <th>Name</th>
           <th>Author</th>
           <th>Prep</th>
           <th>Cook</th>
           <th>More Details</th>
         </tr>
       </thead>
       <tbody>
       <?php
       foreach($results as $row){
         ?>
         <tr>
   <?php
           
         echo '<td>' . $row['id'] . '</td>';
         echo '<td>' . $row['name'] . '</td>';
         echo '<td>' . $row['author'] . '</td>';
         echo '<td>' . $row['prep'] . '</td>';
         echo '<td>' . $row['cook'] . '</td>';
         echo '<td>More Details</td>';
         ?>
         </tr>
   <?php
       }
       ?>
       </tbody>
       </table>

   <?php    
       
       
       }
      }
     
     catch(PDOException $e)
     {
      echo $e->getMessage();
     }
   ?>
   </main>
           <footer>&copy; CSYM019 2022</footer>
     
   </div>
   </body> 
   </html>
   
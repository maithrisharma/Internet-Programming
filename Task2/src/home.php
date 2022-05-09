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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
  <header>
            <a class="home" href="home.php"><h3>CSYM019 - BBC GOOD FOOD RECIPES</h3></a>
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

            <a class="logout" href="logout.php">Logout</a>
        </header>
    
 <nav>
            <ul>
                <li><a href="./recipeSelectionForm.php">Recipe Report</a></li>
                <li><a href="./newRecipe.php">New Recipe</a></li>
            </ul>
        </nav>
        <main>
<?php
        try
  { 
   $query=$db->prepare("SELECT * FROM Recipes"); // sql select query
   
   $query->execute(); //execute query 
   $results=$query->fetchAll(); 
   
   if(empty($results)){
    $errorMsg="Sorry No recipes Exists"; //check condition username already exists 
   }
   
   else //check no "$errorMsg" show then continue
   {
     ?>
    <h1 class="titles">Recipes</h1>
    <table>
    <thead class='tbl-header'>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Author</th>
        <th>More Details</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $c=1;
    foreach($results as $row){
      ?>
      <tr>
<?php
      echo '<td>' . $c++ . '</td>';
      echo '<td>' . $row['name'] . '</td>';
      echo '<td>' . $row['author'] . '</td>';
      echo '<td>Prep Time: ' . $row['prep'] . '<br>Cook Time: ' . $row['cook'] . '<br>Serves: ' . $row['serves']
      . '<br>Ratings: ' . $row['ratings'] . '<br>Description: ' . $row['description'] . '<br><br>Ingredients: ' . 
      $row['ingredients'] . '<br><br>Kcal: ' . $row['kcal'] . '&emsp;Fat: ' . $row['fat'] . 'g&emsp;Saturates: ' . $row['saturates'] . 
      'g&emsp;Carbs: ' . $row['carbs'] . 'g&emsp;Sugars: ' . $row['sugars'] . 'g&emsp;Fibre: ' . $row['fibre'] . 'g&emsp;Protein: ' 
      . $row['protein'] . 'g&emsp;Salts: ' . $row['salt'] . 'g<br><br>Method: ' . $row['method'] . '<br></td>';?>
      <!-- echo '<td><i class="material-icons" onclick="">delete</i></td>'; -->
      <td><a href="delete.php?id=<?php echo $row['id']?>" class="btn btn-danger btn-sm">Delete</a> </td>

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
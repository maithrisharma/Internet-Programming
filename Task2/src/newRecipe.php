<?php
    
 require_once 'connection.php';
    
 session_start();

 if(!isset($_SESSION['user_login'])) //check unauthorize user not access in "newRecipe.php" page
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
            <a class="home" href="home.php"><h3>CSYM019 - BBC GOOD FOOD RECIPES</h3></a>
            Welcome,
<?php
   echo $row['username'];
 }

 if(isset($_POST['add'])) //button name "add"
{
 $name = strip_tags($_POST['name']); 
 $author  = strip_tags($_POST['author']);  
 $prep = strip_tags($_POST['prep']);
 $cook = strip_tags($_POST['cook']); 
 $serves  = strip_tags($_POST['serves']);  
 $ratings = strip_tags($_POST['ratings']);
 $foodType = strip_tags($_POST['foodType']); 
 $difficulty  = strip_tags($_POST['difficulty']);  
 $desc = strip_tags($_POST['desc']);
 $ingredients = strip_tags($_POST['ingredients']); 
 $kcal  = strip_tags($_POST['kcal']);  
 $fat = strip_tags($_POST['fat']); 
 $saturates = strip_tags($_POST['saturates']);
 $carbs = strip_tags($_POST['carbs']); 
 $sugars  = strip_tags($_POST['sugars']);  
 $fibre = strip_tags($_POST['fibre']);
 $protein = strip_tags($_POST['protein']); 
 $salt  = strip_tags($_POST['salt']);  
 $method = strip_tags($_POST['method']); 
  
 if(empty($name) OR empty($author) OR empty($prep) OR empty($cook) OR empty($serves) OR empty($ratings) OR 
 empty($foodType) OR empty($difficulty) OR empty($desc) OR empty($ingredients) OR empty($kcal) OR 
 empty($fat) OR empty($saturates) OR empty($carbs) OR empty($sugars) OR empty($fibre) OR empty($protein)
 OR empty($salt) OR empty($method) ){
  $errorMsg="Please enter All Fields"; 
 }
 
 else
 { 
  try
  { 
   $query=$db->prepare("SELECT name FROM Recipes 
          WHERE name=?"); // sql select query
   
   $query->execute(array($name)); //execute query 
   $row=$query->fetch(PDO::FETCH_ASSOC); 
   
   if($row["name"]==$name){
    $errorMsg="Sorry Recipe Name already exists"; //check condition recipe name already exists 
   }
   
   else if(!isset($errorMsg)) //check no "$errorMsg" show then continue
   {
    
    $insert_stmt=$db->prepare("INSERT INTO Recipes (name,author,prep,cook,serves,ratings,foodType,difficulty,description,ingredients,kcal,fat,saturates,carbs,sugars,fibre,protein,salt,method) VALUES
                (:rname,:author,:prep,:cook,:serves,:ratings,:foodType,:difficulty,:desc,:ingredients,:kcal,:fat,:saturates,:carbs,:sugars,:fibre,:protein,:salt,:method)");   //sql insert query     
    
    if($insert_stmt->execute(array( ':rname' =>$name, 
                                    ':author'=>$author, 
                                    ':prep'=>$prep,
                                    ':cook' =>$cook, 
                                    ':serves'=>$serves, 
                                    ':ratings'=>$ratings,
                                    ':foodType' =>$foodType, 
                                    ':difficulty'=>$difficulty, 
                                    ':desc'=>$desc,
                                    ':ingredients' =>$ingredients, 
                                    ':kcal'=>$kcal, 
                                    ':fat'=>$fat,
                                    ':saturates' =>$saturates, 
                                    ':carbs'=>$carbs, 
                                    ':sugars'=>$sugars,
                                    ':fibre' =>$fibre, 
                                    ':protein'=>$protein, 
                                    ':salt'=>$salt,
                                    ':method' =>$method))){
             
     $addmMsg="Added Successfully....."; //execute query success message
     ?>
     <script>setTimeout(function(){ window.location.href = "home.php"; },2000);</script>
<?php     
    }
   }
  }
  catch(PDOException $e)
  {
   echo $e->getMessage();
  }
 }
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
if(isset($addmMsg))
{
?>
 <div class="alert alert-success">
  <strong><?php echo $addmMsg; ?></strong>
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
            <br>
        <h4>Add Recipe Details</h4>
    <form method="post" class="form-horizontal">
        
      <div class="form-group">
        <label class="col-sm-3 control-label">Name</label>
        <div class="col-sm-6">
          <input type="text" name="name" class="form-control" placeholder="Enter Recipe Name" />
        </div>
      </div>
    
      <div class="form-group">
        <label class="col-sm-3 control-label">Author</label>
        <div class="col-sm-6">
          <input type="text" name="author" class="form-control" placeholder="Enter Author" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Prep Time</label>
        <div class="col-sm-6">
          <input type="text" name="prep" class="form-control" placeholder="Enter Preparation Time" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Cook Time</label>
        <div class="col-sm-6">
          <input type="text" name="cook" class="form-control" placeholder="Enter Cooking Time" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Serves</label>
        <div class="col-sm-6">
          <input type="number" name="serves" min="1" class="form-control" placeholder="Enter Serves " />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Ratings</label>
        <div class="col-sm-6">
          <input type="number" name="ratings" min="0" class="form-control" placeholder="Enter Ratings" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Food Type</label>
        <div class="col-sm-6">
          <input type="text" name="foodType" class="form-control" placeholder="Enter Food Type" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Difficulty</label>
        <div class="col-sm-6">
          <input type="text" name="difficulty" class="form-control" placeholder="Enter Difficulty" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Description</label>
        <div class="col-sm-6">
          <input type="text" name="desc" class="form-control" placeholder="Enter Description" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Ingredients</label>
        <div class="col-sm-6">
        <textarea name="ingredients" rows="10" class="form-control" placeholder="Enter Ingredients"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Kcal</label>
        <div class="col-sm-6">
          <input type="number" min="0" name="kcal" class="form-control" placeholder="Enter Kcal" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Fat</label>
        <div class="col-sm-6">
          <input type="number" step=0.01 name="fat" class="form-control" placeholder="Enter fat" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Saturates</label>
        <div class="col-sm-6">
          <input type="number" step=0.01 name="saturates" class="form-control" placeholder="Enter Saturates" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Carbs</label>
        <div class="col-sm-6">
          <input type="number" step=0.01 name="carbs" class="form-control" placeholder="Enter Carbs" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Sugars</label>
        <div class="col-sm-6">
          <input type="number" step=0.01 name="sugars" class="form-control" placeholder="Enter Sugars" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Fibre</label>
        <div class="col-sm-6">
          <input type="number" step=0.01 name="fibre" class="form-control" placeholder="Enter Fibre" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Protein</label>
        <div class="col-sm-6">
          <input type="number" step=0.01 name="protein" class="form-control" placeholder="Enter Protein" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Salt</label>
        <div class="col-sm-6">
          <input type="number" step=0.01 name="salt" class="form-control" placeholder="Enter Salt" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Method</label>
        <div class="col-sm-6">
        <textarea name="method" rows="10" class="form-control" placeholder="Enter Method"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9 m-t-15">
          <input type="submit"  name="add" class="btn btn-primary " value="Add">
        </div>
      </div>
    
 
     
</form>
</main>
        <footer>&copy; CSYM019 2022</footer>
  

</body> 
</html>

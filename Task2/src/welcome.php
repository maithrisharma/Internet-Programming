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
            <h3>CSYM019 - BBC GOOD FOOD RECIPES</h3>
            Welcome,
<?php
   echo $row['username'];
 }
 ?>
            <a href="logout.php">Logout</a>
        </header>
    
 <nav>
            <ul>
                <li><a href="./recipeSelectionForm.html">Recipe Report</a></li>
                <li><a href="./newRecipe.html">New Recipe</a></li>
            </ul>
        </nav>
        <main>
            <h3>Sample New Recipe Entery Form</h3>
 <div class="container">
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
          <input type="text" name="fat" class="form-control" placeholder="Enter fat" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Saturates</label>
        <div class="col-sm-6">
          <input type="text" name="saturates" class="form-control" placeholder="Enter Saturates" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Carbs</label>
        <div class="col-sm-6">
          <input type="text" name="carbs" class="form-control" placeholder="Enter Carbs" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Sugars</label>
        <div class="col-sm-6">
          <input type="text" name="sugars" class="form-control" placeholder="Enter Sugars" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Fibre</label>
        <div class="col-sm-6">
          <input type="text" name="fibre" class="form-control" placeholder="Enter Fibre" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Protein</label>
        <div class="col-sm-6">
          <input type="text" name="protein" class="form-control" placeholder="Enter Protein" />
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Salt</label>
        <div class="col-sm-6">
          <input type="text" name="salt" class="form-control" placeholder="Enter Salt" />
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
  
</div>
</body> 
</html>

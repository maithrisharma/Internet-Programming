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
       <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
       <script src="script.js"></script>
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
        $c=1;
       foreach($results as $row){

         ?>
        <h4>Recipe <?php echo $c++ ?></h4>
        <table>
            <thead>
            <tr>
          
        <th>Name</th>
        <th>Author</th>
        <th>More Details</th>
      </tr>
            </thead>
            <tbody>
                <tr>
<?php  
         echo '<td>' . $row['name'] . '</td>';
         echo '<td>' . $row['author'] . '</td>';

         echo '<td>Prep Time: ' . $row['prep'] . '<br>Cook Time: ' . $row['cook'] . '<br>Serves: ' . $row['serves']
         . '<br>Ratings: ' . $row['ratings'] . '<br>Description: ' . $row['description'] . '<br><br>Ingredients: ' . 
         $row['ingredients'] . '<br><br>Method: ' . $row['method'] . '<br></td>';?>
         </tr>
         
       </tbody>
       </table>
       <div class="chartStyles">
       <canvas id="myChart" width="400" height="400"></canvas> 
       </div>
       <script>
           const ctx = document.getElementById('myChart').getContext('2d');
console.log(ctx);
const myChart = new Chart(ctx, {
type: 'pie',
data: {
    labels: ['Fat', 'Saturates', 'Carbs', 'Sugars', 'Fibre', 'Protein', 'Salts'],
    datasets: [{
        label: '# g',
        data: [<?php echo $row['fat']?>, <?php echo $row['saturates']?>, <?php echo $row['carbs']?>, <?php echo $row['sugars']?>, <?php echo $row['fibre']?>, <?php echo $row['protein']?>, <?php echo $row['salt']?>],
        backgroundColor: [
            'rgba(0, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(0, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(152, 159, 64, 0.2)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(152, 159, 64, 1)'
        ],
        borderWidth: 1
    }]
},
options: {
    // resnponsive:true;
    // maintainAspectRatio: false;
    scales: {
        y: {
            beginAtZero: true
        }
    }
}
});
       </script>
<?php       
}
       ?>


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
   
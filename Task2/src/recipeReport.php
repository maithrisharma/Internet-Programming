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

$recipeID = $_GET['recipeId'];
echo "<script>Console.log('$recipeID');</script>";

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
        echo "<script>console.log('" . count($results) . "' );</script>";
        ?>
        <script>  
            var recipeLabels=[];
            var kcal=[];
            var fat=[];
            var saturates=[];
            var carbs=[];
            var sugars=[];
            var fibre=[];
            var protein=[];
            var salts=[];
        </script>
<?php
       foreach($results as $row){

         ?>
         <script> 

            recipeLabels.push("<?php echo $row['name']?>");
           kcal.push(<?php echo $row['kcal']?>);
           fat.push(<?php echo $row['fat']?>);
           saturates.push(<?php echo $row['saturates']?>);
           carbs.push(<?php echo $row['carbs']?>);
           sugars.push(<?php echo $row['sugars']?>);
           fibre.push(<?php echo $row['fibre']?>);
           protein.push(<?php echo $row['protein']?>);
           salts.push(<?php echo $row['salt']?>);
                   </script>
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
       <h5>Nutritions:</h5>
       <div class="chartStyles">
       <canvas id="<?php echo $row['id']?>" width="400" height="400"></canvas> 

       </div>
       <script>

           var ctx = document.getElementById('<?php echo $row['id']?>').getContext('2d');
console.log(ctx);
var myChart = new Chart(ctx, {
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
              <p style="text-align:center;">Kcal:<?php echo $row['kcal']?></p>
              <br>
<?php       
}
       ?>
       
           <h3>Bar chart for Nutritions</h3>
    <canvas id="myChart" style="display:none;"></canvas>

    <script>
        if(<?php echo count($results)?>>1){
            var canvasElement= document.getElementById("myChart").style.display="block";
            canvasElement.width=300;
            canvasElement.height=300;
        var ctx = document.getElementById("myChart").getContext("2d");

var data = {
  labels: recipeLabels,
  datasets: [{
    label: "Kcal",
    backgroundColor: "blue",
    data: kcal
  }, {
    label: "Fat",
    backgroundColor: "red",
    data: fat
  }, {
    label: "Saturates",
    backgroundColor: "green",
    data: saturates
  }, {
    label: "Carbs",
    backgroundColor: "blue",
    data: carbs
  }, {
    label: "Sugars",
    backgroundColor: "red",
    data: sugars
  }, {
    label: "Fibre",
    backgroundColor: "green",
    data: fibre
  }, {
    label: "Protein",
    backgroundColor: "blue",
    data: protein
  }, {
    label: "Salts",
    backgroundColor: "red",
    data: salts
  }
]
};
console.log(data.datasets[0].data[0])

var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: {
    barValueSpacing: 20,
    scales: {
      yAxes: [{
        ticks: {
          min: 0,
        }
      }]
    }
  }
});
        }

    </script>

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
   
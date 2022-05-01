
(function Recursive(){
  AjaxRequest();
  setTimeout(Recursive,5000);
  
})();
function AjaxRequest(){
  if(window.XMLHttpRequest){
    xhr = new XMLHttpRequest();
  }
  else{
    if(window.ActiveXObject){
      xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
  if(xhr){
    xhr.open("GET","recipe.json",true);
    xhr.send();
    console.log("sended");
    xhr.onreadystatechange= showContents;
    
  }
  else{
    document.getElementById("updatemessage").innerHTML="Error";
  }
}

function showContents(){
  if(xhr.readyState == 4){
    if(xhr.status==200){
      let response= JSON.parse(xhr.responseText);
      console.log(response);
      let txt ="";
      for(let i in response.recipes){
        var nutritions=JSON.stringify(response.recipes[i].nutrition);
            var ingredients=JSON.stringify(response.recipes[i].ingredients);
            //console.log(ingredients);
            //console.log(JSON.parse(ingredients));
            var methods=JSON.stringify(response.recipes[i].method);
            txt+="<tr><td>"+response.recipes[i].id+"</td><td class='tdImg'><a href='#'><img src='"+response.recipes[i].image+
            "' class='img'/></a></td><td class='tdIcon'><img src='"+response.recipes[i].icon+
            "' class='iconimg'/></td><td><h1 class='name'>"+response.recipes[i].name
            +"</h1><p class='info'>By: "+response.recipes[i].author+"<br><br>"+response.recipes[i].desc+"<br><br>Ratings: "+response.recipes[i].ratings+"<br>Prep Time: "+response.recipes[i].prep+"<br>Cook Time: "+response.recipes[i].cook+"<br>Serves: "+response.recipes[i].serves+"<span>&emsp;Difficulty: "+response.recipes[i].difficulty+"</span></p><button class='btn' onclick='Nutrition("+nutritions+
            ")'>Nutritions</button><span>&emsp;<button class='btn' id='"+"Ingredient"+
            response.recipes[i].id+"'onclick='Ingredients("+ingredients+
            ")'>Ingredients</button>&emsp;<button class='btn' onclick='Method("+methods+")'>Method</button></span></td></tr>";
      }
      console.log("refreshed");
      document.getElementById("recipelist").innerHTML=txt;
    }
    else{
      document.getElementById("updatemessage").innerHTML="Error";
    }
  }
}


function Nutrition(list){
  console.log(list);
  var modal = document.getElementById("nutritionModal");
  var data = document.getElementById("nutritionData");  
  var nutritionhtml="<ul>"
  //list.forEach(element => {
      //ingredientshtml+="<li>"+element+"</li><br>";
  //});
  for (const property in list) {
    nutritionhtml+="<li>"+(`${property}: ${list[property]}`)+"</li><br>";
  }
  nutritionhtml+="</ul>";
  data.innerHTML=nutritionhtml;
  modal.style.display = "block";


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
  modal.style.display = "none";
}
}

}

function Ingredients(list){
    console.log(list);
    var modal = document.getElementById("ingredientsModal");
    var data = document.getElementById("ingredientsList");  
    var ingredientshtml="<ul>"
    list.forEach(element => {
        ingredientshtml+="<li>"+element+"</li><br>";
    });
    ingredientshtml+="</ul>";
    data.innerHTML=ingredientshtml;
    modal.style.display = "block";


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[1];


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

}


function Method(list){
    console.log(list);
    var modal = document.getElementById("methodModal");
    var data = document.getElementById("methodList");  
    var methodhtml="<ul>"
    list.forEach(element => {
        methodhtml+="<li>"+element+"</li><br>";
    });
    methodhtml+="</ul>";
    data.innerHTML=methodhtml;
    modal.style.display = "block";


// Get the <span> element that closes the modal
var span= document.getElementsByClassName("close")[2];
console.log(span);


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

}
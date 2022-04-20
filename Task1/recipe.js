
(function makeAjaxRequest(){
    setTimeout(function(){
    $.ajax( {
        type:'GET',
        url:'recipe.json',
        dataType:"json",
        success: function(response){
            let txt="";
            $.each(response.recipes,function(index){
                var ingredients=JSON.stringify(response.recipes[index].ingredients);
                console.log(ingredients);
                console.log(JSON.parse(ingredients));
                var methods=JSON.stringify(response.recipes[index].method);
                txt+="<tr><td><img src='"+response.recipes[index].image+"' style='width:200px;height:200px'/></td><td>"+response.recipes[index].name
                +"</td><td>"+response.recipes[index].prep+"</td><td><button id='"+"Ingredient"+response.recipes[index].id+"'onclick='Ingredients("+ingredients+")'>Ingredients</button></td><td><button onclick='Method("+methods+")'>Method</button></td></tr>";
            });
            $("#recipelist").append(txt);
        },
        error: function(){
            $("#updatemessage").append("Error");
        }
    });
    }, 250);
})();

function Ingredients(list){
    console.log(list);
    var modal = document.getElementById("myModal");
    var data = document.getElementById("ingredientsList");  
    var ingredientshtml="<ul>"
    list.forEach(element => {
        ingredientshtml+="<li>"+element+"</li><br>";
    });
    ingredientshtml+="</ul>";
    data.innerHTML=ingredientshtml;
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
var span= document.getElementsByClassName("close")[1];
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
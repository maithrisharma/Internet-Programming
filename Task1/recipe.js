
(function makeAjaxRequest(){
    setTimeout(function(){
    $.ajax( {
        type:'GET',
        url:'recipe.json',
        dataType:"json",
        success: function(response){
            let txt="";
            $.each(response.recipes,function(index){
                txt+="<tr><td><img src='"+response.recipes[index].image+"' style='width:200px;height:200px'/></td><td>"+response.recipes[index].name
                +"</td><td>"+response.recipes[index].prep+"</td><td><button id='"+response.recipes[index].id+"'onclick='Ingredients("+response.recipes[index].id+")'>Ingredients</button>"+response.recipes[index].ingredients+"</td><td>"+response.recipes[index].method+"</td></tr>";
            });
            $("#recipelist").append(txt);
        },
        error: function(){
            $("#updatemessage").append("Error");
        }
    });
    }, 250);
}());

function Ingredients(Id){
    var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

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
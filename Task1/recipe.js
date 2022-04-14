document.addEventListener('DOMContentLoaded',makeAjaxRequest);
function makeAjaxRequest(){
    $.ajax({
        type:'GET',
        url:'recipe.json',
        dataType:"json",
        success: function(response){
            let txt="";
            $.each(response.recipes,function(index){
                txt+="<tr><td>"+response.recipes[index].name
                +"</td></tr>";
            });
            $("#recipelist").append(txt);
        },
        error: function(){
            $("#updatemessage").append("Error");
        }
    })
}
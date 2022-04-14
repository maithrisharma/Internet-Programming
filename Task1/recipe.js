document.addEventListener('DOMContentLoaded',makeAjaxRequest);
function makeAjaxRequest(){
    $.ajax({
        type:'GET',
        url:'recipe.json',
        dataType:"json",
        success: function(response){
            let txt="";
            $.each(response.recipes,function(index){
                txt+="<tr><td><img src='"+response.recipes[index].image+"' style='width:200px;height:200px'/></td><td>"+response.recipes[index].name
                +"</td><td>"+response.recipes[index].prep+"</td><td>"+response.recipes[index].ingredients+"</td><td>"+response.recipes[index].method+"</td></tr>";
            });
            $("#recipelist").append(txt);
        },
        error: function(){
            $("#updatemessage").append("Error");
        }
    })
}

document.addEventListener('DOMContentLoaded',makeAjaxRequest);
function makeAjaxRequest(){
    $.ajax({
        type:'GET',
        url:'recipe.json',
        dataType:"json",
        success: function(response){
            let txt="";
            $.each(response.recipes,function(index){
                txt+="<tr><td>"+"#"+"</td><td>"+response.recipes[index].name
                +"</td><td>"+response.recipes[index].prep+"</td><td>"+response.recipes[index].ingredients+"</td><td>"+response.recipes[index].method+"</td></tr>";
            });
            $("#recipelist").append(txt);
        },
        error: function(){
            $("#updatemessage").append("Error");
        }
    })
}
$(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
  }).resize();
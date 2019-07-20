$(document).ready(function(){
    $(".button").click(function(){
        var value=$(this).attr("data-filter");
        if(value == "all" ){
            $(".filter").show("500");
        }
        else{
            $(".filter").not("."+value).hide("500");
            $(".filter").filter("."+value).show("500");
        }
        
        // add active class
        $("ul .button").click(function(){
            $(this).addClass('active').siblings().removeClass('active');
        });
    });
});
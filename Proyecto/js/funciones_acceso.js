$(document).ready(function(){
	
	 var valor = 0;
	$(window).scroll(function()
	{
		if ($(this).scrollTop() > 100)
		{
			$('.scrollup').fadeIn();
		}
		else
		{
			$('.scrollup').fadeOut();
		}
	});

	// Scroll-to-top animate
	$('.scrollup').click(function()
	{
		$("html, body").animate({ scrollTop: 0 }, 600);

		return false;
	});
	
    $("#acceso").click(function(){
        $("#login").fadeIn("slow");
    });
 
    $("#x").click(function(){
        $("#login").fadeOut("slow");
    });

     $("#accesoDos").click(function(){  
       if  (valor == 0)  {
       $("#menu ul").fadeIn("slow");
          valor = 1; 
       } else {
          $("#menu ul").fadeOut("slow");
          $("#accesoDos").attr("title", "Ocultar menu");
          valor = 0;
      }
    });

var carousel = $(".carousel"),
    currdeg  = 0;

$(".next").on("click", { d: "n" }, rotate);
$(".prev").on("click", { d: "p" }, rotate);

function rotate(e){
  if(e.data.d=="n"){
    currdeg = currdeg - 60;
  }
  if(e.data.d=="p"){
    currdeg = currdeg + 60;
  }
  carousel.css({
    "-webkit-transform": "rotateY("+currdeg+"deg)",
    "-moz-transform": "rotateY("+currdeg+"deg)",
    "-o-transform": "rotateY("+currdeg+"deg)",
    "transform": "rotateY("+currdeg+"deg)"
  });
}     




});
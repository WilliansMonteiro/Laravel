document.getElementsByClassName("heading").onmouseover = function (){
    console.log('ola');
  };
  document.getElementsByClassName("caixa").onmouseout = function (){
   document.getElementsByClassName("esconde").style['background-color'] = "white";
};

$("#box").hover(function(){
$("#esconde").css("background-color", "green");
});


   var swiper = new Swiper('.swiper-container', {
       slidesPerView: 5.2,
       spaceBetween: 30,
       pagination: {
         el: '.swiper-pagination',
         clickable: true,
       },
     });





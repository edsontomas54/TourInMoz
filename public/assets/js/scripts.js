
let menu=document.getElementById("menu-btn");
let navBar = document.querySelector(".header .navBar");

menu.onclick=function(){
    menu.classList.toggle('fa-times');
    navBar.classList.toggle('active');

};

window.onscroll=function(){
    menu.classList.remove('fa-times');
    navBar.classList.remove('active');

};
// var swiper = new Swiper(".mySwiper", {
//   spaceBetween: 30,
//   centeredSlides: true,
//   autoplay: {
//     delay: 2500,
//     disableOnInteraction: false,
//   },
//   pagination: {
//     el: ".swiper-pagination",
//     clickable: true,
//   },
//   navigation: {
//     nextEl: ".swiper-button-next",
//     prevEl: ".swiper-button-prev",
//   },
// });


var swiper = new Swiper(".home-slider", {
  // spaceBetween: 30,
  // centeredSlides: true,
  autoplay: {
    delay: 2800,
    disableOnInteraction: false,
  },
    loop:true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
      el: ".",
      clickable: true,
    },
 });
 
 var swiper = new Swiper(".review-slider", {
    loop:true,
    spaceBetween: 20,
    autoHeight:true,
    grabCursor:true,
    breakpoints: {
        0: {
          slidesPerView: 1,
    
        },
        768: {
          slidesPerView: 2,
        },
        1000: {
          slidesPerView: 3,
        },
      },
 });

 var loadMoreBtn=document.querySelector('.package-container  .load-more .btn');

 var currentItem=3;

 loadMoreBtn.onclick=() =>{
   var boxes =[...document.querySelectorAll('.package-container .box-container .box')];

   for(var i =currentItem; i < currentItem +3 ; i++){
    boxes[i].style.display="inline-block";

   }
   currentItem +=3;

   if(currentItem>= boxes.length){
    loadMoreBtn.style.display="none";
   }
 }

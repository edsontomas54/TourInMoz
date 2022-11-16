
<!----------------------Swiper-js---------------------------------------------->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>


 <!----------------------Script-File---------------------------------------------->
 <script src="assets/js/scripts.js"></script>
 <script src="assets/js/jquery-3.6.1.min.map.js"></script>

 <script>
    var swiper = new Swiper(".home-slider", {
    loop:true,    
   navigation: {
     nextEl: ".swiper-button-next",
     prevEl: ".swiper-button-prev",
   },
});

$('#test').toggle("50000");
 </script>
</body>
</html>

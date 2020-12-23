        <footer>
         <div class="container">
            <div class="row">
               <div class="footer_logo col-lg-3 col-md-3 col-sm-12 col-xs-12">
                  <img src="<?php echo base_url(); ?>design/images/IRS.png">
               </div>
               <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                  <h3>Links</h3>
                  <ul>
                     <a href="">
                        <li>About Us</li>
                     </a>
                     <a href="">
                        <li>Events</li>
                     </a>
                     <a href="">
                        <li>Gallery</li>
                     </a>
                     <a href="">
                        <li>Promotions</li>
                     </a>
                  </ul>
               </div>
               <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                  <h3>Links</h3>
                  <ul>
                     <a href="">
                        <li>About Us</li>
                     </a>
                     <a href="">
                        <li>Events</li>
                     </a>
                     <a href="">
                        <li>Gallery</li>
                     </a>
                     <a href="">
                        <li>Promotions</li>
                     </a>
                  </ul>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <h3>Contact Us</h3>
                  <span>Motor Vehicles Inspector Association 
                  4-225/2, Makkevaripeta, <br>
                  Navuluru, Mangalagiri.<br>
                  Email: aptoamaravathi@gmail.com</span>
               </div>
            </div>
         </div>
         <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
      </footer>
   </body>
   <script>
      //Get the button
      var mybutton = document.getElementById("myBtn");
      
      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function() {scrollFunction()};
      
      function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          mybutton.style.display = "block";
        } else {
          mybutton.style.display = "none";
        }
      }
      
      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
   </script>
   <script>
      var slideIndex = 1;
      showSlides(slideIndex);
      
      function plusSlides(n) {
        showSlides(slideIndex += n);
      }
      
      function currentSlide(n) {
        showSlides(slideIndex = n);
      }
      
      function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}    
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
      }
   </script>
   <script type="text/javascript">
      function animateValue(obj, start, end, duration) {
      let startTimestamp = null;
      const step = (timestamp) => {
      if (!startTimestamp) startTimestamp = timestamp;
      const progress = Math.min((timestamp - startTimestamp) / duration, 1);
      obj.innerHTML = Math.floor(progress * (end - start) + start);
      if (progress < 1) {
      window.requestAnimationFrame(step);
      }
      };
      window.requestAnimationFrame(step);
      }
      
      const obj = document.getElementById("value");
      animateValue(obj, 0, 10000, 6000);
      const obj1 = document.getElementById("value1");
      animateValue(obj1, 0, 10000, 6000);
      const obj2 = document.getElementById("value2");
      animateValue(obj2, 0, 70000, 7000);
      const obj3 = document.getElementById("value3");
      animateValue(obj3, 0, 1000, 3000);
   </script>
   <script type="text/javascript">
      $('.brand-carousel').owlCarousel({
      loop:true,
      margin:10,
      autoplay:true,
      responsive:{
      0:{
      items:1
      },
      600:{
      items:3
      },
      1000:{
      items:5
      }
      }
      }) 
      
   </script>
   <script type="text/javascript" src="<?php echo base_url(); ?>design/js/bootstrap.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>rta_assets/js/rta_js.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>rta_assets/js/lightbox-plus-jquery.min.js"></script>
   <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</html>
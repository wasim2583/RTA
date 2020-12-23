      <footer class="footer">
        <div class="container">
          <div class="col-md-12 footer-main">
            <div class="row">
              <div class="col-md-4 footer-main-left">
                <img src="<?php echo base_url();?>rta_assets/images/footer-logo.jpg" class="img-fluid mt-4 mb-3">
              </div>
              <div class="col-md-4 col-6 footer-main-left">
                <h4 class="text-white mt-4 mb-5"> <span class="b-b">Useful Links</span></h4>
                <ul class="col-md-6 mt-4">
                  <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> About Us</a></li>
                  <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Features</a></li>
                  <li><a href="<?php echo HTTP_BASE_PATH;?>front/gallery/gallery_data"><i class="fa fa-angle-right" aria-hidden="true"></i> Gallery</a></li>
                  <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Citizens</a></li>
                  <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i> Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-4 col-6 footer-main-left">
                <h4 class="text-white mt-4 mb-4"><span class="b-b">Contact Us</span> </h4>
                <ul class="col-md-12 mt-5">
                  <li class="text-white"> <i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;Motor Vehicles Inspector Association</li>
                  <li class="text-white"> &nbsp;&nbsp;   4-225/2, Makkevaripeta,  </li>
                  <li class="text-white"> &nbsp;&nbsp;   Navuluru, Mangalagiri.</li>
                  <li class="text-white"> <i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp;Email: aptoamaravathi@gmail.com</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>rta_assets/js/osSlider.js"></script>
    <script src="<?php echo base_url();?>rta_assets/js/rta_js.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#myModal").modal('show');
      });
      var slider = new osSlider({
          pNode:'.slider',
          cNode:'.slider-main li',
          autoPlay:true
      });
    </script>
<!--
    <script type="text/javascript">
      $(document).ready(function(){
        $('#state_select_btn').addClass('disabled');
        $('#state_wrapper button').click(function(e){

          var state_id = e.currentTarget.id; 
          // $('#selectedState').val($('#state_wrapper button#'+state_id).html());
          $('#selectedState').val(state_id);

          if($('#state_wrapper button#'+state_id).hasClass('active') || $('#state_wrapper button#'+state_id).hasClass('btn-secondary')){

            $('#state_wrapper button#'+state_id).removeClass('active btn-secondary');
            // $('#selectedState').val('');
            $('#state_select_btn').removeClass('active btn-primary');
            $('#state_select_btn').addClass('disabled');
            
          }
          else{

            $( "#state_wrapper" ).find( 'button' ).removeClass( "active btn-secondary" );
            $( "#state_wrapper" ).find( 'button' ).addClass( "btn-default" );
            $('#state_wrapper button#'+state_id).addClass('btn-secondary active');
            $('#state_select_btn').removeClass('disabled');
            $('#state_select_btn').addClass('active btn-primary');
          }
        });
      });
        
    </script>

    <script type="text/javascript">
      var base_url = 'http://localhost:8080/rtalive/';
      $('#state_wrapper button').click(function(e){
        var state_id = e.currentTarget.id;
        $('#selectedState').val(state_id);
        $.ajax({
          type: "POST",
          url: base_url + "Welcome/select_state/",
          data: {state_id: state_id},
          success: function(){
            $('#myModal').close();
          }
        });
      });
    </script>
-->
  </body>
</html>
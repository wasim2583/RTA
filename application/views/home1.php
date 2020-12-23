<!DOCTYPE html>
<html lang="en">
  <head>
    <title>RTA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url();?>rta_assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=NTR" rel="stylesheet">
    <link href="<?php echo base_url();?>rta_assets/css/animate.css" rel="stylesheet" type="text/css">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  </head>
  <body style="font-family: 'NTR', sans-serif;">
    <div class="container">
      
      <header>
        <?php $this->load->view('front_view/includes/header'); ?>
        <!--menu part end-->
      </header>
      <div id="myModal" class="modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">State Selection Window</h5>
              <?php
              if( ! empty($this->session->userdata('app_state')))
              {
                ?>
                <button type="button" class="close" data-dismiss="modal" onclick="location.href='<?php echo base_url(); ?>'">&times;</button>
                <?php
              }
              ?>
            </div>
            <div class="modal-body">
              <p>Please select state to go to Homepage</p>
              <form action="" method="POST">
                
                <input type="hidden" name='selectedState' id="selectedState" value="" />

                <div id="state_wrapper">
                  <?php
                  foreach($states as $state)
                  {
                    ?>
                  <button type="button" id="<?php echo $state->id;?>" class="btn <?php echo ($this->session->userdata('app_state') == $state->id) ? 'btn-secondary' : 'btn-default'; ?> btn-sm"><?php echo $state->state_name;?></button>
                    <?php
                  }
                  ?>
                </div>

                <button type="submit" id="state_select_btn" class="btn btn-outline-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
      <?php $this->load->view('front_view/includes/footer'); ?>
    </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>rta_assets/js/osSlider.js"></script>
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

  </body>
</html>
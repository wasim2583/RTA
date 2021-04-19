<section class="GallryWrap" >
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 card-box-bg text-center">
            <h2 class="dispFull">Account activation</h2>
            <?php
            if($this->session->flashdata('password_update_error'))
            { 
               ?>
            <div class="alert-style" ><?php echo $this->session->flashdata('password_update_error');?></div>
               <?php
            }
            ?>
         </div>
      </div>
   </div>
</section>
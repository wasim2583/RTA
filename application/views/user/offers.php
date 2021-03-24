<!-- Main Content -->
<div id="content">
   <!-- Begin Page Content -->
   <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Offers</h1>
      </div>
      <button onclick="location.href='<?php echo base_url(); ?>user/Partner/create_offer'" class="btn btn-primary btn_submit">Create</button>

      <div class="alert">
         <?php
         if( ! empty($this->session->flashdata('partner_update_success')))
            echo $this->session->flashdata('partner_update_success');
         if( ! empty($this->session->flashdata('partner_update_error')))
            echo $this->session->flashdata('partner_update_error');
         ?>
      </div>
     
      <!-- Content Row -->
      <div class="row">
         <!-- Content Column -->
         <div class="col-lg-12 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
               <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"></h6>
               </div>

               <div class="card-body">
                  <div class="row">
                     <div class="col-lg-12 col-md-12">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Offer Name</th>
                                 <th scope="col">Description</th>
                                 <th scope="col">From</th>
                                 <th scope="col">To</th>
                                 <th scope="col">State</th>
                                 <th scope="col">Location</th>
                                 <th scope="col">Status</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <th scope="row">1</th>
                                 <td>Road Show</td>
                                 <td>Safety Awareness</td>
                                 <td>01-04-2021</td>
                                 <td>06-04-2021</td>
                                 <td>Andhra Pradesh</td>
                                 <td>Kavali</td>
                                 <td></td>
                              </tr>
                           </tbody>
                        </table>
                        <?php //print_r($partner); ?>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Color System -->
         </div>
      </div>
       <!-- Content Row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content
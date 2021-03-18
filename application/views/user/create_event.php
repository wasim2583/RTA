<!-- Main Content -->
<div id="content">
   <!-- Begin Page Content -->
   <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Create Event</h1>
      </div>
      <?php
      if($this->session->flashdata('create_event_error'))
         echo $this->session->flashdata('create_event_error');
      ?>
      <!-- Content Row -->
      <div class="row">
         <!-- Content Column -->
         <div class="col-lg-12 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
               <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Create Event</h6>
               </div>
               <div class="card-body">
                  <form action="" method="POST">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="col-lg-12 col-md-12">
                              <div class="row Member_labels">
                                 <div class="col-lg-4 lableTxt">Event Name</div>
                                 <div class="col-lg-8">
                                    <input type="text" name="event_name" id="event_name" class="form-control" value="<?php echo set_value('event_name') ?>">
                                 </div>
                                 <?php echo form_error('event_name'); ?>
                              </div>
                              <div class="row Member_labels">
                                 <div class="col-lg-4 lableTxt">Description</div>
                                 <div class="col-lg-8">
                                    <textarea class="form-control" name="event_description" id="event_description" placeholder="Event Description"><?php echo set_value('event_description'); ?></textarea>
                                 </div>
                                 <?php echo form_error('event_description'); ?>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">From</div>
                              <div class="col-lg-8">
                                 <input type="date" name="event_from" id="event_from" class="form-control" value="<?php echo set_value('event_from'); ?>">
                              </div>
                              <?php echo form_error('event_from'); ?>
                           </div>
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">To</div>
                              <div class="col-lg-8">
                                 <input type="date" name="event_to" id="event_to" class="form-control" value="<?php echo set_value('event_to'); ?>">
                              </div>
                              <?php echo form_error('event_to'); ?>
                           </div>
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">State</div>
                              <div class="col-lg-8">                                 
                                 <select class="form-control" name="state" id="state">
                                    <option value="">--Select State--</option>
                                    <?php
                                    foreach($states as $state)
                                    {
                                       ?>
                                    <option value="<?php echo $state->id; ?>" <?php echo (set_value('state') == $state->id) ? 'selected' : ''; ?>>
                                       <?php echo $state->state_name; ?>
                                    </option>
                                       <?php
                                    }
                                    ?>
                                 </select>
                              </div>
                              <?php echo form_error('state'); ?>
                           </div>
                           <div class="row Member_labels">
                              <div class="col-lg-4 lableTxt">Location</div>
                              <div class="col-lg-8">                                 
                                 <select class="form-control" name="location" id="location">
                                    <option value="">--Select Location--</option>
                                 </select>
                              </div>
                              <?php echo form_error('location'); ?>
                           </div>
                           
                           <button type="submit" class="btn btn-primary btn_submit">Create</button>
                        </div>
                     </div>
                  </form>
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
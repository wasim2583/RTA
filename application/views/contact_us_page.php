<section class="GallryWrap" >
</section>
<section id="contactsec" class="container-fluid paddTB60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                
            </div>
            <div class="col-lg-6 col-md-6">
                <form action="" method="POST">
                    <div class="messages"></div>
                    <div class="controls">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h2 class="headClasses">Enquiry Form</h2>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fullname">Fullname *</label>
                                    <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter your fullname *" required="required" data-error="fullname is required." value="<?php echo set_value('fullname'); ?>">
                                    <div class="help-block with-errors">
                                        <?php echo form_error('fullname'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile No</label>
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter your Mobile Number *" required="required" data-error="Mobile Number is required." value="<?php echo set_value('mobile'); ?>">
                                    <div class="help-block with-errors">
                                        <?php echo form_error('mobile'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Enter your email *" required="required" data-error="Valid email is required." value="<?php echo set_value('email'); ?>">
                                    <div class="help-block with-errors">
                                        <?php echo form_error('email'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Select Your Choice *</label>
                                    <select id="role" name="role" class="form-control" data-error="Please specify your need.">
                                        <option value="">--Select Your Choice--</option>
                                        <option value="T-Shirt">T-Shirt</option>
                                        <option value="Mug">Mug</option>
                                    </select>
                                    <div class="help-block with-errors">
                                        <?php echo form_error('role'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message">Message *</label>
                                    <textarea class="form-control" type="textarea" name="message" id="message" placeholder="Message for me *" rows="4" required="required" data-error="Please, leave us a message."></textarea>
                                    <div class="help-block with-errors">
                                        <?php echo form_error('message'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn-action btn-knowColor" value="Send Order">
                            </div>
                        </div>
                    </div>
                </form>
                <div id="success_message">
                    <h2>
                        <?php
                            if(!empty($this->session->tempdata('contact_success')))
                               echo $this->session->tempdata('contact_success');
                            ?>
                    </h2>
                </div>
                <div id="error_message">
                    <h2>
                        <?php
                            if(!empty($this->session->tempdata('contact_error')))
                               echo $this->session->tempdata('contact_error');
                            ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</section>
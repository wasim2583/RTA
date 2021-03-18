<section class="contactUs">
  <div class="continer-fluid">
    <h2>Contact Us</h2>
    <div class="container">
      <div id="accordion">
        <?php
        foreach($states as $s)
        {
          ?>
        <div class="card">
          <div class="card-header" id="heading-<?php echo $s->id; ?>">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-<?php echo $s->id; ?>" aria-expanded="false" aria-controls="collapseTwo"><?php echo $s->state_name; ?></button>
            </h5>
          </div>
          <div id="collapse-<?php echo $s->id; ?>" class="collapse" aria-labelledby="heading-<?php echo $s->id; ?>" data-parent="#accordion">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <h3>Address1</h3>
                  <address>
                    <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                    <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                    <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                    <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                    <abbr title="email"></abbr> 
                  </address>
                </div>
                <div class="col-lg-4 col-md-4">
                  <h3>Address2</h3>
                  <address>
                    <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                    <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                    <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                    <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                    <abbr title="email"></abbr> 
                  </address>
                </div>
                <div class="col-lg-4 col-md-4">
                  <h3>Address3</h3>
                  <address>
                    <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                    <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                    <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                    <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                    <abbr title="email"></abbr> 
                  </address>
                </div>
              </div>
            </div>
          </div>
        </div>
          <?php
        }
        ?>
<!--
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Maharashtra
              </button>
            </h5>
          </div>
          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <h3>Address1</h3>
                  <address>
                    <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                    <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                    <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                    <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                    <abbr title="email"></abbr> 
                  </address>
                </div>
                <div class="col-lg-4 col-md-4">
                  <h3>Address2</h3>
                  <address>
                    <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                    <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                    <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                    <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                    <abbr title="email"></abbr> 
                  </address>
                </div>
                <div class="col-lg-4 col-md-4">
                  <h3>Address3</h3>
                  <address>
                    <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                    <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                    <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                    <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                    <abbr title="email"></abbr> 
                  </address>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Gujarat
              </button>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <h3>Address1</h3>
                  <address>
                    <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                    <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                    <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                    <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                    <abbr title="email"></abbr> 
                  </address>
                </div>
                <div class="col-lg-4 col-md-4">
                  <h3>Address2</h3>
                  <address>
                    <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                    <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                    <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                    <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                    <abbr title="email"></abbr> 
                  </address>
                </div>
                <div class="col-lg-4 col-md-4">
                  <h3>Address3</h3>
                  <address>
                    <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                    <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                    <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                    <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                    <abbr title="email"></abbr> 
                  </address>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Chhattisgarh
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <h3>Address1</h3>
                  <address>
                    <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                    <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                    <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                    <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                    <abbr title="email"></abbr> 
                  </address>
                </div>
                <div class="col-lg-4 col-md-4">
                  <h3>Address2</h3>
                  <address>
                    <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                    <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                    <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                    <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                    <abbr title="email"></abbr> 
                  </address>
                </div>
                <div class="col-lg-4 col-md-4">
                  <h3>Address3</h3>
                  <address>
                    <strong>Pallaki Enclave, Plot No 44, </strong><br> 3rd Floor, Municipal Plots, <br>Bapuji Nagar, Udayagiri Road,<br>Kavali, Nellore Dist-524201<br>Andhra Pradesh.
                    <div class="address-align"><abbr class="phone-icon" title="Phone">Ph:</abbr> 08626 - 251777</div>
                    <div class="address-align"> <span class="mobile-icon"></span>+91 7036356760</div>
                    <div class="address-align"> <span class="email-icon"></span>projects@mannschaftit.com</div>
                    <abbr title="email"></abbr> 
                  </address>
                </div>
              </div>
            </div>
          </div>
        </div>
-->
      </div>
    </div>
  </div>
</section>
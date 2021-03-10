
      <!-- slider starts -->
      <section class="slider-wrp">
         <div class="container-fluid">
            <div class="row">
               <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                     <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                     <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                     <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                   <!--
                     <div class="carousel-item active">
                        <img src="<?php echo base_url(); ?>design/images/slide1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                           <h5>First slide label</h5>
                           <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                        </div>
                     </div>
                   -->
                     <?php
                     if( ! empty($slides))
                     {
                       $i = 1;
                       foreach($slides as $slide)
                       {
                         ?>
                     <div class="carousel-item <?php if($i==1){echo 'active';} ?>">
                        <img src="<?php echo base_url(); ?>uploads/slider/<?php echo $slide->slider_img; ?>" class="d-block w-100" alt="...">
                        <!-- <img src="<?php echo HTTP_BASE_PATH;?>uploads/slider/<?php echo $rec->slider_img;?>" class="img-fluid" alt="image1" title="image1"> -->
                        <div class="carousel-caption d-none d-md-block">
                           <h5><?php echo $slide->slider_title; ?></h5>
                           <p><?php echo $slide->slider_caption; ?></p>
                        </div>
                     </div>
                         <?php
                         $i++;
                       }
                     }
                     ?>
                     <!--
                     <div class="carousel-item">
                        <img src="<?php echo base_url(); ?>design/images/1.jpeg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                           <h5>Second slide label</h5>
                           <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <img src="<?php echo base_url(); ?>design/images/2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                           <h5>Third slide label</h5>
                           <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                        </div>
                     </div>
                   -->
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                  </a>
               </div>
               <div class="find-locWrapper" style="display: none;">
                  <div class="find-location">
                     <div class="col-lg-12 col-md-12">
                        <h3 class="form__title">Select
                           <span class="form__mark">
                           <span class="form__mark-text">Your Location</span>
                           </span>
                        </h3>
                        <select class="state_select">
                           <option>Select Your State</option>
                           <option>Andhra Pradesh</option>
                           <option>Telangana</option>
                           <option>Karnataka</option>
                        </select>
                        <button class="btn btn-primary btn_submit">Submit</button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <?php
               if( ! empty($this->session->flashdata('member_register_success')))
               {
                  ?>
               <p class="alert alert-success">
                  <?php echo $this->session->flashdata('member_register_success'); ?>
               </p>
                  <?php
               }
               if( ! empty($this->session->flashdata('member_register_error')))
               {
                  ?>
               <p class="alert alert-danger">
                  <?php echo $this->session->flashdata('member_register_error'); ?>
               </p>
                  <?php
               }
               if( ! empty($this->session->flashdata('partner_register_success')))
               {
                  ?>
               <p class="alert alert-success">
                  <?php echo $this->session->flashdata('partner_register_success'); ?>
               </p>
                  <?php
               }
               if( ! empty($this->session->flashdata('partner_register_error')))
               {
                  ?>
               <p class="alert alert-danger">
                  <?php echo $this->session->flashdata('partner_register_error'); ?>
               </p>
                  <?php
               }
               ?>
            </div>
         </div>
      </section>
      <!-- slider ends -->
            
      <section class="about_us">
         <div class="container">
            <h2>Indian Road Safety Club</h2>
            <p><span class="Title_name">IRS CLUB</span> is established by Motor Vehicles Inspectors Association, Andhra Pradesh.
               The motive of <span class="Title_name">IRS CLUB</span> is to support Road safety in the country with our local partners like Educational institutions,volunteers and whoever involved in social welfare activities.
               The <span class="Title_name">IRS CLUB</span> supports Foundation Flagship safe Roads for all, Safety Roads implementation with association of State Police, Law, Medical, Technical Engineers, NGO’s and Policy Makers. 
               The <span class="Title_name">IRS CLUB</span> focus on Ensuring the safety and well-being of local communities living along the National, State Highways and on all roads of the country.
               The <span class="Title_name">IRS CLUB</span> feels Road Safety is Vital for all the young people. It is never too early to teach them about basic safety skills in particular, Children are at high risk because
            </p>
            <ul>
               <li> They are smaller, so find it harder to see, and be seen by, Drivers.</li>
               <li>They are less able to recognise dangerous situations and lack of    
                  Mortality to make good decisions about the safe behaviour.
               </li>
               <li>They are physically smaller and so are more likely to hurt by an   
                  impact.
               </li>
            </ul>
            <p>The <span class="Title_name">IRS CLUB</span> can protect children by teaching them life saving skill and messages.
               The IRS Club making young people aware of risk and providing them with strategies to remain safe are important parts of their development.
               The IRS Club is going to engage children and young people on road Safety platform. Even the youngest child will know something about it because every one uses Road and road safety impacts everyone.
            </p>
            <h5>KEY PRINCIPLES OF <span class="Title_name">IRS CLUB</span>:</h5>
            <ul>
               <li>Awareness on traffic and its dangers.</li>
               <li>Good Behaviour around roads.</li>
               <li>Making safe choices to keep you and others safe.</li>
               <li>Making Law accessible to all.</li>
               <li>Medical camps to Public Transport Drivers.</li>
               <li><span class="Title_name">IRS CLUB</span> members.</li>
            </ul>
            <p>The <span class="Title_name">IRS CLUB</span> team delivers Professional and conscientious services to the people of the country, and remain committed to reducing the human cost on road crashes.</p>
         </div>
      </section>
      <section class="abt_wrap">
         <div class="container">
            <h3 class="form__title" style="display: none;">Our 
               <span class="form__mark">
               <span class="form__mark-text">App Features</span>
               </span>
            </h3>
            <h3 class="heading_h3">App Features</h3>
            <div class="row">
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center mb30">
                  <a href="">
                     <div class="ourappInwrap">
                        <div><img src="<?php echo base_url(); ?>design/images/add-post.png" class="img-fluid"></div>
                        <span class="form__mark">
                        <span class="form__mark-text">Add Posts</span>
                        </span>
                     </div>
                  </a>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center mb30">
                  <a href="">
                     <div class="ourappInwrap">
                        <div><img src="<?php echo base_url(); ?>design/images/contacts.png" class="img-fluid"></div>
                        <span class="form__mark">
                        <span class="form__mark-text">Contacts</span>
                        </span>
                     </div>
                  </a>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center mb30">
                  <a href="">
                     <div class="ourappInwrap">
                        <div><img src="<?php echo base_url(); ?>design/images/create-group.png" class="img-fluid"></div>
                        <span class="form__mark">
                        <span class="form__mark-text">Create groups</span>
                        </span>
                     </div>
                  </a>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                  <a href="">
                     <div class="ourappInwrap mtop30">
                        <div><img src="<?php echo base_url(); ?>design/images/write-a-note.png" class="img-fluid"></div>
                        <span class="form__mark">
                        <span class="form__mark-text">Dairy</span>
                        </span>
                     </div>
                  </a>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                  <a href="http://localhost/IRS/front/gallery/gallery_photos">
                     <div class="ourappInwrap mtop30">
                        <div><img src="<?php echo base_url(); ?>design/images/photos.png" class="img-fluid"></div>
                        <span class="form__mark">
                        <span class="form__mark-text">Photos</span>
                        </span>
                     </div>
                  </a>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-center">
                  <a href="http://localhost/IRS/front/gallery/gallery_videos">
                     <div class="ourappInwrap mtop30">
                        <div><img src="<?php echo base_url(); ?>design/images/videos.png" class="img-fluid"></div>
                        <span class="form__mark">
                        <span class="form__mark-text">Videos</span>
                        </span>
                     </div>
                  </a>
               </div>
            </div>
         </div>
      </section>
      <section class="testimonials" onscroll="myFunction()">
         <!-- Slideshow container -->
         <div class="slideshow-container">
            <h2 style="display: inline-block;width:100%;text-align: center;margin-bottom: 30px;">Testmonials</h2>
            <!-- Full-width slides/quotes -->
            <div class="mySlides">
               <div class="testimo"><img src="<?php echo base_url(); ?>design/images/r1.jpg"></div>
               <q>I love you the more in that I believe you had liked me for my own sake and for nothing else</q>
               <p class="author">- John Keats</p>
            </div>
            <div class="mySlides">
               <div class="testimo"><img src="<?php echo base_url(); ?>design/images/r1.jpg"></div>
               <q>But man is not made for defeat. A man can be destroyed but not defeated.</q>
               <p class="author">- Ernest Hemingway</p>
            </div>
            <div class="mySlides">
               <div class="testimo"><img src="<?php echo base_url(); ?>design/images/r1.jpg"></div>
               <q>I have not failed. I've just found 10,000 ways that won't work.</q>
               <p class="author">- Thomas A. Edison</p>
            </div>
            <!-- Next/prev buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
         </div>
         <!-- Dots/bullets/indicators -->
         <div class="dot-container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
         </div>
      </section>
      <section class="ministers_wrap">
         <div class="container">
            <h2 style="display: inline-block;width:100%;text-align: center;margin-bottom: 30px;text-transform: uppercase;">Our Ministers</h2>
            <div class="row" style="display: none;">
               <div class="col-lg-4 col-md-4"><img src="https://irsc.road-safety.co.in/static/home/img/people/Venkaiah.jpg" style="border-radius: 50%; height: 130px; width: 130px;  display: inline-block;"></div>
               <div class="col-lg-8 col-md-8"></div>
            </div>
            <div class="row">
               <div class="col-lg-4 col-md-4 xol-sm-12 col-xs-12 text-center" style="display: none;">
                  <div class="card" style="width: 18rem;margin:0 auto;">
                     <img src="https://irsc.road-safety.co.in/static/home/img/people/Venkaiah.jpg" class="card-img-top" alt="...">
                     <div class="card-body">
                        <h4>
                        Shri Venkaiah Naidu, Hon’ble Vice President of India</h3>
                        <p class="card-text">“ I am happy to know that Indian Road Safety Campaign, Solve has launched iSAFE - The Safer India Challenge 2019 to reduce road traffic injuries.”</p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4 xol-sm-12 col-xs-12 text-center">
                  <div class="card" style="width: 18rem;margin:0 auto;">
                     <img src="https://irsc.road-safety.co.in/static/home/img/people/nitin.png" class="card-img-top" alt="...">
                     <div class="card-body">
                        <h4>
                        Shri Nitin Gadkari, Hon’ble Minister of Road Transport and Highways of India</h3>
                        <p class="card-text">“ Glad to know that Indian Road Safety Campaign, Solve is working towards road safety awareness all over the India by involving IIT students”.</p>
                     </div>
                  </div>
               </div>
               <!-- added ministers start -->
               <div class="col-lg-4 col-md-4 xol-sm-12 col-xs-12 text-center">
                  <div class="card" style="width: 18rem;margin:0 auto;">
                     <!-- <img src="https://irsc.road-safety.co.in/static/home/img/people/Venkaiah.jpg" class="card-img-top" alt="..."> -->
                     <img src="<?php echo base_url(); ?>rta_assets/ministers/jagan.jpg">
                     <div class="card-body">
                        <h4>
                        Shri Y.S. Jaganmohan Reddy, Hon’ble Chief Minister, Andhra Pradesh</h3>
                        <p class="card-text" style="display: none;">“ I am happy to know that Indian Road Safety Campaign, Solve has launched iSAFE - The Safer India Challenge 2019 to reduce road traffic injuries.”</p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4 xol-sm-12 col-xs-12 text-center">
                  <div class="card" style="width: 18rem;margin:0 auto;">
                     <!-- <img src="https://irsc.road-safety.co.in/static/home/img/people/Venkaiah.jpg" class="card-img-top" alt="..."> -->
                     <img src="<?php echo base_url(); ?>rta_assets/ministers/perni_nani.jpg">
                     <div class="card-body">
                        <h4>
                        Shri Perni Venkataramaiah, Hon’ble Transport Minister, Andhra Pradesh</h3>
                        <p class="card-text" style="display: none;">“ I am happy to know that Indian Road Safety Campaign, Solve has launched iSAFE - The Safer India Challenge 2019 to reduce road traffic injuries.”</p>
                     </div>
                  </div>
               </div>
               <!-- added ministers end -->
               <div class="col-lg-4 col-md-4 xol-sm-12 col-xs-12 text-center" style="display: none;">
                  <div class="card" style="width: 18rem;margin:0 auto;">
                     <img src="https://irsc.road-safety.co.in/static/home/img/people/pramod.jpg" class="card-img-top" alt="...">
                     <div class="card-body">
                        <h4>
                        Shri Pramod Sawant, Hon’ble Chief Minister, Goa</h3>
                        <p class="card-text">“People's safety on road is one of the most important aspects. I appreciate Indian Road Safety Campaign, Solve for undertaking initiatives aimed at making roads a safe place for all the citizens while commuting.”</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="our_clients">
         <div class="container">
            <h2 style="display: inline-block;width:100%;text-align: center;margin-bottom: 30px;text-transform: uppercase;color:#ffffff;">Our Partners</h2>
            <div class="brand-carousel  owl-carousel">
               <div class="single-logo">
                  <img src="<?php echo base_url(); ?>design/images/brand-1.png" alt="">
               </div>
               <div class="single-logo">
                  <img src="<?php echo base_url(); ?>design/images/brand-2.png" alt="">
               </div>
               <div class="single-logo">
                  <img src="<?php echo base_url(); ?>design/images/brand-3.png" alt="">
               </div>
               <div class="single-logo">
                  <img src="<?php echo base_url(); ?>design/images/brand-4.png" alt="">
               </div>
               <div class="single-logo">
                  <img src="<?php echo base_url(); ?>design/images/brand-5.png" alt="">
               </div>
               <div class="single-logo">
                  <img src="<?php echo base_url(); ?>design/images/brand-6.png" alt="">
               </div>
            </div>
         </div>
      </section>
      <section class="mem_part_countWrap">
         <div class="numbers">
            <div class="container">
               <div class="row">
                  <ul class="numbers__list">
                     <li class="numbers__list-item col-md-3 col-lg-3">
                        <h3 class="numbers__value" id="value">100 000+</h3>
                        <span class="form__mark">
                        <span class="form__mark-text">IRS Members</span>
                        </span>
                        <p class="numbers__desc"></p>
                     </li>
                     <li class="numbers__list-item col-md-3 col-lg-3">
                        <h3 class="numbers__value" id="value1">10 000+</h3>
                        <span class="form__mark">
                        <span class="form__mark-text">IRS Partners</span>
                        </span>
                        <p class="numbers__desc"></p>
                     </li>
                     <li class="numbers__list-item col-md-3 col-lg-3">
                        <h3 class="numbers__value" id="value2">70 000+</h3>
                        <span class="form__mark">
                        <span class="form__mark-text">IRS Voluntaries</span>
                        </span>
                        <p class="numbers__desc"></p>
                     </li>
                     <li class="numbers__list-item col-md-3 col-lg-3">
                        <h3 class="numbers__value" id="value3">1000+</h3>
                        <span class="form__mark">
                        <span class="form__mark-text">IRS Sponsors</span>
                        </span>
                        <p class="numbers__desc"></p>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </section>
      <section class="roadsafety">
         <div class="container">
            <h2>Road Safety Precautions</h2>
            <div class="row">
               <div class="col-lg-6 col-md-6">
                  <div class="accordion" id="accordionExample">
                     <div class="card">
                        <div class="card-header" id="headingOne">
                           <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Precaution #1
                              </button>
                           </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                           <div class="card-body">
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-header" id="headingTwo">
                           <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Precaution #2
                              </button>
                           </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                           <div class="card-body">
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-header" id="headingThree">
                           <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Precaution #3
                              </button>
                           </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                           <div class="card-body">
                              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6"></div>
            </div>
         </div>
      </section>
      
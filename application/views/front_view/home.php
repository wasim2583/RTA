
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
      <section class="abt_wrap" style="display:none;">
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
          
            <!-- Full-width slides/quotes -->
            <div class="mySlides">
               <div class="testimo"><img src="<?php echo base_url(); ?>design/images/IAS.jpg"></div>
               <p class="testi-textCenter">I am glad to note that the Andhra Pradesh Transport Department Technical Officer's Association are bringing out a IRSCLUB, The website key statistical and other information which will be very useful to the Members and Partners. I wish that the executive officers of the Transport Department discharge their duties efficiently through their enforcement performance and Road safety activities and to enhance the image of the Department.</p>
               <p class="author">- <b>Sri. M.T.Krishna Babu, I.A.S.</b><br>( Principal Secretary to Government )</p>
            </div>
            <div class="mySlides">
               <div class="testimo"><img src="<?php echo base_url(); ?>design/images/IPS.jpg"></div>
               <p class="testi-textCenter">I am glad to note that Association of Andhra Pradesh Transport Department Technical Officers Association is bringing out IRS CLUB containing the information relating to important Circulars, G.O's and other important matters issued in the Transport Department which will be useful to all the Staff and Ofiicers, I appreciate the efforts of the Association in compiling the information for the benefit of the Club Members and Partners <br> I hope all of us will put in our best efforts to improve the image and performance of the Department and work hard to provide better Online services to citizens and Road Safety activities I wish all success in all their endeavors.</p>
               <p class="author">- <b>Sri. P.S.R. Anjaneyalu, I.P.S.</b><br>( Transport Commissioner Andhra Pradesh )</p>
            </div>
            <div class="mySlides">
               <div class="testimo"><img src="<?php echo base_url(); ?>design/images/TransportDept.jpg"></div>
               <p class="testi-textCenter">The role of technical officers is very important to the Department in terms of enforcing the provisions of Motor Vehicles Act and the Andhra Pradesh Motot vehicles Taxation Act. I request all the members of IRS CLUB to put forth their efforts to improve the image of Transport Department in the state.</p>
               <p class="author">- <b>Sri. S.A.V. Prasada Rao</b><br>( Additional Transport Commissioner Transport Department, Andhra Pradesh )</p>
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
                       
                        <p class="card-text">“ I am happy to note that the Association of Transport Department Technical Officers is bringing out a IRS CLUB I am told that the IRS will have useful information about the important circulars, GO's and other matters related to the Transport Department and key statistical information on Road Safety. I hope the IRS and information will serve the intended purpose and will be useful to the Association members and others.”</p>
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
                        <p class="card-text">“ I am happy to know that the A.P. Transport Department Technical Officers Association bringing out IRS CLUB in the public containing all the information which will be useful to all the officers of Transport Department. I wish this IRS CLUB in a ready reckoner. I sincerely congratulate every member of the IRS CLUB for their tremendous service to improve road safety. I wish all the best to all the IRS CLUB members and partners.”</p>
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
                              Video Of The Day
                              </button>
                           </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                           <div class="card-body">
                              <iframe width="100%" height="315" src="https://www.youtube.com/embed/MeT7WJVz5C4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-header" id="headingTwo">
                           <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Photo Of The Day
                              </button>
                           </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                           <div class="card-body">
                             <img src="<?php echo base_url(); ?>design/images/2.jpg" alt="" style="max-width:100%">
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-header" id="headingThree">
                           <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              News Of The Day
                              </button>
                           </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                           <div class="card-body">
                              <div class="row">
                              <div class="col-lg-4">
                                 <img src="https://akm-img-a-in.tosshub.com/indiatoday/images/story/202103/yuvrajsinghroadsafety_1200x768.jpeg" alt="" style="max-width:100%">
                              </div>
                              <div class="col-lg-6">
                                 Road Safety World Series: Yuvraj Singh smashes 4 sixes in a row after Sachin Tendulkar's 37-ball 60
                              </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6"></div>
            </div>
         </div>
      </section>
      
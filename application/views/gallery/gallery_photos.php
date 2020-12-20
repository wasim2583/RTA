<section class="GallryWrap">
   <div class="continer-fluid">
      <div class="container">
         <div class="row">
            <div class="col-2" id="location_filters">
               <h3>Filter By</h3>
               <form id="location_filters_form">
                  <div class="nav flex-column nav-pills statesNav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                     
                     <h3>States</h3>
                     <ul class="list-group" id="states_list">
                        <?php
                        if( ! empty($states))
                        {
                           foreach($states as $state)
                           {
                              ?>
                        <li class="list-group-item">
                           
                           <input type="checkbox" name="states[]" id="<?php echo $state->id;?>" value="<?php echo $state->id;?>" class="form-check-input me-1">
                           <?php echo $state->state_name; ?>
                        </li>
                              <?php
                           }
                        }
                        ?>
                     </ul>
                     
                  </div>
                  <div class="nav flex-column nav-pills statesNav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                     
                     <h3>Locations</h3>
                     <div id="locations_message">please select state to load locations</div>
                     <ul class="list-group" id="locations_list">
                     </ul>
                     
                  </div>
               </form>
                  
            </div>
            <div class="col-10">
               <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-photos" role="tabpanel" aria-labelledby="v-pills-home-tab">
                     <div class="col-md-12">
                        <div class="row">
                           <div class="gal" id="Matched_photos">
                              <?php
                              if( ! empty($photos))
                              {
                                 foreach($photos as $photo)
                                 {
                                    ?>
                              <div class="photo_wrap">
                                 <a href="<?php echo base_url().'uploads/files/'.$photo->file_name; ?>" data-lightbox="gallery" target="_blank">
                                    <img src="<?php echo base_url().'uploads/files/'.$photo->file_name; ?>" class="img-fluid">
                                 </a>
                                 <span><?php echo $photo->name; ?></span>
                                 <p><?php echo $photo->description; ?><br>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                              </div>
                                    <?php
                                 }
                              }
                              ?>
                              <!--
                              <div class="photo_wrap">
                                 <img src="https://www.setaswall.com/wp-content/uploads/2017/08/1440x2960-HD-Wallpaper-107.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/mWpE3Q/2.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/i0PmHk/1.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/mysOxk/3.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/i0PmHk/1.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/mWpE3Q/2.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://c4.wallpaperflare.com/wallpaper/500/442/354/outrun-vaporwave-hd-wallpaper-preview.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/mysOxk/3.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/i0PmHk/1.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/i0PmHk/1.jpg" alt=""><img src="https://preview.ibb.co/i0PmHk/1.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/i0PmHk/1.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/i0PmHk/1.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/i0PmHk/1.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/i0PmHk/1.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/mysOxk/3.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/mysOxk/3.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/i0PmHk/1.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/i0PmHk/1.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/i0PmHk/1.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                              <div class="photo_wrap">
                                 <img src="https://preview.ibb.co/mWpE3Q/2.jpg" alt="">
                                 <span>Name Name Name Name</span>
                                 <p>Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's </p>
                              </div>
                           -->
                           </div>
                        </div>
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
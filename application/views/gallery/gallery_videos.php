<section class="GallryWrap">
   <div class="continer-fluid">
      <div class="container">
         <div class="row">
            <div class="col-2">
               
               <div class="nav flex-column nav-pills statesNav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <div id="states">
                     <h3>States</h3>
                     <ul class="list-group">
                        <li class="list-group-item">
                           <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                           Andhra Pradesh
                        </li>
                        <li class="list-group-item">
                           <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                           Tamilnadu
                        </li>
                        <li class="list-group-item">
                           <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                           Maharashtra
                        </li>
                        <li class="list-group-item">
                           <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                           Karnataka
                        </li>
                        <li class="list-group-item">
                           <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                           Kerala
                        </li>
                     </ul>
                  </div>                     
               </div>
               <div class="nav flex-column nav-pills statesNav" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <div id="locations">
                     <h3>Location</h3>
                     <ul class="list-group">
                        <li class="list-group-item">
                           <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                           Nellore
                        </li>
                        <li class="list-group-item">
                           <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                           Kavali
                        </li>
                        <li class="list-group-item">
                           <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                          Guntur
                        </li>
                        <li class="list-group-item">
                           <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                           Kadapa
                        </li>
                        <li class="list-group-item">
                           <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                           Gudur
                        </li>
                     </ul>
                  </div>                     
               </div>
            </div>
            <div class="col-10">
               <div class="tab-content" id="v-pills-tabContent">
                  <div class="videotab tab-pane fade show active" id="v-pills-videos" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                     <div class="col-12">
                        <div class="row">
                           <?php
                           if( ! empty($videos))
                           {
                              foreach($videos as $vid)
                              {
                                 ?>
                           <div class="col-6">
                              <div class="embed-responsive embed-responsive-16by9">
                                 <iframe  class="embed-responsive-item" src="https://www.youtube.com/embed/PqeMkdU8fac" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div>
                           </div>
                                 <?php
                              }
                           }
                           ?>
                           <div class="col-6">
                              <div class="embed-responsive embed-responsive-16by9">
                                 <iframe  class="embed-responsive-item" src="https://www.youtube.com/embed/PqeMkdU8fac" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div>
                           </div>
                           <div class="col-6">
                              <div class="embed-responsive embed-responsive-16by9">
                                 <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/74MRP5fRKwM" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div>
                           </div>
                           <div class="col-6">
                              <div class="embed-responsive embed-responsive-16by9">
                                 <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/XTUnz-A_uuU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div>
                           </div>
                           <div class="col-6">
                              <div class="embed-responsive embed-responsive-16by9">
                                 <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/obbeAhXIp7g" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div>
                           </div>
                           <div class="col-6">
                              <div class="embed-responsive embed-responsive-16by9">
                                 <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/CB2A5knBMjs" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                              </div>
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
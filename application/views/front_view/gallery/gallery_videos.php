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
                  <div class="videotab tab-pane fade show active" id="v-pills-videos" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                     <div class="col-12">
                        <div class="row" id="Matched_videos">                           
                           <?php
                           if( ! empty($videos))
                           {
                              foreach($videos as $vid)
                              {
                                 $url = $vid->url;
                                 $ytarray = explode("/", $url);
                                 $ytendstring = end($ytarray);
                                 $ytendarray = explode("?v=", $ytendstring);
                                 $ytendstring = end($ytendarray);
                                 $ytendarray = explode("&", $ytendstring);
                                 $ytcode = $ytendarray[0];
                                 ?>
                           <div class="col-6">
                              <div class="embed-responsive embed-responsive-16by9">
                                 <!-- <iframe  class="embed-responsive-item" src="<?php  ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                                 <iframe class="embed-responsive-item" width="100%" src="http://www.youtube.com/embed/<?php echo $ytcode; ?>" frameborder="0" allowfullscreen></iframe>
                              </div>
                           </div>
                                 <?php
                              }
                           }
                           ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12 inventory">
               <?php echo $links;?>
            </div>
         </div>
      </div>
   </div>
</section>
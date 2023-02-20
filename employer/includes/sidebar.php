<div class="col-lg-3 col-md-4">
  <div class="account_dt_left">
    <div class="job-center-dt">
      <img src="<?php echo $url?>/<?php echo $result['imageLink']?>" alt="">
      <div class="job-urs-dts">
        <div class="dp_upload">
          <input type="file" id="file">
          <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-add-ticket"><i class="fa fa-camera"></i> Change</a>
        </div>

       
         <?php
        if ($result['profileStatus'] == 1){
            echo ' <h4>'.$result['fullName'].' <i class="fas fa-check-circle verified_sign"></i></h4>';
        }else{
            echo ' <h4>'.$result['fullName'].' <i class="fas fa-times-circle unverified_sign"></i></h4>';
            
        }
        ?>
        <a href="personal-information.php"><button class="btn btn-info btn-sm"><i class="fa fa-user"></i> My Profile Info</button></a><br>
        <div class="mt-20">
        <span class="label label-success">Employer Profile</span>
        </div>
        <div class="exp145 text-center mt-2">
          Joined : <span><?php echo $result['joinDate']?></span>
        </div>
      </div>
    </div>
    <div class="my_websites">
      <ul>
        <li><a href="#" class="web_link"><i class="fas fa-envelope"></i><?php echo $result['emailAddress']?></a></li>
        <li><a href="#" class="web_link"><i class="fas fa-mobile"></i><?php echo $result['mobileNo']?></a></li>
      </ul>
    </div>
    <!-- <div class="group_skills_bar">
      <h6>Profile Completeness</h6>
      <div class="group_bar1">
        <span>100%</span>
        <div class="progress skill_process">
          <div class="progress-bar progress_bar_skills" role="progressbar" style="width: 100%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
      <a href="#" class="skiils_button">Complete Required Skills</a> 
    </div> -->
    
    <div class="rlt_section">
      <div class="rtl_left">
        <h6>Location</h6>
      </div>
      <div class="rtl_right">
        <span><i class="fas fa-map-marker-alt lc_icon"></i> <?php echo $result['district']?>, <?php echo $result['country']?></span>
      </div>
      <div class="my_location">
        <div id="map"></div>
      </div>
      
    </div>
    
  </div>
</div>
 <header class="main-header"> 
  <!-- Logo --> 
  <a href="<?php echo $url;?>/mydashboard/" class="logo blue-bg"> 
    <!-- mini logo for sidebar mini 50x50 pixels --> 
    <span class="logo-mini"><img src="<?php echo $url;?>/admin/images/logo2.jpg" style="height: 40px; width: 38px; border-radius: 30px;" alt=""></span> 
    <!-- logo for regular state and mobile devices --> 
    <span class="logo-lg"><img src="<?php echo $url;?>/admin/images/logo2.jpg" alt="" style="border-radius: 30px;height: 50px; width: 150px;"></span> </a> 
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar blue-bg navbar-static-top"> 
      <!-- Sidebar toggle button-->
      <ul class="nav navbar-nav pull-left">
        <li><a class="sidebar-toggle" data-toggle="push-menu" href=""></a> </li>
      </ul>
      <div class="pull-left search-box">
        <form action="#" method="get" class="search-form">
          <div class="input-group">
            <input name="search" class="form-control" placeholder="Search..." type="text">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> </button>
            </span></div>
          </form>
          <!-- search form --> </div>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope-o"></i>
                <!-- <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> -->
              </a>
              <ul class="dropdown-menu">
                <!-- <li class="header">You have 4 new messages</li> -->
                <li>
                  <ul class="menu">

                  


                  </ul>
                </li>
                <li class="footer"><a href="<?php echo $url;?>/mod/settings/messages.php">View All Messages</a></li>
              </ul>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown messages-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i>
              <!-- <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> -->
            </a>
            <ul class="dropdown-menu">
              <li class="header">Notifications</li>
              <li>
                <ul class="menu">
                  <!-- <li><a href="#">
                    <div class="pull-left icon-circle red"><i class="icon-lightbulb"></i></div>
                    <h4>Alex C. Patton</h4>
                    <p>I've finished it! See you so...</p>
                    <p><span class="time">9:30 AM</span></p>
                    </a></li>
                  <li><a href="#">
                    <div class="pull-left icon-circle blue"><i class="fa fa-coffee"></i></div>
                    <h4>Nikolaj S. Henriksen</h4>
                    <p>I've finished it! See you so...</p>
                    <p><span class="time">1:30 AM</span></p>
                    </a></li>
                  <li><a href="#">
                    <div class="pull-left icon-circle green"><i class="fa fa-paperclip"></i></div>
                    <h4>Kasper S. Jessen</h4>
                    <p>I've finished it! See you so...</p>
                    <p><span class="time">9:30 AM</span></p>
                    </a></li>
                  <li><a href="#">
                    <div class="pull-left icon-circle yellow"><i class="fa  fa-plane"></i></div>
                    <h4>Florence S. Kasper</h4>
                    <p>I've finished it! See you so...</p>
                    <p><span class="time">11:10 AM</span></p>
                  </a></li> -->
                </ul>
              </li>
              <li class="footer"><a href="#">Check all Notifications</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo $url;?>/admin/<?php echo $_SESSION['image'];?>" class="user-image" alt="User Image"> <span class="hidden-xs"><?php echo $_SESSION['username'];?></span> </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <div class="pull-left user-img"><img src="<?php echo $url;?>/admin/<?php echo $_SESSION['image'];?>" class="img-responsive" alt="User"></div>
                <p class="text-left"><?php echo $_SESSION['full_name'];?> <small><?php echo $_SESSION['email'];?></small>
                 </p>
                <div class="view-link text-left"><a href="<?php echo $url;?>/mod/settings/view-profile.php">View Profile</a> </div>
              </li>
              <li><a href="<?php echo $url;?>/mod/settings/view-profile.php"><i class="icon-profile-male"></i> My Profile</a></li>
              <li><a href="#"><i class="icon-wallet"></i> My Notifications</a></li>
              <li><a href="<?php echo $url;?>/mod/settings/messages.php"><i class="icon-envelope"></i> Messages</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#"><i class="icon-gears"></i> Account Setting</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?php echo $url;?>/admin/logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
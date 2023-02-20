 <div class="sidebar"> 
  <!-- Sidebar user panel -->


  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">Work For All Admin Panel</li>
    <li > <a href="<?php echo $url;?>/admin/dashboard.php"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> <span class="pull-right-container">  </span> </a>

    </li>

    <li class="treeview"> <a href="#"> <i class="fa fa-users "></i> <span>Employer</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo $url;?>/admin/view-employer.php">View All Employer</a></li>
      </ul>
    </li>
    <li class="treeview"> <a href="#"> <i class="fa fa-users "></i> <span>Employee</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo $url;?>/mod/tickets/alltickets.php">View All Employer</a></li>
      </ul>
    </li>

    <li class="treeview"> <a href="#"> <i class="fa  fa-cogs"></i> <span>Settings</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
      <ul class="treeview-menu">

        <li><a href="<?php echo $url;?>/admin/mod/settings/admin.php">Admin</a></li>
        <li><a href="<?php echo $url;?>/mod/settings/site-settings.php">Site Settings</a></li>
        <li><a href="<?php echo $url;?>/mod/accounts/monthly-generator.php">Monthly Generator</a></li>
        <li><a href="<?php echo $url;?>/mod/settings/cron-jobs.php">Cron Jobs</a></li>
        <li><a href="<?php echo $url;?>/mod/settings/syslog.php">Syslog</a></li>

      </ul>
    </li>
       <!--  <li class="treeview"> <a href="#"> <i class="fa fa-map-marker"></i> <span>Maps</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="map-google.html">Google Maps</a></li>
            <li><a href="map-vector.html" class="active">Vector Maps</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-paint-brush"></i> <span>Icons</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="icon-fontawesome.html">Fontawesome Icons</a></li>
            <li><a href="icon-themify.html">Themify Icons</a></li>
            <li><a href="icon-linea.html">Linea Icons</a></li>
            <li><a href="icon-weather.html">Weather Icons</a></li>
            <li><a href="icon-simple-lineicon.html">Simple Lineicons</a></li>
            <li><a href="icon-flag.html">Flag Icons</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="fa fa-share"></i> <span>Multilevel</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="#">Level One</a></li>
            <li class="treeview"> <a href="#">Level One <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
              <ul class="treeview-menu">
                <li><a href="#"> Level Two</a></li>
                <li class="treeview"> <a href="#">Level Two <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                  <ul class="treeview-menu">
                    <li><a href="#">Level Three</a></li>
                    <li><a href="#">Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#">Level One</a></li>
          </ul>
        </li> -->
      </ul>
    </div>
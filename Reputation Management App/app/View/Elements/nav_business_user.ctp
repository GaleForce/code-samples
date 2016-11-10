<?php 
$controller=$this->params['controller'];
$action=$this->params['action'];
?>
<!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->
      <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
      <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
      <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
      <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
      <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
      <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
      <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
        <li class="sidebar-toggler-wrapper">
          <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
          <div class="sidebar-toggler">
          </div>
          <!-- END SIDEBAR TOGGLER BUTTON -->
        </li>
        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
        
        <li <?php if(($controller==='dashboard' && $action==='feedback') || ($controller==='dashboard' && $action==='feedBackSeeMore'))  { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/feedback/<?php echo $busid?>">
          <i class="icon-home"></i>
          <span class="title">Dashboard</span>
          <span class="selected"></span>
          <span class="arrow"></span>
          </a>
        </li>
        <li <?php if($controller==='dashboard' && $action==='businesSetup') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/businesSetup/<?php echo $busid?>">
          <i class="icon-wrench"></i>
          <span class="title">Setup</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if($controller==='dashboard' && $action==='visibility') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/visibility/<?php echo $busid?>">
          <i class="fa fa-binoculars"></i>
          <span class="title">Visibility</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if($controller==='dashboard' && $action==='contactManager') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/contactManager/<?php echo $busid?>">
          <i class="icon-users"></i>
          <span class="title">Manage Customers</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if($controller==='dashboard' && $action==='notification') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/notification/<?php echo $busid?>">
		  <i class="fa fa-envelope-o"></i>
          <span class="title">Email Templates</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if($controller==='dashboard' && $action==='reporting') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/reporting/<?php echo $busid?>">
		  <i class="icon-bar-chart"></i>
          <span class="title">Reporting</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if($controller==='dashboard' && $action==='businessUserTraining') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/businessUserTraining/<?php echo $busid?>">
          <i class="icon-book-open"></i>
          <span class="title">Training</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        
      </ul>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
  <!-- END SIDEBAR -->

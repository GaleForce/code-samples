<?php 
$controller=$this->params['controller'];
$action=$this->params['action'];
?>
<!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->
      <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="sidebar-toggler-wrapper">
          <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
          <div class="sidebar-toggler">
          </div>
          <!-- END SIDEBAR TOGGLER BUTTON -->
        </li>
        <li class="sidebar-search-wrapper">
          <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
          
          <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>
        <li <?php if(($controller==='Employee' && $action==='employeeFeedback') || ($controller==='Employee' && $action==='feedBackSeeMore'))  { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>Employee/employeeFeedback">
          <i class="icon-home"></i>
          <span class="title">Feedback</span>
          <span class="selected"></span>
          <span class="arrow"></span>
          </a>
        </li>
        <li <?php if($controller==='Employee' && $action==='index') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>Employee">
          <i class="icon-wrench"></i>
          <span class="title">Manage Customers</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if($controller==='Employee' && $action==='reporting') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>Employee/reporting/">
          <i class="icon-settings"></i>
          <span class="title">Reporting</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        
      </ul>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
  <!-- END SIDEBAR -->
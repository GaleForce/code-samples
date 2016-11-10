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
          <form class="sidebar-search " action="extra_search.html" method="POST">
            <a href="javascript:;" class="remove">
            <i class="icon-close"></i>
            </a>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
              <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
              </span>
            </div>
          </form>
          <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>
        <li <?php if($controller==='admin' && $action==='index' || $controller==='admin' && $action==='') {?>class="active"<?php }?> ><a href="<?php echo HTTP_ROOT?>admin/index">
          <i class="icon-home"></i>
          <span class="title">Agencies</span>
          <span class="selected"></span>
          <span class="arrow"></span>
          </a>
        </li>
        <li <?php if($controller==='admin' && $action==='agencyBusiness') {?>class="active"<?php }?> ><a href="<?php echo HTTP_ROOT?>admin/agencyBusiness">
          <i class="icon-wrench"></i>
          <span class="title">Businesses</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if($controller==='admin' && $action==='employees') {?>class="active"<?php }?> ><a href="<?php echo HTTP_ROOT?>admin/employees">
          <i class="icon-settings"></i>
          <span class="title">Employees</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if($controller==='admin' && $action==='customer') {?>class="active"<?php }?> ><a href="<?php echo HTTP_ROOT?>admin/customer">
          <i class="icon-users"></i>
          <span class="title">Customers</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if($controller==='admin' && $action==='category') {?>class="active"<?php }?> ><a href="<?php echo HTTP_ROOT?>admin/category">
          <i class="icon-bar-chart"></i>
          <span class="title">Manage Categories</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if($controller==='admin' && $action==='sites') {?>class="active"<?php }?> ><a href="<?php echo HTTP_ROOT?>admin/sites">
          <i class="icon-flag"></i>
          <span class="title">Manage Sites</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        
      </ul>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
  <!-- END SIDEBAR -->
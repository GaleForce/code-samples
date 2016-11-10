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
        <li class="sidebar-search-wrapper">
          <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
          <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
          <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
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
        <li <?php if(($controller==='dashboard' && $action==='index')||($controller==='dashboard' && $action==='')||($controller==='dashboard' && $action==='searchBusiness')){?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard">
          <i class="icon-home"></i>
          <span class="title">Dashboard</span>
          <span class="selected"></span>
          <span class="arrow"></span>
          </a>
        </li>
        <li <?php if(($controller==='dashboard' && $action==='admin')){?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/admin">
          <i class="icon-wrench"></i>
          <span class="title">Tools</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if(($controller==='agencysiteSettings' && $action==='index')||($controller==='agencysiteSettings' && $action==='')){?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>agencysiteSettings">
          <i class="icon-settings"></i>
          <span class="title">Site Settings</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if($controller==='dashboard' && $action==='manageUser'){?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/manageUser">
          <i class="icon-users"></i>
          <span class="title">Manage Users</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if(($controller==='businesses' && $action==='report') || ($controller==='businesses' && $action==='customerView')){?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>businesses/report">
          <i class="icon-bar-chart"></i>
          <span class="title">Reporting</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if(($controller==='dashboard' && $action==='visibilityAgency')){?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/visibilityAgency">
          <i class="icon-flag"></i>
          <span class="title">Visibility</span>
          <span class="arrow "></span>
          </a>
          
        </li>
        <li <?php if(($controller==='dashboard' && $action==='training')){?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/training">
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
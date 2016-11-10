<?php 
$controller=$this->params['controller'];
$action=$this->params['action'];
?>
<nav id="subnavbar" class="navbar">
    <div id="navbar" class="navbar-collapse collapse">
     <ul class="nav navbar-nav">
									 
									<li <?php if($controller==='dashboard' && $action==='feedback') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/feedback">Feedback</a></li>
									<li <?php if($controller==='dashboard' && $action==='mysite') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>AgencysiteSettings/businessUserSiteSetting">My Site</a></li>
									<li <?php if($controller==='dashboard' && $action==='visibility') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/visibility">Visibility</a></li>
                                    <li <?php if($controller==='dashboard' && $action==='contactManager') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/contactManager">Contact Manager</a></li>
                                     <li <?php if($controller==='dashboard' && $action==='notification') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/notification">Notifications</a></li>
                                     <li <?php if($controller==='dashboard' && $action==='reporting') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/reporting">Reporting</a></li>
                                     <li <?php if($controller==='dashboard' && $action==='businessUserTraining') { ?>class="active"<?php }?>><a href="<?php echo HTTP_ROOT?>dashboard/businessUserTraining">Training</a></li>
									
								</ul>
    </div>
</nav>
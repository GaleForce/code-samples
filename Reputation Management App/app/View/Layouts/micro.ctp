<?php


$cakeDescription = __d('cake_dev', 'Reputation Management System');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php echo $this->Html->script('jquery'); ?>
	<?php echo $this->Html->script('jquery.validate.min'); ?>
	<script type="text/javascript"> 
		</script>

	<!-- js files -->
	<?php echo $this->Html->script('jquery.min.js'); ?>
	<?php echo $this->Html->script('bootstrap.js'); ?>
	<?php echo $this->Html->script(array('common.js','custom.js'));?>
	<?php echo $this->Html->script('jquery.validate.js'); ?>
	<?php echo $this->Html->script('ckeditor/ckeditor.js'); ?>
	<!-- stylesheets -->

	<?php echo $this->Html->css('bootstrap.min.css'); ?>
	<?php echo $this->Html->css('repelev.css'); ?>
	<?php echo $this->Html->css('bootstrap-theme.min.css'); ?>

</head>
<body>
<div id="header">
			
			<div class="container">
				<div class="row">
				
					<div class="col-xs-3">
						<img src="<?php echo $this->webroot; ?>img/review-elevator.png" alt="Review Elevator" class="logo" />
					</div>
					
					<div class="col-xs-9">
					<button type="button" class="btn topicon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></button>
					<button type="button" class="btn topicon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
					<button type="button" class="btn topicon"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></button>
					</div>
					
					
					
				</div>
			</div>
				
				<nav class="navbar navbar-inverse">
					<div class="container">
						<div class="row">
							<div class="col-xs-3">
								<h1 class="maintitle">review <b>elevator</b></h1>
							</div>
						
						</div>
					</div>
				</nav>
				
			</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
		</div>
	</div>
	
</body>
</html>

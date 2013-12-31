<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title><?=$page_title;?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?=$page_description;?>">
	<meta name="author" content="<?=$page_author;?>">
	<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url();?>assets/css/application.css">
	<!--[if lt IE 9]>
	<script src="<?=base_url();?>assets/js/ie/ie8-responsive-file-warning.js"></script>
	<script src="<?=base_url();?>assets/js/ie/html5shiv.js"></script>
	<script src="<?=base_url();?>assets/js/ie/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<nav class="navbar navbar-fixed-top navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?=base_url();?>"><span class="text-primary"><?=$page_title;?></span></a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="<?=base_url();?>"><span class="glyphicon glyphicon-home"></span> Start</a></li>
				<!--<li><a href="#">Link</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li><a href="#">Separated link</a></li>
						<li class="divider"></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>-->
			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<div class="row row-offcanvas row-offcanvas-right">
		<div id="content" class="col-xs-12 col-sm-9">
			<p class="pull-right visible-xs">
				<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Pokaż ustawienia</button>
			</p>
<?=$content;?>
		</div>
		<div id="sidebar" class="col-xs-6 col-sm-3 sidebar-offcanvas">
<?=$sidebar;?>
		</div>
	</div>
	<hr>
	<footer>
		<p><?=$page_title;?> &copy; vbert 2013</p>
	</footer>
</div>
<!--Page rendered in: {elapsed_time} seconds-->
<!-- JSCRIPTS -->
<script src="<?=base_url();?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
	// toggle sidebar
	$('[data-toggle=offcanvas]').click(function() {
		$('.row-offcanvas').toggleClass('active');
	});
});
</script>
<?=$extend_js;?>
<!-- /JSCRIPTS -->
</body>
</html>
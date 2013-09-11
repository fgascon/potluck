<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo $this->assets;?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->assets;?>/css/style.css" rel="stylesheet">
	
    <!--[if lt IE 9]>
      <script src="<?php echo $this->assets;?>/js/html5shiv.js"></script>
    <![endif]-->
  </head>
  <body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Brand</a>
		</div>
		
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<?php foreach(array(
					'site/index'=>"Infos",
					'site/potluck'=>"Potluck",
				) as $url=>$label):?>
				<li class="<?php echo $this->route===$url ? 'active' : '';?>">
					<a href="<?php echo $this->createUrl($url);?>"><?php echo CHtml::encode($label);?></a>
				</li>
				<?php endforeach;?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="#">Action</a>
						</li>
						<li>
							<a href="#">Another action</a>
						</li>
						<li>
							<a href="#">Something else here</a>
						</li>
						<li>
							<a href="#">Separated link</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	
	<div class="container">
		<div class="content">
    		<?php echo $content;?>
		</div>
	</div>
	
    <script src="<?php echo $this->assets;?>/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

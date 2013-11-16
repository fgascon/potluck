<?php $this->beginContent('//layouts/main');?>
	
	<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo $this->createUrl('admin/index');?>">Admin</a>
		</div>
		
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<?php foreach(array(
					'admin/index'=>"Gestion Potluck",
					'user/index'=>"Users",
					'post/index'=>"Posts",
					'site/logout'=>"Logout",
				) as $url=>$label):?>
				<li class="<?php echo $this->route===$url ? 'active' : '';?>">
					<a href="<?php echo $this->createUrl($url);?>"><?php echo CHtml::encode($label);?></a>
				</li>
				<?php endforeach;?>
			</ul>
		</div>
	</nav>
	
	<div class="container">
		<div class="content admin-content clearfix">
    		<?php echo $content;?>
		</div>
	</div>
	
<?php $this->endContent();?>
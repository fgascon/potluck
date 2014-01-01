<?php $this->beginContent('//layouts/main');?>
	
	<nav class="navbar navbar-default container container-narrow" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				Myriam &amp; Fr&eacute;d&eacute;ric
				<!--<img src="<?php echo $this->assets;?>/images/logo.png" alt="Myriam &amp; Fr&eacute;d&eacute;ric" width="123" height="92">-->
			</a>
		</div>
		
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav navbar-right">
				<?php foreach(array(
					'site/info'=>"Infos",
					'site/potluck'=>"Potluck",
					'site/logout'=>"Quitter",
				) as $url=>$label):?>
				<li class="<?php echo $this->route===$url ? 'active' : '';?>">
					<a href="<?php echo $this->createUrl($url);?>"><?php echo CHtml::encode($label);?></a>
				</li>
				<?php endforeach;?>
			</ul>
		</div>
	</nav>
	
	<div id="content">
		<?php echo $content;?>
	</div>
	
<?php $this->endContent();?>

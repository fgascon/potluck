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
	
	<div class="container container-narrow<?php echo Yii::app()->user->presence === null ? "" : " hidden";?>">
		<div class="jumbotron">
			<p>Veuillez confirmer votre présence.</p>
			<p>
				<form method="post">
					<?php echo CHtml::link("Je serai présent", '#oui', array(
						'class'=>'btn btn-success btn-lg',
						'submit'=>array('/site/presence', 'presence'=>'oui'),
					));?>
					<?php echo CHtml::link("Je ne serai pas présent", '#non', array(
						'class'=>'btn btn-danger btn-lg',
						'submit'=>array('/site/presence', 'presence'=>'non'),
					));?>
				</form>
			</p>
		</div>
	</div>
	
	<div id="content">
		<?php echo $content;?>
	</div>
	
<?php $this->endContent();?>

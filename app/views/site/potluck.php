<?php Yii::app()->clientScript->registerPackage('jquery')->registerScriptFile($this->assets.'/js/app.js');?>

<section id="section-potluck" class="container container-narrow">
	
	<!--<div class="page-header">
		<h1>Potluck</h1>
	</div>-->
	
<?php foreach(Food::categoriesNames() as $category=>$categoryLabel):?>
	
	<div class="food-category panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo CHtml::encode($categoryLabel);?></h2>
		</div>
		<ul class="list-group">
		<?php foreach($foodsByCategories[$category] as $food):?>
			<li class="food list-group-item" data-id="<?php echo $food->id;?>">
				<input type="text" class="attr-description" placeholder="Inscrivez votre plat ici"<?php if(!empty($food->user_id) && $food->user_id!=Yii::app()->user->id):?> disabled="disabled"<?php endif;?>>
				<span class="attr-user<?php if(!$food->user_id) echo " hidden";?>">
					<small>Contribution de</small>
					<strong class="name"><?php if($food->user_id) echo CHtml::encode($food->user->name);?></strong>
				</span>
			</li>
		<?php endforeach;?>
		</ul>
	</div>
	
<?php endforeach;?>
</div>

<script>
App.endpoint = "<?php echo Yii::app()->request->baseUrl;?>";
jQuery(function($){
	App.setFood(<?php echo CJSON::encode($foods);?>);
	App.bindFood($('.food'));
});
</script>
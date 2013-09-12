<?php Yii::app()->clientScript->registerPackage('jquery')->registerScriptFile($this->assets.'/js/app.js');?>

<?php foreach(Food::categoriesNames() as $category=>$categoryLabel):?>
	
	<div class="food-category">
		<h2><?php echo CHtml::encode($categoryLabel);?></h2>
		<?php foreach($foodsByCategories[$category] as $food):?>
			<div class="food" data-id="<?php echo $food->id;?>">
				<input type="text" class="attr-description"<?php if(!empty($food->user_id) && $food->user_id!=Yii::app()->user->id):?> disabled="disabled"<?php endif;?>>
				<span class="attr-user">
					<?php if($food->user_id) echo CHtml::encode($food->user->name);?>
				</span>
			</div>
		<?php endforeach;?>
	</div>
	
<?php endforeach;?>

<script>
App.endpoint = "<?php echo Yii::app()->request->baseUrl;?>";
jQuery(function($){
	App.setFood(<?php echo CJSON::encode($foods);?>);
	App.bindFood($('.food'));
});
</script>
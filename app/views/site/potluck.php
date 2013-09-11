<?php foreach(Food::categoriesNames() as $category=>$categoryLabel):?>
	
	<h2><?php echo CHtml::encode($categoryLabel);?></h2>
	<div class="food-category">
	<?php foreach($foods[$category] as $food):?>
		<div>
			<?php if(empty($food->description)):?>
				<input type="text">
			<?php else:?>
				<?php echo CHtml::encode($food->description);?>
				<?php if($food->user_id):?>
					<?php echo CHtml::encode($food->user->name);?>
				<?php endif;?>
			<?php endif;?>
		</div>
	<?php endforeach;?>
	</div>
	
<?php endforeach;?>

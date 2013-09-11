
<div class="btn-toolbar">
	<div class="btn-group">
		<?php echo CHtml::link("Utilisateurs", array('user/index'), array('class'=>'btn btn-default'));?>
	</div>
	
	<div class="btn-group">
		<?php echo CHtml::link("Ajouter une entrée", array('addFood', 'category'=>Food::CAT_ENTRE), array('class'=>'btn btn-default'));?>
		<?php echo CHtml::link("Ajouter un plat principal", array('addFood', 'category'=>Food::CAT_PRINCIPAL), array('class'=>'btn btn-default'));?>
		<?php echo CHtml::link("Ajouter un dessert", array('addFood', 'category'=>Food::CAT_DESSERT), array('class'=>'btn btn-default'));?>
	</div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>new CActiveDataProvider('Food'),
	'itemsCssClass'=>'table table-striped',
	'columns'=>array(
		'categoryName',
		array(
			'name'=>'user.name',
			'header'=>"User",
		),
		'description',
		array(
			'class'=>'zii.widgets.grid.CButtonColumn',
			'template'=>'{update} {delete}',
		),
	),
));?>

<div class="row">
	<div class="col-md-4">
		<ul class="list-group">
		<?php foreach($counts as $category=>$count):?>
			<li class="list-group-item">
				<span class="badge"><?php echo $count;?></span>
				<?php echo Food::categoryLabel($category);?>
			</li>
		<?php endforeach;?>
		</ul>
	</div>
</div>
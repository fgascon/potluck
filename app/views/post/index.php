
<?php echo CHtml::link("Ajouter un post", array('create'), array('class'=>'btn btn-default'));?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>new CActiveDataProvider('Post'),
	'itemsCssClass'=>'table table-striped',
	'columns'=>array(
		'name',
		'created_at',
		'position',
		array(
			'class'=>'zii.widgets.grid.CButtonColumn',
			'template'=>'{update} {delete}',
		),
	),
));?>
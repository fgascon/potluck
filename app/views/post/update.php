
<div class="row">
	<?php $this->renderPartial('_form', array('model'=>$model));?>
</div>

<h3>Commentaires</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>new CActiveDataProvider('Comment', array(
		'criteria'=>array(
			'condition'=>'post_id = :post_id',
			'order'=>'id DESC',
			'params'=>array(
				':post_id'=>$model->id,
			),
		),
	)),
	'itemsCssClass'=>'table table-striped',
	'columns'=>array(
		'content',
		'user.name',
		'date_created',
		array(
			'class'=>'zii.widgets.grid.CButtonColumn',
			'template'=>'{update} {delete}',
			'updateButtonUrl'=>'Yii::app()->getController()->createUrl("updateComment", array("id"=>$data->id))',
			'deleteButtonUrl'=>'Yii::app()->getController()->createUrl("deleteComment", array("id"=>$data->id))',
		),
	),
));?>
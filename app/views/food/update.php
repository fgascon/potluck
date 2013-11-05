<?php
$users = User::model()->findAll(array('order'=>'name'));
?>

<div class="form col-lg-8">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'htmlOptions'=>array(
			'role'=>'form',
		),
	));?>
	
	<div class="form-group <?php echo $model->hasErrors('category')?'has-error':'';?>">
		<?php echo $form->label($model,'category', array('class'=>'control-label'));?>
		<?php echo $form->dropDownList($model,'category', Food::categoriesNames(), array('class'=>'form-control', 'prompt'=>'')); ?>
		<?php echo $form->error($model,'category');?>
	</div>
	
	<div class="form-group <?php echo $model->hasErrors('user_id')?'has-error':'';?>">
		<?php echo $form->label($model,'user_id', array('class'=>'control-label'));?>
		<?php echo $form->dropDownList($model,'user_id', CHtml::listData($users, 'id', 'name'), array('class'=>'form-control', 'prompt'=>'')); ?>
		<?php echo $form->error($model,'user_id');?>
	</div>
	
	<div class="form-group <?php echo $model->hasErrors('description')?'has-error':'';?>">
		<?php echo $form->label($model,'description', array('class'=>'control-label'));?>
		<?php echo $form->textField($model,'description', array('class'=>'form-control', 'rows'=>10)); ?>
		<?php echo $form->error($model,'description');?>
	</div>
	
	<button type="submit" class="btn btn-primary">Enregistrer</button>
	<?php echo CHtml::link("Annuler", array('admin/index'), array('class'=>"btn btn-default"));?>
	
	<?php $this->endWidget('CActiveForm');?>
</div>

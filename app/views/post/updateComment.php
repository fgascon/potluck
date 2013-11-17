<div class="form col-lg-8">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'htmlOptions'=>array(
			'role'=>'form',
		),
	));?>
	
	<div class="form-group <?php echo $model->hasErrors('content')?'has-error':'';?>">
		<?php echo $form->label($model,'content', array('class'=>'control-label'));?>
		<?php echo $form->textArea($model,'content', array('class'=>'form-control', 'rows'=>10)); ?>
		<?php echo $form->error($model,'content');?>
	</div>
	
	<button type="submit" class="btn btn-default">Enregistrer</button>
	
	<?php $this->endWidget('CActiveForm');?>
</div>


<section id="section-posts" class="container container-narrow">
	<?php foreach($posts as $post):?>
	<article class="post">
		<?php echo $post->content;?>
		<hr class="hidden">
		<div class="comments hidden">
			
		</div>
		<form class="new-comment hidden" method="post" action="<?php echo $this->createUrl('comment/post');?>">
			<textarea name="[Comment]content"></textarea>
		</form>
	</article>
	<?php endforeach;?>
</section>

<?php Yii::app()->clientScript->registerPackage('jquery')->registerScriptFile($this->assets.'/js/app.js');?>
<script>
App.endpoint = "<?php echo Yii::app()->request->baseUrl;?>";
jQuery(function($){
	App.initComments($('.new-comment'));
});
</script>
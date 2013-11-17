
<section id="section-posts" class="container container-narrow">
	<?php foreach($posts as $post):?>
	<article class="post">
		<?php echo $post->content;?>
		<hr>
		<div class="comments" data-post-id="<?php echo $post->id;?>">
			<a href="#" class="show-comments">
				<?php if($post->commentsCount == 0):?>
					Aucun commentaire
				<?php elseif($post->commentsCount == 1):?>
					1 commentaire
				<?php else:?>
					<?php echo $post->commentsCount;?> commentaires
				<?php endif;?>
			</a>
			<div class="comments-list"></div>
			<form class="new-comment" method="post" action="<?php echo $this->createUrl('comments/create', array('post_id'=>$post->id));?>">
				<strong><small>Écrire un commentaire:</small></strong>
				<div class="errors"></div>
				<textarea name="content"></textarea>
			</form>
		</div>
	</article>
	<?php endforeach;?>
</section>

<?php Yii::app()->clientScript->registerPackage('jquery')->registerScriptFile($this->assets.'/js/app.js');?>
<script>
App.endpoint = "<?php echo Yii::app()->request->baseUrl;?>";
jQuery(function($){
	App.initComments($('.comments'));
});
</script>
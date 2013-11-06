
<section id="section-posts" class="container container-narrow">
	<?php foreach($posts as $post):?>
	<article class="post">
		<?php echo $post->content;?>
		<hr>
		<div class="comments">
			
		</div>
	</article>
	<?php endforeach;?>
</section>
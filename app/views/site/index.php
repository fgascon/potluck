
<section id="section-posts" class="container container-narrow">
	<?php foreach($posts as $post):?>
	<article class="post well">
		<?php echo $post->content;?>
	</article>
	<?php endforeach;?>
</section>
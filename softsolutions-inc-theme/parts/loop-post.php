<a href="<?php the_permalink(); ?>" class="blog-section__item blog-card">
	<div  class="blog-card__image _anim-items">
		<?php the_post_thumbnail('full') ?>
	</div>
	<div class="blog-card__title"><?php the_title(); ?></div>
	<div class="blog-card__text">
		<p><?php do_excerpt(get_the_content(), 50); ?></p>
	</div>
</a>

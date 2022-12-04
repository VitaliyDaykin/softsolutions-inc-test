<section class="featured-works">
	<div class="featured-works__container _container">
		<div class="featured-works__title title-posts">
			<?php the_field('feat_title'); ?>
		</div>
		<div class="featured-works__items works">

			<?php
			$featuredWork = get_field('featured_work');
			$link_site = the_field('work_link');
			$worksArgs = array(
				'post_type' => 'vd-work',
				'posts_per_page' => -1,
				'post__in' => $featuredWork

			);
			$works = new WP_Query($worksArgs); ?>
			<?php if ($works->have_posts()) : ?>
				<?php while ($works->have_posts()) : $works->the_post(); ?>
					<article class="works__item">
						<a href="<?php the_field('work_link'); ?>" class="works__image _ibg _anim-items" target="_blank">
							<?php the_post_thumbnail('work-skrin') ?>
						</a>
						<div class="works__body _anim-items">
							<a href="<?php the_field('work_link'); ?>" target="_blank" class="works__title"><?php the_title(); ?></a>
							<div class="works__info">
								<div class="works__year"><?php the_field('work_year'); ?></div>
								<div class="works__category">
									<?php the_field('work_technology'); ?>
								</div>
							</div>
							<div class="works__text text">
								<?php the_field('work_вescription'); ?>
							</div>
						</div>
					</article>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>

		</div>
	</div>
</section>

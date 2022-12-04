<?php

/**
 * Archive
 *
 * Standard loop for the archive page
 */
get_header(); ?>

<main class="page">
	<div class="page__container">

		<h2 class="works__main-title title"><?php echo get_the_archive_title(); ?></h2>
		<div class="works__items">
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$pageWorksArgs = array(
				'paged' => $paged,
				'post_type' => 'vd-work',
				'posts_per_page' => 5,
				'orderby' => '',
				'order'   => 'ASC',
			);
			$pageWorks = new WP_Query($pageWorksArgs); ?>
			<?php if ($pageWorks->have_posts()) : ?>
				<?php while ($pageWorks->have_posts()) : $pageWorks->the_post(); ?>

					<article class="works__item">
						<a href="<?php the_field('work_link'); ?>" class="works__image _ibg" target="_blank">
							<?php the_post_thumbnail('work-skrin') ?>
						</a>
						<div class="works__body">
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

				<?php endwhile;
				$total_pages = $pageWorks->max_num_pages;

				if ($total_pages > 1) {

					$current_page = max(1, get_query_var('paged'));

					echo paginate_links(array(
						'base' => get_pagenum_link(1) . '%_%',
						'format' => '/page/%#%',
						'current' => $current_page,
						'total' => $total_pages,
						'prev_text'    => __('« prev'),
						'next_text'    => __('next »'),
					));
				}
				?>

				<?php wp_reset_postdata(); ?>
			<?php endif; ?>

		</div>

	</div>
</main>

<?php get_footer(); ?>

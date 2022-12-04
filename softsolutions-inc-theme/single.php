<?php

/**
 * Single
 *
 * Loop container for single post content
 */

get_header(); ?>

<main class="page">
	<section class="single-page">
		<div class="single-page__container">

			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<h1 class="single-page__title title"><?php the_title(); ?></h1>
					<div class="single-page__image">
						<?php the_post_thumbnail('full') ?>
					</div>
					<div class="single-page__text">
						<?php the_content(); ?>
					</div>

					<div class="single-page__meta"><?php echo sprintf(__('Written by %s  %s  %s ',  'default'), get_the_author_meta('display_name'), get_avatar(get_the_author_meta('ID'), 40), get_the_time(get_option('date_format'))); ?></div>


				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
